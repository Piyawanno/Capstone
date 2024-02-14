<?php
require_once("config.php");
require_once("Util.php");
require_once("Student.php");
require_once("Course.php");


class DataFetcher{
	function fetch(){
		$table = $_GET['table'];
		$this->connect();
		$result = [];
		if($table == 'Student') $result = $this->getStudent();
		else if($table == 'Course') $result = $this->getCourse();
		echo(json_encode($result));
	}

	function connect(){
		$this->handler = getHandler();
	}

	function getStudent(){
		$query = "SELECT id, firstName, lastName, email, birthDATE FROM Student";
		$statement = $this->handler->query($query);
		$result = array();
		while($row = $statement->fetchArray(SQLITE3_ASSOC)){
			$result[] = $row;
		}
		sleep(5);
		return $result;
	}

	function getCourse(){
		$query = "SELECT id, name, description, startDate, endDate FROM Course";
		$statement = $this->handler->query($query);
		$result = array();
		while($row = $statement->fetchArray(SQLITE3_ASSOC)){
			$result[] = $row;
		}
		return $result;
	}
	
	function getHandler(){
	
	}
}

if (get_included_files()[0] == __FILE__) {
	$fetcher = new DataFetcher();
	$fetcher->fetch();	
}
?>