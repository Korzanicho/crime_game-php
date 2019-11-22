<?php
session_start();
require_once('../class/dbCommunication.php');
require_once('../class/playerAccess.php');
require_once('../class/actions/actionCrime.php');
require_once('../class/disableActions.php');
require_once('../class/playerAccessTime.php');

$disableAction = new BlockAction;
$playerBlockingAccess = new PlayerAccess;
$playerBlockingAccess->handle(true);
$crime = new ActionCrime;
$crimeAccessTime = new PlayerAccessTime;	
$crimeAccessTime->blockingAccess($_SESSION['tsilka'], 'silkastop');

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
        
		<div class='content crimes'>
		    <h1 style="text-align: center;">Przestępstwa</h1>
		<p>
            Jakim byłbyś gangsterem gdybyś nie robił żadnych przestępstw. To
            jedna z prostszych metod zarobku, a dodatkowo zyskujesz więcej 
            doświadczenia.
        </p>

		<table>
            <tbody>
                <tr>
                    <th>Akcja: </th><th></th><th>Szansa</th>
                </tr>
                <tr>
                    <td>Ukradnij batonik z automatu</td>
                    <td>
                        <form method=POST>
                            <input name=crime value=1 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>
                    <?php
                        echo $crime->calculateChance(90, $_SESSION['progress']).'%'   
                    ?>           
                    </td>    
                </tr>
                <tr>
                    <td>Obrabuj żebraka</td>
                    <td>
                        <form method=POST>
                            <input name=crime value=2 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>
                    <?php
                        echo $crime->calculateChance(540, $_SESSION['progress']).'%'   
                    ?>           
                    </td>   
                </tr>
                <tr>
                    <td>Zabierz torebkę starszej pani</td>
                    <td>
                        <form method=POST>
                            <input name=crime value=3 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>
                    <?php
                        echo $crime->calculateChance(800, $_SESSION['progress']).'%'   
                    ?>           
                    </td>   
                </tr>
                <tr>
                    <td>Napadnij na Kebaba</td>
                    <td>
                        <form method=POST>
                            <input name=crime value=4 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>
                    <?php
                        echo $crime->calculateChance(3500, $_SESSION['progress']).'%'   
                    ?>      
                    </td>   
                </tr>
            </tbody>
        </table>
        <?php
            $connect = new DatabaseCommunication;

        //BLOKOWANIE PRZESTĘPSTW
        function blokowanie(){
            $_SESSION['przestepstwastop']=true;
            $id = $_SESSION["id"];
            $kwerenda = "UPDATE users SET tprzestepstwa=now()+INTERVAL 3 MINUTE WHERE id=$id ;";
            $update = mysqli_query( $connect, $kwerenda);
            $zmienna = mysqli_query( $connect, "SELECT tprzestepstwa FROM users WHERE id=$id");
            $row = mysqli_fetch_array($zmienna);
            $_SESSION['tprzestepstwa'] = $row['tprzestepstwa'];
        }            

        if(isset($_SESSION['przestepstwastop']) && $_SESSION['przestepstwastop']){
            echo "<p class='lose'>Spokojnie, nie szalej tak - odpocznij trochę od przestępstw</p>";
        //if(isset($_SESSION['odswiezenieprzestepstw']))
        //    header('refresh: '.$_SESSION['odswiezenieprzestepstw'].' url=przestepstwa.php'); //odświeżenie strony po 5 minutach
        }
        else{

            if(isset($_POST['crime'])){
                $disableAction->handle('przestepstwastop', $connect, 180, 'tsilka', $_SESSION["id"]);

                switch($_POST['crime']){
                /////////////////////////////PRZESTĘPSTWO 1/////////////////////////
                case 1:

                    function przegrana(){
                        $czas=3; //3 minuty
                        $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                        $kwerenda = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                        $update = mysqli_query( $connect, $kwerenda); //Wykonuje kwerendę
                        $zmienna = mysqli_query( $connect, "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                        $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                        $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
                        mysqli_close($unconnect); //zamyka połączenie z bazą

                        $_SESSION['wiezieniestop1']=true;
                        echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minuty!</p>";
                    }
                    
                    if($crime->checkIfPlayerWin(90, $_SESSION['progress']))
                        $crime->playerWin(10, 10, $connect, $_SESSION['id']);

                    else przegrana();
                    break;
                    /////////////////////////////PRZESTĘPSTWO 2/////////////////////////
                case 2:

                function wygrana(){
                    $hajs=rand(11,20);
                    $progress=rand(11,20);
                    $id =  $_SESSION['id'];
                    echo "<p class='success'>Udało Ci się, zyskałeś $hajs PLN i $progress do szacunku</p>";
                    $_SESSION['progress']+=$progress;
                    $_SESSION['hajs']+=$hajs;
                    $prog=$_SESSION['progress'];
                    $twojhajs=$_SESSION['hajs'];
                    $kwerenda = "UPDATE users SET progress=$prog, hajs=$twojhajs  WHERE id=$id ;";
                    $update = mysqli_query( $connect, $kwerenda);
                }

                function przegrana(){
                    $czas=5; //minuty
                    $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                    $kwerenda = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                    $update = mysqli_query( $connect, $kwerenda); //Wykonuje kwerendę
                    $zmienna = mysqli_query( $connect, "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                    $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                    $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
                    mysqli_close($unconnect); //zamyka połączenie z bazą

                    $_SESSION['wiezieniestop1']=true;
                    echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minut!</p>";
                }

                if($crime->checkIfPlayerWin(540, $_SESSION['progress']))
                    $crime->playerWin(20, 20, $connect, $_SESSION['id']);
                
                else przegrana();
                break;
                 /////////////////////////////PRZESTĘPSTWO 3/////////////////////////
                case 3:
 
                 function przegrana(){
                    $czas=10; //minuty
                    $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                    $kwerenda = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                    $update = mysqli_query( $connect, $kwerenda); //Wykonuje kwerendę
                    $zmienna = mysqli_query( $connect, "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                    $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                    $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
                    mysqli_close($unconnect); //zamyka połączenie z bazą

                    $_SESSION['wiezieniestop1']=true;
                    echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minut!</p>";
                }
                if($crime->checkIfPlayerWin(800, $_SESSION['progress'])){
                    $crime->playerWin(30, 30, $connect, $_SESSION['id']);
                }
                else przegrana();
                 break;
                  /////////////////////////////PRZESTĘPSTWO 4/////////////////////////
                  case 4:
  
                  function przegrana(){
                    $czas=5; //minuty
                    $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                    $kwerenda = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                    $update = mysqli_query( $connect, $kwerenda); //Wykonuje kwerendę
                    $zmienna = mysqli_query($connect, "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                    $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                    $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej

                    $_SESSION['wiezieniestop1']=true;
                    echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minut!</p>";
                }
                if($crime->checkIfPlayerWin(3500, $_SESSION['progress'])){
                    $crime->playerWin(300, 300, $connect, $_SESSION['id']);
                }
                else przegrana();
                break;
            }
        }
    }

    //CZAS DOSTĘPU
    if(isset($_SESSION['przestepstwastop']))
					echo "<p style=text-align:center>Pozostało: ".$crimeAccessTime->timeToEnd($_SESSION['tprzestepstwa'])."</p>";
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