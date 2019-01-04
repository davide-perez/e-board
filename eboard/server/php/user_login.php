<?php
/**
* Queries the content for the homepage coverflow (data is then fetched via AJAX)
*/

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();
	$username = $_POST["inputUsername"];
	$pwd = $_POST["inputPassword"];




	$stmt = mysqli_prepare($conn, "SELECT * FROM standard_user WHERE username = ? AND password = ?");
	mysqli_stmt_bind_param($stmt, "ss", $username, $pwd);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	
	if ($result -> num_rows === 0) {echo '<script>document.location.href=""</script>';}
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
		echo '<script>document.location.href="/eboard/eboard/public/userPanel.php"</script>';

	}

	$stmt->close();
	$conn->close();


?>