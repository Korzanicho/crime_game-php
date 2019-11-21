<!DOCTYPE html>
<html>
<head>
	<?php 
		session_start();
		include("head.php");
		if(!isset($_SESSION['zalogowany'])){
			header('Location: ../index.php');
			exit();
		}

        require_once "connect.php";
        
        $max=100-$_SESSION['zdrowie'];
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
        
		<div class='content hospital'>

		<h1 style="text-align: center;">Szpital</h1>
		<p>Szpital to miejsce, do którego trafisz gdy ktoś Ci dokopał.
		Masz szanse na wcześniejsze wyjście ze szpitala gdy gracz z wyższą
		rangą Cię wykupi. Stracisz wtedy 10% hajsu z Twojego konta bankowego</p>

        <tr>
        <form method="POST">
           
                <td><input type=number min=1 max=<?=$max?> value=<?=$max?> name=szpital class='hospital' /></td>
                <td><input type=submit value="Idź do szpitala"></td>
            
        </form>

        <?php
		if(isset($_SESSION['szpitalstop']) && $_SESSION['szpitalstop']){
			echo "<p class='lose'>Byłeś miękką fają, teraz musisz odsiedzieć swoje. Posiedzisz tu trochę.</p>";
			if(isset($_SESSION['odswiezenieszpitala']))
			header('refresh: '.$_SESSION['odswiezenieszpitala'].' url=szpital.php'); //odświeżenie strony po określonym czasie
		}
		else{
			if(isset($_POST['szpital'])){
				$_SESSION['spitalstop'] = true; 
				$czas=$_POST['szpital']/2; #Czas taki jaki wysłaliśmy POSTEM
				$updatezdrowia=$_SESSION['zdrowie']+$_POST['szpital']; //Takie zdrowie ustawi nam w bazie
				connect(); //Łączymy się z bazą
				$id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
				$kwerenda = "UPDATE users SET tszpital=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
				$update = mysqli_query(connect(), $kwerenda); //Wykonuje kwerendę
				$zmienna = @mysqli_query(mysqli_connect("localhost", "root", "", "gangi"), "SELECT tszpital FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
				$row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
				$_SESSION['tszpital'] = $row['tszpital']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
	
				$kwerenda = "UPDATE users SET zdrowie=$updatezdrowia WHERE id=$id ;"; //wstawia zaktualizowane zdrowie do bazy
				$update = mysqli_query(connect(), $kwerenda); //Wykonuje powyższą kwerendę
				$_SESSION['zdrowie'] = $updatezdrowia; #od razu ustawia zdrowie na to po wizycie w szpitalu
	
				mysqli_close($unconnect); //zamyka połączenie z bazą 
			}
		}
        	
		//CZAS DOSTĘPU
		$dataczas = new DateTime();
		$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tszpital']);
		$roznica = $dataczas->diff($koniec);
		$_SESSION['szpitalczas'] = $roznica;

		if($dataczas<$koniec){
			$_SESSION['szpitalstop'] = true;
			echo "<p style=text-align:center>Pozostało: ".$roznica->format('%i minut, %s sekund')."</p>";
			$_SESSION['odswiezenieszpitala']=$roznica->format('%s')+1;
			$_SESSION['szpital']=$roznica->format('%i minut, %s sekund');
		}
		else {
			$_SESSION['szpitalstop'] = false;
		} 

        ?>
        </tr>
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


































