<!DOCTYPE html>
<html>
<head>
	<?php 
		session_start();
		include("head.php");

		if(!isset($_SESSION['udanarejestracja'])){
			header("Location: ./index.php");
		}
	?>
</head>
<body>
	<div class=container>
		<header>
			<?php include("header.php")?>
		</header>
		<div class='panel panel--left'>
			<div class=menu>
				<?php include("menu.php")?>
			</div>
			<div class="menu">
				<?php include("screenshoty.php");?>
			</div>
		</div>
		<div class='content'>
        <?php
    if(isset($_SESSION['udanarejestracja'])){
        echo "
        <h1>Diękujemy Za Rejestrację</h1>
<p>Właśnie oficjalnie zostałeś bandziorem. Teraz możesz już zalogować 
się do świata przestępczego. Wykonuj przestępstwa, atakuj innych graczy,
zarabiaj gruby hajs i co najważniejsze - nie daj się złapać. Powodzenia!
</p>";
        unset($_SESSION['udanarejestracja']);
    }
   else{
        header("Location: ./index.php");
   }
?>
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
			<?php include("stopka.php");?>
		</footer>
	</div>
</body>
</html>