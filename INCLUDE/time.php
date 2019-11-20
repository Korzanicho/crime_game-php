<?php
  /*  echo date('Y-m-d H:i:s')."<br />";

    $dataczas = new DateTime();
    echo $dataczas->format('Y-m-d H:i:s')."<br>".print_r($dataczas);


    $dzien = 26;
    $miesiac = 7;
    $rok = 1875;

    if(checkdate($miesiac, $dzien, $rok))
        echo "<br>Poprawna data";
    else echo "<br>Niepoprawna data!";*/


 
    $host = "localhost";
    $db_user = "root";
    $db_password= "";
    $db_name = "gangi";

    function connect(){
        $host = "localhost";
        $db_user = "root";
        $db_password= "";
        $db_name = "gangi";

        $sql = mysql_connect($host, $db_user, '') or die ('Błąd wyboru bazy danych');
        $baza = mysql_select_db($db_name) or die ('Błąd łączenia z bazą');
    }

    connect();

    $wynik = mysql_query("SELECT * FROM time") OR die('Błąd zapytania');

    if(mysql_num_rows($wynik)>0){
        while($r = mysql_fetch_assoc($wynik)){
            echo $r['id'];
        }
    }

        echo $wynik;

?>
