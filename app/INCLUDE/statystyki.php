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
            <h1 style="text-align: center;">Ranking</h1>
            
           <div class="table-responsive">
               <table id=ranking class="table table-hover">
                <tr>
                    <th>Nr.</th> <th>Ksywka</th> <th>Hajs</th> <th>Bank</th> <th>Progress</th> <th>Ranga</th>
                </tr>
                <?php
                connect();
                $rows=mysqli_query(connect(), 'SELECT * FROM users ORDER BY progress DESC');

                $i=1;
                while($wiersz=mysqli_fetch_array($rows)){               
                    echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        if($wiersz['id']==$_SESSION['id']){
                            echo '<td style=color:red;>'.$wiersz['username'].'</td>';
                        }
                        else{
                            echo '<td>'.$wiersz['username'].'</td>';
                        }
                        echo '<td>'.$wiersz['hajs'].'</td>';
                        echo '<td>'.$wiersz['bank'].'</td>';
                        echo '<td>'.$wiersz['progress'].'</td>';
                        echo '<td>'.$wiersz['ranga'].'</td>';
                    echo '<tr />';
                    $i++;
                }
                mysqli_close($unconnect);
                ?>
            </table>
           </div>
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


































