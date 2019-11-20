		
<?php	
	if(isset($_SESSION['zalogowany'])){
		echo '<a href=start.php style="color: white;">';
	}	
	else echo '<a href=index.php style="color: white;">';
?>	
			<div class='logo'>
				Gangi Warszawy
			</div>
			<div class='date'>
				<?php
					echo Date('d-m-Y');
				?>
			</div>
			<div class='header__quotation'>
				<?php
					$i = rand(0,3);

					switch ($i) {
						case 0:
							echo "Większość ludzi nie wie, że mieliśmy też wiele legalnych interesów jak sprzątanie albo lakierowanie. ~Al Capone";
							break;
						case 1:
							echo "Kocham Cię tak, jak tłusty dzieciak kocha ciastka ~50 Cent";
							break;
						case 2:
							echo "Jestem gorszy niż mówisz, ale lepszy niż myślisz ~Tony Montana";
							break;
						case 3:
							echo "W tym kraju, najpierw musisz zdobyć pieniądze. Potem, kiedy zdobędziesz pieniądze, zdobędziesz władzę. Potem, kiedy zdobędziesz władzę, wtedy zdobędziesz kobiety.  ~Tony Montana";
							break;
						case 4:
							echo "Jestem gorszy niż mówisz, ale lepszy niż myślisz ~Tony Montana";
							break;
					}
					?>
			</div>
			<?php echo '</a>'?>