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

		public function calculateChance($difficulty, $progress)
		{
			$chance = $progress/$difficulty*100;
			$chance > 95 ? $chance = 95 : null;
			return intval($chance);
		}

		public function checkIfPlayerWin($difficulty, $progress)
		{
			$chance = $this->calculateChance($difficulty, $progress);
			$rand = rand(0, 100);
			if($chance > $rand) return true;
			else return false;
		}

		public function playerWin( Int $maxMoney = 0, Int $maxProgress = 0, $connect, Int $id = 0): void
		{
			$money = rand(0, $maxMoney);
			$progress = rand(0, $maxProgress);
			$addStatistics = new AddStatistics;
			$addStatistics->handle('hajs', $money, 'hajs', $connect, $id);
			$addStatistics->handle('progress', $progress, 'progress', $connect, $id);
			echo "<p class='success'>Udało Ci się, zyskałeś $money PLN i $progress do szacunku</p>";
		}

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


	}
?>