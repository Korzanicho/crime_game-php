<?php
	session_start();
	require_once('../class/dbCommunication.php');
	require_once('../class/playerAccess.php');
	require_once('../class/actions/actionFight.php');
	require_once('../class/disableActions.php');


	$disableAction = new BlockAction;

	$playerBlockingAccess = new PlayerAccess;
	$playerBlockingAccess->handle(true);

	$fight = new ActionFight;

	$opponents = [
		[
			'slug'         => 'emeryt',
			'name'         => 'Emeryt', 
			'maxReward'    => rand(5, 15),
			'power'		   => rand(5, 15),
			'defence'	   => rand(5, 15),
			'fast'		   => rand(5, 15)
		],
		[
			'slug'         => 'menel',
			'name'         => 'Menel', 
			'maxReward'    => rand(5, 15),
			'power'		   => rand(5, 15),
			'defence'	   => rand(5, 15),
			'fast'		   => rand(5, 15)
		],
		[
			'slug'         => 'sebix',
			'name'         => 'Sebix', 
			'maxReward'    => rand(5, 15),
			'power'		   => rand(5, 15),
			'defence'	   => rand(5, 15),
			'fast'		   => rand(5, 15)
		],
		[
			'name'         => 'turysta', 
			'slug'         => 'Turysta',
			'maxReward'    => rand(5, 15),
			'power'		   => rand(5, 15),
			'defence'	   => rand(5, 15),
			'fast'		   => rand(5, 15)
		],
		[
			'slug'         => 'feministka',
			'name'         => 'Feministka', 
			'maxReward'    => rand(5, 15),
			'power'		   => rand(5, 15),
			'defence'	   => rand(5, 15),
			'fast'		   => rand(5, 15)
		],
		[
			'slug'         => 'imigrant',
			'name'         => 'Imigrant', 
			'maxReward'    => rand(5, 15),
			'power'		   => rand(5, 15),
			'defence'	   => rand(5, 15),
			'fast'		   => rand(5, 15)
		],
	
	];

?>
<!DOCTYPE html>
<html>
<head>
	<?php 
		include("head.php");
		require_once "connect.php";
		?>
</head>
<body>

	<div class='container'>
		<header>
			<?php include("header.php")?>
        </header>
        
		<div class='panel panel--left'>
			<?php include("lewypanel.php")?>
        </div>
        
		<div class='content'>

			<?php
			if($_SESSION['zdrowie']<25)
				echo "<p class='lose'>Masz za mało zdrowia żeby walczyć. Musisz
					mieć chociaż 25%. Leć do szpitala</p>";
			else{
				echo '
					<h1 style="text-align: center;">Walki Uliczne</h1>
					<p>Chcesz wziąć udział w nielegalnych walkach ulicznych?
					Poza umiejętnościami musisz liczyć na sporo szczęścia - tu nie każdy
					gra czysto. Wybierz równego sobie przeciwnika i wygrywając zyskaj kwit 
					oraz szacunek na mieście, powodzenia!</p>';

					echo '<form action="action-fight.php" method="POST">
							<p>Wybierz przeciwnika</p>
					';
						foreach($opponents as $opponent){
							echo "
								<div id='{$opponent['slug']}'>
									<label for='{$opponent['slug']}Id'>
										<p>{$opponent['name']}</p>
									</label>
									<input type='radio' name='walka' value='{$opponent['slug']}' id='{$opponent['slug']}Id'>
								</div>
							";
						}
					echo '
							<input type=submit value="Walcz!" class="btn">
						</form>
					';

				if(isset ($_POST['walka']))
				{
						$playerPower=$_SESSION['sila']+$_SESSION['bron'];
						$playerDefence=$_SESSION['obrona']+$_SESSION['zdrowie'];
						
						$playerFast=$_SESSION['szybkosc'];
						
						$id = $_SESSION["id"];
						$connect = new DatabaseCommunication;

						foreach($opponents as $opponent){
							switch($_POST['walka']){
								case $opponent['slug']:

									$fight -> handle($opponent['power'], $opponent['defence'], $opponent['fast'],
									$playerPower, $playerDefence, $playerFast, $opponent['maxReward'], 
									$opponent['maxReward'], $connect, $_SESSION['id']);

									break;
							}
						}

						$connect->disconnect();
				}
			}
			?>

		</div>
		
		<div class='panel panel--right'>
			<?php include("prawypanel.php")?>
        </div>
        
		<div style="clear: both;"></div>
		<footer>
		    <?php include("stopka.php");?>
		</footer>
	</div>
</body>
</html>