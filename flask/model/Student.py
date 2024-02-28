from datetime import datetime
from faker import Faker

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

if __name__ == '__main__':
	# pretty print
	import pprint
	student = Student()
	print(student)
	faker = Faker()
	student.generate(faker)
	pprint.pprint(student.toDict())

