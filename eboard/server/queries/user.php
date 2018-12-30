<?php

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();


	$sql = "SELECT title, ad_text, link FROM ad AS a INNER JOIN image AS i ON a.ad_id = i.ad_id AND category = \"lectures\""; 

	$result = mysqli_query($conn, $sql);

	$data = array();
	$serialize = array();
	array_push($serialize, array("category" => "Lectures")); //this will change based on the category selected (which will be given with a post and thus will require parametrization)
	while($res = mysqli_fetch_row($result)){

		$obj = create_obj($res);
		array_push($data, $obj);

	}

	array_push($serialize, array("ads" => $data));
	echo json_encode($serialize);



	/**
	* Creates an array representing the object that will be read
	*/
	function create_obj($res){
		//add option to truncate the description if longer than x chars, adding ... at the end (blablablabla...)

		 return array("title" => $res[0], "description" => $res[1], "image" => $res[2]);

	}


?>