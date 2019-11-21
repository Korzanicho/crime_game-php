<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php 
		include("head.php");
	?>
</head>
<body>
	<div class=container>
		<header>
			<?php include("header.php")?> 
        </header>
        
		<div class='panel panel--left'>
			<?php include("lewypanel.php")?>        
		</div>
        
		<div class='content'>
			<h2 style="text-align: center;">Siłka</h2>
			<p>
				Nie przetrwasz na ulicy jeśli nie będziesz chodzić na siłkę.
				Zaglądaj tu regularnie ale pamiętaj również żeby dać
				mięśniom czas na regenerację.
			</p>

			<table>
				<tbody>
					<tr>
						<form method="POST"> 
							<td>
								<input 
									type=text 
									class='gym' 
									style="color: black;" 
									value=<?=$_SESSION['ranga']?> 
									readonly 
									name="sila"/>
							</td>
							<td>
								<input 
									type='submit' 
									class='gym' 
									value='Siła'
									title="Trenuj siłę"
								/>
							</td>
						</form>
						<form method="POST">
							<td>
								<input 
									type=text 
									class='gym' 
									style="color: black;" 
									value=<?=$_SESSION['ranga']?> 
									readonly 
									name="obrona"/>
							</td>
							<td>
								<input 
									type=submit 
									class='gym' 
									value="Obrona" 
									title="Trenuj obronę"
								/>
							</td>
						</form>
						<form method="POST">
							<td>
								<input 
									type=text 
									class='gym' 
									style="color: black;" 
									value=<?=$_SESSION['ranga']?> 
									readonly 
									name="szybkosc"
								/>
							</td>
							<td>
								<input 
									type=submit 
									class='gym' 
									value="Szybkość" 
									title="Trenuj szybkość"
								/>
							</td>
						</form>
					</tr>
				</tbody>
			</table>
			<?php 
				gymManagement();
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
		require_once('../class/dbCommunication.php');
		require_once('../class/playerAccess.php');
		require_once('../class/playerAccessTime.php');
		require_once('../class/disableActions.php');
		require_once('../class/addStatistics.php');
	
		$playerAccess = new PlayerAccess;
		$playerAccess->handle();
	
		$gymAccessTime = new PlayerAccessTime;
		$gymAccessTime-> blockingAccess($_SESSION['tsilka'], 'silkastop');
	
		$disableAction = new BlockAction;
		$addStatistic = new AddStatistics;

		if(isset($_SESSION['silkastop']))
			echo "<p class='lose'>Daj mięśniom trochę odpocząć bo się przerenujesz</p>";

		else{
			$connect = new DatabaseCommunication;
			$id = $_SESSION["id"];
			//SIŁA
			if(isset ($_POST['sila']))
			{
				$addStatistic->handle( 'sila', 'sila', 'sila', $connect, $id );
				$disableAction->handle('silkastop', $connect, 300, 'tsilka', $_SESSION["id"]);
				
				echo "<p class='success'>Gratuluję, dodałeś ".$_POST['sila']." do siły</p>";	
			}

			//OBRONA
			if(isset ($_POST['obrona']))
			{
				$disableAction->handle('silkastop', $connect, 300, 'tsilka', $_SESSION["id"]);
				$addStatistic->handle( 'obrona', 'obrona', 'obrona', $connect, $id );

				echo "<p class='success'> Gratuluję, dodałeś ".$_POST['obrona']." do obrony</p>";
			}

			//SZYBKOŚĆ
			if(isset ($_POST['szybkosc']))
			{
				$disableAction->handle('silkastop', $connect, 300, 'tsilka', $_SESSION["id"]);
				$addStatistic->handle( 'szybkosc', 'szybkosc', 'szybkosc', $connect, $id );

				echo "<p class='success'>Gratuluję, dodałeś ".$_POST['szybkosc']." do szybkości</p>";
			}
			$connect->disconnect();
		}	
			
			if(isset($_SESSION['silkastop']))
				echo "<p style=text-align:center>Pozostało: ".$gymAccessTime->timeToEnd($_SESSION['tsilka'])."</p>";
		}
?>


































