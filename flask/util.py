from jinja2 import Template
from typing import Dict, Any
import json

def readConfig() -> Dict[str, Any]:
	with open('config.json') as fd :
		config = json.load(fd)
	return config

def readTemplate(templateName: str) -> Template:
	with open(f'template/{templateName}') as fd:
		content = fd.read()
	return Template(content)