from flask import Flask
from datetime import datetime

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

if __name__ == '__main__':
	app.run(host='localhost', port=8080)