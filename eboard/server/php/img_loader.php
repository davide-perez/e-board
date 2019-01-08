
<?php
//some kind of clientside validation on the name of the file uploaded is required. There is no guarantee that a file will have a name with structure filename.ext, it could also be something like file.name.something.ext and it will not be validated in this case

//also (and importantly) validate the $fname parameter to see if its valid and if it already exists! otherwise, overwriting is possible

class ImageLoader{
	

	private $imgname; // $_FILES["imgToUpload"] or "imgToUpload"? Second one looks better
	private $dest_dir; //read from config.ini
	private $fname; //given by user



	private $status = 0;
	private $status_map = array('ok', 'not_an_img', 'unsupported', 'out_of_size', 'already_existent', 'non_existent_dir', 'non_writable_dir', 'unable_to_upload');
	private $accepted = array('gif', 'png', 'jpeg', 'jpg');
	private $size_limit = 2097152; //bytes = 2M


	function __construct($image, $filename){

		$this -> dest_dir = $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/resources/ads/images/";

		if(!$this -> is_img($image)){
			echo $image . ' is not an image file.';
			$this -> status = 1;

		}
		else if(!$this -> is_supported($image)){
			echo $image . ' has an unsupported extension.';
			$this -> status = 2;
		}
		else if(!$this -> is_in_sizebound($image)){

			echo $image . ' exceeds the size limit.';
			$this -> status = 3;


		}
		else if(file_exists($image)){

			echo $image . ' already exists in the directory ' . $this -> dest_dir;
			$this -> state = 4;

		}
		else if(!is_dir($this -> dest_dir)){

			echo $this->dest_dir . ' does not exist or is not a directory.';
			$this -> status = 5;

		}
		else if(!is_writable($this -> dest_dir)){

			echo $this->dest_dir . ' is not writable.';
			$this -> status = 6;

		}
		else{
			$this -> imgname = $image; 
		}

		//validate filename too
		$this -> fname = $filename;

	}


	public function do_upload(){

		if($this -> status == 0){
			$parts = explode(".", $_FILES[$this -> imgname]["name"]);
			$newfilename = $this -> fname . '.' . end($parts);
			$dest = $this -> dest_dir . $newfilename;

			if(!move_uploaded_file($_FILES[$this -> imgname]["tmp_name"], $dest)){
				$this -> status = 7;
			}
			else{
				echo "UPLOAD COMPLETE!";
			}

		}
		//true if its all right, error code otherwise (or better: ret false, option to check what happened by calling something such as "get error code". Check mysql to see how they do it)
		return $this -> status == 0;

	}



	public function get_status(){

		return $this -> $status_map[$this -> status];

	}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	private function is_img($img){

		$test = is_uploaded_file($_FILES[$img]["tmp_name"]) 
		   and $_FILES[$img]['error'] > 0;


		return $test;

	}


	private function is_supported($img){

		$target = $this -> dest_dir . basename($_FILES[$img]["name"]);
		$ext = strtolower(pathinfo($target,PATHINFO_EXTENSION));
		return in_array($ext, $this -> accepted);

	}


	private function is_in_sizebound($img){

		return $_FILES[$img]["size"] <= $this -> size_limit;

	}




	






}

?>