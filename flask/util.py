from jinja2 import Template
from typing import Dict, Any

import json, sqlite3

def connectDB(path: str) -> sqlite3.Connection:
	connection = sqlite3.connect(path, isolation_level=None, check_same_thread=False)
	return connection.cursor()

def readConfig() -> Dict[str, Any]:
	with open('config.json') as fd :
		config = json.load(fd)
	return config

def readTemplate(templateName: str) -> Template:
	with open(f'template/{templateName}') as fd:
		content = fd.read()
	return Template(content)

if __name__ == '__main__':
	cursor = connectDB("DATA.sqlite.bin")
	print("Database is connected.")
	with open('TABLE.sql') as fd:
		cursor.execute(fd.read())
	print("Table is created.")