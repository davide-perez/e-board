<?php
//TODO: refactor code, maybe create two functions (one for uploading ad, one for uploading image) to simplify extension to more images if needed

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";
require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/php/img_loader.php";

    session_start();
	$db = new ConnectionFactory();
	$conn = $db -> get_connection();

    //img6-



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
	$insert = mysqli_prepare($conn, "INSERT INTO ad (title, category, ad_text, status, date_published, 	date_until, user_id) VALUES (?, ?, ?, 1, ?, ?, ?)");
	mysqli_stmt_bind_param($insert, "ssssss", $title, $cat, $descr, $published, $until, $_SESSION["LOGIN"]);
	mysqli_stmt_execute($insert);

    $fname = "img" . mysqli_insert_id($conn);
	$uploader = new ImageLoader("imgToUpload", $fname);

    if($uploader -> do_upload()){

        $abspath = $uploader -> get_path();
        $relpath = substr($abspath, strpos($abspath, "/eboard"));
        $img_only = 0; //will be changed then


        $insert_img = "INSERT INTO image (link, image_only, ad_id) VALUES(\"" . $relpath . "\", " . $img_only . " , " . mysqli_insert_id($conn) . ")";

        if($conn -> query($insert_img) === TRUE){

            echo "Ad and image inserted succesfully";

        }
        else{

            echo "Error inserting image: " . mysqli_error($conn) . "<br>";
        }

    }
    else{

        echo "Error: " . $uploader -> get_status();

    }


	
    $insert->close();
	$conn->close();





    







?>
