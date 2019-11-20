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
        
		<div id="lewypanel">
			<?php include("lewypanel.php")?>
        </div>
        
		<div id=content>
			<h1 style="text-align: center;">Paczki</h1>
			<p>
                Raz dziennie możesz odebrać paczkę ze statystykami. 
			</p>

        <form method=POST>
        <input type=submit value="Odbierz paczkę" name=paczki class=button>
        </form>


        <?
        if(isset($_SESSION['paczkistop']) && $_SESSION['paczkistop']){
            echo "<p id=losewalka>Odebrałeś już paczkę</p>";
            if(isset($_SESSION['odswiezeniepaczek']))
                header('refresh: '.$_SESSION['odswiezeniepaczek'].' url=./paczki.php'); //odświeżenie strony po 5 minutach
        }
        else{
            if(isset($_POST['paczki'])){
                $czas=24; //24 godziny
                        if($_SESSION['ranga']<=2){
                            $hajs=rand(50,100);
                            $sila=rand(15,25);
                            $obrona=rand(10,15);
                            $szybkosc=rand(10,15);
                        }

                        if($_SESSION['ranga']<=5){
                            $hajs=rand(100,500);
                            $sila=rand(25,35);
                            $obrona=rand(20,25);
                            $szybkosc=rand(20,25);
                        }
                        if($_SESSION['ranga']<=10){
                            $hajs=rand(500,1000);
                            $sila=rand(35,45);
                            $obrona=rand(30,35);
                            $szybkosc=rand(30,35);
                        }

                        echo "<p id=winwalka>Otworzyłeś dzienną paczkę. Zgarnąłeś $hajs PLN, $sila siły
                              , $obrona obrony i $szybkosc szybkości</p>";
                        $_SESSION['hajs']+=$hajs;
                        $hajs=$_SESSION['hajs'];
                        $_SESSION['sila']+=$sila;
                        $sila=$_SESSION['sila'];
                        $_SESSION['obrona']+=$obrona;
                        $obrona=$_SESSION['obrona'];
                        $_SESSION['szybkosc']+=$szybkosc;
                        $szybkosc=$_SESSION['szybkosc'];

                        connect();
                        $unconnect=connect();
                        $id = $_SESSION["id"];
                        $kwerenda = "UPDATE users SET hajs=$hajs, sila=$sila, obrona=$obrona, szybkosc=$szybkosc WHERE id=$id ;";
                        $update = mysqli_query(connect(), $kwerenda);
                        mysqli_close($unconnect);

                                            //BLOKOWANIE PRACY
                        $_SESSION['paczkistop']=true;
                        connect();
                        $unconnect=connect();
                        $id = $_SESSION["id"];
                        $kwerenda = "UPDATE users SET tpaczki=now()+INTERVAL $czas HOUR WHERE id=$id ;";
                        $update = mysqli_query(connect(), $kwerenda);
                        $zmienna = @mysqli_query(mysqli_connect("localhost", "root", "", "gangi"), "SELECT tpaczki FROM users WHERE id=$id");
                        $row = mysqli_fetch_array($zmienna);
                        $_SESSION['tpaczki'] = $row['tpaczki'];
                        mysqli_close($unconnect);      
                }
            }

        //CZAS DOSTĘPU
$dataczas = new DateTime();
$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tpaczki']);
$roznica = $dataczas->diff($koniec);
$_SESSION['paczkiczas'] = $roznica;

if($dataczas<$koniec){
	$_SESSION['paczkistop'] = true;
	echo "<p style=text-align:center>Pozostało: ".$roznica->format('%H godzin, %i minut, %s sekund')."</p>";
	$_SESSION['odswiezeniepaczek']=$roznica->format('%s')+1;
	$_SESSION['paczki']=$roznica->format('%H godzin, %i minut, %s sekund');
}
else {
	$_SESSION['paczkistop'] = false;
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


































