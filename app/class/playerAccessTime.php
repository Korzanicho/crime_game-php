<?php
	/**
	* Class PlayerAccesTime.
	* Class for blocking actions before time
	*/
	class PlayerAccessTime{
		
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
		private function endTime( String $endTime = ''): DateTime
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
		 * Check time to end block
		 *
		 * @return DateTime
		 * 
		 */
		public function timeToEnd( String $endTime = '' )
		{
			if( $this->comparisonTimes( $endTime ) )
			{
				$dif = $this->currentTime()->diff($this->endTime($endTime));
				return $dif->format('%i minut, %s sekund');
			}
		}

		public function blockingAccess($endTime, $variable)
		{
			if($this->comparisonTimes($endTime))
			{
				$_SESSION[$variable] = true;
				return true;
			}
			else unset($_SESSION[$variable]);
			return false;
		}

	}
?>