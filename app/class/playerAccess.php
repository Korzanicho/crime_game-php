<?php
	/**
	* Class PlayerAccess.
	* Class for moving player from blocking pages
	*/
	class PlayerAccess{
		
		function __construct()
		{
			//
		}

		/**
		 * Check if the player is logged
		 *
		 * @return Bool
		 * 
		 */
		private function isPlayerLogged()
		{
			if($_SESSION['zalogowany']) return true;
		}

		/**
		 * Check if the player is in hospital
		 *
		 * @return Bool
		 * 
		 */
		private function isPlayerInHospital()
		{
			if(isset($_SESSION['szpitalstop']) && $_SESSION['szpitalstop']) return true;
		}

		/**
		 * Check if the player is in hospital
		 *
		 * @return Bool
		 * 
		 */
		private function isPlayerInPrison()
		{
			if(isset($_SESSION['wiezieniestop']) && $_SESSION['wiezieniestop'])	return true;
		}

		/**
		 * 
		 * move the player to the correct location
		 *
		 */
		private function movePlayer(Bool $isMoveWanted = false): void
		{
			$this->isPlayerLogged() ? NULL : header('Location: ./index.php');
			if($isMoveWanted){
				$this->isPlayerInPrison() ? header('Location: ./wiezienie.php') : null;
				$this->isPlayerInHospital() ? header('Location: ./szpital.php') : null;
			}
		}

		/**
		 * 
		 * handle function for PlayerAccess class
		 *
		 */
		public function handle(Bool $isMoveWanted = false): void
		{
			$this->movePlayer($isMoveWanted);
		}

	}
?>