<?php
session_start();
require_once 'database.php';
require_once 'logginn.php';
$db = kobleOpp();
?>
<!doctype html>
<html>
    <head>
  <title>Yoghurt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
    <body>
        <?php include_once 'header.php'; ?>

        <?php
        $status = mysqli_set_charset($db, "utf8");
        if (!$status) {
            echo "Feil i pålogging";
            exit;
            //legger nå innlogg inn under for at jeg er avhengig av variabel $id for å få opp hver forskjellige side
        } else if (isset($_GET["res"])) {
            $id = $_GET["res"];
            starAlertInnlogg();
            $side = 'Location: restaurantVisning.php?res=' . $id;
            loggInn($side);
            $sqlSpørring = (
                "SELECT * FROM
                    Restauranter AS r,
                    Poststed AS p,
                    Tilsynsrapporter AS t
                WHERE p.postnr = r.postnr
                AND t.tilsynsobjektid = r.tilsynsobjektid
                AND r.tilsynsobjektid
                LIKE ?
                ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC"
            ); /* Legger til ORDER BY her for at den første linjen skal være den som er sist utført mtp DATO. 
            Dato er lagret som Integer, ettersom databasen fra Mattilsynet ikke hadde lagret 0'ere i en av de to 
            databasefilene sine. Jeg har løst problemet med å sortere etter år, så måned og så dag.*/
            $stmt = mysqli_prepare($db, $sqlSpørring);
            mysqli_stmt_bind_param($stmt, 's' , $id);
            mysqli_stmt_execute($stmt);
            $svar = mysqli_stmt_get_result($stmt);
            $rad = mysqli_fetch_assoc($svar);
            if ($rad) {
                $navn = $rad['navn'];
                $adresse = $rad['adrlinje1'];
                $postnummer = $rad['postnr'];
                $poststed = $rad['poststed'];
                $orgnummer = $rad['orgnummer'];
                $totalkarakter = $rad['total_karakter'];
                $fullAdresse = $rad['adrlinje1'] . ' ' . $rad['poststed'];
                echo "
                    
                    <div class='jumbotron text-center'>
                    <h1>$navn</h1>
                    <h2>$fullAdresse</h2>
                    </div>
                <div class='container-fluid'>

                    
                    <div class='col-md-3'>
                    <div class='col-md-5; col-md-offset-1'>

                    <div class='table-responsive'>
                    <table class='table table-hover'>
                        <th>Adresse: </th>
                        <th>$adresse</th>
                    <tr>
                        <th>Postnummer: </th>
                        <th>$postnummer</th>
                    </tr>
                    <tr>
                        <th>Orgnummer: </th>
                        <th>$orgnummer</th>
                    </tr>
                        <th>Smilefjes</th>
                        


                    
                    ";
                    /* Legger til Smilefjes-karakter*/
                    $sqlSpørringHenteKarakter = (
                        "SELECT t.total_karakter FROM
                            Tilsynsrapporter AS t
                        WHERE t.tilsynsobjektid LIKE ?
                        ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC" 
                        );
                    $stmt = mysqli_prepare($db, $sqlSpørringHenteKarakter);
                    mysqli_stmt_bind_param($stmt, 's' , $id);
                    mysqli_stmt_execute($stmt);
                    $svar = mysqli_stmt_get_result($stmt);
                    $svarKarakter  = mysqli_fetch_assoc($svar);
                    
                    $karakterSisteTilsyn = 0;
                    $teller = 0;
                    while ($svarKarakter && $teller<3) {
                    $karakterSisteTilsyn = $karakterSisteTilsyn + $svarKarakter['total_karakter'];
                    $teller = $teller + 1;
                    $svarKarakter = mysqli_fetch_assoc($svar);
                    }
                    $karakterSisteTilsynSnitt = $karakterSisteTilsyn/$teller;
                    if ($karakterSisteTilsynSnitt<0.5) {
                         $bilde = './bilder/smileys/storSmil.png';
                     }else if ($karakterSisteTilsynSnitt<=1) {
                         $bilde = './bilder/smileys/liteSmil.png';
                     }else if ($karakterSisteTilsynSnitt<=1.5) {
                         $bilde = './bilder/smileys/ingenSmil.png';
                     }else{
                         $bilde = './bilder/smileys/spySmil.png';
                     }
                    
                    echo "
                    
                     <th><img id ='smileBilde' src='$bilde' title='smilefjes' width= '25%'></th>
                    </table>
                    </div>
                      </div>
                      </div>
                      
                      
                    ";
                    
                    //Legger til siste 3 tilsynsrapporter dersom det eksisterer:
                    $sqlSpørringHenteTilsynsrapport = (
                        "SELECT * FROM
                            Tilsynsrapporter AS t
                        WHERE t.tilsynsobjektid LIKE ?
                        ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC" 
                        );
                    $stmt = mysqli_prepare($db, $sqlSpørringHenteTilsynsrapport);
                    mysqli_stmt_bind_param($stmt, 's' , $id);
                    mysqli_stmt_execute($stmt);
                    $svar = mysqli_stmt_get_result($stmt);
                    $svarTilsynsrapport = mysqli_fetch_assoc($svar);
                        $tema1 = $svarTilsynsrapport['tema1_no'];
                        $tema2 = $svarTilsynsrapport['tema2_no'];   
                        $tema3 = $svarTilsynsrapport['tema3_no'];
                        $tema4 = $svarTilsynsrapport['tema4_no'];
                        $karakter4=$svarTilsynsrapport['karakter4'];

                    echo "<div class='col-md-5'><table class='table table-hover;'>
                    <div class='table-responsive'>
                    <th><h4>Dato for rapport</h4></th><th><h4>Mattilsynets smilefjes</h4></th><th><h4>
                    $tema1</h4></th>
                    <th><h4>
                    $tema2</h4></th>
                    <th><h4>
                    $tema3</h4></th>
                    <th><h4>
                    $tema4</h4></th>";
                    $teller = 0;
                    while ($svarTilsynsrapport && $teller<3) {
                        $karakter1=$svarTilsynsrapport['karakter1'];
                        $karakter2=$svarTilsynsrapport['karakter2'];
                        $karakter3=$svarTilsynsrapport['karakter3'];
                        $karakter4=$svarTilsynsrapport['karakter4'];

                        $dato = $svarTilsynsrapport['dato'];
                        $dag = round($dato/1000000);
                        $måned = round(fmod($dato, 1000000)/10000);
                        $år = fmod($dato, 100);
                        if ($måned<10) {
                            $måned = "0" . $måned;
                        }
                        if ($dag<10) {
                            $dag = "0" . $dag;
                        }
                        $dato = "$dag.$måned.$år";
                        switch ($svarTilsynsrapport['total_karakter']) {
                            case '0':
                                $mattilsynetSmil = './bilder/smileys/storSmil.png';
                                break;
                            case '1':
                                $mattilsynetSmil = './bilder/smileys/liteSmil.png';
                                break;
                            case '2':
                                $mattilsynetSmil = './bilder/smileys/ingenSmil.png';
                                break;
                            case '3':
                                $mattilsynetSmil = './bilder/smileys/storSmil.png';
                                break;
                            default:
                                $mattilsynetSmil = './bilder/smileys/spySmil.png';
                                break;
                        }
                        $tilsynid = $svarTilsynsrapport['tilsynid'];
                        echo "<tr><td>";
                        echo "<a href='tilsynsrapport/tilsyn.php?tilsynid=$tilsynid&dato=$dato'>$dato</td>";
                        echo "<td><a href='tilsynsrapport/tilsyn.php?tilsynid=$tilsynid&dato=$dato'><img id ='smileBilde' src='$mattilsynetSmil' title='smilefjes' width= '20%'></td>";
                        echo "<td>$karakter1</td><td>$karakter2</td><td>$karakter3</td><td>$karakter4</td>";
                        $svarTilsynsrapport = mysqli_fetch_assoc($svar);
                        $teller++;
                        echo "</tr>";
                        }
                        echo "</table>
                    </div>
                    
                    
                        
                    <div class='col-md-4'>
                      <div id='map' hidden='true' style='width: 100%; height: 450px;'></div>
                      </div>
                  </div>
                  

                        
                    ";



                    /*Legger til script for å vise Google Map*/
                    echo "
                    <script>
                      function initMap() {
                      var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 17,
                        center: {lat: 0, lng: 0}
                      });
                      var geocoder = new google.maps.Geocoder();

                        geocodeAddress(geocoder, map);
                    }

                    function geocodeAddress(geocoder, resultsMap) {
                      var address = '$fullAdresse';
                      geocoder.geocode({'address': address}, function(results, status) {
                        if (status === 'OK') {
                        	document.getElementById('map').hidden=false;
                          resultsMap.setCenter(results[0].geometry.location);
                          var marker = new google.maps.Marker({
                            map: resultsMap,
                            position: results[0].geometry.location
                          });
                        } else {
                          document.getElementById('map').hidden=true;
                        }
                      });
                    }
                                        </script>
                                        
                ";
            } else {
                echo "<h1>Resultatet av SQL-spørringen ga 0 rader</h1>";
            }
        }
        
        mysqli_close($db);

        ?>



        </main>
        <?php include_once 'footer.php'; ?>


        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG_9QaZStF7k76o_tBYtuA3J89WnQXedQ&callback=initMap"></script>
        <script src="bibloteker/jquery/jquery-3.3.1.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>