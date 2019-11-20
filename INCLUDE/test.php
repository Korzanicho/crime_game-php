<?php
    session_start(); //rozpoczęcie sesji
    include("head.php"); //zainkludowanie nagłówka <head>
    require_once('./connect.php');
    
    $host = "localhost";
    $db_user = "root";
    $db_password= "";
    $db_name = "gangi";

    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    if($polaczenie->connect_errno!=0){
        echo "Error ".$polaczenie->connect_errno;
    }


    
    $id = 1;
    $oczekiwanie = "UPDATE users SET tsilka=now()+INTERVAL 20 SECOND WHERE id=1 ;";
    $update = mysql_query($oczekiwanie);


    $zmienna = @mysqli_query(mysqli_connect("localhost", "root", "", "gangi"), "SELECT tsilka FROM users WHERE id=1");
    $row = mysqli_fetch_array($zmienna);
    $_SESSION['tsilka'] = $row['tsilka'];

    echo $_SESSION['tsilka'];
?>