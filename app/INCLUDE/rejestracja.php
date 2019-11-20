<!DOCTYPE html>
<html>
<head>
	<?php include("./head.php")?>
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<?php
		session_start();

		if(isset($_POST['email'])){
			$wszystko_OK = true;

			$nick = $_POST['nick'];
			if((strlen($nick)<3) || (strlen($nick)>16)){
				$wszystko_OK = false;
				$_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków";

			}

			if(ctype_alnum($nick)==false){
				$wszystko_OK = false;
				$_SESSION['e_nick'] = "Nick nie może zawierać znaków specjalnych";
			}

			$email = $_POST['email'];
			$emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
			if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($email!=$emailB)){
				$wszystko_OK=false;
				$_SESSION['e_email'] = "Niepoprawny adres e-mail";
			}

			$haslo1 = $_POST['password'];
			$haslo2 = $_POST['2password'];

			if(strlen($haslo1)<6){
				$wszystko_OK = false;
				$_SESSION['e_haslo'] = "Hasło musi posiadać minimum 6 znaków";
			}

			if($haslo1!=$haslo2){
				$wszystko_OK = false;
				$_SESSION['e_haslo'] = "Podane hasła nie są identyczne";
			}

			$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
			
			if(!isset($_POST['checkbox'])){
				$wszystko_OK = false;
				$_SESSION['e_checkbox'] = "Proszę zaakceptować regulamin";
			}
/*
			$sekret = "6LfgiBsUAAAAAIXeuKCD3zoQxtQzSL_0qdGoEtzf";
			$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
			$odpowiedz= json_decode($sprawdz);
			if($odpowiedz->success==false){
				$wszystko_OK = false;
				$_SESSION['e_reca'] = "Proszę potwierdzić, że nie jesteś robotem";
			}
*/
			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);
			try{
				$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
				if($polaczenie->connect_errno!=0){
					throw new Exception(mysqli_connect_errno());
				}
				else{
					$rezultat=$polaczenie->query("SELECT id FROM users WHERE email='$email'");
					if(!$rezultat) throw new Exception($polaczenie->error);
					$ile_takich_maili = $rezultat->num_rows;
					if($ile_takich_maili>0){
						$wszystko_OK = false;
						$_SESSION['e_email'] = "Podany email jest zajęty";
					}

					$rezultat=$polaczenie->query("SELECT id FROM users WHERE username='$nick'");
					if(!$rezultat) throw new Exception($polaczenie->error);
					$ile_takich_nickow = $rezultat->num_rows;
					if($ile_takich_nickow>0){
						$wszystko_OK = false;
						$_SESSION['e_nick'] = "Podana nazwa jest zajęta";
					}

					if($wszystko_OK==true){
						//hurra
						if($polaczenie->query("INSERT INTO users VALUES(NULL, '$nick', '$haslo_hash', 0, 0, 0, 100, 0, '$email', 0, 0, 0, 0, now(), now(), now(), now(), now(), now(), now(), 0, 1)")){
							
							
							$sklep = "INSERT INTO sklep VALUES (NULL, $nick, 0);"; //TWORZYMY BAZĘ Z PRZEDMIOTAMI;
							$update = mysqli_query($sklep); //NA TYM SKOŃCZYŁEM ROZKMINY!!!!!!!!!!!!!!!!!!!!!!!!!!
							
							$_SESSION['udanarejestracja']=true;
							header ("Location: witamy.php");
						}
						else{
							throw new Exception($polaczenie->error);
						}
					}

					$polaczenie->close();
				}
			}
			catch(Exception $e){
				echo "Błąd serwera, przepraszamy za niedogodności";
				echo "<br />Informacja deweloperska: ".$e;
			}
		}
	?>
</head>
<body>
	<div class=container>
		<header>
			<?php include("./header.php")?>
		</header>
		<div class='panel panel--left'>
			<div class=menu>
				<?php include("./menu.php")?>
			</div>
			<div class="menu">
				<?php include("./screenshoty.php");?>
			</div>
		</div>
		<div class='content'>
		
			<div class="panel panel--register">
				<h4 class='title'>Rejestracja</h4>

				<form method=POST>
					<label for="nick">Nazwa użytkownika:</label>
					<input type="text" id="nick" name="nick">
					<?php 
						if(isset($_SESSION['e_nick'])){
							echo "<div class=error>".$_SESSION['e_nick']."</div>";
							unset($_SESSION['e_nick']);
						}
					?>

					<label for="password">Hasło:</label>
					<input type="password" id="password" name="password">

					<?php 
						if(isset($_SESSION['e_haslo'])){
							echo "<div class=error>".$_SESSION['e_haslo']."</div>";
							unset($_SESSION['e_haslo']);
					}
					?>

					<label for="2password">Powtórz hasło:</label>
					<input type="password" id="2password" name="2password">

					<label for="email">Adres e-mail:</label>
					<input type="email" id="email" name="email">

					<?php 
						if(isset($_SESSION['e_email'])){
							echo "<div class=error>".$_SESSION['e_email']."</div>";
							unset($_SESSION['e_email']);
					}
					?>

					<div class="g-recaptcha" data-sitekey="6LfgiBsUAAAAAEpOg-kVnN1AmAGJnUvG1RSZkU8j"></div>
					<?php 
						if(isset($_SESSION['e_reca'])){
							echo "<div class=error>".$_SESSION['e_reca']."</div>";
							unset($_SESSION['e_reca']);
					}
					?>
					
					<table>
						<tr>
							<td><label for="checkbox">Akceptuję regulamin</label></td>
							<td><input type="checkbox" id="checkbox" name="checkbox"></td>
						</tr>
					</table>
					<?php 
								if(isset($_SESSION['e_checkbox'])){
									echo "<div class=error>".$_SESSION['e_checkbox']."</div>";
									unset($_SESSION['e_checkbox']);
								}
					?>

					<input type="reset" value="Wyczyść" class='btn--reset'>
					<input type="submit" value="Zarejestruj" class='btn'>
					
				</form>
			</div>
		</div>
		
		<div class='panel panel--right'>
			<div class='panel__login'>
					<?php include("logowanie.php")?>
			</div>
			<div class="menu">
				<?php include("graczeonline.php")?>
			</div>
		</div>
		<div style="clear: both;"></div>
		<footer>
			<?php include("./stopka.php");?>
		</footer>
	</div>
</body>
</html>
