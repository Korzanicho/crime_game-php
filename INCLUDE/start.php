<!DOCTYPE html>
<html>
<head>
	
	<?php
	//rozpoczęcie sesji, jeśli niezalogowany, odeślij do indexu
		session_start();
		if(!isset($_SESSION['zalogowany'])){
			header('Location: /index.php');
			exit();
		}
	?>

	<?php 
		include("head.php");
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
			<div class=naglowek>
				Informacje o Graczu
			</div>
			<div class=content>
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
			<div class=naglowek>
				Ekwipunek
			</div>
			<div class=content>
				<table class=ekwipunek>
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
			<div class=naglowek>
				Czas oczekiwania
			</div>	
			<div class=content>
			
			<?php
			//CZAS DOSTĘPU WIĘZIENIE
			$wdataczas = new DateTime();
			$wkoniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['twiezienie']);
			$wroznica = $wdataczas->diff($wkoniec);

			if($wdataczas<$wkoniec){
				$_SESSION['wiezieniestop'] = true;
				$_SESSION['odswiezeniewiezienia']=$wroznica->format('%s')+1;
				$_SESSION['wiezienie']=$wroznica->format('%i minut, %s sekund');
			}
			else {
				$_SESSION['wiezienie']="00:00";
				$_SESSION['wiezieniestop'] = false;
			} 

			//CZAS DOSTĘPU SZPITAL
			$sdataczas = new DateTime();
			$skoniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tszpital']);
			$sroznica = $sdataczas->diff($skoniec);
			$_SESSION['szpitalczas'] = $sroznica;

			if($sdataczas<$skoniec){
				$_SESSION['szpitalstop'] = true;
				$_SESSION['odswiezenieszpitala']=$sroznica->format('%s')+1;
				$_SESSION['szpital']=$sroznica->format('%i minut, %s sekund');
			}
			else {
				$_SESSION['szpitalstop'] = false;
				$_SESSION['szpital']="00:00";
			} 


			//CZAS DOSTĘPU SIŁKA
			$sidataczas = new DateTime();
			$sikoniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tsilka']);
			$siroznica = $sidataczas->diff($sikoniec);
			$_SESSION['silkaczas'] = $siroznica;

			if($sidataczas<$sikoniec){
				$_SESSION['silkastop'] = true;
				$_SESSION['odswiezeniesilki']=$siroznica->format('%s')+1;
				$_SESSION['silka']=$siroznica->format('%i minut, %s sekund');
			}
			else {
				$_SESSION['silkastop'] = false;
				$_SESSION['silka']="00:00";
			} 

			function przestepstwaczas(){
				//CZAS DOSTĘPU PRZESTĘPSTW
				$dataczas = new DateTime();
				$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tprzestepstwa']);
				$roznica = $dataczas->diff($koniec);
				$_SESSION['przestepstwaczas'] = $roznica;

				if($dataczas<$koniec){
					$_SESSION['przestepstwastop'] = true;
					$_SESSION['odswiezenieprzestepstw']=$roznica->format('%s')+1;
					return $_SESSION['przestepstwa']=$roznica->format('%i minut, %s sekund');
				}
				else {
					$_SESSION['przestepstwastop'] = false;
					return $_SESSION['przestepstwa']="00:00";
				} 
			}


					//CZAS DOSTĘPU DILERKI
			function dilerkaczas(){
				$dataczas = new DateTime();
				$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tdilerka']);
				$roznica = $dataczas->diff($koniec);
				$_SESSION['dilerkaczas'] = $roznica;
				
				if($dataczas<$koniec){
					$_SESSION['dilerkastop'] = true;
					$_SESSION['odswiezeniedilerki']=$roznica->format('%s')+1;
					return	$_SESSION['dilerka']=$roznica->format('%i minut, %s sekund');
				}
				else {
					$_SESSION['dilerkastop'] = false;
					return $_SESSION['dilerka']="00:00";
				 } 
			}

			//CZAS DOSTĘPU PRACY
			function pracaczas(){
				$dataczas = new DateTime();
				$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tpraca']);
				$roznica = $dataczas->diff($koniec);
				$_SESSION['pracaczas'] = $roznica;
				
				if($dataczas<$koniec){
					$_SESSION['pracastop'] = true;
					$_SESSION['odswiezeniepracy']=$roznica->format('%s')+1;
					return $_SESSION['praca']=$roznica->format('%i minut, %s sekund');
				}
				else {
					$_SESSION['pracastop'] = false;
					return $_SESSION['praca']="00:00";
				 } 
			}

			//CZAS DOSTĘPU PACZKI
			function paczkiczas(){
				$dataczas = new DateTime();
				$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tpaczki']);
				$roznica = $dataczas->diff($koniec);
				$_SESSION['paczkiczas'] = $roznica;
				
				if($dataczas<$koniec){
					$_SESSION['paczkistop'] = true;
					return	$_SESSION['paczki']=$roznica->format('%H godzin, %i minut, %s sekund');
				}
				else {
					return	$_SESSION['paczki']="00:00";
					$_SESSION['paczkistop'] = false;
				 } 
			}
			?>
				<p>Przestępstwa: <?=przestepstwaczas() ?>
				<p>Dilerka: <?=dilerkaczas() ?>
				<p>Siłownia: <?=$_SESSION['silka']?></p> 
				<p>Praca: <?=pracaczas() ?> </p>
				<p>Paczki: <?=paczkiczas() ?> </p>
				<br />
				<p>Więzienie: <?=$_SESSION['wiezienie']?></p>
				<p>Szpital: <?=$_SESSION['szpital']?></p>
				
			</div>		
		</div>
		
		<div id=prawypanel>
			<?php include("./prawypanel.php")?>
        </div>
        
		<div style="clear: both;"></div>
		<div id="stopka">
		    <?php include("stopka.php");?>
		</div>
	</div>
</body>
</html>