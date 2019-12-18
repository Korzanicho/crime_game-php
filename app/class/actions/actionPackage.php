<?php
	require_once('../class/addStatistics.php');
	require_once('../class/disableActions.php');

	/**
	* Class ActionPackage.
	* Class for packages
	*/
	class ActionPackage
	{

		private function addStats( $connect, Int $id = 0, Int $level = 0 ): void
		{
			$addStatistics = new AddStatistics;
			$money = rand(0, $level*15);
			$progress = rand(0, $level*15);
			$power = rand(0, $level*15);
			$defence = rand(0, $level*15);
			$speed = rand(0, $level*15);

			$addStatistics->handle('hajs', $money, 'hajs', $connect, $id);
			$addStatistics->handle('progress', $progress, 'progress', $connect, $id);
			$addStatistics->handle('sila', $power, 'sila', $connect, $id);
			$addStatistics->handle('obrona', $defence, 'obrona', $connect, $id);
			$addStatistics->handle('szybkosc', $speed, 'szybkosc', $connect, $id);

			echo "<p class='success'>Dostałeś paczkę, super. Zyskałeś: $money PLN, $progress szacunku, $power do siły, $defence do obrony i $speed szybkości. Wróć po następną paczkę za 24h</p>";
		}

		private function blockPackages( $time, $id, $connect )
		{
			$disableAction = new BlockAction;
			$disableAction->handle('paczkistop', $connect, $time, 'tpaczki', $id );
		}

		public function handle( $connect, Int $id = 0, Int $level ){
			$this->addStats( $connect, $id, $level );
			$this->blockPackages( 86400, $id, $connect );
		}
	}
?>