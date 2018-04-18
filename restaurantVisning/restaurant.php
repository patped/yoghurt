<?php
session_start();
require_once '../div/database.php';
require_once 'restaurantHjelpPHP.php';
require_once '../logginn/logginn.php';
$db = kobleOpp();
?>
<!doctype html>
<html lang="no">
<head>
  <title>Restauranter</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bibloteker/bootstrap-3.3.7-dist/css/bootstrap.min.css"> 
  <link rel="stylesheet" type="text/css" href="restaurantVisning.css">
</head>
    <body>
        <?php include_once '../div/header.php'; ?> 

        <?php
        $status = mysqli_set_charset($db, "utf8");
        if (!$status) {
            echo "Feil i pålogging";
            exit;
            //legger nå innlogg inn under for at jeg er avhengig av variabel $id for å få opp hver forskjellige side
        } else if (isset($_GET["res"])) {
            $id = $_GET["res"];
            starAlertInnlogg();
            $side = 'Location: /restaurantVisning/restaurant.php?res=' . $id;
            loggInn($side);
            $sqlSpørring = restaurantSpørring(); /* Legger til ORDER BY her for at den første linjen skal være den som er sist utført mtp DATO. 
            Dato er lagret som Integer, ettersom databasen fra Mattilsynet ikke hadde lagret 0'ere i en av de to 
            databasefilene sine. Jeg har løst problemet med å sortere etter år, så måned og så dag.*/
            $stmt = mysqli_prepare($db, $sqlSpørring);
            mysqli_stmt_bind_param($stmt, 's' , $id);
            mysqli_stmt_execute($stmt);
            $svar = mysqli_stmt_get_result($stmt);
            $rad = mysqli_fetch_assoc($svar); 
            if ($rad) { //Skal bare være en unik resturant i resultatet når vi søker på primærnøkkel
                $navn = $rad['navn'];
                $adresse = $rad['adrlinje1'];
                $totalkarakter = $rad['total_karakter'];
                $fullAdresse = $rad['adrlinje1'] . ' i ' . $rad['poststed'];
                echo "<div class='container-fluid padding0'>
                        <div id='banner' class='text-center col-xs-offset-1 jumbotron'>
                            <h1>$navn</h1>
                            <h2>$fullAdresse</h2>
                        </div>
                        <div class='col-xs-1'></div>
                    </div>";
                echo "<div class='container-fluid padding0 text-center'>
                    <div id='venstreTabell' class='col-xs-2 col-xs-offset-1'>
                    <div class='table-responsive'>
                    <table class='table'>
                        <tr><th>Kompi Kvalitet:</th></tr>";
                    /* Legger til Smilefjes-karakter*/
                    $sqlSpørringHenteKarakter = tilsynsrapportSpørring();
                    $stmt = mysqli_prepare($db, $sqlSpørringHenteKarakter);
                    mysqli_stmt_bind_param($stmt, 's' , $id);
                    mysqli_stmt_execute($stmt);
                    $svar = mysqli_stmt_get_result($stmt);
                    $svarKarakter  = mysqli_fetch_assoc($svar);
                    
                    $karakterSisteTilsyn = 0;
                    $teller = 0;
                    while ($svarKarakter && $teller<3) {
                        $karakterSisteTilsyn += $svarKarakter['total_karakter'];
                        $teller++;
                        $svarKarakter = mysqli_fetch_assoc($svar);
                    }
                    $karakterSisteTilsynSnitt = $karakterSisteTilsyn/$teller;
                    $bilde = bildeSnittKarakter($karakterSisteTilsynSnitt);
                    
                    echo "
                     <tr><td><img alt='smilefjes' id ='smileBilde' src='$bilde' title='smilefjes' width= '150' onmouseover='visKarakterInfo()' onmouseout='skjulKarakterInfo()'></td></tr>
                     <tr><td><h4 id='hoverText' style='display:none'>$karakterSisteTilsynSnitt</h4></td></tr>
                    </table>
                    </div>
                </div>
                    <div id='midtTabell' class='col-xs-4'>";
                    
                    //Legger til siste 3 tilsynsrapporter dersom det eksisterer:
                    $sqlSpørringHenteTilsynsrapport = tilsynsrapportSpørring();
                    $stmt = mysqli_prepare($db, $sqlSpørringHenteTilsynsrapport);
                    mysqli_stmt_bind_param($stmt, 's' , $id);
                    mysqli_stmt_execute($stmt);
                    $svar = mysqli_stmt_get_result($stmt);
                    $svarTilsynsrapport = mysqli_fetch_assoc($svar);
                    echo (
                        "<table id='infoTabell' class='table text-center'>
                            <thead>
                                <tr>
                                    <th class='thMidt'>Dato for rapport</th>
                                    <th class='thMidt'><a href='#' data-toggle='tooltip' title='Karakter går fra 0-3, hvor 0 er best'>Karakter*</a></th>
                                    <th class='thMidt'>Mattilsynets smilefjes</th>
                                </tr>
                            </thead>
                            <tbody>"
                    );
                    $teller = 0;
                    while ($svarTilsynsrapport && $teller<3) {
                        $dato = $svarTilsynsrapport['dato'];
                        $dag = round($dato/1000000);
                        $måned = round(fmod($dato, 1000000)/10000);
                        $år = fmod($dato, 100);
                        $år = "20" . $år;
                        if ($måned<10) {
                            $måned = "0" . $måned;
                        }
                        if ($dag<10) {
                            $dag = "0" . $dag;
                        }
                        $mattilsynetSmil = mattilsynSmil($svarTilsynsrapport);
                        $karakter = $svarTilsynsrapport['total_karakter'];
                        $tilsynid = $svarTilsynsrapport['tilsynid'];
                        echo (
                            "<tr>
                                <td><a href='../tilsynsrapport/tilsyn.php?tilsynid=$tilsynid'>$dag.$måned.$år</a></td>
                                <td>$karakter</td>
                                <td><a href='../tilsynsrapport/tilsyn.php?tilsynid=$tilsynid'><img alt='smilefjes' src='$mattilsynetSmil' title='smilefjes' width= '35'></a></td>
                            </tr>"
                        );
                        $svarTilsynsrapport = mysqli_fetch_assoc($svar);
//                        echo "</tr>";
                        if ($teller == 0) { // Sjekker kun den nyeste rapporten
                            $tilsynDato = strtotime($år . "-" . $måned . "-" . $dag);
                            $datodiff = tilsynsrapportAntallDagerSiden($tilsynDato);
                        }
                        $teller++;
                    }
                    echo "</table>";
                    if ($datodiff > 180) {
                       //Vi sjekker om det er mer enn 6 måneder siden siste tilsyn og gir beskjed til brukeren om ny tilsynsrapport bør utføres
                        echo "<br><br><h3 id='obsMelding'>OBS! Det er mer enn 6 måneder siden siste tilsyn</h3>";
                        if (isset($_SESSION['loggetInn'])) {
                            if ($_SESSION['loggetInn'] == true) { // Dersom logget inn, få knapp til å legge inn ny tilsynsrapport med en gang.
                            echo <<<EOT
                            <button type='button' onclick="window.location.href='/tilsynsrapport/endre.php?tilsynsobjektid=$id'">Legg til ny rapport</button>
EOT;
                            }
                        }
                    }
                    echo "
                    </div>
                    <div id='kart' class='col-xs-4'>
                      <div id='map' hidden=''></div>
                    </div></div>";
                    /*Legger til script for å vise Google Map*/
                    include_once 'googleMaps.php';
            } else {
                echo "<h1>Resultatet av SQL-spørringen ga 0 rader</h1>";
            }
        }   
        mysqli_close($db);
        ?>
        <?php include_once '../div/footer.php'; ?>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG_9QaZStF7k76o_tBYtuA3J89WnQXedQ&callback=initMap"></script>
        <script src="restaurantVisningJS.js"></script>
        <script src="/bibloteker/jquery/jquery-3.3.1.min.js"></script>
        <script src="/bibloteker/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>
</html>