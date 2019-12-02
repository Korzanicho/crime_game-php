<?php
	require_once('../class/addStatistics.php');

	/**
	* Class ActionCrime.
	* Class for adding crimes
	*/
	class ActionCrime{
		
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
				// for($i=0;$i<=100;$i++){
				// 	$opponent['defence']-=$player['power'];
				// 	if($opponent['defence']<=0) return $player['defence'];

				// 	$player['defence']-=$opponent['power'];
				// 	if($player['defence']<=0) return 0;
				// }

				while($player['defence'] <= 0 || $opponent['defence'] <= 0){
					$opponent['defence']-=$player['power'];
					if($opponent['defence']<=0) return $player['defence'];

					$player['defence']-=$opponent['power'];
					if($player['defence']<=0) return 0;
				}

			}
			else{
				while($player['defence'] <= 0 || $opponent['defence'] <= 0){
					$player['defence']-=$opponent['power'];
					if($player['defence']<=0) return 0;

					$opponent['defence']-=$player['power'];
					if($opponent['defence']<=0) return $player['defence'];
				}	
			}
		}

		public function result($playerDefence)
		{
			if($playerDefence>0){
				echo 'wygrałeś';
			}
			else echo 'przegrałeś';
		}

		// public function playerWin( Int $maxMoney = 0, Int $maxProgress = 0, $connect, Int $id = 0): void
		// {
		// 	$money = rand(0, $maxMoney);
		// 	$progress = rand(0, $maxProgress);
		// 	$addStatistics = new AddStatistics;
		// 	$addStatistics->handle($_SESSION['hajs'], $money, 'hajs', $connect, $id);
		// 	$addStatistics->handle($_SESSION['progress'], $progress, 'hajs', $connect, $id);
		// 	echo "<p class='success'>Udało Ci się, zyskałeś $money PLN i $progress do szacunku</p>";
		// }

		// public function playerLose( Int $time = 0, $connect ): void
		// {
		// 	$id = $_SESSION["id"];

		// 	$query = "UPDATE users SET twiezienie=now()+INTERVAL $time SECOND WHERE id=$id ;";

		// 	$connect->update($query);
		// 	$timeToEnd = $connect->select("SELECT twiezienie FROM users WHERE id=$id");
		// 	$_SESSION['twiezienie'] = $timeToEnd['twiezienie'];

		// 	$_SESSION['wiezieniestop']=true;
		// 	echo "<p class='lose'>Trafiasz do więzienia na ".$time." sekund!</p>";
		// }

		public function handle($opponentPower, $opponentDefence, $opponentSpeed, 
			$playerPower, $playerDefence, $playerSpeed){
			$this->result(
				$this->fight(
					getOpponentStatistics($opponentPower, $opponentDefence, $opponentSpeed),
					getPlayerStatistics($playerPower, $playerDefence, $playerSpeed)
				)
				)
		}
	}
?>