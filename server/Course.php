<?php

require_once 'vendor/autoload.php';

class Course{
	function __construct(){
		$this->name = "";
		$this->description = "";
		$this->startDate = NULL;
		$this->endDate = NULL;
	}

	function generate(){
		$faker = Faker\Factory::create();
		$this->name = $faker->name();
		$this->description = $faker->text();
		$this->startDate = $faker->dateTime();
		$this->endDate = $faker->dateTime();
	}

	function prepareInsert($handler){
		$query = "INSERT INTO Course(name, description, startDate, endDate) VALUES(:name, :description, :startDate, :endDate);";
		$statement = $handler->prepare($query);
		return $statement;
	}

	function bindInsert($statement){
		$statement->bindValue(':name', $this->name, SQLITE3_TEXT);
		$statement->bindValue(':description', $this->description, SQLITE3_TEXT);
		$statement->bindValue(':startDate', $this->startDate->format('Y-m-d H:i:s'), SQLITE3_TEXT);
		$statement->bindValue(':endDate', $this->endDate->format('Y-m-d H:i:s'), SQLITE3_TEXT);
	}
}
?>