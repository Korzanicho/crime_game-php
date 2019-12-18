<?php
		session_start();
		require_once('../class/dbCommunication.php');
		require_once('../class/playerAccess.php');
		require_once('../class/playerAccessTime.php');
		require_once('../class/actions/ActionBank.php');
		require_once('../class/disableActions.php');
	
		$playerBlockingAccess = new PlayerAccess;
		$playerBlockingAccess->handle(true);
		
		$disableAction = new BlockAction;
		
		$actionBank = new ActionBank;
?>

<!DOCTYPE html>
<html>
	<head>
		<?php 
			include("head.php"); //zainkludowanie nagłówka <head>

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
					
			<div class='content bank'>

							<h1 style="text-align: center;">Bank</h1>
				<p>Regularnie wpłacaj hajs do banku żeby nikt nie mógł Cię okraść.</p>
				<?php
					$max=$_SESSION['hajs'];
					$max2=$_SESSION['bank'];
				?>
				<form method="POST">    
						<td><input type='number' style="color: black"  min=0 max=<?=$max?> value=<?=$max?> name='deposit' /></td>
						<td><input type='submit' value="Wpłać hajs do banku"></td>     
				</form>
				<form method="POST">    
						<td>
							<input type='number' style="color: black" min=0 max=<?=$max2?> value=<?=$max2?> name='withdraw' />
						</td>
						<td><input type='submit' value="Wypłać pieniądze"></td>     
				</form>

				<?php            
					$connect = new DatabaseCommunication;
					$actionBank->handle( $_SESSION['hajs'], $_SESSION['bank'], $connect, $_SESSION['id'] );
					$connect->disconnect();
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