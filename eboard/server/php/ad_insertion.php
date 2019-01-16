 <?php
//TODO: refactor code, maybe create two functions (one for uploading ad, one for uploading image) to simplify extension to more images if needed

require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/db/dbconnfactory.php";
require $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/php/img_loader.php";

    session_start();

    function do_upload_multiple($files, $id, $dir){
        $count = 1;
        $names = array();
        foreach($_FILES[$files]['name'] as $filename){

            $curr_fname = 'img' . $id . "-" . $count;
            $parts = explode(".", $filename);
            $newfilename = $curr_fname . '.' . end($parts);
            $dest = $_SERVER['DOCUMENT_ROOT'] . $dir . $newfilename;

            if(!move_uploaded_file($_FILES[$files]['tmp_name'][$count - 1], $dest)){
                echo "Error uploading some file in the gallery" . "<br>";
            }
            else{

                array_push($names, $newfilename);

            }

            $count++;


        }

        return $names;

    }

	$db = new ConnectionFactory();
	$conn = $db -> get_connection();

    $max_uploads = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/config.ini")["max_uploads"];
    $default_dir = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/config.ini")["default_dir"];

    //img6-



	// get all the inputs from insertion
	$cat = $_POST["category"];
	$title = $_POST["title"];
	$descr = $_POST["description"];
    $image = "";
	

	switch ($cat) {
    case "For rent":
        $cat = "rentals";
        $image = "/eboard/eboard/server/resources/ads/images/rentals.jpg";
        break;
    case "Jobs":
        $cat = "jobs";
        $image = "/eboard/eboard/server/resources/ads/images/jobs.jpg";
        break;
    case "Items for sale":
        $cat = "itemsale";
        $image = "/eboard/eboard/server/resources/ads/images/itemsale.jpg";
        break;
    case "Events":
        $cat = "events";
        $image = "/eboard/eboard/server/resources/ads/images/events.jpg";
    break;
    case "Lectures":
        $cat = "lectures";
        $image = "/eboard/eboard/server/resources/ads/images/lectures.jpg";
    break;
    case "Other":
        $cat = "others";
        $image = "/eboard/eboard/server/resources/ads/images/others.jpg";
    break;
	}

	$today = getdate();
	$published =  $today["year"] . "-" . $today["mon"] . "-" . $today["mday"];
	$until = $today["year"] . "-" . ($today["mon"] + 1) . "-" . $today["mday"];


	// insert ad in database
	$insert = mysqli_prepare($conn, "INSERT INTO ad (title, category, ad_text, status, date_published, 	date_until, user_id) VALUES (?, ?, ?, 2, ?, ?, ?)");
    $cleanedDescr = cleanDescr($descr);
    $cleanedTitle = cleanDescr($title);
	mysqli_stmt_bind_param($insert, "ssssss", $cleanedTitle, $cat, $cleanedDescr, $published, $until, $_SESSION["LOGIN"]);
	mysqli_stmt_execute($insert);

    $last_id = mysqli_insert_id($conn);

    $img_only = 0; //will be changed then

    if($_FILES["imgToUpload"]["size"] != 0) {

        $fname = "img" . mysqli_insert_id($conn);
	    $uploader = new ImageLoader("imgToUpload", $fname, false);

        if($uploader -> do_upload()){

            $abspath = $uploader -> get_path();
            $relpath = substr($abspath, strpos($abspath, "/eboard"));
        

    

        $insert_img = "INSERT INTO image (link, image_only, ad_id) VALUES(\"" . $relpath . "\", " . $img_only . " , " . $last_id . ")";

        if($conn -> query($insert_img) === TRUE){

            //echo '<script>document.location.href="/eboard/eboard/public/userPanel.php"</script>';

        }
        else{

            echo "Error inserting image: " . mysqli_error($conn) . "<br>";
        }

    }
    else{

        echo "Error: " . $uploader -> get_status();

    }
}
else {

    $insert_img = "INSERT INTO image (link, image_only, ad_id) VALUES(\"" . $image . "\", " . $img_only . " , " . $last_id. ")";

        if($conn -> query($insert_img) === TRUE){


            //echo '<script>document.location.href="/eboard/eboard/public/userPanel.php"</script>';

        }
        else{

            echo "Error inserting image: " . mysqli_error($conn) . "<br>";
        }
    
    }


if($_FILES['gallery']['size'] != 0){
    if(count($_FILES['gallery']['name']) > $max_uploads){

        throw new Exception("Upload file number per request exceeded.");

    }
    $fnames = do_upload_multiple('gallery', $last_id, $default_dir);
    print_r($fnames);

    foreach ($fnames as $imgname) {
        echo "Iterating on " . $imgname;
        $insert_img = "INSERT INTO imagegallery (link, ad_id) VALUES(\"" . $imgname . "\", " . $last_id . ")";

        $conn -> query($insert_img);
        
    }


}
else{

    //no gallery

}

	
    $insert->close();
	$conn->close();





    


    function cleanDescr($description) {
        $string = str_replace("\n", " ", $description);
        $string = str_replace("\r", " ", $string);
        $string = str_replace("  ", " ", $string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = str_replace("€", " euro", $string);
        $string = str_replace("$", " dollar", $string);
        $string = str_replace("'", "\'", $string);

        return $string;
    }




?>
