<?php

require_once 'vendor/autoload.php';

class Student{
	function __construct(){
		$this->firstName = "";
		$this->lastName = "";
		$this->email = "";
		$this->birthDate = NULL;
	}

	function generate(){
		$faker = Faker\Factory::create();
		$this->firstName = $faker->name();
		$this->lastName = $faker->name();
		$this->email = $faker->email();
		$this->birthDate = $faker->dateTime();
	}

	function prepareInsert($handler){
		$query = "INSERT INTO Student(firstName, lastName, email, birthDATE) VALUES(:firstName, :lastName, :email, :birthDate);";
		$statement = $handler->prepare($query);
		return $statement;
	}

	function bindInsert($statement){
		$statement->bindValue(':firstName', $this->firstName, SQLITE3_TEXT);
		$statement->bindValue(':lastName', $this->lastName, SQLITE3_TEXT);
		$statement->bindValue(':email', $this->email, SQLITE3_TEXT);
		$statement->bindValue(':birthDate', $this->birthDate->format('Y-m-d H:i:s'), SQLITE3_TEXT);
	}
}
?>