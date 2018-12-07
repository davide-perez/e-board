<?php

require "dbconnection.php";
require "dbexecutor.php";

	$db = new DatabaseConnection();
	$exec = new QueryExecutor($db);

?>