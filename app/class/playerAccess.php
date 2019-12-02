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
		 * 
		 * Check current time
		 * 
		 */
		private function currentTime()
		{
			$currentTime = new DateTime();
			return $currentTime;
		}

		/**
		 * Check end time
		 *
		 * @return DateTime
		 * 
		 */
		private function endTime( $endTime )
		{
			$endTime = DateTime::createFromFormat('Y-m-d H:i:s', $endTime);
			return $endTime;
		}

		/**
		 * Comparison times
		 *
		 * @return Bool
		 * 
		 */
		private function comparisonTimes($endTime): Bool
		{
			if($this->currentTime() < $this->endTime($endTime))	return true;
			else return false;
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
			$this->comparisonTimes($_SESSION['tszpital']) 
			? $_SESSION['szpitalstop'] = true 
			: $_SESSION['szpitalstop'] = false;
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
			$this->comparisonTimes($_SESSION['twiezienie']) 
				? $_SESSION['wiezieniestop'] = true 
				: $_SESSION['wiezieniestop'] = false;
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