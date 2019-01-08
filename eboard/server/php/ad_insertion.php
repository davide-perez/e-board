<?php

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";
require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/php/img_loader.php";
/*
	$db = new ConnectionFactory();
	$conn = $db -> get_connection();
	session_start();

	// get all the inputs from insertion
	$cat = $_POST["category"];
	$title = $_POST["title"];
	$descr = $_POST["description"];
	

	switch ($cat) {
    case "For rent":
        $cat = "rentals";
        break;
    case "Jobs":
        $cat = "jobs";
        break;
    case "Items for sale":
        $cat = "itemsale";
        break;
    case "Events":
        $cat = "events";
    break;
    case "Lectures":
        $cat = "lectures";
    break;
    case "Other":
        $cat = "others";
    break;
	}

	$today = getdate();
	$published =  $today["year"] . "-" . $today["mon"] . "-" . $today["mday"];
	$until = $today["year"] . "-" . ($today["mon"] + 1) . "-" . $today["mday"];


	// insert ad in database
	$insert = mysqli_prepare($conn, "INSERT INTO ad (title, category, ad_text, status, date_published, 		date_until, user_id) VALUES (?, ?, ?, 2, ?, ?, ?)");
	mysqli_stmt_bind_param($insert, "ssssss", $title, $cat, $descr, $published, $until, $_SESSION["LOGIN"]);
	mysqli_stmt_execute($insert);




	

	$insert->close();
	$conn->close();
*/

/*WORKS
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/resources/ads/images"; //move to config.ini
$target_file = $target_dir . basename($_FILES["imgToUpload"]["name"]);
$uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imgToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 0;
    } else {
        echo "File is not an image.";
        $uploadOk = 1;
    }
}
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["imgToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["imgToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["imgToUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
*/




$uploader = new ImageLoader("imgToUpload", "babajaga");
if($uploader -> do_upload()){

	echo "yes";
}
else{

	echo "nope";


}


?>
