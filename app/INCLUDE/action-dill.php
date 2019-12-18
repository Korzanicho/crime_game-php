<?php
	session_start();
	require_once('../class/dbCommunication.php');
	require_once('../class/playerAccess.php');
	require_once('../class/playerAccessTime.php');
	require_once('../class/actions/actionDill.php');
    require_once('../class/disableActions.php');
    
	$playerBlockingAccess = new PlayerAccess;
    $playerBlockingAccess->handle(true);
    
    $disableAction = new BlockAction;
    $addStatistic = new AddStatistics;
	$dillAccessTime = new PlayerAccessTime;	
    $dillAccessTime->blockingAccess($_SESSION['tdilerka'], 'dilerkastop');
    
    $actionDill = new ActionDill;
    
    $actions = [
		[
			'slug'         => 'handluj_drozdzowkami',
			'name'         => 'Handluj drożdżówkami pod podstawówką', 
			'time'		     => 30,
			'prisonTime'   => 30,
			'maxReward'    => rand(5, 15),
			'defence'	     => rand(5, 15),
        ]
    ]
?>

<!DOCTYPE html>
<html>

<head>
  <?php 
		include("head.php"); //zainkludowanie nagłówka <head>
		require_once('./connect.php'); //zainkludowanie połączenia z bazą
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
      <h1 style="text-align: center;">Dilerka</h1>
      <p>
        Łatwa kasa dla kumatych - wiążąca się z przypałem. Duży zarobek
        i doświadczenie ale również możliwość długiej odsiadki w więzieniu.
        Bądź ostrożny, na pewno przyda Ci się bycie szybkim.
      </p>

      <table id='ranking'>
        <tr>
          <th>Diluj: </th>
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
                              <input name='dill' value='{$action['slug']}' type='hidden'>
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

        if(isset($_SESSION['dilerkastop']) && $_SESSION['dilerkastop']){
            echo "<p class='lose'>Jak będziesz za często dilował to zgarniesz przypał. Poczekaj trochę</p>";

        }
        else{

          foreach ($actions as $action) {
            if(isset($_POST['dill'])){
              switch($_POST['dill']){
                case $action['slug']:
                          
                  $disableAction->handle('dilerkastop', $connect, $action['time'], 'tdilerka', $_SESSION["id"]);
                  $actionDill->handle( $connect, $action['prisonTime'], $_SESSION['id'], $action['maxReward'], 
                  $action['maxReward'], $_SESSION['szybkosc'], $action['defence'] );
                  break;
  
              }
            }
          }

        }

        if(isset($_SESSION['dilerkastop']))
            echo "<p style=text-align:center>Pozostało: ".$dillAccessTime->timeToEnd($_SESSION['tdilerka'])."</p>";
            
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