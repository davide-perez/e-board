<?php
/**
* Queries the content for the homepage coverflow (data is then fetched via AJAX)
*/
require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();


	$sql = "SELECT title, link FROM ad AS a INNER JOIN image AS i ON a.ad_id = i.ad_id";
	$result = mysqli_query($conn, $sql);

	$data = array();
	while($res = mysqli_fetch_assoc($result)){
		$a = array($res["title"], $res["link"]);

		array_push($data, $a);
	}

	echo json_encode($data);

?>