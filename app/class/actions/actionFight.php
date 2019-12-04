<?php
	require_once('../class/addStatistics.php');

	/**
	* Class ActionFight.
	* Class for fights
	*/
	class ActionFight{
		
		function __construct()
		{
			//
		}

		private function getPlayerStatistics($playerPower, $playerDefence, $playerSpeed)
		{
			$playerPower = rand($playerPower/2, $playerPower+$playerPower*1.5);
			$playerDefence = rand($playerDefence/2, $playerDefence+$playerDefence*1.5);
			$playerSpeed = rand($playerSpeed/2, $playerSpeed+$playerSpeed*1.5);
			$player = ['power' => $playerPower, 'defence' => $playerDefence, 'speed' => $playerSpeed];
			return $player;
		}

		private function getOpponentStatistics($opponentPower, $opponentDefence, $opponentSpeed)
		{
			$opponentPower = rand($opponentPower/2, $opponentPower+$opponentPower*1.5);
			$opponentDefence = rand($opponentDefence/2, $opponentDefence+$opponentDefence*1.5);
			$opponentSpeed = rand($opponentSpeed/2, $opponentSpeed+$opponentSpeed*1.5);
			$opponent = ['power' => $opponentPower, 'defence' => $opponentDefence, 'speed' => $opponentSpeed];
			return $opponent;
		}

		private function fight($opponent, $player): Int
		{
			if($player['speed'] >= $opponent['speed'])
			{

				while($player['defence'] >= 0 || $opponent['defence'] >= 0){
					$opponent['defence']-=$player['power'];
					if($opponent['defence']<=0) return $player['defence'];

					$player['defence']-=$opponent['power'];
					if($player['defence']<=0) return 0;
				}

			}
			else{
				while($player['defence'] >= 0 || $opponent['defence'] >= 0){
					$player['defence']-=$opponent['power'];
					if($player['defence']<=0) return 0;

					$opponent['defence']-=$player['power'];
					if($opponent['defence']<=0) return $player['defence'];
				}	
			}
		}

		private function result($playerDefence, $maxMoney, $maxProgress, $connect, $id)
		{
			if($playerDefence>0){
				$this->playerWin($maxMoney, $maxProgress, $connect, $id);
				if($playerDefence<100){
					$addStatistics = new AddStatistics;
					$addStatistics->handle('zdrowie', -$_SESSION['zdrowie']+$playerDefence, 'zdrowie', $connect, $id);
					$_SESSION['zdrowie'] = $playerDefence;
				}
			}
			else $this->playerLose( $connect, $id );
		}

		private function playerWin( Int $maxMoney = 0, Int $maxProgress = 0, $connect, Int $id = 0): void
		{
			$money = rand(0, $maxMoney);
			$progress = rand(0, $maxProgress);
			$addStatistics = new AddStatistics;
			$addStatistics->handle('hajs', $money, 'hajs', $connect, $id);
			$addStatistics->handle('progress', $progress, 'progress', $connect, $id);
			echo "<p class='success'>Udało Ci się, zyskałeś $money PLN i $progress do szacunku</p>";
		}

		public function playerLose( $connect, $id ): void
		{
			$addStatistics = new AddStatistics;
			$addStatistics->handle('zdrowie', -$_SESSION['zdrowie'], 'zdrowie', $connect, $id);
			echo "<p class='lose'>Ale lipa, przegrałeś. Leć do szpitala bo bez zdrowia jesteś łatwym celem dla innych graczy</p>";
		}

		public function handle($opponentPower, $opponentDefence, $opponentSpeed, 
			$playerPower, $playerDefence, $playerSpeed, $maxMoney, $maxProgress, $connect, $id){
			$this->result(
				$this->fight(
					$this->getOpponentStatistics($opponentPower, $opponentDefence, $opponentSpeed),
					$this->getPlayerStatistics($playerPower, $playerDefence, $playerSpeed)
				), $maxMoney, 
				$maxProgress, 
				$connect, 
				$id
				);
		}
	}
?>