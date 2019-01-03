<?php
/**
* Queries the content for the homepage coverflow (data is then fetched via AJAX)
*/

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();
	$email = $_POST['inputUsername'];
	$pwd = $_POST['inputPassword'];

	




	$sql = "SELECT title, ad_text, link FROM ad AS a INNER JOIN image AS i ON a.ad_id = i.ad_id";
	$result = mysqli_query($conn, $sql);


?>