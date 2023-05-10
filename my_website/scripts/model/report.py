from dataclasses import dataclass 

@dataclass
class Report:
    content: str
    file_path: str
    status: str
    
    def Report(self, content, file_path):
        self.content = content.encode('utf-8')
        self.file_path = file_path
    
    def __str__(self) -> str:
        return ','.join((self.status, self.file_path, self.content))
    
    
@dataclass
class SuccessReport(Report):
    status: str = 'SUCCESS'
    
@dataclass
class FailureReport(Report):
    status: str = 'FAILED'