<?php
/**
* Queries the content for the homepage coverflow (data is then fetched via AJAX)
*/

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();


	$sql = "SELECT title, ad_text, link, a.ad_id FROM ad AS a INNER JOIN image AS i ON a.ad_id = i.ad_id AND a.date_published > CURDATE() - INTERVAL 2 WEEK AND a.status = 1";
	$result = mysqli_query($conn, $sql);

	$data = array();
	while($res = mysqli_fetch_row($result)){
		$obj = create_obj($res);
		array_push($data, $obj);
	}


	echo json_encode($data);






	/**
	* Creates an array representing the object that will be read
	*/
	function create_obj($res){
		//add option to truncate the description if longer than x chars, adding ... at the end (blablablabla...)

		$description = $res[1];
		if(strlen($description) > 50){
			$description = substr($description, 0, 47) . "...";
			$description = str_replace("\\'", "'", $description);
		}
		
		 return array("title" => $res[0], "description" => $description, "image" => $res[2], "id" => $res[3]);

	}


?>