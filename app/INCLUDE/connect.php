<?php
    $host = "localhost";
    $db_user = "root";
    $db_password= "";
    $db_name = "gangi";


    
    function connect(){
        $host = "localhost";
        $db_user = "root";
        $db_password= "";
        $db_name = "gangi";

        $link = mysqli_connect($host, $db_user, $db_password, $db_name);
        // $baza = mysqli_select_db($sql, $db_name) or die ('Błąd łączenia z bazą');
        if (!$link) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

        return $link;
    }

    $unconnect=connect();
?>