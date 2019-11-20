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
			<h1 style="text-align: center;">Siłka</h1>
			<p>
				Nie przetrwasz na ulicy jeśli nie będziesz chodzić na siłkę.
				Zaglądaj tu regularnie ale pamiętaj również żeby dać
				mięśniom czas na regenerację.
			</p>

				<table>
					<tbody>
						<tr>
						<form method="POST"> 
							<td><input type=text class=silka style="color: black;" value=<?=$_SESSION['ranga']?> readonly name="sila"/></td>
							<td><input type=submit class=silkasub value="Siła" title="Trenuj siłę"/></td>
						</form>
						<form method="POST">
							<td><input type=text class=silka style="color: black;" value=<?=$_SESSION['ranga']?> readonly name="obrona"/></td>
							<td><input type=submit class=silkasub value="Obrona" title="Trenuj obronę"/></td>
						</form>
						<form method="POST">
							<td><input type=text class=silka style="color: black;" value=<?=$_SESSION['ranga']?> readonly name="szybkosc"/></td>
							<td><input type=submit class=silkasub value="Szybkość" title="Trenuj szybkość"/></td>
						</tr>
						</form>
					</tbody>
				</table>

<p></p>

<?php 

if(isset($_SESSION['silkastop']) && $_SESSION['silkastop']){
	echo "<p id=losewalka>Daj mięśniom trochę odpocząć bo się przerenujesz</p>";
	if(isset($_SESSION['odswiezeniesilki']))
	header('refresh: '.$_SESSION['odswiezeniesilki'].' url=silka.php'); //odświeżenie strony po 5 minutach
}
else{
	//SIŁA
	if(isset ($_POST['sila']))
	{
		//Blokowanie siłowni
		$_SESSION['silkastop']=true;
		$id = $_SESSION["id"];
		$kwerenda = "UPDATE users SET tsilka=now()+INTERVAL 300 SECOND WHERE id=$id ;";
		$update = mysqli_query(connect(), $kwerenda);


		$zmienna = @mysqli_query(mysqli_connect("localhost", "root", "", "gangi"), "SELECT tsilka FROM users WHERE id=$id");
		$row = mysqli_fetch_array($zmienna);
		$_SESSION['tsilka'] = $row['tsilka'];



		$_SESSION['sila']=$_SESSION['sila']+$_POST['sila'];
		$sila = $_SESSION['sila'];
		$kwerenda = "UPDATE users SET sila=$sila WHERE id=$id ;";
		$update = mysqli_query(connect(), $kwerenda);
		mysqli_close($unconnect); //rozłączenie z bazą
		echo "<p id=winwalka>Gratuluję, dodałeś ".$_POST['sila']." do siły</p>";
		
	}


	//OBRONA
	if(isset ($_POST['obrona']))
	{
		//Blokowanie siłowni
		$_SESSION['silkastop']=true;
		connect();
		$id = $_SESSION["id"];
		$kwerenda = "UPDATE users SET tsilka=now()+INTERVAL 300 SECOND WHERE id=$id ;";
		$update = mysqli_query(connect(), $kwerenda);
		$zmienna = @mysqli_query(mysqli_connect("localhost", "root", "", "gangi"), "SELECT tsilka FROM users WHERE id=$id");
		$row = mysqli_fetch_array($zmienna);
		$_SESSION['tsilka'] = $row['tsilka'];


		$_SESSION['obrona']+=$_POST['obrona'];
		echo "<p id=winwalka> Gratuluję, dodałeś ".$_POST['obrona']." do obrony</p>";
		$obrona = $_SESSION['obrona'];
		$kwerenda = "UPDATE users SET obrona=$obrona WHERE id=$id ;";
		$update = mysqli_query(connect(), $kwerenda);
		mysqli_close($unconnect);
	}

		//SZYBKOŚĆ
		if(isset ($_POST['szybkosc']))
		{
			//Blokowanie siłowni
			$_SESSION['silkastop']=true;
			connect();
			$id = $_SESSION["id"];
			$kwerenda = "UPDATE users SET tsilka=now()+INTERVAL 300 SECOND WHERE id=$id ;";
			$update = mysqli_query(connect(), $kwerenda);
			$zmienna = @mysqli_query(mysqli_connect("localhost", "root", "", "gangi"), "SELECT tsilka FROM users WHERE id=$id");
			$row = mysqli_fetch_array($zmienna);
			$_SESSION['tsilka'] = $row['tsilka'];
					
			//Dodawanie statystyk
			$_SESSION['szybkosc']+=$_POST['szybkosc'];
			$szybkosc = $_SESSION['szybkosc'];
			$kwerenda = "UPDATE users SET szybkosc=$szybkosc WHERE id=$id ;";
			$update = mysqli_query(connect(), $kwerenda);
			mysqli_close($unconnect);
			echo "<p id=winwalka>Gratuluję, dodałeś ".$_POST['szybkosc']." do szybkości</p>";
		}
}	




//CZAS DOSTĘPU
$dataczas = new DateTime();
$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tsilka']);
$roznica = $dataczas->diff($koniec);
$_SESSION['silkaczas'] = $roznica;

if($dataczas<$koniec){
	$_SESSION['silkastop'] = true;
	echo "<p style=text-align:center>Pozostało: ".$roznica->format('%i minut, %s sekund')."</p>";
	$_SESSION['odswiezeniesilki']=$roznica->format('%s')+1;
	$_SESSION['silka']=$roznica->format('%i minut, %s sekund');
}
else {
	$_SESSION['silkastop'] = false;
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


































