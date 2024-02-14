<?php
require_once("config.php");
require_once("Util.php");
require_once("Student.php");
require_once("Course.php");

class DataGenerator{
	function generate(){
		$this->handler = getHandler();
		$this->generateStudent();
		$this->generateCourse();
	}

	function generateStudent(){
		$studentList = array();
		for($i=0;$i<20;$i++){
			$student = new Student();
			$student->generate();
			$statement = $student->prepareInsert($this->handler);
			$student->bindInsert($statement);
			$statement->execute();
			$studentList[] = $student;
		}
		print_r($studentList);
	}

	function generateCourse(){
		$courseList = array();
		for($i=0;$i<5;$i++){
			$course = new Course();
			$course->generate();
			$statement = $course->prepareInsert($this->handler);
			$course->bindInsert($statement);
			$statement->execute();
			$courseList[] = $course;
		}
		print_r($courseList);
	}
}
if (get_included_files()[0] == __FILE__) {
	$generator = new DataGenerator();
	$generator->generate();
}
?>