<?php
	
	//database class
	class Database{

		//privates fields

		private $host = "localhost";
		private $dbname = "inventory";
		private $user = "root";
		private $password = "";
		private $connection;

		//connect function

		public function connect(){

			try {
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
				$this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $e) {
				echo "Connection Error: $e->getMessage()";
			}

			return $this->connection;
			
		}

	}



















?>