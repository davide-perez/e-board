<?php
/**
* User login
*/

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();
	$username = $_POST["inputUsername"];
	$pwd = md5($_POST["inputPassword"]);

	// first control if it is an admin

	$stmt_admin = mysqli_prepare($conn, "SELECT * FROM moderator WHERE username = ? AND password = ?");
	mysqli_stmt_bind_param($stmt_admin, "ss", $username, $pwd);
	mysqli_stmt_execute($stmt_admin);
	$result_admin = mysqli_stmt_get_result($stmt_admin);
	if($result_admin -> num_rows != 0) {
		session_start();
		$_SESSION["LOGIN_ADMIN"] = "true";
		echo "admin";
	} 

	else {

	$stmt = mysqli_prepare($conn, "SELECT * FROM standard_user WHERE username = ? AND password = ?");
	mysqli_stmt_bind_param($stmt, "ss", $username, $pwd);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	
	if ($result -> num_rows === 0) {echo 'mistake';}
	else {

		$row = $result -> fetch_assoc();
		$user_id = $row["user_id"];

		session_start();
		$_SESSION["LOGIN"] = $user_id;
		$_SESSION["USERNAME"] = $username;
		$_SESSION["NAME"] = $row["name"];
		$_SESSION["SURNAME"] = $row["surname"];
		$_SESSION["MAIL"] = $row["mail"];
		$_SESSION["PHONE"] = $row["phone"];
		echo 'correct';

	}
	$stmt->close();
}

	
	$conn->close();


?>