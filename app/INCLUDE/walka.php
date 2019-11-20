<!DOCTYPE html>
<html>
<head>
	<?php 
		session_start();
		include("head.php");
		if(!isset($_SESSION['zalogowany'])){
			header('Location: ./index.php');
			exit();
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

		require_once "connect.php";
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

		<?php
		if($_SESSION['zdrowie']<25)
			echo "<p class='lose'>Masz za mało zdrowia żeby walczyć. Musisz
				mieć chociaż 25%. Leć do szpitala</p>";
		else{
			echo '
		<h1 style="text-align: center;">Walki Uliczne</h1>
		<p>Chcesz wziąć udział w nielegalnych walkach ulicznych?
		Poza umiejętnościami musisz liczyć na sporo szczęścia - tu nie każdy
		gra czysto. Wybierz równego sobie przeciwnika i wygrywając zyskaj kwit 
		oraz szacunek na mieście, powodzenia!</p>

		<form action="walka.php" method="POST">
			<div class="content">
				<p>Wybierz przeciwnika:</p>
				<div id=emeryt>
					<label for="emeryta"><p>Emeryt</p></label>
					<input type="radio" name="walka" value="emeryt" id="emeryta"/>
				</div>
				<div id=sebix>
					<label for="sebixa"><p>Młodszy Sebix</p></label>
					<input type="radio" name="walka" value="sebix" id="sebixa"/>
				</div>
				<div id=menel>
					<label for="menela"><p>Menel</p></label>
					<input type="radio" name="walka" value="menel" id="menela"/>
				</div>
				
				<div id=turysta>
					<label for="turystaa"><p>Turysta</p></label>
					<input type="radio" name="walka" value="turysta" id="turystaa"/>
				</div>
				<div id=feministka>
				<label for="feministkaa"><p>Feministka</p></label>
				<input type="radio" name="walka" value="feministka" id="feministkaa"/>
				</div>
				<div id=imigrant>
					<label for="imigranta"><p>Imigrant</p></label>
					<input type="radio" name="walka" value="imigrant" id="imigranta"/>
				</div>
				<div id=sebix2> <!--Nie zrobione-->
					<label for="sebix2a"><p>Sebix</p></label>
					<input type="radio" name="walka" value="sebix2" id="sebix2a"/>
				</div>

				<input type=submit value="Walcz!" class="btn">
			</div>
		</form>';
		}
		?>
<?php 
//STATYSTYKI GRACZA
$asil=$_SESSION['sila'];
$aobr=$_SESSION['obrona'];
$abro=$_SESSION['bron'];
$azdr=$_SESSION['zdrowie'];

$aszy=$_SESSION['szybkosc'];

$id = $_SESSION["id"];


	if(isset ($_POST['walka']))
	{

		//Walka
		switch($_POST['walka']){
			/////////////////////////////WALKA1/////////////////////////
			case "emeryt":
						
			$progress = rand(1, 10);
			$hajs = rand(1,10);

						$bsil=10;
						$bobr=10;
						$bbro=10;
						$bzdr=100;
						$bszy=10;
						
						$asz=$aszy+rand(0,10);
						$as=$asil+$abro+rand(0,10);
						$az=$azdr+$aobr+rand(0,10);
						
						$bsz=$bszy+rand(0,10);
						$bs=$bsil+$bbro+rand(0,10);
						$bz=$bzdr+$bobr+rand(0,10);
						
		
						if($asz>$bsz)
						{		
							for($i=100; $i>0; $i--)
							{	
								$bz=$bz-$as;
								$az=$az-$bs;

								if($bz<=0){
									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;
									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION["id"];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;
									
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs  WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);

									mysqli_close($unconnect);

									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									break;
								}	
								elseif($az<=0){

									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>Ale lipa - emeryt dał Ci nieźle popalić</p>";
									break;
								}
								else echo "";
							}
						}
						else{
							for($i=100; $i>0; $i--)
							{	
								$az=$az-$bs;
								$bz=$bz-$as;
								
								if($az<=0){

									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>Przegrałeś z emerytem, lepiej się tu więcej nie pokazuj</p>";
									break;
								}	
								elseif($bz<=0){
									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;
									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION["id"];
									if($az>$azdr)
									$_SESSION['zdrowie']=$azdr;
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs  WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									$_SESSION['zdrowie']=$az-$aobr;
									break;
								}
								else echo "";
							}
						}
						break;
						/////////////////////////////WALKA2/////////////////////////
						case "sebix":
						
						$progress = rand(11, 20);
						$hajs = rand(11,20);

						$bsil=20;
						$bobr=20;
						$bbro=20;
						$bzdr=20;
						$bszy=20;
						
						$asz=$aszy+rand(0,20);
						$as=$asil+$abro+rand(0,20);
						$az=$azdr+$aobr+rand(0,20);

						$bsz=$bszy+rand(0,20);
						$bs=$bsil+$bbro+rand(0,20);
						$bz=$bzdr+$bobr+rand(0,20);
						
						
						
						if($asz>$bsz)
						{		
							for($i=100; $i>0; $i--)
							{	
								$bz=$bz-$as;
								$az=$az-$bs;
								
								if($bz<=0){
									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;
									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION["id"];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;	
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs  WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);

									mysqli_close($unconnect);

									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									break;
								}	
								elseif($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>To nie Twoje osiedle, Sebix Cię dojechał</p>";
									break;
								}
								else echo "";
							}
						}
						else{
							for($i=100; $i>0; $i--)
							{	
								$az=$az-$bs;
								$bz=$bz-$as;
								
								if($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>Przegrałeś z Sebixem miękka fajo</p>";
									break;
								}	
								elseif($bz<=0){
									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;

									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION["id"];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs  WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);
									
									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									break;
								}
								else echo "";
							}
						}
						break;
						/////////////////////////////WALKA3/////////////////////////
						case "menel":
						
						$progress = rand(21, 30);
						$hajs = rand(21,30);

						$bsil=40;
						$bobr=40;
						$bbro=40;
						$bzdr=40;
						$bszy=40;
						
						$asz=$aszy+rand(0,30);
						$as=$asil+$abro+rand(0,30);
						$az=$azdr+$aobr+rand(0,30);

						$bsz=$bszy+rand(0,30);
						$bs=$bsil+$bbro+rand(0,30);
						$bz=$bzdr+$bobr+rand(0,30);
						
						
						
						if($asz>$bsz) //Jeżeli jesteś szybszy
						{		
							for($i=100; $i>0; $i--) //Pętla wykona się max. 100 razy
							{	
								$bz-=$as; //Zdrowie = Zdrowie - Siła
								$az-=$bs; 
								
								if($bz<=0){ //Jeżeli zdrowie przeciwnika <=0
									$_SESSION['progress']+=$progress; //Dodanie doświadczenia
									$_SESSION['hajs']+=$hajs;

									connect(); //Połączenie z bazą
									$prog = $_SESSION['progress'];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION['id'];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;	
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;"; 
									$update = mysqli_query(connect(), $kwerenda);

									mysqli_close($unconnect);

									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>"; #
									break;
								}	
								elseif($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>To nie Twoje osiedle, Sebix Cię dojechał</p>";
									break;
								}
								else echo "";
							}
						}
						else{
							for($i=100; $i>0; $i--)
							{	
								$az=$az-$bs;
								$bz=$bz-$as;
								
								if($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>Przegrałeś z Sebixem miękka fajo</p>";
									break;
								}	
								elseif($bz<=0){
									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;

									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs']; 
									$id = $_SESSION["id"];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);
									
									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									break;
								}
								else echo "";
							}
						}
						break;
						/////////////////////////////WALKA4/////////////////////////
						case "turysta":
						
						$progress = rand(31, 40);
						$hajs = rand(31, 40);

						$bsil=80;
						$bobr=80;
						$bbro=80;
						$bzdr=80;
						$bszy=80;
						
						$asz=$aszy+rand(0,40);
						$as=$asil+$abro+rand(0,40);
						$az=$azdr+$aobr+rand(0,40);

						$bsz=$bszy+rand(0,40);
						$bs=$bsil+$bbro+rand(0,40);
						$bz=$bzdr+$bobr+rand(0,40);
						
						
						
						if($asz>$bsz) //Jeżeli jesteś szybszy
						{		
							for($i=100; $i>0; $i--) //Pętla wykona się max. 100 razy
							{	
								$bz-=$as; //Zdrowie = Zdrowie - Siła
								$az-=$bs; 
								
								if($bz<=0){ //Jeżeli zdrowie przeciwnika <=0
									$_SESSION['progress']+=$progress; //Dodanie doświadczenia
									$_SESSION['hajs']+=$hajs;

									connect(); //Połączenie z bazą
									$prog = $_SESSION['progress'];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION['id'];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;	
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;"; 
									$update = mysqli_query(connect(), $kwerenda);

									mysqli_close($unconnect);

									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>"; #
									break;
								}	
								elseif($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>To nie Twoje osiedle, Sebix Cię dojechał</p>";
									break;
								}
								else echo "";
							}
						}
						else{
							for($i=100; $i>0; $i--)
							{	
								$az=$az-$bs;
								$bz=$bz-$as;
								
								if($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>Przegrałeś z Sebixem miękka fajo</p>";
									break;
								}	
								elseif($bz<=0){
									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;

									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs']; 
									$id = $_SESSION["id"];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);
									
									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									break;
								}
								else echo "";
							}
						}
						break;
						/////////////////////////////WALKA5/////////////////////////
						case "feministka":
						
						$progress = rand(41, 50);
						$hajs = rand(41,50);

						$bsil=160;
						$bobr=160;
						$bbro=160;
						$bzdr=160;
						$bszy=160;
						
						$asz=$aszy+rand(0,50);
						$as=$asil+$abro+rand(0,50);
						$az=$azdr+$aobr+rand(0,50);

						$bsz=$bszy+rand(0,50);
						$bs=$bsil+$bbro+rand(0,50);
						$bz=$bzdr+$bobr+rand(0,50);
						
						
						
						if($asz>$bsz) //Jeżeli jesteś szybszy
						{		
							for($i=100; $i>0; $i--) //Pętla wykona się max. 100 razy
							{	
								$bz-=$as; //Zdrowie = Zdrowie - Siła
								$az-=$bs; 
								
								if($bz<=0){ //Jeżeli zdrowie przeciwnika <=0
									$_SESSION['progress']+=$progress; //Dodanie doświadczenia
									$_SESSION['hajs']+=$hajs;

									connect(); //Połączenie z bazą
									$prog = $_SESSION['progress'];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION['id'];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;	
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;"; 
									$update = mysqli_query(connect(), $kwerenda);

									mysqli_close($unconnect);

									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>"; #
									break;
								}	
								elseif($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>To nie Twoje osiedle, Sebix Cię dojechał</p>";
									break;
								}
								else echo "";
							}
						}
						else{
							for($i=100; $i>0; $i--)
							{	
								$az=$az-$bs;
								$bz=$bz-$as;
								
								if($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>Przegrałeś z Sebixem miękka fajo</p>";
									break;
								}	
								elseif($bz<=0){

									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;

									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs']; 
									$id = $_SESSION["id"];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);
									
									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									break;
								}
								else echo "";
							}
						}
						break;
						/////////////////////////////WALKA6/////////////////////////
						case "imigrant":
						
						$progress = rand(51, 60);
						$hajs = rand(51,60);

						$bsil=320;
						$bobr=320;
						$bbro=320;
						$bzdr=320;
						$bszy=320;
						
						$asz=$aszy+rand(0,60);
						$as=$asil+$abro+rand(0,60);
						$az=$azdr+$aobr+rand(0,60);

						$bsz=$bszy+rand(0,60);
						$bs=$bsil+$bbro+rand(0,60);
						$bz=$bzdr+$bobr+rand(0,60);
						
						
						
						if($asz>$bsz) //Jeżeli jesteś szybszy
						{		
							for($i=100; $i>0; $i--) //Pętla wykona się max. 100 razy
							{	
								$bz-=$as; //Zdrowie = Zdrowie - Siła
								$az-=$bs; 
								
								if($bz<=0){ //Jeżeli zdrowie przeciwnika <=0
									$_SESSION['progress']+=$progress; //Dodanie doświadczenia
									$_SESSION['hajs']+=$hajs;

									connect(); //Połączenie z bazą
									$prog = $_SESSION['progress'];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION['id'];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;	
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;"; 
									$update = mysqli_query(connect(), $kwerenda);

									mysqli_close($unconnect);

									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>"; #
									break;
								}	
								elseif($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>To nie Twoje osiedle, Sebix Cię dojechał</p>";
									break;
								}
								else echo "";
							}
						}
						else{
							for($i=100; $i>0; $i--)
							{	
								$az=$az-$bs;
								$bz=$bz-$as;
								
								if($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>Przegrałeś z Sebixem miękka fajo</p>";
									break;
								}	
								elseif($bz<=0){
									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;

									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs']; 
									$id = $_SESSION["id"];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);
									
									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									break;
								}
								else echo "";
							}
						}
						break;
						/////////////////////////////WALKA6/////////////////////////
						case "sebix2":
						
						$progress = rand(61, 70);
						$hajs = rand(61,70);

						$bsil=640;
						$bobr=640;
						$bbro=640;
						$bzdr=640;
						$bszy=640;
						
						$asz=$aszy+rand(0,70);
						$as=$asil+$abro+rand(0,70);
						$az=$azdr+$aobr+rand(0,70);

						$bsz=$bszy+rand(0,70);
						$bs=$bsil+$bbro+rand(0,70);
						$bz=$bzdr+$bobr+rand(0,70);
						
						
						
						if($asz>$bsz) //Jeżeli jesteś szybszy
						{		
							for($i=100; $i>0; $i--) //Pętla wykona się max. 100 razy
							{	
								$bz-=$as; //Zdrowie = Zdrowie - Siła
								$az-=$bs; 
								
								if($bz<=0){ //Jeżeli zdrowie przeciwnika <=0
									$_SESSION['progress']+=$progress; //Dodanie doświadczenia
									$_SESSION['hajs']+=$hajs;

									connect(); //Połączenie z bazą
									$prog = $_SESSION['progress'];
									$twojhajs=$_SESSION['hajs'];
									$id = $_SESSION['id'];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;"; 
									$update = mysqli_query(connect(), $kwerenda);

									mysqli_close($unconnect);

									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>"; #
									break;
								}	
								elseif($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>To nie Twoje osiedle, Sebix Cię dojechał</p>";
									break;
								}
								else echo "";
							}
						}
						else{
							for($i=100; $i>0; $i--)
							{	
								$az=$az-$bs;
								$bz=$bz-$as;
								
								if($az<=0){
									connect();
									$_SESSION['zdrowie']=0;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET zdrowie=$zdrowie WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);

									echo "<p class='lose'>Przegrałeś z Sebixem miękka fajo</p>";
									break;
								}	
								elseif($bz<=0){
									$_SESSION['progress']+=$progress;
									$_SESSION['hajs']+=$hajs;

									connect();
									$prog = $_SESSION["progress"];
									$twojhajs=$_SESSION['hajs']; 
									$id = $_SESSION["id"];
									if($az>$azdr)
										$_SESSION['zdrowie']=$azdr;
									else
										$_SESSION['zdrowie']=$az;
									$zdrowie=$_SESSION['zdrowie'];
									$kwerenda = "UPDATE users SET progress=$prog, zdrowie=$zdrowie, hajs=$twojhajs WHERE id=$id ;";
									$update = mysqli_query(connect(), $kwerenda);
									mysqli_close($unconnect);
									
									echo "<p class='success'>Wygrałeś! Zyskałeś $progress doświadczenia oraz $hajs hajsu.</p>";
									break;
								}
								else echo "";
							}
						}
						break;
		}
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


































