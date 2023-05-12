import hashlib
import pathlib
from scripts.model.connection import DB
from typing import List
import os
from tqdm import tqdm
import datetime
from scripts.model.report import Report, FailureReport, SuccessReport
 
BASE_URL = os.getenv('SITE_URL')
SKIP_DIRS = [".env", "logs", "scripts"]

def notify_warnings(report_file_path: str):
    pass

def write_report(prefix: str, reports: List[Report])-> str:
    if not os.path.exists('logs'):
        os.makedirs('logs')
    current_time = datetime.datetime.now()
    formatted_time = current_time.strftime("%Y-%m-%dT%H:%M:%S")
    file_name = os.path.join('logs',f'{prefix}_{formatted_time}.csv')
    print(f'Exported to {file_name}')
    with open(file_name, 'w') as f:
        for report in reports:
            f.writelines(str(report) + '\n')
    return file_name

def list_files_in_directory(directory: str, skip_dirs):
    items = []
    large_dir = pathlib.Path(directory)
    for item in large_dir.rglob("*"):
        if set(item.parts).isdisjoint(skip_dirs) and not os.path.isdir(item):
            items.append(str(item))
    return items

def get_current_hash(path: str):
    with open(path, 'rb') as f:
        html =  f.read()
        sha256_hash = hashlib.sha256(html).hexdigest()
        return sha256_hash

def get_previous_hash(path: str):
    query = """
        SELECT * FROM tbl_hashed_web_content where file_path = %s"""
    cursor.execute(query, params=[path])
    result = cursor.fetchone()
    print('result', result)
    if result:
        return result[2]
    else:
        return None

def changed_hash_web_content_result(path: str, status: str):
    new_hash = get_current_hash(path)
    query = '''INSERT INTO tbl_hashed_web_content (file_path, hashed_content, result) VALUES (%s, %s, %s) 
                ON DUPLICATE KEY UPDATE hashed_content = %s, result = %s'''
    cursor.execute(query, params=(path, new_hash, status, new_hash, status))
    # print(query % (path, new_hash, status, new_hash, status))
    cnx.commit()
    print(f'Added new hashed content: {new_hash}')
    return new_hash

def try_detect_content_change(reports: List[Report]):
    try:
        flag = True
        for path in tqdm(list_files_in_directory('.', skip_dirs=SKIP_DIRS)):
            current_hash = get_current_hash(path)
            previous_hash = get_previous_hash(path)
            print('==================', previous_hash)
            if not previous_hash:
                print('Cannot get previous_hash, proceed to create new hash')
                previous_hash = changed_hash_web_content_result(path, 'intacted')
                
            if current_hash != previous_hash:
                changed_hash_web_content_result(path, 'changed')
                reports.append(
                    FailureReport(
                        content='Website has been modified, possible deface attack!',
                        file_path=path
                    )
                )
                flag = False
            else:
                reports.append(
                    SuccessReport(
                        content='Website is intact',
                        file_path=path
                    )
                )
        return flag
    except Exception as e:
        raise e

if __name__=='__main__':
    db = DB.getInstance()
    try:
        cursor = db.cursor
        cnx = db.cnx
        reports = []
        is_success = try_detect_content_change(reports)
        report_file_path = write_report('deface_attack_report', reports)
        if not is_success:
            notify_warnings(report_file_path)
    finally:
        db.close()
