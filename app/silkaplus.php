<?
if(isset ($_POST['sila']))
{
	//Blokowanie siłowni
	connect();
	$id = $_SESSION["id"];
	$oczekiwanie = "UPDATE users SET tsilka=now()+INTERVAL 20 SECOND WHERE id=$id ;";
	$update = mysql_query($oczekiwanie);




	
		
			$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name); //połączenie z bazą danych
		
			if($polaczenie->connect_errno!=0){
				echo "Error ".$polaczenie->connect_errno;
			}
			else{
				$username = $_SESSION['user'];
				//$password = $_SESSION['password'];

				if($rezultat=@$polaczenie->query(
				sprintf("SELECT * FROM users WHERE username='%s'",
				mysqli_real_escape_string($polaczenie,$username))))
				{
					$ilu_userow = $rezultat->num_rows;
					if($ilu_userow>0){

						$wiersz = $rezultat->fetch_assoc();

							$_SESSION['tsilka'] = $wiersz['tsilka'];

					}
				}

				$polaczenie->close();
			}		
			unconnect();


	$_SESSION['sila']=$_SESSION['sila']+5;
	echo "Gratuluję, dodałeś 5 do siły";
}
	
?>