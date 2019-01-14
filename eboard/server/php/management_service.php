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
            //$interval = $_POST['interval'] or $_REQUEST['interval'];
    		approve($conn, $id);
    	break;
    	case "reject":
    		reject($conn, $id);
    	break;
        case "restore":
            restore($conn, $id);
    	break;
        case "delete":
            delete($conn, $id);
        break;
        case "delete_all":
            delete_all($conn);
        break;
        default:
    		echo "Unknown command.";
    	break;
    }


    

///ADD DATE WHEN MANIPULATING

//pending -> approved
    function approve($conn, $id){

		$stmt = $conn -> prepare('UPDATE ad SET status = 1, date_published = CURDATE(), date_until = DATE_ADD(CURDATE(), INTERVAL 1 MONTH) WHERE ad_id=? AND status = 2');
		if($stmt === FALSE){
			echo $conn -> error;
		}
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		


    }

 

//approved -> pending

    function revoke($conn, $id){

		$stmt = $conn -> prepare("UPDATE ad SET status = 2 WHERE ad_id=? AND status = 1");
		if($stmt === FALSE){
			echo $conn -> error;
		}
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		


    }



//pending -> rejected
    function reject($conn, $id){

		$stmt = $conn -> prepare("UPDATE ad SET status = 3 WHERE ad_id=? AND status = 2");
		if($stmt === FALSE){
			echo $conn -> error;
		}
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		


    }



//rejected -> pending ; outdated -> pending
    function restore($conn, $id){

        $stmt = $conn -> prepare("UPDATE ad SET status = 2 WHERE ad_id=? AND (status = 3 OR status = 4)");
        if($stmt === FALSE){
            echo $conn -> error;
        }
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        


    }



//outdated -> null ; rejected -> null
    function delete($conn, $id){

        $stmt = $conn -> prepare("DELETE FROM ad WHERE ad_id=? AND (status = 3 OR status = 4)");
        if($stmt === FALSE){
            echo $conn -> error;
        }
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        


    }



//when clicking a trashcan button
    function delete_all($conn){

        $stmt = $conn -> prepare("DELETE FROM ad WHERE status = 3");
        if($stmt === FALSE){
            echo $conn -> error;
        }
        mysqli_stmt_execute($stmt);
    }



    //function outdate: implemented as a periodic database event 


    //function delete_all: implement it periodically also?





?>