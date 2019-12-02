<?php
session_start();
require_once('../class/dbCommunication.php');
require_once('../class/playerAccess.php');
require_once('../class/actions/actionCrime.php');
require_once('../class/disableActions.php');
require_once('../class/playerAccessTime.php');
require_once('../class/moveToPrison.php');

$disableAction = new BlockAction;

$playerBlockingAccess = new PlayerAccess;
$playerBlockingAccess->handle(true);
$crime = new ActionCrime;

$crimeAccessTime = new PlayerAccessTime;	
$crimeAccessTime->blockingAccess($_SESSION['tprzestepstwa'], 'przestepstwastop');

$moveToPrison = new MoveToPrison;

$crimes = [
    [
        'slug'         => 'ukradnij_batonik',
        'name'         => 'Ukradnij batonik z automatu', 
        'chance'       => 90,
        'maxReward'    => 10,
        'penaltyTime'  => 30
    ],
    [
        'slug'         => 'obrabuj_zebraka',
        'name'         => 'Obrabuj żebraka', 
        'chance'       => 540,
        'maxReward'    => 20,
        'penaltyTime'  => 30
    ],
    [
        'slug'         => 'torebka_starszej_pani',
        'name'         => 'Zabierz torebkę starszej pani', 
        'chance'       => 800,
        'maxReward'    => 30,
        'penaltyTime'  => 30
    ],
    [
        'slug'         => 'ukradnij_cole_z_kebaba',
        'name'         => 'Ukradnij Colę z kebaba', 
        'chance'       => 1500,
        'maxReward'    => 300,
        'penaltyTime'  => 30
    ],
    [
        'slug'         => 'obrabuj_dziadka_metoda_na_wnuczka',
        'name'         => 'Obrabuj dziadka metodą na wnuczka', 
        'chance'       => 2500,
        'maxReward'    => 600,
        'penaltyTime'  => 30
    ],
    [
        'slug'         => 'niewykonalne',
        'name'         => 'niewykonalne', 
        'chance'       => 25000,
        'maxReward'    => 600,
        'penaltyTime'  => 30
    ],

];

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
        
		<div class='content crimes'>
		    <h1 style="text-align: center;">Przestępstwa</h1>
		<p>
            Jakim byłbyś gangsterem gdybyś nie robił żadnych przestępstw. To
            jedna z prostszych metod zarobku, a dodatkowo zyskujesz więcej 
            doświadczenia.
        </p>

		<table>
            <tbody>
                <tr>
                    <th>Akcja: </th><th></th><th>Szansa</th>
                </tr>
                <?php
                    foreach($crimes as $currentCrime){
                        echo "
                            <tr>
                                <td>{$currentCrime['name']}</td>
                                <td>                                
                                    <form method='POST'>
                                        <input name='crime' value={$currentCrime['slug']} type='hidden' />
                                        <input src='../img/ok.gif' type=image />
                                    </form>
                                </td>
                                <td>
                                    {$crime->calculateChance($currentCrime['chance'], $_SESSION['progress'])}%
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
        <?php
            $connect = new DatabaseCommunication;        

            if(isset($_SESSION['przestepstwastop']) && $_SESSION['przestepstwastop']){
                echo "<p class='lose'>Spokojnie, nie szalej tak - odpocznij trochę od przestępstw</p>";
            }
            else{

                if(isset($_POST['crime'])){
                    
                    foreach($crimes as $currentCrime){

                        switch($_POST['crime']){
                            
                            case $currentCrime['slug']:

                                $disableAction->handle('przestepstwastop', $connect, 30, 'tprzestepstwa', $_SESSION["id"]);

                                if($crime->checkIfPlayerWin($currentCrime['chance'], $_SESSION['progress']))
                                    $crime->playerWin($currentCrime['maxReward'], $currentCrime['maxReward'], $connect, $_SESSION['id']);

                                else $moveToPrison->handle($currentCrime['penaltyTime'], $connect, $_SESSION['id']);
                                
                                break;
                        }
                    }
                }
            }

            if(isset($_SESSION['przestepstwastop']))
                echo "<p style=text-align:center>Pozostało: ".$crimeAccessTime->timeToEnd($_SESSION['tprzestepstwa'])."</p>";
            $connect->disconnect();

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