<!DOCTYPE html>
<html>
<head>
	<?php 
		session_start(); //rozpoczęcie sesji
		include("head.php"); //zainkludowanie nagłówka <head>
		require_once('./connect.php'); //zainkludowanie połączenia z bazą
		if(!isset($_SESSION['zalogowany'])){ //jeżeli nie jesteś zalogowany wykonaj if
			header('Location: ../index.php'); //przenieś niezalogowanego użytkownika do indexu
			exit(); //przerwij wykonywanie reszty kodu
		}

		//Jeżeli jesteś w szpitalu
		if(isset($_SESSION['szpitalstop']) && $_SESSION['szpitalstop']){
			header('Location: ./szpital.php');
			exit();
        }
        
        //Jeżeli jesteś w więzieniu
		if(isset($_SESSION['wiezieniestop']) && $_SESSION['wiezieniestop']){
			header('Location: ./wiezienie.php');
			exit();
        }
		
		#error_reporting(E_ALL ^ E_NOTICE);
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
			<h1 style="text-align: center;">Dilerka</h1>
			<p>
                Łatwa kasa dla kumatych - wiążąca się z przypałem. Duży zarobek
                i doświadczenie ale również możliwość długiej odsiadki w więzieniu. 
                Bądź ostrożny.
			</p>

        <table id=ranking>
            <tr>
                <th>Diluj: </th><th></th><th>Czas:</th>
            <tr>
            <tr>
            <td>Handluj drożdżówkami pod podstawówką</td>
                    <td>
                        <form method=POST>
                            <input name=dil value=1 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>10 min<td>
            </tr>
        </table>


        <?php

        if(isset($_SESSION['dilerkastop']) && $_SESSION['dilerkastop']){
            echo "<p class='lose'>Jak będziesz za często dilował to zgarniesz przypał. Poczekaj trochę</p>";
            if(isset($_SESSION['odswiezeniedilerki']))
                header('refresh: '.$_SESSION['odswiezeniedilerki'].' url=./dilerka.php'); //odświeżenie strony po 5 minutach
        }
        else{

            $szansa=rand(0,100);

            if(isset($_POST['dil'])){
                switch($_POST['dil']){
                    case 1:

                    if($szansa<15){
                        $czas=20; //3 minuty
                        $unconnect=connect();
                        connect(); //Łączymy się z bazą
                        $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                        $oczekiwanie = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                        $update = mysql_query($oczekiwanie); //Wykonuje kwerendę
                        $zmienna = @mysqli_query(mysqli_connect("localhost", "root", "", "gangi"), "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                        $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                        $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
                        mysql_close($unconnect); //zamyka połączenie z bazą

                        $_SESSION['wiezieniestop']=true;
                        echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minut!</p>";
                    }
                    else{
                        $hajs=rand(1,20);
                        $progress=rand(1,20);

                        $czas=10;
                        echo "<p class='success'>Udało Ci się bez przypału. Zgarnąłeś $hajs PLN i $progress szacunku</p>";
                        $_SESSION['hajs']+=$hajs;
                        $_SESSION['progress']+=$progress;
                        $hajs=$_SESSION['hajs'];
                        $progress=$_SESSION['progress'];
                        connect();
                        $unconnect=connect();
                        $id = $_SESSION["id"];
                        $kwerenda = "UPDATE users SET hajs=$hajs, progress= WHERE id=$id ;";
                        $update = mysqli_query(connect(), $kwerenda);
                        mysqli_close($unconnect);

                                            //BLOKOWANIE DILERKI
                        $_SESSION['dilerkastop']=true;
                        connect();
                        $unconnect=connect();
                        $id = $_SESSION["id"];
                        $oczekiwanie = "UPDATE users SET tdilerka=now()+INTERVAL $czas MINUTE WHERE id=$id ;";
                        $update = mysqli_query(connect(), $oczekiwanie);
                        $zmienna = @mysqli_query(connect(), "SELECT tdilerka FROM users WHERE id=$id");
                        $row = mysqli_fetch_array($zmienna);
                        $_SESSION['tdilerka'] = $row['tdilerka'];
                        mysqli_close($unconnect);
                    }
                    break;       
                }
            }
        }

        //CZAS DOSTĘPU
$dataczas = new DateTime();
$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tdilerka']);
$roznica = $dataczas->diff($koniec);
$_SESSION['dilerkaczas'] = $roznica;

if($dataczas<$koniec){
	$_SESSION['dilerkastop'] = true;
	echo "<p style=text-align:center>Pozostało: ".$roznica->format('%i minut, %s sekund')."</p>";
	$_SESSION['odswiezeniedilerki']=$roznica->format('%s')+1;
	$_SESSION['dilerka']=$roznica->format('%i minut, %s sekund');
}
else {
	$_SESSION['dilerkastop'] = false;
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


































