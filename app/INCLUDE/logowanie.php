<h4 class='title'>Logowanie</h4>
<form action=index.php method=POST>
	<label for="username">Nazwa użytkownika:</label>
	<input type="text" id="username" name="username">
	<br>
	<label for="password">Hasło:</label>
	<input type="password" id="password" name="password">
					
	<input type="submit" value="Login" class='btn'>
	<p><a href="#">Zapomniałeś hasła?</a></p>
	<p><a href="rejestracja.php">Rejestracja</a></p>
</form>

<?php
	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
		header ('Location: start.php');
		exit();
	}

	if(isset ($_POST['username']) || isset ($_POST['password'])){
		require_once "connect.php";
		
			$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name); //połączenie z bazą danych
		
			if($polaczenie->connect_errno!=0){
				echo "Error ".$polaczenie->connect_errno;
			}
			else{
				$username = $_POST['username'];
				$password = $_POST['password'];

				$username = htmlentities($username, ENT_QUOTES, "UTF-8");

				if($rezultat=@$polaczenie->query(
				sprintf("SELECT * FROM users WHERE username='%s'",
				mysqli_real_escape_string($polaczenie,$username))))
				{
					$ilu_userow = $rezultat->num_rows;
					if($ilu_userow>0){

						$wiersz = $rezultat->fetch_assoc();
						if(password_verify($password,$wiersz['pass'])){

							$_SESSION['zalogowany'] = true;

							$_SESSION['id'] = $wiersz['id'];
							$_SESSION['user'] = $wiersz['username'];
							$_SESSION['sila'] = $wiersz['sila'];
							$_SESSION['obrona'] = $wiersz['obrona'];
							$_SESSION['bron'] = $wiersz['bron'];
							$_SESSION['zdrowie'] = $wiersz['zdrowie'];
							$_SESSION['szybkosc'] = $wiersz['szybkosc'];
							$_SESSION['email'] = $wiersz['email'];
							$_SESSION['premium'] = $wiersz['premium'];
							$_SESSION['hajs'] = $wiersz['hajs'];
							$_SESSION['bank'] = $wiersz['bank'];
							$_SESSION['progress'] = $wiersz['progress'];
							//CZASY
							$_SESSION['tsilka'] = $wiersz['tsilka'];
							$_SESSION['tprzestepstwa'] = $wiersz['tprzestepstwa'];
							$_SESSION['tdilerka'] = $wiersz['tdilerka'];
							$_SESSION['tpraca'] = $wiersz['tpraca'];
							$_SESSION['tpaczki'] = $wiersz['tpaczki'];
							$_SESSION['tszpital'] = $wiersz['tszpital'];
							$_SESSION['twiezienie'] = $wiersz['twiezienie'];

							
							$_SESSION['admin'] = $wiersz['admin'];
							$_SESSION['ranga'] = $wiersz['ranga'];

							//WYCIĄGANIE DANYCH Z TABELI SKLEP!!!!!!!
							$user = $_SESSION['user'];
							$rows=mysqli_query(connect(), "SELECT * FROM sklep WHERE username='$user'");
							
							$wiersz=mysqli_fetch_array($rows);
							$_SESSION['sklepid']=$wiersz['id'];
							$_SESSION['czapkawpierdolka']=$wiersz['czapkawpierdolka'];
							$_SESSION['kolczanprawilnosci']=$wiersz['kolczanprawilnosci'];

							unset($blad);
							$rezultat->free_result(); //czyszczenie
							header('Location: start.php');
						}
						else{
							$blad = '<span style="background-color:red"> 
							Nieprawidłowy login lub hasło </span>';
				  			echo $blad;
						}
					}
					else{
						$blad = '<span style="background-color:red"> 
								 Nieprawidłowy login lub hasło </span>';
						echo $blad;
					}
				}

				$polaczenie->close();
			}


	}		
?>