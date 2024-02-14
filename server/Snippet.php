<?php
require_once("config.php");
require_once("DataFetcher.php");
?>

<script src="<?=ROOT_URL?>lib/Util.js"></script>
<link rel="stylesheet" type="text/css" href="<?=ROOT_URL?>style/Responsive.css" />

<style>
	#button{
		padding:5px 15px;
		background:red;
		color:white;
		border-radius:5px;
		cursor:pointer;
		width:240px;
	}
</style>

<script>
	const ROOT_URL = "http://localhost/CAPSTONE/";
	async function renderStudent(){
		let studentList = await fetchStudent();
		let list = document.getElementById("studentList");
		for(let student of studentList){
			let item = document.createElement('li');
			item.innerHTML = `${student.firstName} ${student.lastName} (${student.email})`;
			list.append(item);
		}
	}

	async function renderCourse(){
		let courseList = await fetchCourse();
		let list = document.getElementById("courseList");
		for(let course of courseList){
			let item = document.createElement('li');
			item.innerHTML = `<b>${course.name}</b> ${course.description}`;
			list.append(item);
		}
	}

	async function fetchStudent(){
		let response = await fetch(`${ROOT_URL}/DataFetcher.php?table=Student`);
		let studentList = await response.json();
		console.log(studentList);
		return studentList;
	}
	
	async function fetchCourse(){
		let response = await fetch(`${ROOT_URL}/DataFetcher.php?table=Course`);
		let courseList = await response.json();
		console.log(courseList);
		return courseList;
	}

	function countDown(){
		let count = 1;
		let refreshIntervalId = setInterval(() => {
			if(count >= 5){
				clearInterval(refreshIntervalId);
			}
			let message = document.getElementById("countDown");
			message.innerHTML = `Waiting for student ${5-count}s`;
			count += 1;
		}, 1_000);
		
	}

	document.addEventListener("DOMContentLoaded", function(event) {
		let button = document.getElementById("button");
		button.onclick = () => {
			console.log("click");
		}
		console.log("Hello World.");
		renderStudent();
		renderCourse();
		countDown();
	});
</script>


<a href="OtherSide.php">Other Side</a>
<p id="countDown"></p>
<ul id="studentList"></ul>
<ul id="courseList"></ul>
<ul>
<?php
	$fetcher = new DataFetcher();
	$fetcher->connect();
	$studentList = $fetcher->getStudent();
	foreach($studentList as &$student){
		echo("<li>".$student['firstName']." ".$student['lastName']." (".$student['email']."</li>");
	}
?>
</ul>

<div id="boxContainer">
	<div class="box" style="background:red;"></div>
	<div class="box" style="background:white;"></div>
	<div class="box" style="background:green;"></div>
	<div class="box" style="background:blue;"></div>
</div>