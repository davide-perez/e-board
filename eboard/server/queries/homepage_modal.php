<?php
/**
* Queries the content for the homepage coverflow (data is then fetched via AJAX)
*/

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();
	$ad_id = $_POST['ad_id'];


	$stmt = $conn->prepare("SELECT title, ad_text, link, date_published, username, mail, phone FROM ad AS a INNER JOIN image AS i ON a.ad_id = i.ad_id AND a.ad_id = ? INNER JOIN standard_user AS s ON a.user_id = s.user_id" );

    $stmt->bind_param('s', $ad_id);
    

    $stmt->execute();


    $result = $stmt->get_result();

    $row = $result -> fetch_assoc();

	$data = array();
	
	


	$gallery = $conn->prepare("SELECT link FROM image_gallery WHERE ad_id = ?" );
    $gallery->bind_param('s', $ad_id);


    $gallery->execute();
    $resultGallery = $gallery->get_result();
    $images = '';
    if ($resultGallery -> num_rows != 0) {
      	$hasGallery = "true";
      	while($myimage = mysqli_fetch_row($resultGallery)) {
        	$images = $images . " " . $myimage[0];
      	}
      	$images = trim($images);
    }
    else
      	$hasGallery = "false";

    $obj = create_obj($row, $images, $hasGallery);
	array_push($data, $obj);
	


	echo json_encode($data);






	/**
	* Creates an array representing the object that will be read
	*/
	function create_obj($res, $images, $hasGallery){
		
		 return array("title" => $res["title"], "description" => $res["ad_text"], "image" => $res["link"], "date" => $res["date_published"], "username" => $res["username"], "mail" => $res["mail"], "phone" =>$res["phone"], "gallery" => $images, "hasGallery" => $hasGallery);

	}


?>