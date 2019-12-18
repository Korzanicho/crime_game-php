<?php	
	/**
	* Class AddStatistics.
	* Class for adding statistic for player
	*/
	class AddStatistics{
		
		function __construct()
		{
			//
		}

		/**
		 * 
		 * addStatistic
		 * 
		 */
		private function addStatistic( String $session = '', Int $add = 0 ): Int
		{
			$_SESSION[$session] += $add;
			return $_SESSION[$session];
		}

		/**
		 * 
		 * Check current time
		 * 
		 */
		private function addStatisticToDatabase( String $session = '', $add, 
			String $dbCell = '', $connect, Int $id = 0 )
		{
			$value = $this->addStatistic( $session, $add );
			$query = "UPDATE users SET $dbCell=$value WHERE id=$id ;";
			$connect->update($query);
		}



		/**
		* Handle BlockAction
		*
		* @param String session variable of statistic
		* @param String post variable of statistic
		* @param String $dbCell with statistic
		* @param MySql $connetc Connect with DB
		* @param Int $id id of player
		* 
		*/
		public function handle( $session, $add, $dbCell, $connect, $id )
		{
			$this->addStatisticToDatabase( $session, $add, $dbCell, $connect, $id );
		}

	}
?>