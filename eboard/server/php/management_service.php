<?php
	//think of an additional control to check if the request really comes from an user logged in as admin
	session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

    $db = new ConnectionFactory();
    $conn = $db -> get_connection();

    $id = $_POST['idVal'] or $_REQUEST['idVal'];
    $command = $_POST['command'] or $_REQUEST['command'];

    switch($command){

    	case "revoke":
    		revoke($conn, $id);
    	break;
    	case "approve":
    		approve($conn, $id);
    	break;
    	case "reject":
    		reject($conn, $id);
    	break;
    	default:
    		echo "Unknown command.";
    	break;
    }


    

///ADD DATE WHEN MANIPULATING



    function approve($conn, $id){

		$stmt = $conn -> prepare("UPDATE ad SET status = 1 WHERE ad_id=?");
		if($stmt === FALSE){
			echo $conn -> error;
		}
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		


    }


    function revoke($conn, $id){

		$stmt = $conn -> prepare("UPDATE ad SET status = 2 WHERE ad_id=?");
		if($stmt === FALSE){
			echo $conn -> error;
		}
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		


    }



    function reject($conn, $id){

		$stmt = $conn -> prepare("UPDATE ad SET status = 3 WHERE ad_id=?");
		if($stmt === FALSE){
			echo $conn -> error;
		}
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		


    }





?>