from flask import Flask
from jinja2 import Template
from datetime import datetime
from faker import Faker

from model.Student import Student
from util import readConfig, readTemplate, connectDB

import json

app = Flask(__name__)

@app.route("/data")
def getData():
	# List
	# Dict
	# int
	# float
	# str
	data = [
		123, 'abcde', 20.56, datetime.now().strftime('%Y-%m-%d')
	]
	dumped = json.dumps(data)
	print(type(data))
	print(type(dumped))
	return dumped

@app.route("/")
def renderIndex():
	config = readConfig()
	rootURL = config["rootURL"]
	form = readTemplate('SPAForm.html')
	template = readTemplate("index.html")
	return template.render(
		rootURL=rootURL,
		form=form.render(),
	)

@app.post("/insertMPA")
def insertMPA():
	from flask import request
	import pprint
	pprint.pprint(dict(request.form))
	config = readConfig()
	dataPath = config['dataPath']
	cursor = connectDB(dataPath)
	student = Student().fromDict(dict(request.form))
	student.insert(cursor)
	return "INSERT MPA"

@app.route("/getStudent")
def getStudent():
	from typing import List
	config = readConfig()
	dataPath = config['dataPath']
	cursor = connectDB(dataPath)
	cursor.execute("SELECT * FROM student")
	result: List[Student] = []
	while True:
		raw = cursor.fetchone()
		if raw is None: break
		student = Student().fromDict(raw)
		student.register()
		result.append(student)
	return [i.toDict() for i in result]


if __name__ == '__main__':
	app.run(host='localhost', port=8080)