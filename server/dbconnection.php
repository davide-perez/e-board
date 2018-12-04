<?php

	/**
	 * 
	 */
	class DatabaseConnection{

		private $connection;
		private $open;
		
		function __construct($host, $user, $password, $database){

			$this -> connection = pg_connect("host=$host dbname=$database user=$user password=$password") or die("Unable to connect to database.");
			$open = true;
			
		}


		public function close(){
			if($open){
				pg_close($this->connection);
				echo "Connection to database has been terminated.";
				$open = false;
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