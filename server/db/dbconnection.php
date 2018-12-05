<?php

	require "dbexception.php";
	/**
	 * This class is responsible to set up the database connection. Credentials are read from a config file.
	 */

	//TODO: limit accss to database credentials from outside
	class DatabaseConnection{

		private $connection;
		private $credentials;
		private $open = false;
		
		function __construct(){

			$this -> credentials = $this->read_config();
	
			$host = $this -> credentials["host"];
			$user = $this -> credentials["user"];
			$password = $this -> credentials["password"];
			$database = $this -> credentials["database"];

			$this -> connection = pg_pconnect("host=$host dbname=$database user=$user password=$password");

			if ($this -> connection == null){

				throw new DatabaseException("Unable to connect to database $database.");
			}
			else{

			$open = true;
			print "Connection established.<br>";

			}
			
		}


		private function read_config(){

			return parse_ini_file("config.ini");

		}


		public function close(){

			if($open){

				if(pg_close($this->connection)){

					echo "Connection to the database has been closed.";
					$open = false;

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





		public function __get($property) {

    		if (property_exists($this, $property)) {

      			return $this->$property;

    		}
  		}

  		public function __set($property, $value) {
    		if (property_exists($this, $property)) {

      			$this->$property = $value;

    		}

    		return $this;
  		}


	}

?>