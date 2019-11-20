<!DOCTYPE html>
<html>
<head>
	<?php 
		session_start(); //rozpoczęcie sesji
		include("head.php"); //zainkludowanie nagłówka <head>
		require_once('./connect.php'); //zainkludowanie połączenia z bazą
		if((!isset($_SESSION['zalogowany'])) || ($_SESSION['admin']!=1)){ //jeżeli nie jesteś zalogowany wykonaj if
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
        
		<div id="lewypanel">
			<?php include("lewypanel.php")?>        
		</div>
        
		<div id=content>

            <h1 style="text-align: center;">Ranking</h1>
            <table id=ranking>
                <tr>
                    <th>Nr.</th> <th>Ksywka</th> <th>Hajs</th> <th>Bank</th> <th>Progress</th> <th>Ranga</th>
                </tr>
                <?
                connect();
                $rows=mysql_query('SELECT * FROM users ORDER BY progress DESC');

                $i=1;
                while($wiersz=mysql_fetch_array($rows)){               
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
                        echo '<td><a href=edit.php>Edytuj</td>';
                    echo '<tr />';
                    $_SESSION['edytowany']=$wiersz['username'];
                    $i++;
                }
                mysql_close($unconnect);
                ?>
            </table>
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


































