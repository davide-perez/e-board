<?php

	require "dbconnection.php";
	
	/**
	 * 
	 */
	class QueryExecutor{

		private $connection;
		
		function __construct($conn){

			if( !isset($conn) or !$conn -> is_open()){

				throw new DatabaseException("Invalid database connection!");

			}


			$this -> connection = $conn;


			
		}
	}

?>