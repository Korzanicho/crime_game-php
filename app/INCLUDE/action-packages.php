<?php
	session_start();
	require_once('../class/dbCommunication.php');
	require_once('../class/playerAccess.php');
	require_once('../class/playerAccessTime.php');
	require_once('../class/actions/actionPackage.php');
	require_once('../class/disableActions.php');

    $playerBlockingAccess = new PlayerAccess;
    $playerBlockingAccess->handle(true);
    
    $disableAction = new BlockAction;
    $addStatistic = new AddStatistics;
		$packageAccessTime = new PlayerAccessTime;	
    $packageAccessTime->blockingAccess($_SESSION['tpaczki'], 'paczkistop');
    
    $actionPackage = new ActionPackage;
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
        
		<div class='content'>
			<h2 style="text-align: center;">Paczki</h2>
			<p>Raz dziennie możesz odebrać paczkę ze statystykami.</p>

        <form method=POST>
        	<input type='submit' value="Odbierz paczkę" name='package' class='btn'>
        </form>

        <?php
					$connect = new DatabaseCommunication;

					if(isset($_SESSION['paczkistop']) && $_SESSION['paczkistop']){
							echo "<p class='lose'>Odebrałeś już paczkę</p>";
					}
					else{
						if(isset($_POST['package']))
							$actionPackage->handle( $connect, $_SESSION['id'], $_SESSION['ranga'] );
					}

					if(isset($_SESSION['paczkistop']))
							echo "<p style=text-align:center>Pozostało: ".$packageAccessTime->timeToEnd($_SESSION['tpaczki'])."</p>";
					
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