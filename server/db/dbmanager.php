<?php

require "dbconnection.php";
require "dbexecutor.php";

	$db = new DatabaseConnection();
	$exec = new QueryExecutor($db);

	$query = "insert into standard_user (name, surname, username, password) values(pathos, pathos, pathos, pathos)";

	$exec -> query($query);

?>