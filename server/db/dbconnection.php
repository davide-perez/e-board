<?php

	/**
	 * This class is responsible to set up the database connection. Credentials are read from a config file.
	 */
	class DatabaseConnection{

		private $connection;
		private $open;
		
		function __construct(){

			$credentials = $this->read_config();
	
			$host = $credentials["host"];
			$user = $credentials["user"];
			$password = $credentials["password"];
			$database = $credentials["database"];


			$this -> connection = pg_connect("host=$host dbname=$database user=$user password=$password") or trigger_error("Unable to connect to database.",E_USER_ERROR);
			$open = true;
			print "Connection established.<br>";
			
		}


		private function read_config(){

			return parse_ini_file("config.ini");

		}


		public function close(){
			if($open){
				pg_close($this->connection);
				echo "Connection to the database has been closed.";
				$open = false;
			}
			else{
				trigger_error("Connection already closed", E_USER_WARNING);
			}
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