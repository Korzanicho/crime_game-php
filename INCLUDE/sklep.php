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

            <h1 style="text-align: center;">Sklep</h1>
			<p>
				Witaj na czarnym rynku. Kupisz tu broń, która przyda Ci się w walkach.
			</p>
            <table class=ekwipunek>
            <thead>
                <h3>Atak</h3>
            </thead>
                <tr>
                    <th>Nazwa</th> <th>Statystyki</th> <th>Cena</th> <th>Kup</th>
                </tr>
                <tr>
                    <td>Czapka wpierdolka</td> 
                    <td>+50</td> 
                    <td>300 PLN</td> 
                    <td>
                        <form method=POST>
                            <input name=czapka type=hidden />
                            <input src="../pictures/ok.gif" type=image />
                        </form>
                    </td>
                </tr>
            </table>

			<table class=ekwipunek>
            <thead>
                <h3>Obrona</h3>
            </thead>
                <tr>
                    <th>Nazwa</th> <th>Statystyki</th> <th>Cena</th> <th>Kup</th>
                </tr>
                <tr>
                    <td>Kołczan Prawilności</td> 
                    <td>+100</td> 
                    <td>250 PLN</td> 
                    <td>
                        <form method=POST>
                            <input name=kolczan type=hidden />
                            <input src="../pictures/ok.gif" type=image />
                        </form>
                    </td>
                </tr>
            </table>

        <?php
        //KUPNO CZAPKI WPIERDOLKI
            if(isset($_POST['czapka'])){
                $cena=300;
                if($cena>$_SESSION['hajs']){
                    echo "<p id=losewalka>Kogo chcesz oszukać, masz za mało hajsu!</p>";
                }
                else{
					if($_SESSION['czapkawpierdolka']==1){
						echo "<p id=losewalka>Masz już ten przedmiot!</p>";
					}
					else{
						$_SESSION['hajs']-=$cena;
						$cena=$_SESSION['hajs'];
						$user = $_SESSION["user"];
						$_SESSION['sila']+=50;
						$sila = $_SESSION['sila'];

						connect();
						$unconnect=connect();
                        $kwerenda = "UPDATE sklep SET czapkawpierdolka=1 WHERE username='$user'";
						$update = mysqli_query(connect(), $kwerenda);
						
						$kwerenda = "UPDATE users SET sila=$sila, hajs=$cena WHERE username='$user' ;";
						$update = mysqli_query(connect(), $kwerenda);
						mysqli_close($unconnect);
						
						$_SESSION['czapkawpierdolka']=1;
						echo "<p id=winwalka>Kupiłeś czapkę wpierdolkę!</p>";
						
					}
                }
			}
			
	//KUPNO KOŁCZANU PRAWILNOŚCI
	if(isset($_POST['kolczan'])){
		$cena=250;
		if($cena>$_SESSION['hajs']){
			echo "<p id=losewalka>Kogo chcesz oszukać, masz za mało hajsu!</p>";
		}
		else{
			if($_SESSION['kolczanprawilnosci']==1){
				echo "<p id=losewalka>Masz już ten przedmiot!</p>";
			}
			else{
				$_SESSION['hajs']-=$cena;
				$cena=$_SESSION['hajs'];
				$user = $_SESSION["user"];
				$_SESSION['obrona']+=50;
				$sila = $_SESSION['obrona'];

				connect();
				$unconnect=connect();
				$kwerenda = "UPDATE sklep SET kolczanprawilnosci=1 WHERE username='$user'";
				$update = mysqli_query(connect(), $kwerenda);
				
				$kwerenda = "UPDATE users SET sila=$sila, hajs=$cena WHERE username='$user' ;";
				$update = mysqli_query(connect(), $kwerenda);
				mysqli_close($unconnect);
				
				$_SESSION['kolczanprawilnosci']=1;
				echo "<p id=winwalka>Kupiłeś kołczan prawilności!</p>";
				
			}
		}
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


































