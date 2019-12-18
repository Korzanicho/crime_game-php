<?php
	require_once('../class/addStatistics.php');

	/**
	* Class ActionBank.
	* Class for bank
	*/
	class ActionBank
	{

		private function depositeMoneyToBank( $money, $bank, $connect, $id )
		{
			$value = $_POST['deposit'];
			if($value>$money) $value = $money;
			$addStatistics = new AddStatistics;
			$addStatistics->handle('hajs', -$value, 'hajs', $connect, $id);
			$addStatistics->handle('bank', $money, 'bank', $connect, $id);

			echo "<p class='success'>Wpłaciłeś pieniądze do banku</p>";

		}

		private function withdrawMoneyFromBank( $money, $bank, $connect, $id )
		{
			$value = $_POST['withdraw'];
			if($value>$bank) $value = $bank;
			$addStatistics = new AddStatistics;
			$addStatistics->handle('bank', -$value, 'bank', $connect, $id);
			$addStatistics->handle('hajs', $value, 'hajs', $connect, $id);

			echo "<p class='success'>Wypłaciłeś pieniądze z banku</p>";
		}

		public function handle( $money, $bank, $connect, $id ){
			if(isset($_POST['deposit'])){
				$this->depositeMoneyToBank( $money, $bank, $connect, $id );
			}
			else if(isset($_POST['withdraw'])){
				$this->withdrawMoneyFromBank( $money, $bank, $connect, $id );
			}
		}
	}
?>