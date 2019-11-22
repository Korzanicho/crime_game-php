<?php
	session_start();
	require_once('../class/playerAccess.php');
	require_once('../class/playerAccessTime.php');
	
	$playerAccess = new PlayerAccess;
	$playerAccess->handle(false);

	$accessTime = new PlayerAccessTime;

?>
<!DOCTYPE html>
<html>
<head>
	<?php 
		include("head.php");
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
			<div class='title'>
				Informacje o Graczu
			</div>
			<div>
				<p>Ksywa: <?php echo $_SESSION['user'] ?></p>
				<p>Doświadczenie: <?php echo $_SESSION['progress']?></p>
				<p>Ranga: <?php echo $_SESSION['ranga']?></p>
				<p>Hajs: <?php echo $_SESSION['hajs'] ?></p>
				<p>Bank: <?php echo $_SESSION['bank'] ?></p>
				<p>Siła: <?php echo $_SESSION['sila'] ?></p>
				<p>Obrona: <?php echo $_SESSION['obrona'] ?></p>
				<p>Szybkość: <?php echo $_SESSION['szybkosc'] ?></p>
				<p>Zdrowie: <?php echo $_SESSION['zdrowie'] ?></p>
			</div>
			<div class='title'>
				Ekwipunek
			</div>
			<div>
				<table class='equipment'>
					<tbody>
						<tr>
							<th>Atak</th> 
							<th>Obrona</th> 
							<th>Szybkość</th>
						</tr>
						<tr>
							<td><?php if($_SESSION['czapkawpierdolka']==1) echo "Czapka Wpierdolka" ?></td>
							<td><?php if($_SESSION['kolczanprawilnosci']==1) echo "Kołczan Prawilnosci" ?></td>
						</tr>
					<tbody>
				</table>
			</div>
			<div class='title'>
				Czas oczekiwania
			</div>	
			<div class=content>
				<p>Przestępstwa: <?=$accessTime->timeToEnd($_SESSION['tprzestepstwa'])?>
				<p>Dilerka: <?=$accessTime->timeToEnd($_SESSION['tdilerka'])?>
				<p>Siłownia: <?=$accessTime->timeToEnd($_SESSION['tsilka'])?></p> 
				<p>Praca: <?=$accessTime->timeToEnd($_SESSION['tpraca'])?> </p>
				<p>Paczki: <?=$accessTime->timeToEnd($_SESSION['tpaczki'])?> </p>
				<br />
				<p>Więzienie: <?=$accessTime->timeToEnd($_SESSION['twiezienie'])?></p>
				<p>Szpital: <?=$accessTime->timeToEnd($_SESSION['tszpital'])?></p>
			</div>		
		</div>
		
		<div class='panel panel--right'>
			<?php include("./prawypanel.php")?>
        </div>
        
		<div style="clear: both;"></div>
		<footer>
		    <?php include("stopka.php");?>
		</footer>
	</div>
</body>
</html>