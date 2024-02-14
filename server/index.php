<?php
require_once("config.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Server Side Page</title>
		<style>
		</style>
		<script>
			document.addEventListener("DOMContentLoaded", function(event) {
				console.log("Hello World.");
			});
		</script>
		<link rel="stylesheet" type="text/css" href="<?=ROOT_URL?>style/Responsive.css" />
	</head>
	<body>
		<h1>This is the Header.</h1>
		<div id="button">click me</div>
	</body>
</html>