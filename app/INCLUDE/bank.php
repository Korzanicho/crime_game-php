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

        $max=$_SESSION['hajs'];
        $max2=$_SESSION['bank'];

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
        
		<div class='content bank'>

            <h1 style="text-align: center;">Bank</h1>
			<p>
				Regularnie wpłacaj hajs do banku żeby nikt nie mógł Cię
                okraść.
			</p>
            <form method="POST">    
                <td><input type=number style="color: black"  min=0 max=<?=$max?> value=<?=$max?> name=wplac /></td>
                <td><input type=submit value="Wpłać hajs do banku"></td>     
            </form>
            <form method="POST">    
                <td><input type=number style="color: black" min=0 max=<?=$max2?> value=<?=$max2?> name=wyplac /></td>
                <td><input type=submit value="Wypłać pieniądze"></td>     
            </form>
            <br /><br />

            <?
            if(isset($_POST['wplac'])){
                $_SESSION['hajs']-=$_POST['wplac'];
                $_SESSION['bank']+=$_POST['wplac'];

                $hajs=$_SESSION['hajs'];
                $bank=$_SESSION['bank'];
                header ("Location: bank.php");
                
                connect(); //Łączymy się z bazą
				$id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
				$kwerenda = "UPDATE users SET hajs=$hajs, bank=$bank WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
				$update = mysqli_query(connect(), $kwerenda); //Wykonuje kwerendę
				mysqli_close($unconnect); //zamyka połączenie z bazą 
            }

            if(isset($_POST['wyplac'])){
                $_SESSION['hajs']+=$_POST['wyplac'];
                $_SESSION['bank']-=$_POST['wyplac'];
                header ("Location: bank.php");

                $hajs=$_SESSION['hajs'];
                $bank=$_SESSION['bank'];

                connect(); //Łączymy się z bazą
				$id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
				$kwerenda = "UPDATE users SET hajs=$hajs, bank=$bank WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
				$update = mysqli_query(connect(), $kwerenda); //Wykonuje kwerendę
				mysqli_close($unconnect); //zamyka połączenie z bazą 
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


































