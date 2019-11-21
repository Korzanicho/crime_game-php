<?php
	/**
	* Class PlayerAccesTime.
	* Class for blocking actions
	*/
	class BlockAction{
		
		function __construct()
		{
			//
		}

		/**
		 * 
		 * Check current time
		 * 
		 */
		private function setActionOnDisable( String $action = '')
		{
			$_SESSION['action'] = true;
		}

		/**
		 * 
		 * Set time of blocking in seconds
		 * 
		 */
		private function setBlockTime($connect, Int $time = 0, String $dbCell = '', Int $id = 0)
		{
			$query = "UPDATE users SET $dbCell=now()+INTERVAL $time SECOND WHERE id=$id ;";
			$connect->update($query);
			$row = $connect->select("SELECT $dbCell FROM users WHERE id=$id");
			$_SESSION[$dbCell] = $row[$dbCell];
		}

		/**
		* Handle BlockAction
		*
		* @param String $action session variable of blocking action
		* @param MySql $connetc Connect with DB
		* @param Int $time Time in sec
		* @param String $dbCell with time and session var with time
		* @param Int $id id of player
		* 
		*/
		public function handle($action, $connect, $time, $dbCell, $id)
		{
			$this->setActionOnDisable($action);
			$this->setBlockTime($connect, $time, $dbCell, $id);
		}

	}
?>