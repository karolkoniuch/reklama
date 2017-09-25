<?php
ob_start();
// ========== Funkcje ==========

    function open($name="",$trybe="r",$value="0")
        {
            if(file_exists($name))
                {
                    $file=fopen($name, $trybe);
                    flock($file, 1);
                    if (filesize($name)>0) return fread(fopen($name, $trybe), filesize($name)); else return $value;
                    flock($file, 3);
                    fclose($file);
                }
        }

    function save($name="",$date="",$trybe="w")
        {
            if(file_exists($name))
                {
                    $file=fopen($name, $trybe);
                    flock($file, 2);
                    fwrite($file, $date);
                    flock($file, 3);
                    fclose($file);
                }
        }

// ========== Scieżki ==========

    $scr[0] = "licznik/ip.txt";
    $scr[1] = "licznik/dane.txt";
    $scr[2] = "licznik/log.txt";

// ========== Zmienne ==========

    $aktu_ip = $_SERVER['REMOTE_ADDR'];
    $host = gethostbyaddr($aktu_ip); 
    $aktu_czas = (date(G)*3600)+(date(i)*60)+date(s);//date(G)*60+date(i); 3600 = 1h; 
    $czas_online = 600; //  (10 minut) = 600 sekund
    $czas_opuznienia = 900; //  (15 minut) = 900 sekund
    $data = date("Y-m-d", time());
    $online = 1;
    $zmienna = False;
    $nowe_dane = '';

// ========== zródło ==========

    $dane = explode(chr(1),open($scr[1]));

    if(!strcmp($dane[2],$data))
        {
            $tab1 = explode(chr(1), open($scr[0]));

            for( $x = 0; $x <= count($tab1)-2; $x+=2 )
                {
                    if(!strcmp($aktu_ip, $tab1[$x]))
                        {
                            if($aktu_czas - $czas_opuznienia < $tab1[$x+1]) $zmienna=True;
                        }
                    else
                        {
                            if($aktu_czas - $czas_opuznienia < $tab1[$x+1])
                                {
                                    $nowe_dane .= $tab1[$x].chr(1).$tab1[$x+1].chr(1);
                                    if($aktu_czas - $czas_online < $tab1[$x+1]) $online++;
                                }
                        }
                }

            if ($zmienna == 0)
                {
                    $dane[0]++;
                    $dane[1]++;

                    save($scr[1],$dane[0].chr(1).$dane[1].chr(1).$dane[2]);

$wszystko = "$dane[0] -".chr(1). "- $dane[1] -" .chr(1). "- $online -" .chr(1). date("- Y-m-d  -" .chr(1). "- G:i:s -", time()) .chr(1). "- $aktu_ip -" .chr(1). "- $host -" .chr(1). $HTTP_REFERER .chr(1). $HTTP_USER_AGENT .chr(13).chr(10);
save($scr[2],$wszystko,"a");
                }
        }
    else
        {
            save($scr[0]);

            $dane[0]++;
            $dane[1] = 1;

            save($scr[1],$dane[0].chr(1).$dane[1].chr(1).$data);

$wszystko = "$dane[0] -".chr(1). "- $dane[1] -" .chr(1). "- $online -" .chr(1). date("- Y-m-d -" .chr(1). "- G:i:s -", time()) .chr(1). "- $aktu_ip -" .chr(1). "- $host -" .chr(1). $HTTP_REFERER .chr(1). $HTTP_USER_AGENT .chr(13).chr(10);
save($scr[2],$wszystko,"a");
        }

    $nowe_dane .= $aktu_ip.chr(1).$aktu_czas.chr(1);
    save($scr[0],$nowe_dane);
	
	echo "Odwiedzin: <font color=\"#ef5d21\" ><b>$dane[0]</b></font><br />\n";
   echo "Dzisiaj: <font color=\"#ef5d21\" ><b>$dane[1]</b></font><br />\n";
   echo "On-line: <font color=\"#ef5d21\" ><b>$online</b></font><br />\n"; 

  // LICZNIK POWSTANIA STRONY
  //przekształcamy datę w przeszłosci do formatu unix'owego
   $data = strtotime("2012-02-17 0:00:30");  // tu wpisz datę od kiedy ma liczyć
  //pobieramy bieżacy czas
   $teraz = time();
  //różnice dzielimy przez jeden dzień czyli 60 s. * 60 m. * 24 godz.
   $dni_r = ($teraz - $data) / (60 * 60 * 24);
  //częsć całkowita z dzielenia to liczba dni
   $dni_c = floor($dni_r);
  //resztę z dzielenia mnożymy przez dobę
   $godzin_r = ($dni_r - $dni_c) * 24;
  //częsć całkowita z mnożenia to liczba godzin
   $godzin_c = floor($godzin_r);
  //resztę mnożymy przez godzinę
   $minut_r = ($godzin_r - $godzin_c) * 60;
  //częsć całkowita to liczba minut
   $minut_c = floor($minut_r);
  //częsć całkowita reszty pomnożonej przez minutę to liczba sekund
   $sekund_c = floor(($minut_r - $minut_c) * 60);
  echo "Strona istnieje: <font color=\"#ef5d21\"><b>$dni_c</b></font> dni<br\n>\n";

  // LICZNIK GENEROWANIA STRONY
   echo "Czas ładowania: </font>";
   echo "<font color=\"#ef5d21\"><b>";
   echo round(microtime()-$start, 3);
   echo "</b></font> sek";

?>
