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

		public function playerWin($maxMoney, $maxProgress, $connect, $id)
		{
			$money = rand(0, $maxMoney);
			$progress = rand(0, $maxProgress);
			$addStatistics = new AddStatistics;
			$addStatistics->handle('hajs', $money, 'hajs', $connect, $id);
			echo "<p class='success'>Udało Ci się xD, zyskałeś $money PLN i $progress do szacunku</p>";
		}


	}
?>