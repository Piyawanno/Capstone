<?php
require_once("config.php");

function getHandler(){
	return new SQLite3(SQLITE_LOCATION);
}
?>