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

		<h1 style="text-align: center;">Więzienie</h1>
		<p>Nie byłbyś prawdziwym gangsterem gdybyś nie trafił nigdy do pudła.
		Masz szanse na wcześniejsze wyjście z więzienia gdy gracz z wyższą
		rangą Cię wykupi. Stracisz wtedy 10% hajsu z Twojego konta bankowego</p>


        <?php
		if(isset($_SESSION['wiezieniestop']) && $_SESSION['wiezieniestop']){
			echo "<p id=losewalka>Dałeś się złapać. Wypij piwo, którego sobie naważyłeś.</p>";
			if(isset($_SESSION['odswiezeniewiezienia']))
			header('refresh: '.$_SESSION['odswiezeniewiezienia'].' url=wiezienie.php'); //odświeżenie strony po określonym czasie
		}

        	
		//CZAS DOSTĘPU
		$dataczas = new DateTime();
		$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['twiezienie']);
		$roznica = $dataczas->diff($koniec);
		$_SESSION['wiezienieczas'] = $roznica;

		if($dataczas<$koniec){
			$_SESSION['wiezieniestop'] = true;
			echo "<p style=text-align:center>Pozostało: ".$roznica->format('%i minut, %s sekund')."</p>";
            $_SESSION['odswiezeniewiezienia']=$roznica->format('%s')+1;
            $_SESSION['wiezienie']=$roznica->format('%i minut, %s sekund');
		}
		else {
			$_SESSION['wiezieniestop'] = false;
		} 
        ?>
        </tr>
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


































