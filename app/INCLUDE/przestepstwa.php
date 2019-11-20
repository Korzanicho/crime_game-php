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
                <tr>
                    <td>Ukradnij batonik z automatu</td>
                    <td>
                        <form method=POST>
                            <input name=crime value=1 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>
                    <?php
                    if($_SESSION['progress']<5)
                            echo "Spróbuj";
                    elseif($_SESSION['progress']<10)
                        echo "40%";
                    elseif($_SESSION['progress']<20)
                        echo "50%";
                    elseif($_SESSION['progress']<30)
                        echo "60%";
                    elseif($_SESSION['progress']<40)
                        echo "70%";
                    elseif($_SESSION['progress']<50)
                        echo "80%";
                    elseif($_SESSION['progress']<90)
                        echo "90%";
                    elseif($_SESSION['progress']>90)
                        echo "95%";     
                    ?>           
                    </td>    
                </tr>
                <tr>
                    <td>Obrabuj żebraka</td>
                    <td>
                        <form method=POST>
                            <input name=crime value=2 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>
                    <?php
                    if($_SESSION['progress']<50)
                            echo "0%";
                    elseif($_SESSION['progress']<90)
                        echo "40%";
                    elseif($_SESSION['progress']<150)
                        echo "50%";
                    elseif($_SESSION['progress']<230)
                        echo "60%";
                    elseif($_SESSION['progress']<300)
                        echo "70%";
                    elseif($_SESSION['progress']<400)
                        echo "80%";
                    elseif($_SESSION['progress']<540)
                        echo "90%";
                    elseif($_SESSION['progress']>540)
                        echo "95%";    
                    ?>           
                    </td>   
                </tr>
                <tr>
                    <td>Zabierz torebkę starszej pani</td>
                    <td>
                        <form method=POST>
                            <input name=crime value=3 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>
                    <?php
                    if($_SESSION['progress']<300)
                        echo "0%";
                    elseif($_SESSION['progress']<320)
                        echo "40%";
                    elseif($_SESSION['progress']<350)
                        echo "50%";
                    elseif($_SESSION['progress']<390)
                        echo "60%";
                    elseif($_SESSION['progress']<450)
                        echo "70%";
                    elseif($_SESSION['progress']<500)
                        echo "80%";
                    elseif($_SESSION['progress']<640)
                        echo "90%";
                    elseif($_SESSION['progress']>640)
                        echo "95%";      
                    ?>           
                    </td>   
                </tr>
                <tr>
                    <td>Napadnij na Kebaba</td>
                    <td>
                        <form method=POST>
                            <input name=crime value=4 type=hidden />
                            <input src="../img/ok.gif" type=image />
                        </form>
                    </td>
                    <td>
                    <?php
                    if($_SESSION['progress']<500)
                        echo "0%";
                    elseif($_SESSION['progress']<600)
                        echo "40%";
                    elseif($_SESSION['progress']<700)
                        echo "50%";
                    elseif($_SESSION['progress']<800)
                        echo "60%";
                    elseif($_SESSION['progress']<900)
                        echo "70%";
                    elseif($_SESSION['progress']<1000)
                        echo "80%";
                    elseif($_SESSION['progress']<1100)
                        echo "90%";
                    elseif($_SESSION['progress']>1100)
                        echo "95%";  
                    ?>      
                    </td>   
                </tr>
            </tbody>
        </table>
        <?php
            $szansa=rand(0,100);

        //BLOKOWANIE PRZESTĘPSTW
        function blokowanie(){
            $_SESSION['przestepstwastop']=true;
            connect();
            $unconnect=connect();
            $id = $_SESSION["id"];
            $kwerenda = "UPDATE users SET tprzestepstwa=now()+INTERVAL 3 MINUTE WHERE id=$id ;";
            $update = mysqli_query(connect(), $kwerenda);
            $zmienna = mysqli_query(connect(), "SELECT tprzestepstwa FROM users WHERE id=$id");
            $row = mysqli_fetch_array($zmienna);
            $_SESSION['tprzestepstwa'] = $row['tprzestepstwa'];
            mysqli_close($unconnect);
        }            

        if(isset($_SESSION['przestepstwastop']) && $_SESSION['przestepstwastop']){
            echo "<p class='lose'>Spokojnie, nie szalej tak - odpocznij trochę od przestępstw</p>";
        //if(isset($_SESSION['odswiezenieprzestepstw']))
        //    header('refresh: '.$_SESSION['odswiezenieprzestepstw'].' url=przestepstwa.php'); //odświeżenie strony po 5 minutach
        }
        else{

            if(isset($_POST['crime'])){
                switch($_POST['crime']){
                /////////////////////////////PRZESTĘPSTWO 1/////////////////////////
                case 1:

                    blokowanie();

                    function wygrana(){
                        $hajs=rand(0,10);
                        $progress=rand(0,10);
                        $id = $_SESSION['id'];
                        $unconnect=connect();
                        echo "<p class='success'>Udało Ci się, zyskałeś $hajs PLN i $progress do szacunku</p>";
                        $_SESSION['progress']+=$progress;
                        $_SESSION['hajs']+=$hajs;
                        connect();
                        $prog=$_SESSION['progress'];
                        $twojhajs=$_SESSION['hajs'];
                        $kwerenda = "UPDATE users SET progress=$prog, hajs=$twojhajs  WHERE id=$id ;";
                        $update = mysqli_query(connect(), $kwerenda);
                        mysqli_close($unconnect);
                    }

                    function przegrana(){
                        $czas=3; //3 minuty
                        $unconnect=connect();
                        connect(); //Łączymy się z bazą
                        $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                        $kwerenda = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                        $update = mysqli_query(connect(), $kwerenda); //Wykonuje kwerendę
                        $zmienna = mysqli_query(connect(), "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                        $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                        $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
                        mysqli_close($unconnect); //zamyka połączenie z bazą

                        $_SESSION['wiezieniestop1']=true;
                        echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minuty!</p>";
                    }
                    
                        if($_SESSION['progress']<5){
                            if($szansa<=90){
                               wygrana();
                            }
                            else{
                                przegrana();
                            }
                        }
                        elseif($_SESSION['progress']<10){
                            if($szansa<=40){
                                wygrana();
                            }
                            else{
                                przegrana();
                            }
                        }
                        elseif($_SESSION['progress']<20){
                            if($szansa<=50){
                                wygrana();
                            }
                            else{
                                przegrana();
                            }
                        }
                        elseif($_SESSION['progress']<30){
                            if($szansa<=60){
                                wygrana();
                            }
                            else{
                                przegrana();
                            }
                        }
                        elseif($_SESSION['progress']<40){
                            if($szansa<=70){
                                wygrana();
                            }
                            else{
                                przegrana();
                            }
                        }
                        elseif($_SESSION['progress']<50){
                            if($szansa<=80){
                                wygrana();
                            }
                            else{
                                przegrana();
                            }
                        }
                        elseif($_SESSION['progress']<=90){
                            if($szansa<=90){
                                wygrana();
                            }
                            else{
                                przegrana();
                            }
                        }
                        elseif($_SESSION['progress']>90){
                            if($szansa<=95){
                                wygrana();
                            }
                            else{
                                przegrana();
                            }
                        }
                    break;
                    /////////////////////////////PRZESTĘPSTWO 2/////////////////////////
                case 2:

                blokowanie();

                function wygrana(){
                    $hajs=rand(11,20);
                    $progress=rand(11,20);
                    $id =  $_SESSION['id'];
                    $unconnect=connect();
                    echo "<p class='success'>Udało Ci się, zyskałeś $hajs PLN i $progress do szacunku</p>";
                    $_SESSION['progress']+=$progress;
                    $_SESSION['hajs']+=$hajs;
                    connect();
                    $prog=$_SESSION['progress'];
                    $twojhajs=$_SESSION['hajs'];
                    $kwerenda = "UPDATE users SET progress=$prog, hajs=$twojhajs  WHERE id=$id ;";
                    $update = mysqli_query(connect(), $kwerenda);
                    mysqli_close($unconnect);
                }

                function przegrana(){
                    $czas=5; //minuty
                    $unconnect=connect();
                    connect(); //Łączymy się z bazą
                    $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                    $kwerenda = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                    $update = mysqli_query(connect(), $kwerenda); //Wykonuje kwerendę
                    $zmienna = mysqli_query(connect(), "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                    $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                    $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
                    mysqli_close($unconnect); //zamyka połączenie z bazą

                    $_SESSION['wiezieniestop1']=true;
                    echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minut!</p>";
                }
                    if($_SESSION['progress']<50){
                        if($szansa<=0){
                           wygrana();
                        }
                        else{
                            przegrana();
                        }
                    }
                    elseif($_SESSION['progress']<90){
                        if($szansa<=40){
                            wygrana();
                        }
                        else{
                            przegrana();
                        }
                    }
                    elseif($_SESSION['progress']<150){
                        if($szansa<=50){
                            wygrana();
                        }
                        else{
                            przegrana();
                        }
                    }
                    elseif($_SESSION['progress']<230){
                        if($szansa<=60){
                            wygrana();
                        }
                        else{
                            przegrana();
                        }
                    }
                    elseif($_SESSION['progress']<300){
                        if($szansa<=70){
                            wygrana();
                        }
                        else{
                            przegrana();
                        }
                    }
                    elseif($_SESSION['progress']<400){
                        if($szansa<=80){
                            wygrana();
                        }
                        else{
                            przegrana();
                        }
                    }
                    elseif($_SESSION['progress']<540){
                        if($szansa<=90){
                            wygrana();
                        }
                        else{
                            przegrana();
                        }
                    }
                    elseif($_SESSION['progress']>540){
                        if($szansa<=95){
                            wygrana();
                        }
                        else{
                            przegrana();
                        }
                    }
                break;
                 /////////////////////////////PRZESTĘPSTWO 3/////////////////////////
                case 3:

                blokowanie();

                 function wygrana(){
                     $hajs=rand(21,30);
                     $progress=rand(21,30);
                     $id =  $_SESSION['id'];
                     $unconnect=connect();
                     echo "<p class='success'>Udało Ci się, zyskałeś $hajs PLN i $progress do szacunku</p>";
                     $_SESSION['progress']+=$progress;
                     $_SESSION['hajs']+=$hajs;
                     connect();
                     $prog=$_SESSION['progress'];
                     $twojhajs=$_SESSION['hajs'];
                     $kwerenda = "UPDATE users SET progress=$prog, hajs=$twojhajs  WHERE id=$id ;";
                     $update = mysqli_query(connect(), $kwerenda);
                     mysqli_close($unconnect);
                 }
 
                 function przegrana(){
                    $czas=10; //minuty
                    $unconnect=connect();
                    connect(); //Łączymy się z bazą
                    $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                    $kwerenda = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                    $update = mysqli_query(connect(), $kwerenda); //Wykonuje kwerendę
                    $zmienna = mysqli_query(connect(), "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                    $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                    $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
                    mysqli_close($unconnect); //zamyka połączenie z bazą

                    $_SESSION['wiezieniestop1']=true;
                    echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minut!</p>";
                }

                     if($_SESSION['progress']<300){
                         if($szansa<=0){
                            wygrana();
                         }
                         else{
                             header("Location: wiezienie.php");
                             $_SESSION['wiezienie']=true;
                         }
                     }
                     elseif($_SESSION['progress']<320){
                         if($szansa<=40){
                             wygrana();
                         }
                         else{
                             header("Location: wiezienie.php");
                             $_SESSION['wiezienie']=true;
                         }
                     }
                     elseif($_SESSION['progress']<350){
                         if($szansa<=50){
                             wygrana();
                         }
                         else{
                             header("Location: wiezienie.php");
                             $_SESSION['wiezienie']=true;
                         }
                     }
                     elseif($_SESSION['progress']<390){
                         if($szansa<=60){
                             wygrana();
                         }
                         else{
                             header("Location: wiezienie.php");
                             $_SESSION['wiezienie']=true;
                         }
                     }
                     elseif($_SESSION['progress']<450){
                         if($szansa<=70){
                             wygrana();
                         }
                         else{
                             header("Location: wiezienie.php");
                             $_SESSION['wiezienie']=true;
                         }
                     }
                     elseif($_SESSION['progress']<500){
                         if($szansa<=80){
                             wygrana();
                         }
                         else{
                             echo "Idziesz do więzienia";
                         }
                     }
                     elseif($_SESSION['progress']<640){
                         if($szansa<=90){
                             wygrana();
                         }
                         else{
                             echo "Idziesz do więzienia";
                         }
                     }
                     elseif($_SESSION['progress']>640){
                         if($szansa<=5){
                             wygrana();
                         }
                         else{
                             przegrana();
                         }
                     }
                 break;
                  /////////////////////////////PRZESTĘPSTWO 4/////////////////////////
                  case 4:

                  blokowanie();

                  function wygrana(){
                      $hajs=rand(31,40);
                      $progress=rand(31,40);
                      $id =  $_SESSION['id'];
                      $unconnect=connect();
                      echo "<p class='success'>Udało Ci się, zyskałeś $hajs PLN i $progress do szacunku</p>";
                      $_SESSION['progress']+=$progress;
                      $_SESSION['hajs']+=$hajs;
                      connect();
                      $prog=$_SESSION['progress'];
                      $twojhajs=$_SESSION['hajs'];
                      $kwerenda = "UPDATE users SET progress=$prog, hajs=$twojhajs  WHERE id=$id ;";
                      $update = mysqli_query(connect(), $kwerenda);
                      mysqli_close($unconnect);
                  }
  
                  function przegrana(){
                    $czas=5; //minuty
                    $unconnect=connect();
                    connect(); //Łączymy się z bazą
                    $id = $_SESSION["id"]; //Podajemy ID użytkownika do zmiennej ID
                    $kwerenda = "UPDATE users SET twiezienie=now()+INTERVAL $czas MINUTE WHERE id=$id ;"; //Ustawia czas w bazie, do którego będziemy w szpitalu
                    $update = mysqli_query(connect(), $kwerenda); //Wykonuje kwerendę
                    $zmienna = mysqli_query(connect(), "SELECT twiezienie FROM users WHERE id=$id"); //Wybiera z bazy czas, który pozostał
                    $row = mysqli_fetch_array($zmienna); //stwarza tablicę asocjacyjną z wynikiem z bazy
                    $_SESSION['twiezienie'] = $row['twiezienie']; //zapisuje czas końcowy z bazy do zmiennej sesyjnej
                    mysqli_close($unconnect); //zamyka połączenie z bazą

                    $_SESSION['wiezieniestop1']=true;
                    echo "<p class='lose'>Trafiasz do więzienia na ".$czas." minut!</p>";
                }

                      if($_SESSION['progress']<500){
                          if($szansa<=0){
                             wygrana();
                          }
                          else{
                              header("Location: wiezienie.php");
                              $_SESSION['wiezienie']=true;
                          }
                      }
                      elseif($_SESSION['progress']<600){
                          if($szansa<=40){
                              wygrana();
                          }
                          else{
                              header("Location: wiezienie.php");
                              $_SESSION['wiezienie']=true;
                          }
                      }
                      elseif($_SESSION['progress']<700){
                          if($szansa<=50){
                              wygrana();
                          }
                          else{
                              header("Location: wiezienie.php");
                              $_SESSION['wiezienie']=true;
                          }
                      }
                      elseif($_SESSION['progress']<800){
                          if($szansa<=60){
                              wygrana();
                          }
                          else{
                              header("Location: wiezienie.php");
                              $_SESSION['wiezienie']=true;
                          }
                      }
                      elseif($_SESSION['progress']<900){
                          if($szansa<=70){
                              wygrana();
                          }
                          else{
                              header("Location: wiezienie.php");
                              $_SESSION['wiezienie']=true;
                          }
                      }
                      elseif($_SESSION['progress']<1000){
                          if($szansa<=80){
                              wygrana();
                          }
                          else{
                              echo "Idziesz do więzienia";
                          }
                      }
                      elseif($_SESSION['progress']<1100){
                          if($szansa<=90){
                              wygrana();
                          }
                          else{
                              echo "Idziesz do więzienia";
                          }
                      }
                      elseif($_SESSION['progress']>1100){
                          if($szansa<=95){
                              wygrana();
                          }
                          else{
                              przegrana();
                          }
                      }
                  break;
            }
        }
    }

//CZAS DOSTĘPU
$dataczas = new DateTime();
$koniec = DateTime::createFromFormat('Y-m-d H:i:s', $_SESSION['tprzestepstwa']);
$roznica = $dataczas->diff($koniec);
$_SESSION['przestepstwaczas'] = $roznica;

if($dataczas<$koniec){
	$_SESSION['przestepstwastop'] = true;
	echo "<p style=text-align:center>Pozostało: ".$roznica->format('%i minut, %s sekund')."</p>";
	$_SESSION['odswiezenieprzestepstw']=$roznica->format('%s')+1;
	$_SESSION['przestepstwa']=$roznica->format('%i minut, %s sekund');
}
else {
	$_SESSION['przestepstwastop'] = false;
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