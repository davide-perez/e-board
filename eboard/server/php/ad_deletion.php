<?php
  session_start();

  require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

  $db = new ConnectionFactory();
  $conn = $db -> get_connection();

  if(isset($_POST["ad_id"])){

  	$ad_id = $_POST["ad_id"];

  }

  $stmt = $conn->prepare("DELETE FROM ad WHERE ad_id = ? AND user_id = ?");
  mysqli_stmt_bind_param($stmt, "ii", $ad_id, $_SESSION["LOGIN"]);

  
  if($stmt->execute()){

  	echo "Ad deleted succesfully!";

  }
  else{

  	echo "Error while deleting the ad from database.";

  }

?>