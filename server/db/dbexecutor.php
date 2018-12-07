 <?php
	/**
	 * 
	 */
	class QueryExecutor{

		private $connection;
		
		function __construct($conn){

			if(!isset($conn) or !$conn -> is_open()){

				//throw new DatabaseException("Invalid database connection!");

			}


			$this -> connection = $conn -> get_socket();

			
		}



		public function unsafe_query($query){
			return mysqli_query($this -> connection, $query);

		}



		public function transaction($queries, $params){
			$conn = $this -> connection;
			//carefully log stuff. Do a transaction id enumeration to carefully keep track.
			if(pg_query($conn, "BEGIN")){
				echo "Transaction started";
			}
			else{
				//throw new DatabaseException("failed to start transaction");
			}

			$result = $this -> query($queries, $params);

			if($result){
				echo "Transaction completed. Attempting to commit...";
				if(pg_query($conn, "COMMIT")){
					echo "Transaction committed.";
					return;
				}
				else{

					//throw new DatabaseException("failed to commit a transaction.");
			
				}
			}
			else{

				echo "Failed committing. Attempting to roll back...";

				if(pg_query($conn, "ROLLBACK")){

					echo "Transaction successfully rolled back";

				}
				else{

					//throw new DatabaseException("Failed to roll back a transaction.");

				}

			}
			
		}



	}

?>