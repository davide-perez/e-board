<?php
/**
* User registration
*/

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();

	$name = ucfirst ( $_POST["inputName"] );
	$surname = ucfirst ( $_POST["inputSurname"] );
	$email = $_POST["inputEmail"];
	$tel = $_POST["inputTel"];
	$username = $_POST["inputUsername"];
	$pw = $_POST["inputPassword"];


	// First, control that email, telephone and username are not already present in the database

	$control = mysqli_prepare($conn, "SELECT user_id FROM standard_user WHERE username = ? OR mail = ? OR phone = ?");
	mysqli_stmt_bind_param($control, "sss", $username, $email, $tel);
	mysqli_stmt_execute($control);
	$result = mysqli_stmt_get_result($control);

	// case they are already present
	if($result -> num_rows > 0) {
		// TODO
		echo "eh no bello così non va bene";
	}

	// case they are not present
	else {

		// now insert the new user in the database and redirect to its profile page
		$insert = mysqli_prepare($conn, "INSERT INTO standard_user (name, surname, username, password, mail, phone) VALUES (?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($insert, "ssssss", $name, $surname, $username, $pw, $email, $tel);
		mysqli_stmt_execute($insert);

		session_start();
		$_SESSION["LOGIN"] = mysqli_insert_id($conn);
		$_SESSION["USERNAME"] = $username;
		$_SESSION["NAME"] = $name;
		$_SESSION["SURNAME"] = $surname;
		$_SESSION["MAIL"] = $email;
		$_SESSION["PHONE"] = $tel;
		echo '<script>document.location.href="/eboard/eboard/public/userPanel.php"</script>';
	}

	










	


?>