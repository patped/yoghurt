<?php
require_once 'database.php';
$db = kobleOpp($tilsynrapportConfig);
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
                LIKE '$id'"
            );
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
                        <th>Smilefjes-Karakter</th>
                        <tr>
                            <td>$orgnummer</td>
                            <td>$adresse</td>
                            <td>$postnummer</td>
                            <td>$poststed</td>
                            <td>$totalkarakter</td>
                        </tr>
                    </table>
                    <div id='map'></div>";
                    /*Legger til script for å vise Google Map*/
                    echo "
                    <script>
                      function initMap() {
                      var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: {lat: -34.397, lng: 150.644}
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