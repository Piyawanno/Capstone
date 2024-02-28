from datetime import datetime
from faker import Faker
from typing import Dict, Any

import sqlite3

DATE_FORMAT = '%Y-%m-%d'

class Student:
	def __init__(self):
		self.firstName: str = ""
		self.lastName: str = ""
		self.email: str = ""
		self.birthDate: datetime = None
	
	def generate(self, faker: Faker):
		self.firstName = faker.name()
		self.lastName = faker.name()
		self.email = faker.email()
		self.birthDate = faker.date_time()
	
	def toDict(self):
		return {
			'firstName': self.firstName,
			'lastName': self.lastName,
			'email': self.email,
			'birthDate': self.birthDate.strftime(DATE_FORMAT),
		}
	
	def fromDict(self, data: Dict[str, Any]):
		self.firstName = data['firstName']
		self.lastName = data['lastName']
		self.email = data['email']
		self.birthDate = datetime.strptime(data['birthDate'], DATE_FORMAT)
		return self
	
	def register(self):
		print(">>> DO FOO")

	def insert(self, cursor: sqlite3.Connection):
		cursor.execute(
			"INSERT INTO Student(firstName, lastName, email, birthDATE) VALUES(?, ?, ?, ?)",
			[
				self.firstName,
				self.lastName,
				self.email,
				self.birthDate.date(),
			]
		)

if __name__ == '__main__':
	# pretty print
	import pprint
	student = Student()
	print(student)
	faker = Faker()
	student.generate(faker)
	pprint.pprint(student.toDict())

