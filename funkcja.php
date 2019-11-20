<meta charset="UTF-8">

<?php
/*
    function oblicz(){
        $zm1 = 3;
        $zm1 += 5;
        $zm1++;

        return $zm1;
    }

    if(oblicz()>5)
        echo "Funkcja zwraca wartość większą od 5";
    else    
        echo "Funkcja zwraca wartość mniejszą od 5";
 */       
?>

<?php
/*
function mozenie(){
 $zm1 = rand(1,14);
 $zm2 = rand(1,14);

    return $zm = $zm1*$zm2;
    echo $zm;
}
?>

<?php
    echo mozenie()+100;
    echo "<br>";
    echo mozenie();
    */
?>

<?php
/*
    function przywitaj($zmienna_z_imieniem){
        echo 'Witaj '.$zmienna_z_imieniem.'!';
    }

    $imie="Marcin";
    przywitaj($imie);
*/
?>


<?php
/*
    function kwadrat($liczba){
        return $liczba*$liczba;
    }
    $numer = 5;
    $wynik = kwadrat($numer);

    echo $wynik;
*/ 
?>

<form action="funkcja.php" method=POST>
    <label for="liczba1">Liczba 1:</label>
	<input type="number" id="liczba1" name="liczba1">

    <label for="liczba2">Liczba 2:</label>
	<input type="number" id="liczba2" name="liczba2">

    <label for="liczba3">Liczba 3:</label>
	<input type="number" id="liczba3" name="liczba3">

    <input type=submit value="Wyślij">

</form>

<?php
    function mnozenie1(){
        $l1 = $_POST['liczba1'];
        $l2 = $_POST['liczba2'];
        $l3 = $_POST['liczba3'];

        return $l = ($l1+$l2)*$l3;
        echo $l;
    };

    if(isset ($_POST['liczba1'])){
        echo "(Liczba1 + Liczba2)*Liczba3 = ".mnozenie1();
    };
?>

<br><br><br><br><br><br>

Kalkulator
<form action="kalkulator.php" method=POST>
    <label for="liczbaA">Liczba 1:</label>
	<input type="number" id="liczbaA" name="liczbaA">

    <label for="liczbaB">Liczba 2:</label>
	<input type="number" id="liczbaB" name="liczbaB">

    <input type=submit value="Wyślij">

</form>


<?php
function dodawanie($liczba1,$liczba2){
   return $wynik = $liczba1+$liczba2;
   echo "wynik";
};
/*
function odejmowanie($liczba){
    return $wynik = $liczba-$liczba;
};

function mnozenie($liczba){
    return $wynik = $liczba*$liczba;
};

function dzielenie($liczba){
    return $wynik = $liczba*$liczba;
};
*/
dodawanie($_POST['liczbaA'],$_POST['liczbaB']]);
?>