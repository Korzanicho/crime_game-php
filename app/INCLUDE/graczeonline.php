<?php
function showPlayersOnline(){
    if(!$_SERVER['PHP_SELF']=="/gierka/INCLUDE/index.php "){
        require('./connect.php');
    };
    
    connect();
    $query = mysqli_query(connect(),'SELECT COUNT(id) as "wynik" FROM users');
    $numberOfAllPlayers=mysqli_fetch_array($query);
    $result=$numberOfAllPlayers["wynik"];

    return $result;
}
?>

<h4 class="title">Graczy Łącznie</h4>
<p><?=showPlayersOnline() ?> łącznie</p>
<p>x online</p>
