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
			if($_SESSION['szpitalstop']) return true;
		}

		/**
		 * Check if the player is in hospital
		 *
		 * @return Bool
		 * 
		 */
		private function isPlayerInPrison()
		{
			if($_SESSION['wiezieniestop'])	return true;
		}

		/**
		 * 
		 * move the player to the correct location
		 *
		 */
		private function movePlayer(): void
		{
			$this->isPlayerLogged() ? NULL : header('Location: ./index.php');
			$this->isPlayerInPrison() ? header('Location: ./wiezienie.php') : null;
			$this->isPlayerInHospital() ? header('Location: ./szpital.php') : null;
		}

		public function handle()
		{
			$this->movePlayer();
		}

	}
?>