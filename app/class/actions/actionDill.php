<?php
	require_once('../class/addStatistics.php');
	require_once('../class/moveToPrison.php');


	/**
	* Class ActionFight.
	* Class for fights
	*/
	class ActionDill{

		private function getPlayerSpeed( $playerSpeed )
		{
			$playerSpeed = rand($playerSpeed/2, $playerSpeed+$playerSpeed*1.5);
			return $playerSpeed;
		}

		private function result( $connect, $time, $id, $maxMoney, $maxProgress, $playerSpeed, $requiredSpeed )
		{
			$speed = $this->getPlayerSpeed( $playerSpeed );
			$requiredSpeed > $speed ? $this->playerLose( $connect, $id, $time ) : $this->playerWin( $maxMoney, $maxProgress, $connect, $id );
		}

		private function playerWin( Int $maxMoney = 0, Int $maxProgress = 0, $connect, Int $id = 0): void
		{
			$money = rand(0, $maxMoney);
			$progress = rand(0, $maxProgress);
			$addStatistics = new AddStatistics;
			$addStatistics->handle('hajs', $money, 'hajs', $connect, $id);
			$addStatistics->handle('progress', $progress, 'progress', $connect, $id);

			echo "<p class='success'>Udało Ci się bez przypału. Zyskałeś $money PLN i $progress do szacunku</p>";
		}

		public function playerLose( $connect, $id, $time ): void
		{
			$moveToPrison = new MoveToPrison;
			$moveToPrison->handle($time, $connect, $id);
		}

		public function handle( $connect, $time, $id, $maxMoney, $maxProgress, $playerSpeed, $requiredSpeed ){
			$this->result( $connect, $time, $id, $maxMoney, $maxProgress, $playerSpeed, $requiredSpeed );
		}
	}
?>