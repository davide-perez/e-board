<?php

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();
	session_start();

	// get all the inputs from insertion
	$cat = $_POST["category"];
	$title = $_POST["title"];
	$descr = $_POST["description"];

	$today = getdate();
	$published =  $today["year"] . "-" . $today["mon"] . "-" . $today["mday"];
	$until = $today["year"] . "-" . ($today["mon"] + 1) . "-" . $today["mday"];


	// insert ad in database
	$insert = mysqli_prepare($conn, "INSERT INTO ad (title, category, ad_text, status, date_published, 		date_until, user_id) VALUES (?, ?, ?, 2, ?, ?, ?)");
	mysqli_stmt_bind_param($insert, "ssssss", $title, $cat, $descr, $published, $until, $_SESSION["LOGIN"]);
	mysqli_stmt_execute($insert);




	

	$insert->close();
	$conn->close();



?>