<?php
session_start();
require_once '../div/session-kapring.php';
require_once '../div/database.php';
require_once 'sok.php';
require_once '../logginn/logginn.php';

?>
<!doctype html>
<html>
<head>
  <title>Yoghurt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="sokeresultat.css">
</head>
<body>
    <?php 
    include_once '../div/header.php';
    starAlertInnlogg();
    $side = 'Location: /sok/sokeresultat.php?start=0';
    logginn($side);
    $db = kobleOpp();
   
   if (!isset($_GET['start'])) {
   	header("Location: /index.php");
   }
   	$antallResultat = 10;
    $startSøk = $_GET['start'];
    $sluttSøk = $startSøk + $antallResultat;
    $søkTeller = 0;
    if (!isset($_POST["søkeKnapp"])) {
        if (!isset($_SESSION['tidligereSøk'])) {
            header("Location: /index.php");
        }  
    }
    $status = mysqli_set_charset($db, "utf8");
    $stmt;
    $hvordanSøk;
    $nesteSøkTall = $startSøk + $antallResultat;
    $forrigeSøkTall = $startSøk-$antallResultat;
    $nesteSide = '/sok/sokeresultat.php?start=' . $nesteSøkTall;
    $forrigeSide = '/sok/sokeresultat.php?start=' . $forrigeSøkTall;
    $kategori = finnKategori();
    $tabellEllerView = finnTabellEllerView($kategori);
    if (isset($_POST["søkeKnapp"])) {
        if (isset($_POST["orgnr"])) {
            $_SESSION['søkeverdi'] = $søkeverdi;
            $sqlSpørring = hentOrgSpørring($tabellEllerView);
            $stmt = mysqli_prepare($db, $sqlSpørring);
            mysqli_stmt_bind_param($stmt, 's' , $_SESSION['søkeverdi']);
            mysqli_stmt_execute($stmt);
            $hvordanSøk = "org";
        }
        else if (isset($_POST["adresse"])) {
            if (isset($_POST["restaurant"])) {
                $_SESSION['adresseSøkekriterie'] = "%" . $_POST["Søkefelt"] . "%";
                $_SESSION['poststedSøkekriterie'] = "%" . $_POST["poststedInput"] . "%";
                $_SESSION['restaurantSøkekriterie'] = "%" . $_POST["spisestedSokefelt"] . "%";
                $sqlSpørring = hentAdresseSpisestedSpørring($tabellEllerView);
                $stmt = mysqli_prepare($db, $sqlSpørring);
                mysqli_stmt_bind_param($stmt, 'sss', $_SESSION['poststedSøkekriterie'], $_SESSION['adresseSøkekriterie'], $_SESSION['restaurantSøkekriterie']);
                mysqli_stmt_execute($stmt);
                $hvordanSøk = "adr&rest";
            }
            else{
                $_SESSION['adresseSøkekriterie'] = "%" . $_POST["Søkefelt"] . "%";
                $_SESSION['poststedSøkekriterie'] = "%" . $_POST["poststedInput"] . "%";
                $sqlSpørring = hentAdresseSpørring($tabellEllerView);
                $stmt = mysqli_prepare($db, $sqlSpørring);
                mysqli_stmt_bind_param($stmt, 'ss' , $_SESSION['poststedSøkekriterie'], $_SESSION['adresseSøkekriterie']);
                mysqli_stmt_execute($stmt);
                $hvordanSøk = "adr";
            }
        }else if (isset($_POST["restaurant"])) {
            $_SESSION['restaurantSøkekriterie'] = "%" . $_POST["spisestedSokefelt"] . "%";
            $sqlSpørring = hentSpisestedSpørring($tabellEllerView);
            $stmt = mysqli_prepare($db, $sqlSpørring);
            mysqli_stmt_bind_param($stmt, 's' , $_SESSION['restaurantSøkekriterie']);
            mysqli_stmt_execute($stmt);
            $hvordanSøk = "rest";
        }
        echo "<div class='container text-center'>";
        echo "<button type='button' onclick='visSøkeFelt()' id='søkPåNytt' class='btn btn-primary'><h2 id='søkPåNyttTekst'>Søk på nytt?</h2></button>";
        echo "<div id='søkeFeltDiv' style='display:none'>";
        sok();
        echo "</div>";
        echo "</div>";

        if (!$status) {
            echo "Feil i pålogging";
            exit;
        } else {
            if (isset($_POST["geolokasjon"])) {
                require_once "geo-resultat.php";
                $latitude = $_POST["latitude"];
                $longitude = $_POST["longitude"];
                //Trenger ikke hindre sql-injection her, ettersom metoden ikke bruker brukers "input" til noe annet enn sjekk i forhold til allerede eksisterende long, lat.
                $resultat = iNaerheten($tabellEllerView, $db, $latitude, $longitude);
                $hvordanSøk = 'geo';
            } else {
                $svar = mysqli_stmt_get_result($stmt);
                $resultat = $svar->fetch_all(MYSQLI_ASSOC);
            }
            echo "<div id='tabellContainer' class='container col-xs-offset-1 col-xs-9'>";
            echo "<div class=''> <h3 id='h3Resultat'>Resultat</h3> </div>";

            if (count($resultat) > 0) {                    
                echo (
                    "<table class='table table-condensed table-hover'>
                        <thead>
                            <th>Navn</th>
                            <th>Adresse</th>
                            <th>Poststed</th>
                            <th>Smilefjes</th>
                        </thead>"
                );
                    
                    foreach ($resultat as $rad) {
                        //søkTeller gjennomfører gjennomkjøringer slik at første resultat blir $startsøk.
                        if ($søkTeller >= $sluttSøk) {
                            break;
                        }
                        if ($søkTeller< $startSøk) {
                        $søkTeller++;
                        }
                        else{
                        $søkTeller++;
                        skrivUtSøkeresultat($rad, $db); // Skriver ut en rad av resultat
                        }
                    }
                    echo "</table>";
                    //Legger til neste, knapp og initierer at det er utført et søk før
                    $_SESSION['hvordanSøk'] = $hvordanSøk; // lagrer variabel om hvordan søk som er utført.
                    if (isset($sqlSpørring)) {
                    	$_SESSION['spørringen'] = $sqlSpørring; // Lagrer spørringen som er utført.
                    }
                    $_SESSION['tidligereSøk'] = true;
                    nesteForrigeSideButton($resultat, $sluttSøk, $nesteSide, $forrigeSide);
            } else {
                echo"<p>Ingen resultat matcher ditt søk</p>";
            } 
            echo "</div>";
        }
    }
if (!isset($_POST["søkeKnapp"])) {
    if (isset($_SESSION['tidligereSøk'])) {
    	echo "<div class='container text-center'>";
        echo "<button type='button' onclick='visSøkeFelt()' id='søkPåNytt' class='btn btn-primary'><h2 id='søkPåNyttTekst'>Søk på nytt?</h2></button>";
        echo "<div id='søkeFeltDiv' style='display:none'>";
        sok();
        echo "</div>";
        echo "</div>";
        $sqlSpørring = $_SESSION['spørringen'];
        $stmt = mysqli_prepare($db, $sqlSpørring);
        $hvordanSøk = $_SESSION['hvordanSøk'];
        switch ($hvordanSøk) {
            case 'org':
                mysqli_stmt_bind_param($stmt, 's' , $_SESSION['søkeverdi']);
                mysqli_stmt_execute($stmt);
                break;
            case 'adr&rest':
                mysqli_stmt_bind_param($stmt, 'sss', $_SESSION['poststedSøkekriterie'], $_SESSION['adresseSøkekriterie'], $_SESSION['restaurantSøkekriterie']);
                mysqli_stmt_execute($stmt);
                break;
            case 'adr':
                mysqli_stmt_bind_param($stmt, 'ss' , $_SESSION['poststedSøkekriterie'], $_SESSION['adresseSøkekriterie']);
                mysqli_stmt_execute($stmt);
                break;
            case 'rest':
                mysqli_stmt_bind_param($stmt, 's' ,$_SESSION['restaurantSøkekriterie']);
                mysqli_stmt_execute($stmt);
                break;
            default:
                # code...
                break;
        }
        $svar = mysqli_stmt_get_result($stmt);
        $resultat = $svar->fetch_all(MYSQLI_ASSOC);
            }
            echo "<div id='tabellContainer' class='container col-xs-offset-1 col-xs-10'>";
            echo "<div> <h3 id='h3Resultat'>Resultat</h3> </div>";
            if (count($resultat) > 0) {                    
                echo (
                    "<table class='table table-condensed table-hover'>
                        <thead>
                            <th>Navn</th>
                            <th>Adresse</th>
                            <th>Poststed</th>
                            <th>Smilefjes</th>
                        </thead>"
                );
                // Her kunne vi lagt inn LIMIT i spørringene til SQL istedet for å kjøre gjennom
                // løkka like mange ganger som startSøk er i antall.
                    foreach ($resultat as $rad) {
                        if ($søkTeller >= $sluttSøk) {
                            break;
                        }
                        if ($søkTeller< $startSøk) {
                        $søkTeller++;
                        }
                        else{
                        $søkTeller++;
                        skrivUtSøkeresultat($rad, $db); // Skriver ut en rad av resultat
                        }
                    }
                    echo "</table>";
                if (count($resultat) > $sluttSøk){
                nesteForrigeSideButton($resultat, $sluttSøk, $nesteSide, $forrigeSide);
                }
                else if ($sluttSøk>10) {
                	echo "<div id='knappeDiv'><tr><td><a href='$forrigeSide'><button type='button' id='bakoverKnapp' class='btn btn-primary'>10 forrige resultater</button></a><td></tr></div>";
                }
                echo "</div>";
    }

}
echo "<div id='clearme'></div>";
    ?>
    <?php include_once '../div/footer.php'; ?>

    <script src="sok.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".clickable-link").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    <?php
mysqli_close($db);
?>
</body>
</html>