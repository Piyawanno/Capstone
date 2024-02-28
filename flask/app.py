from flask import Flask
from jinja2 import Template
from datetime import datetime

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
	template = readTemplate("index.html")
	return template.render(rootURL=rootURL)

if __name__ == '__main__':
	app.run(host='localhost', port=8080)