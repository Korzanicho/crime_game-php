<?php
	/**
	* Class dbCommunication.
	* Class for communication with mysql
	*/
	class DatabaseCommunication{

		/** 
		 * @var String host
		*/
		private $host = "localhost";

		/** 
		* @var String user
		*/
		private $dbUser = "root";
		
		/** 
		* @var String password
		*/
		private $dbPassword= "";
		
		/** 
		* @var String database name
		*/
		private $dbName = "gangi";
		
		/**
		 * constructor
		 */
		function __construct()
		{
			$this->connect();
		}


		public function connect()
		{
			try{
				$link = mysqli_connect($this->host, $this->dbUser, $this->dbPassword, $this->dbName);
			}catch(Exception $e){
				echo 'Błąd łączenia z bazą danych: '.$e;
			}
			return $link;
		}

		/**
		 * Update database.
		 *
		 * @param string $query
		 * 
		 */
		public function update(String $query = ''): void
		{
			$update = mysqli_query($this->connect(), $query);
		}

		/**
		 * Update database.
		 *
		 * @param string $query
		 * @return $row
		 * 
		 */
		public function select($query)
		{
			$select = mysqli_query($this->connect(), $query);
			$row = mysqli_fetch_array($select);
			return $row;
		}

		/**
		 * 
		 * Disconnect from database.
		 * 
		 */
		public function disconnect(): void
		{
			mysqli_close($this->connect());
		}
	}
?>