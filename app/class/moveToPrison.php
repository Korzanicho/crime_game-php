<?php 	
	/**
	* Class MoveToPrison.
	* Class for moving player to prison
	*/
	class MoveToPrison{
		
		function __construct()
		{
			//
		}

		/**
		 * Move player to prison
		 *
		 * @return Bool
		 * 
		 */
		private function moveToPrison($connect, Int $time = 0, Int $id = 0): void
		{
			$query = "UPDATE users SET twiezienie=now()+INTERVAL $time SECOND WHERE id=$id ;";
			$connect->update($query);
			$timeToEnd = $connect->select("SELECT twiezienie FROM users WHERE id=$id");
			$_SESSION['twiezienie'] = $timeToEnd['twiezienie'];
			$_SESSION['wiezieniestop']=true;
			echo "<p class='lose'>Trafiasz do więzienia na ".$time." sekund!</p>";
		}

		/**
		 * 
		 * handle function for MoveToPrison class
		 *
		 */
		public function handle(Int $time = 0, $connect, Int $id = 0): void
		{
			$this->moveToPrison($connect, $time, $id);
		}

	}
?>