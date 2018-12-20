<?php

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();


	$sql = "SELECT title, ad_text, link FROM ad AS a INNER JOIN image AS i ON a.ad_id = i.ad_id" ; //AND category = "?"
	$result = mysqli_query($conn, $sql);

	$data = array();

	while($res = mysqli_fetch_row($result)){

		array_push($data, $res);

	}


	echo json_encode($data);


?>