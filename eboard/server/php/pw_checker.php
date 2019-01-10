<?php
/**
* Control the old password
*/

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();
	$password = md5($_POST["oldpw"]);
	$newPW = md5($_POST["inputPassword"]);
	$user_id = $_POST["user_id"];
	

	$stmt = mysqli_prepare($conn, "SELECT * FROM standard_user WHERE user_id = ? AND password = ?");
	mysqli_stmt_bind_param($stmt, "ss", $user_id, $password);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	
	if ($result -> num_rows === 0) {echo 'not_existing';}
	else {
		$modify = mysqli_prepare($conn, "UPDATE standard_user SET password = ? WHERE user_id = ?");
		mysqli_stmt_bind_param($modify, "ss", $newPW, $user_id);
		mysqli_stmt_execute($modify);
		echo "existing";
	}

	$stmt->close();
	$conn->close();

?>