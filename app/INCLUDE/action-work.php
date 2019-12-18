<?php
	session_start();
	require_once('../class/dbCommunication.php');
	require_once('../class/playerAccess.php');
	require_once('../class/playerAccessTime.php');
	require_once('../class/actions/actionWork.php');
  require_once('../class/disableActions.php');
    
	  $playerBlockingAccess = new PlayerAccess;
    $playerBlockingAccess->handle(true);
    
    $disableAction = new BlockAction;
    $addStatistic = new AddStatistics;
		$workAccessTime = new PlayerAccessTime;	
    $workAccessTime->blockingAccess($_SESSION['tpraca'], 'pracastop');
    
    $actionWork = new ActionWork;
    
    $actions = [
      [
        'slug'         => 'biuro_prezesa',
        'name'         => 'Posprzątaj biuro prezesa', 
        'time'		   	 => 20,
        'reward'       => 50,
      ]
    ]
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
      <h1 style="text-align: center;">Praca</h1>
      <p>
        Nie ma to jak legalny zarobek. Pewna kasa i zero przypału. Niestety nie zdąbędziesz przy tym szacunku.
        Pamiętaj jedno - żadna praca nie hańbi
      </p>

      <table id='ranking'>
        <tr>
          <th>Praca: </th>
          <th></th>
          <th>Czas:</th>
        <tr>
          <?php
            foreach($actions as $action){
							echo "
								<tr>
										<td>{$action['name']}</td>
										<td>
												<form method='POST'>
														<input name='work' value='{$action['slug']}' type='hidden'>
														<input src='../img/ok.gif' type='image' /> 
												</form>
										</td>
										<td>{$action['time']} min<td>
								</tr>"
							;
						}
            ?>
      </table>

      <?php

        $connect = new DatabaseCommunication;

        if(isset($_SESSION['pracastop']) && $_SESSION['pracastop']){
            echo "<p class='lose'>Nie skończyłeś jeszcze poprzedniej roboty kolego. Nie rób wszystkiego na łapu capu tylko jedno, a porządnie. Wróć tutaj później</p>";
        }
        else{

          foreach ($actions as $action) {
            if(isset($_POST['work'])){
              switch($_POST['work']){
                case $action['slug']:
                          
                  $disableAction->handle('pracastop', $connect, $action['time'], 'tpraca', $_SESSION["id"]);
                  $actionWork->handle( $action['reward'], $connect, $_SESSION['id']) ;
                  break;
  
              }
            }
          }

        }

        if(isset($_SESSION['pracastop']))
            echo "<p style=text-align:center>Pozostało: ".$workAccessTime->timeToEnd($_SESSION['tpraca'])."</p>";
            
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