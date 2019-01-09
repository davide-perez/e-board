
<?php
//some kind of clientside validation on the name of the file uploaded is required. There is no guarantee that a file will have a name with structure filename.ext, it could also be something like file.name.something.ext and it will not be validated in this case

//also (and importantly) validate the $fname parameter to see if its valid and if it already exists! otherwise, overwriting is possible


/**
* This class is responsible for validating and loading images that have been uploaded via POST, and are located in
* the $_FILES supervariable.
*
* Usage:
* -Create an instance of the class. 1st arg: the value of the name attribute of the html input element used to send the file
*  2nd arg: the name under which you want to save the file (just filename, folder is already set)
* -Call do_upload() function and check its return value. If it returns true, then upload was successful. If it returns false,
* an error has occured and image was not uploaded. Check the error by calling error_status.
**/
class ImageLoader{
	
	/**
	* The name as used in the attribute of the related html input element.
	*/
	private $imgname; //will be used as $_FILES[$imgname]
	private $dest_dir; //read from config.ini ?
	private $fname; //given by user
	private $new_path = NULL;



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
				$this -> new_path = $dest;
			}

		}

		return $this -> status == 0;

	}



	public function get_status(){

		return $this -> $status_map[$this -> status];

	}



	public function get_path(){
		return $this -> new_path === NULL ? '' : $this -> new_path;
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