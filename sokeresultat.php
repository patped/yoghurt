<?php
require_once 'database.php';
require_once 'sok/sok.php';
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
    <?php
    if (!isset($_POST["søkeKnapp"])) {
        header("Location: index.php");
    }
    $header = "Resultat";
    $db = kobleOpp();
    $status = mysqli_set_charset($db, "utf8");
    if (isset($_POST["søkeKnapp"])) {
        if (isset($_POST["orgnr"])) {
            $søkeverdi = $_POST["Søkefelt"];
            $sqlSpørring = 
            ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
                FROM Restauranter AS r, Poststed AS p
                WHERE p.postnr = r.postnr
                AND r.orgnummer LIKE '%$søkeverdi%'
                ORDER BY r.navn");
        }
        else if (isset($_POST["adresse"])) {
            if (isset($_POST["restaurant"])) {
                $adresseSøkekriterie = $_POST["Søkefelt"];
                $poststedSøkekriterie = $_POST["poststedInput"];
                $restaurantSøkekriterie = $_POST["spisestedSokefelt"];
                $sqlSpørring = 
                ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
                FROM Restauranter AS r, Poststed AS p
                WHERE p.postnr = r.postnr
                AND p.poststed LIKE '%$poststedSøkekriterie%'
                AND r.adrlinje1 LIKE '%$adresseSøkekriterie%'
                AND r.navn LIKE '%$restaurantSøkekriterie%'
                ORDER BY r.navn");
            }
            else{
                $adresseSøkekriterie = $_POST["Søkefelt"];
                $poststedSøkekriterie = $_POST["poststedInput"];
                $sqlSpørring = 
                ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
                FROM Restauranter AS r, Poststed AS p
                WHERE p.postnr = r.postnr
                AND p.poststed LIKE '%$poststedSøkekriterie%'
                AND r.adrlinje1 LIKE '%$adresseSøkekriterie%'
                ORDER BY r.navn");

            }
        }else if (isset($_POST["restaurant"])) {
            $restaurantSøkekriterie = $_POST["spisestedSokefelt"];
            $sqlSpørring = 
            ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
            FROM Restauranter AS r, Poststed AS p
            WHERE p.postnr = r.postnr
            AND r.navn LIKE '%$restaurantSøkekriterie%'
            ORDER BY r.navn");
        }
        
        if (!$status) {
            echo "Feil i pålogging";
            exit;
        } else {
            $svar;
            $resultat;
            if (isset($_POST["geolokasjon"])) {
                require_once "geoResultat.php";
                $latitude = $_POST["latitude"];
                $longitude = $_POST["longitude"];
                $resultat = iNaerheten($db, $latitude, $longitude);
            } else {
                $svar = mysqli_query($db, $sqlSpørring);
                $resultat = $svar->fetch_all(MYSQLI_ASSOC);
            }
            echo "<h1>$header</h1>";
            if (count($resultat) > 0) {                    
                echo "<table name='resultatTabell'><th>Navn</th><th>Adresse</th><th>Postnummer</th><th>Poststed</th><th>Smilefjes</th>";
                foreach ($resultat as $rad) {
                    $id = $rad['tilsynsobjektid'];
                    $rNavn = $rad['navn'];
                    $rPostnr = $rad['postnr'];
                    $rAdresse = $rad['adrlinje1'];
                    $rPoststed = $rad['poststed'];
                    $orgnummer = $rad['orgnummer'];

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
                    /*Legger til alle resultater i en tabell*/
                    echo "<tr class='radMedLink'>";
                    echo "<td><a href='restaurantVisning.php?res=$id'>$rNavn</td>";
                    echo "<td><a href='restaurantVisning.php?res=$id'>$rAdresse</td>";
                    echo "<td><a href='restaurantVisning.php?res=$id'>$rPostnr</td>";
                    echo "<td><a href='restaurantVisning.php?res=$id'>$rPoststed</td>";
                    echo "<td><a href='restaurantVisning.php?res=$id'><img id ='karakterSmil' src='$bilde' title='smilefjes' width= '30px' height='30px'</td>";
                    echo "<td>$karakterSisteTilsynSnitt</td>";
                    echo "</tr>";
                }
            } else {
                echo"<p>Ingen resultat matcher ditt søk</p>";
            }
            echo "</table>";
            mysqli_close($db);
        }
    }
    ?>
    <h1>Søk på nytt?</h1>
    <?php sok(); ?>

    <script src="sok/sok.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>