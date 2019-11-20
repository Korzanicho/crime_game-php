<!DOCTYPE html>
<html>
<head>
	<?php 
		session_start();
		include("head.php");
	?>
</head>
<body>
	<div class='container'>
		<header>
			<?php include("header.php")?>
</header>
		<div id="lewypanel">
			<div class=menu>
				<?php include("menu.php")?>
			</div>
			<div class="menu">
				<?php include("screenshoty.php");?>
			</div>
		</div>
		<div id=content>
			<h1>Gangi Warszawy</h1>
			<h2>Najlepsza gra przestępcza - zostań gangsterem lub policjantem</h2>
<p>,,Kilkunastoletni Henry, zafascynowany lokalną mafią i jej potęgą, dostaje się pod opiekę szanowanego w kręgach mafijnych gangstera Jimmy'ego Conwaya. Henry chce być taki jak Jimmy, pragnie mieć pieniądze, szacunek i przyjaciół. Do organizacji zostaje również przyjęty inny młody chłopak, Tommy DeVito. Obaj z łatwością uczą się nowych obowiązków i panujących w mafii reguł. Coraz bardziej też przyzwyczajają się do przemocy, okrucieństwa i ogromnych pieniędzy zdobywanych na drodze przestępstwa" - recenzja znakomitego filmu o tematyce mafijnej: goodfellas</p>


<p>Tak zaczęła się przygoda niejednego zwyczajnego chłopaka z przedmieść dużego miasta. A Ty, czemu tutaj jesteś?</p>

<p>Dokonaj wyboru - chcesz być gangsterem czy wsadzać ich za kratki. Możesz zostać gliną lub stanąć po drugiej stronie barykady</p>

<p><i>,,Keep your friends close, but keep your enemies closer"</i></p>
		</div>
		
		<div id=prawypanel>
			<div id=logowanie>
				<?php include("logowanie.php")?>
			</div>
			<div class="menu">
				<?php include("graczeonline.php")?>
			</div>
		</div>
		<div style="clear: both;"></div>
		<div id="stopka">
		<?php include("stopka.php");?>
		</div>
	</div>
</body>
</html>