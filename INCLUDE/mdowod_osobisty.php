
<a href=./start.php><h4 class="tytulzakladki">Dowód Osobisty</h4></a>
<p>Ksywa: <?php echo $_SESSION['user'] ?></p>
<!--<p>E-Mail: <?php echo $_SESSION['email'] ?></p>-->
<p>Ranga: <?php echo  $_SESSION['ranga'] ?></p>
<p>Zdrowie: <?php echo $_SESSION['zdrowie']."%" ?></p>
<p>Szacunek: <?php echo $_SESSION['progress'] ?>
<p>Hajs: <?php echo $_SESSION['hajs'] ?> </p>
<p>Bank: <?php echo $_SESSION['bank'] ?></p>
<p>Dzielnica: </p>
<p><a href="./logout.php">Wyloguj</a></p>

<?php
//nadawanie rangi
require_once('connect.php');
$progress = $_SESSION['progress'];

  
if($progress<100){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=1 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=1;
}
elseif($progress<300){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=2 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=2;
}
elseif($progress<600){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=3 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
   $_SESSION['ranga']=3;
}
elseif($progress<1000){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=4 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=4;
}
elseif($progress<1500){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=5 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=5;
}
elseif($progress<2100){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=6 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=6;
}

elseif($progress<2800){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=7 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=7;
}
elseif($progress<3600){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=8 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=8;
}
elseif($progress<4500){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=9 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=9;
}
elseif($progress<5500){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=10 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=10;
}
elseif($progress<6600){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=11 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=11;
}
elseif($progress<7800){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=12 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=12;
}
elseif($progress<9100){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=13 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=13;
}
elseif($progress<10500){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=14 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=14;
}
elseif($progress<12000){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=15 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=15;
}
elseif($progress<13600){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=16 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=16;
}
elseif($progress<15300){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=17 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=17;
}
elseif($progress<17100){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=18 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=18;
}
elseif($progress<19000){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=19 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=19;
}
elseif($progress<21000){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=20 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=20;
}
elseif($progress<23100){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=21 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=21;
}
elseif($progress<25200){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=22 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=22;
}
elseif($progress<27500){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=23 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=23;
}
elseif($progress<29900){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=24 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=24;
}
elseif($progress<32400){
    connect();
    $id=$_SESSION['id'];
    $kwerenda = "UPDATE users SET ranga=25 WHERE id=$id ;";
    $update = mysqli_query(connect(), $kwerenda);
    mysqli_close(connect());
    $_SESSION['ranga']=25;
}
?>
