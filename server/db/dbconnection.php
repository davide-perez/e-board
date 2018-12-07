<?php

	/**
	 * This class is responsible to set up a PERSISTENT database connection. Credentials are read from a config file.
	 */

	//TODO: limit accss to database credentials from outside classes
	//TODO add log facility
	class DatabaseConnection{

		private $connection;
		private $credentials; 
		private $start_time;
		private $end_time;
		private $open = false;
		
		function __construct(){

			$this -> credentials = $this->read_config();
	
			$host = $this -> credentials["host"];
			$user = $this -> credentials["user"];
			$password = $this -> credentials["password"];
			$database = $this -> credentials["database"];

			$this -> connection = mysqli_connect("host=$host dbname=$database user=$user password=$password");

			if ($this -> connection == null){

				error_log("Unable to connect to database $database !", 3, $_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/log/log.txt");
				throw new DatabaseException("Unable to connect to database $database.");
			}
			else{

				$this -> open = true;
				$this -> start_time = date("m/d/Y h:i:s a"); //UNIX timestamp
				print "Connection established at time " . $this-> start_time . "<br>";

			}
			
		}


		function __destruct(){
			
			$this -> close();
		}


		private function read_config(){

			return parse_ini_file("config.ini");

		}


		public function close(){

			if($this -> open){

				if(mysqli_close($this->connection)){
					$this -> open = false;
					$this -> end_time = date("m/d/Y h:i:s a");
					//log this
					echo "Connection to the database has been closed at time " . $this-> end_time;
					

				}
				else{

					throw new DatabaseException("Error closing the database.");
					
				}
			}
			else{

				throw new DatabaseException("Connection already closed.");

			}
		}



		public function is_open(){

			return ($this -> open) == true;

		}


		public function get_socket(){
			return $this -> connection;
		}

	}

?>