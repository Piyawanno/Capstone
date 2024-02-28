from flask import Flask
from jinja2 import Template
from datetime import datetime
from faker import Faker

from model.Student import Student
from util import readConfig, readTemplate

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
	form = readTemplate('MPAForm.html')
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
	student = Student().fromDict(dict(request.form))
	
	return "INSERT MPA"

@app.route("/getStudent")
def getStudent():
	faker = Faker()
	student = Student()
	student.generate(faker)
	return student.toDict()


if __name__ == '__main__':
	app.run(host='localhost', port=8080)