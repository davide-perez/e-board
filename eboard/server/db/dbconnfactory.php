<?php

	require "dbexception.php";


	class ConnectionFactory {


		private $credentials;


		function __construct(){

			$this -> credentials = $this->read_config();

			if($this -> credentials == false){
				throw new DatabaseException("Error parsing the database credentials!\n");
			}
		}


		public function get_connection(){



			$host = $this -> credentials["host"];
			$user = $this -> credentials["user"];
			$password = $this -> credentials["password"];
			$database = $this -> credentials["database"];

			$connection = mysqli_connect($host, $user, $password, $database);

			if (mysqli_connect_errno()){


				throw new DatabaseException("Unable to connect to database: " . mysqli_connect_error());
			}

			else{

				return $connection;

			}
			
		}


		private function read_config(){

			return parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/eboard/eboard/server/config.ini");

		}



	}

?>