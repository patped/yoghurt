<?php
require_once 'database.php';
$db = kobleOpp();
?>
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Forside youghurt</title>
        <link rel="stylesheet" href="stilark.css" type="text/css">
    </head>
    <body>
        <div class="loginn">
                <input type="text" name="" id="Brukernavn" style="width: 75px; height: 15px">
                <br>
                <input type="passord" name="" id="passord"
                style="width: 75px; height: 15px">
                <br>
                <input type="submit" name="" value="logg inn" style=" width: 65px; height: 20px">
        </div>
        <?php
        $status = mysqli_set_charset($db, "utf8");
        if (!$status) {
            echo "Feil i pålogging";
            exit;
        } else if (isset($_GET["res"])) {
            $id = $_GET["res"];
            $sqlSpørring = (
                "SELECT * FROM
                    Restauranter AS r,
                    Poststed AS p,
                    Tilsynsrapporter AS t
                WHERE p.postnr = r.postnr
                AND t.tilsynsobjektid = r.tilsynsobjektid
                AND r.tilsynsobjektid
                LIKE '$id'
                ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC" 
            ); /* Legger til ORDER BY her for at den første linjen skal være den som er sist utført mtp DATO. 
            Dato er lagret som Integer, ettersom databasen fra Mattilsynet ikke hadde lagret 0'ere i en av de to 
            databasefilene sine. Jeg har løst problemet med å sortere etter år, så måned og så dag.*/
            $svar = mysqli_query($db, $sqlSpørring);
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
                    <h1>$navn</h1>
                    <h2>$fullAdresse</h2>
                    <table name='resultatTabell'>
                        <th>Organisasjonsnummer</th>
                        <th>Adresse</th>
                        <th>Postnummer</th>
                        <th>Poststed</th>
                        <th>Smilefjes-Karakter<br>(siste rapport)</th>
                        <tr>
                            <td>$orgnummer</td>
                            <td>$adresse</td>
                            <td>$postnummer</td>
                            <td>$poststed</td>
                            <td>$totalkarakter</td>
                        </tr>
                    </table>
                    ";
                    /* Legger til Smilefjes-karakter*/
                    $sqlSpørringHenteKarakter = (
                        "SELECT t.total_karakter FROM
                            Tilsynsrapporter AS t
                        WHERE t.tilsynsobjektid LIKE '$id'
                        ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC" 
                        );
                        $utførSpørringMedKarakter = mysqli_query($db, $sqlSpørringHenteKarakter);
                        $svarKarakter = mysqli_fetch_assoc($utførSpørringMedKarakter);
                        $karakterSisteTilsyn = 0;
                        $teller = 0;
                        while ($svarKarakter && $teller<3) {
                        $karakterSisteTilsyn = $karakterSisteTilsyn + $svarKarakter['total_karakter'];
                        $teller = $teller + 1;
                        $svarKarakter = mysqli_fetch_assoc($utførSpørringMedKarakter);
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
                      <img id ='smileBilde' src='$bilde' title='smilefjes' width= '25%'>
                      <div id='map'></div>
                    ";
                    
                    //Legger til siste 3 tilsynsrapporter dersom det eksisterer:
                    $sqlSpørringHenteTilsynsrapport = (
                        "SELECT * FROM
                            Tilsynsrapporter AS t
                        WHERE t.tilsynsobjektid LIKE '$id'
                        ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC" 
                        );
                    $utførSpørringHenteTilsynsRapport = mysqli_query($db, $sqlSpørringHenteTilsynsrapport);
                    $svarTilsynsrapport = mysqli_fetch_assoc($utførSpørringHenteTilsynsRapport);
                    echo "<table name='tilsynTabell'><th>Dato for rapport</th><th>Mattilsynets smilefjes</th>";
                    $teller = 0;
                    while ($svarTilsynsrapport && $teller<3) {
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
                        echo "<a href='tilsynsrapport/tilsynsrapportKontroller.php?tilsynid=$tilsynid&dato=$dato'>$dato</td>";
                        echo "<td><a href='tilsynsrapport/tilsynsrapportKontroller.php?tilsynid=$tilsynid&dato=$dato'><img id ='smileBilde' src='$mattilsynetSmil' title='smilefjes' width= '5%'></td>";
                        $svarTilsynsrapport = mysqli_fetch_assoc($utførSpørringHenteTilsynsRapport);
                        $teller++;
                        echo "</tr>";
                        }
                        echo "</table>";


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
                          resultsMap.setCenter(results[0].geometry.location);
                          var marker = new google.maps.Marker({
                            map: resultsMap,
                            position: results[0].geometry.location
                          });
                        } else {
                          alert('Geocode was not successful for the following reason: ' + status);
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




        <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG_9QaZStF7k76o_tBYtuA3J89WnQXedQ&callback=initMap">
    </script>
    </body>
</html>