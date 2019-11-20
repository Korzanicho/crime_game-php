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
		/*if(isset($_SESSION['wiezieniestop']) && $_SESSION['wiezieniestop']){
			header('Location: ./wiezienie.php');
			exit();
        }*/
		
		#error_reporting(E_ALL ^ E_NOTICE);
	?>
</head>
<body>
	<div class=container>
		<header>
			<?php include("header.php")?> 
        </header>
        
		<div id="lewypanel">
			<?php include("lewypanel.php")?>
        </div>
        
		<div id=content>
			<h1 style="text-align: center;">Praca</h1>
			<p>
                Nie ma to jak legalne interesy. Z góry wiesz ile hajsu 
                dostaniesz oraz nie musisz się martwić przypałem. Tylko
                szacunku za to nie dostaniesz lecz pamiętaj - żadna praca 
                nie hańbi. 
			</p>

        <table id=ranking>
            <tr>
                <th>Pracuj: </th><th></th><th>Wynagrodzenie:</th><th>Czas:</th>
            <tr>
            <tr>
            <td>Posprzątaj biuro prezesa</td>
                    <td>
                        <form method=POST>
                            <input name=work value=1 type=hidden />
                            <input src="../pictures/ok.gif" type=image />
                        </form>
                    </td>
                    <td>50 pln</td>
                    <td>20 min</td>
            </tr>
        </table>


        <?php

        if(isset($_SESSION['pracastop']) && $_SESSION['pracastop']){
            echo "<p id=losewalka>Musisz skończyć najpierw poprzednią
            robotę aby brać się za następną</p>";
            if(isset($_SESSION['odswiezeniepracy']))
                header('refresh: '.$_SESSION['odswiezeniepracy'].' url=./praca.php'); //odświeżenie strony po 5 minutach
        }
        else{
            if(isset($_POST['work'])){
                switch($_POST['work']){
                    case 1:

                        $hajs=50;
                        $czas=20;

                        echo "<p id=winwalka>Poszedłeś do pracy. Zgarnąłeś $hajs PLN</p>";
                        $_SESSION['hajs']+=$hajs;
                        $hajs=$_SESSION['hajs'];
                        connect();
                        $unconnect=connect();
                        $id = $_SESSION["id"];
                        $kwerenda = "UPDATE users SET hajs=$hajs WHERE id=$id ;";
                        $update = mysqli_query(connect(), $kwerenda);
                        mysqli_close($unconnect);

                                            //BLOKOWANIE PRACY
                        $_SESSION['pracastop']=true;
                        connect();
                        $unconnect=connect();
                        $id = $_SESSION["id"];
                        $oczekiwanie = "UPDATE users SET tpraca=now()+INTERVAL $czas MINUTE WHERE id=$id ;";
                        $update = mysqli_query(connect(), $oczekiwanie);
                        $zmienna = mysqli_query(mysqli_connect("localhost", "root", "", "gangi"), "SELECT tpraca FROM users WHERE id=$id");
                        $row = mysqli_fetch_array($zmienna);
                        $_SESSION['tpraca'] = $row['tpraca'];
                        mysqli_close($unconnect);
                        break;       
                }
            }
        }

        //CZAS DOSTĘPU
$dataczas = new DateTime();
$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tpraca']);
$roznica = $dataczas->diff($koniec);
$_SESSION['pracaczas'] = $roznica;

if($dataczas<$koniec){
	$_SESSION['pracastop'] = true;
	echo "<p style=text-align:center>Pozostało: ".$roznica->format('%i minut, %s sekund')."</p>";
	$_SESSION['odswiezeniepracy']=$roznica->format('%s')+1;
	$_SESSION['praca']=$roznica->format('%i minut, %s sekund');
}
else {
	$_SESSION['pracastop'] = false;
 } 
        ?>
		</div>
		
		<div id=prawypanel>
            <?php include("prawypanel.php")?>
        </div>
        
		<div style="clear: both;"></div>
		<div id="stopka">
		    <?php include("stopka.php");?>
		</div>
	</div>
</body>
</html>


































