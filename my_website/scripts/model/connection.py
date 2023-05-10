import os
from dotenv import load_dotenv
import mysql.connector

load_dotenv()

config = {
  'user': os.getenv('DB_USERNAME'),
  'password': os.getenv('DB_PASSWORD'),
  'host': os.getenv('DB_HOST'),
  'database': os.getenv('DB_NAME')
}

class DB:
    __instance = None

    @staticmethod
    def getInstance():
        if DB.__instance == None:
            DB()
        return DB.__instance

    def __init__(self):
        if DB.__instance != None:
            raise Exception("This class is a singleton!")
        else:
            self.cnx = mysql.connector.connect(**config)
            self.cursor = self.cnx.cursor()
            DB.__instance = self

    def close(self):
        self.cursor.close()
        self.cnx.close()
