<?php
	session_start();
	require_once('../class/dbCommunication.php');
	require_once('../class/playerAccess.php');
	require_once('../class/playerAccessTime.php');
	require_once('../class/disableActions.php');
	require_once('../class/addStatistics.php');

	$playerBlockingAccess = new PlayerAccess;
	$playerBlockingAccess->handle(true);

	$disableAction = new BlockAction;
	$addStatistic = new AddStatistics;
	$gymAccessTime = new PlayerAccessTime;	
	$gymAccessTime->blockingAccess($_SESSION['tsilka'], 'silkastop');

?>
<!DOCTYPE html>
<html>
<head>
	<?php 
		include("head.php");
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
        
		<div class='content gym'>
			<h2 style="text-align: center;">Siłka</h2>
			<p>
				Nie przetrwasz na ulicy jeśli nie będziesz chodzić na siłkę.
				Zaglądaj tu regularnie ale pamiętaj również żeby dać
				mięśniom czas na regenerację.
			</p>

			<div class="gym__forms-wrapper">
				<div class="gym__form-wrapper">
					<form method="POST"> 
						<input 
							type=text 
							class='gym' 
							style="color: black;" 
							value=<?=$_SESSION['ranga']?> 
							readonly 
							name="sila"/>
						<input 
							type='submit' 
							class='gym' 
							value='Siła'
							title="Trenuj siłę"
						/>
					</form>
				</div>
				<div class="gym__form-wrapper">
					<form method="POST">
						<input 
							type=text 
							class='gym' 
							style="color: black;" 
							value=<?=$_SESSION['ranga']?> 
							readonly 
							name="obrona"/>
						<input 
							type=submit 
							class='gym' 
							value="Obrona" 
							title="Trenuj obronę"
						/>
					</form>
				</div>
				<div class="gym__form-wrapper">
					<form method="POST">
							<input 
								type=text 
								class='gym' 
								style="color: black;" 
								value=<?=$_SESSION['ranga']?> 
								readonly 
								name="szybkosc"
							/>
							<input 
								type=submit 
								class='gym' 
								value="Szybkość" 
								title="Trenuj szybkość"
							/>
					</form>
				</div>
			</div>
			
			<?php 
				if(isset($_SESSION['silkastop']))
				echo "<p class='lose'>Daj mięśniom trochę odpocząć bo się przerenujesz</p>";
	
				else{
					$connect = new DatabaseCommunication;
					$id = $_SESSION["id"];
					//SIŁA
					if(isset ($_POST['sila'])){
						$disableAction->handle('silkastop', $connect, 300, 'tsilka', $_SESSION["id"]);
						$addStatistic->handle( 'sila', $_POST['sila'], 'sila', $connect, $id );
						
						echo "<p class='success'>Gratuluję, dodałeś ".$_POST['sila']." do siły</p>";	
					}
		
					//OBRONA
					if(isset ($_POST['obrona'])){
						$disableAction->handle('silkastop', $connect, 300, 'tsilka', $_SESSION["id"]);
						$addStatistic->handle( 'obrona', $_POST['obrona'], 'obrona', $connect, $id );
		
						echo "<p class='success'> Gratuluję, dodałeś ".$_POST['obrona']." do obrony</p>";
					}
		
					//SZYBKOŚĆ
					if(isset ($_POST['szybkosc'])){
						$disableAction->handle('silkastop', $connect, 300, 'tsilka', $_SESSION["id"]);
						$addStatistic->handle( 'szybkosc', $_POST['szybkosc'], 'szybkosc', $connect, $id );
		
						echo "<p class='success'>Gratuluję, dodałeś ".$_POST['szybkosc']." do szybkości</p>";
					}
					$connect->disconnect();
				}	
				
				if(isset($_SESSION['silkastop']))
					echo "<p style=text-align:center>Pozostało: ".$gymAccessTime->timeToEnd($_SESSION['tsilka'])."</p>";
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

<?php
	function gymManagement()
	{

		}
?>


































