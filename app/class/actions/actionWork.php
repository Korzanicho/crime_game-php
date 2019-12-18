<?php
	require_once('../class/addStatistics.php');

	/**
	* Class ActionWork.
	* Class for jobs
	*/
	class ActionWork{

		private function addStats( Int $money = 0, $connect, Int $id = 0 ): void
		{
			$addStatistics = new AddStatistics;
			$addStatistics->handle('hajs', $money, 'hajs', $connect, $id);

			echo "<p class='success'>Poszedłeś do pracy. Oto Twoja przedpłata: $money PLN</p>";
		}

		public function handle( Int $money = 0, $connect, Int $id = 0 ){
			$this->addStats( $money, $connect, $id );
		}
	}
?>