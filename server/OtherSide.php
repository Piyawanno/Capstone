<?php
require_once 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Server Side Page</title>
	</head>
	<body>
		<h1>This is the other side.</h1>
		<p>
			<?php
			$faker = Faker\Factory::create();
			echo($faker->text());
			?>
		</p>
	</body>
</html>