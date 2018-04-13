<?php
session_start();
require_once '../div/session-kapring.php';
require_once '../div/database.php';
require_once 'sok.php';
require_once '../logginn/logginn.php';
if (!isset($_GET['start']) || (!isset($_POST["søkeKnapp"]) && !isset($_SESSION['tidligereSøk']))) {
    header("Location: /index.php");
}
function finnKategori(){
	if (isset($_POST["kategori"])) {
		return $_POST["kategori"];
	}
	return;
}
function finnTabellEllerView($kat){
	switch ($kat) {
		case 'Italiensk':
			return 'katItalia';
			break;
		case 'Indisk':
			return 'katIndia';
			break;
		case 'Kinesisk':
			return 'katKina';
			break;
		case 'Annen Asiatisk':
			return 'katAsia';
			break;
		case 'Burger og Kebab':
			return 'katBurger';
			break;		
		default:
			return 'Restauranter';
			break;
	}
}
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
    include_once '../div/header.php';
    starAlertInnlogg();
    $side = 'Location: /sok/sokeresultat.php?start=0';
    logginn($side);
    $db = kobleOpp();
    $startSøk = $_GET['start'];
    $sluttSøk = $startSøk + 10;
    $søkTeller = 0;
    $status = mysqli_set_charset($db, "utf8");
    $stmt;
    $hvordanSøk;
    $nesteSøkTall = $startSøk + 10;
    $forrigeSøkTall = $startSøk-10;
    $nesteSide = '/sok/sokeresultat.php?start=' . $nesteSøkTall;
    $forrigeSide = '/sok/sokeresultat.php?start=' . $forrigeSøkTall;
    $kategori = finnKategori();
    $tabellEllerView = finnTabellEllerView($kategori);
    if (isset($_POST["søkeKnapp"])) {
        if (isset($_POST["orgnr"])) {
            $søkeverdi = $_POST["Søkefelt"];
            $_SESSION['søkeverdi'] = $søkeverdi;
            $sqlSpørring = 
            ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
                FROM $tabellEllerView AS r, Poststed AS p
                WHERE p.postnr = r.postnr
                AND r.orgnummer LIKE ?
                ORDER BY r.navn");
            $stmt = mysqli_prepare($db, $sqlSpørring);
            $stmt2 = mysqli_prepare($db, $sqlSpørring);
            mysqli_stmt_bind_param($stmt, 's' , $søkeverdi);
            mysqli_stmt_execute($stmt);
            $hvordanSøk = "org";
        }
        else if (isset($_POST["adresse"])) {
            if (isset($_POST["restaurant"])) {
                $adresseSøkekriterie = "%" . $_POST["Søkefelt"] . "%";
                $poststedSøkekriterie = "%" . $_POST["poststedInput"] . "%";
                $restaurantSøkekriterie = "%" . $_POST["spisestedSokefelt"] . "%";
                $_SESSION['adresseSøkekriterie'] = "%" . $_POST["Søkefelt"] . "%";
                $_SESSION['poststedSøkekriterie'] = "%" . $_POST["poststedInput"] . "%";
                $_SESSION['restaurantSøkekriterie'] = "%" . $_POST["spisestedSokefelt"] . "%";
                $sqlSpørring = 
                ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
                FROM $tabellEllerView AS r, Poststed AS p
                WHERE p.postnr = r.postnr
                AND p.poststed LIKE ?
                AND r.adrlinje1 LIKE ?
                AND r.navn LIKE ?
                ORDER BY r.navn");
                $stmt = mysqli_prepare($db, $sqlSpørring);
                $stmt2 = mysqli_prepare($db, $sqlSpørring);
                mysqli_stmt_bind_param($stmt, 'sss', $poststedSøkekriterie, $adresseSøkekriterie, $restaurantSøkekriterie);
                mysqli_stmt_execute($stmt);
                $hvordanSøk = "adr&rest";
            }
            else{
                $adresseSøkekriterie = "%" . $_POST["Søkefelt"] . "%";
                $poststedSøkekriterie = "%" . $_POST["poststedInput"] . "%";
                $_SESSION['adresseSøkekriterie'] = "%" . $_POST["Søkefelt"] . "%";
                $_SESSION['poststedSøkekriterie'] = "%" . $_POST["poststedInput"] . "%";
                $sqlSpørring = 
                ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
                FROM $tabellEllerView AS r, Poststed AS p
                WHERE p.postnr = r.postnr
                AND p.poststed LIKE ?
                AND r.adrlinje1 LIKE ?
                ORDER BY r.navn");
                $stmt = mysqli_prepare($db, $sqlSpørring);
                $stmt2 = mysqli_prepare($db, $sqlSpørring);
                mysqli_stmt_bind_param($stmt, 'ss' , $poststedSøkekriterie, $adresseSøkekriterie);
                mysqli_stmt_execute($stmt);
                $hvordanSøk = "adr";

            }
        }else if (isset($_POST["restaurant"])) {
            $restaurantSøkekriterie = "%" . $_POST["spisestedSokefelt"] . "%";
            $_SESSION['restaurantSøkekriterie'] = "%" . $_POST["spisestedSokefelt"] . "%";
            $sqlSpørring = 
            ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
            FROM $tabellEllerView AS r, Poststed AS p
            WHERE p.postnr = r.postnr
            AND r.navn LIKE ?
            ORDER BY r.navn");
            $stmt = mysqli_prepare($db, $sqlSpørring);
            $stmt2 = mysqli_prepare($db, $sqlSpørring);
            mysqli_stmt_bind_param($stmt, 's' , $restaurantSøkekriterie);
            mysqli_stmt_execute($stmt);
            $hvordanSøk = "rest";
        }

        echo "<div class='container text-center'>";
        echo "<h2>Søk på nytt?</h2>";
        sok();
        echo "</div>";

        if (!$status) {
            echo "Feil i pålogging";
            exit;
        } else {
            $svar;
            $resultat;
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
            echo "<div class='container'>";
            echo "<div class='page-header'> <h3>Resultat</h3> </div>";

            if (count($resultat) > 0) {                    
                echo (
                    "<table class='table table-hover'>
                        <thead>
                            <th>Navn</th>
                            <th>Adresse</th>
                            <th>Postnummer</th>
                            <th>Poststed</th>
                            <th>Smilefjes</th>
                        </thead>"
                );
                    
                    foreach ($resultat as $rad) {
                        
                        if ($søkTeller >= $sluttSøk) {
                            break;
                        }
                        if ($søkTeller< $startSøk) {
                        $søkTeller++;
                        }
                        else{
                        $søkTeller++;
                        $id = $rad['tilsynsobjektid'];
                        $rNavn = $rad['navn'];
                        $rPostnr = $rad['postnr'];
                        $rAdresse = $rad['adrlinje1'];
                        $rPoststed = $rad['poststed'];
                        $orgnummer = $rad['orgnummer'];

                        //Trenger ikke hindre SQL-injection her, ettersom det er hindret på laget over, der vi henter '$id' fra.
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
                                $bilde = '/bilder/smileys/storSmil.png';
                            }else if ($karakterSisteTilsynSnitt<=1) {
                                $bilde = '/bilder/smileys/liteSmil.png';
                            }else if ($karakterSisteTilsynSnitt<=1.5) {
                                $bilde = '/bilder/smileys/ingenSmil.png';
                            }else{
                                $bilde = '/bilder/smileys/spySmil.png';
                            }
                        /*Legger til alle resultater i en tabell*/
                        echo "<tbody>";
                        echo    "<tr class='clickable-link' data-href='/restaurant.php?res=$id' style='cursor:pointer'>";
                        echo        "<td>$rNavn</td>";
                        echo        "<td>$rAdresse</td>";
                        echo        "<td>$rPostnr</td>";
                        echo        "<td>$rPoststed</td>";
                        echo        "<td><img id ='karakterSmil' src='$bilde' title='smilefjes' width= '30px' height='30px'</td>";
                        echo        "<td>$karakterSisteTilsynSnitt</td>";
                        echo    "</tr>";
                        echo "</tbody>";
                        }
                    }
                    //Legger til neste, knapp og initierer at det er utført et søk før
                    $_SESSION['hvordanSøk'] = $hvordanSøk;
                    if (isset($sqlSpørring)) {
                    	$_SESSION['spørringen'] = $sqlSpørring;
                    }
                    $_SESSION['tidligereSøk'] = true;
                    if (count($resultat) > $sluttSøk){
                        echo "<tr><td><a href='$nesteSide'><button type='button'>10 neste resultater</button></a><td>";
                        if ($sluttSøk>10) {
                        	echo "<td><a href='$forrigeSide'><button type='button'>10 forrige resultater</button></a><td>";
                        }
                    }
                    echo "</tr>";
            } else {
                echo"<p>Ingen resultat matcher ditt søk</p>";
            }
            echo "</table>";
            echo "</div>";
            
        }
    }
if (!isset($_POST["søkeKnapp"])) {
    if (isset($_SESSION['tidligereSøk'])) {
    	echo "<div class='container text-center'>";
        echo "<h2>Søk på nytt?</h2>";
        sok();
        echo "</div>";
        $sqlSpørring = $_SESSION['spørringen'];
        $stmt = mysqli_prepare($db, $sqlSpørring);
        $hvordanSøk = $_SESSION['hvordanSøk'];
        switch ($hvordanSøk) {
            case 'org':
                $søkeverdi = $_SESSION['søkeverdi'];
                mysqli_stmt_bind_param($stmt, 's' , $søkeverdi);
                mysqli_stmt_execute($stmt);
                break;
            case 'adr&rest':
                $adresseSøkekriterie = $_SESSION['adresseSøkekriterie'];
                $poststedSøkekriterie = $_SESSION['poststedSøkekriterie'];
                $restaurantSøkekriterie = $_SESSION['restaurantSøkekriterie'];
                mysqli_stmt_bind_param($stmt, 'sss', $poststedSøkekriterie, $adresseSøkekriterie, $restaurantSøkekriterie);
                mysqli_stmt_execute($stmt);
                break;
            case 'adr':
                $adresseSøkekriterie = $_SESSION['adresseSøkekriterie'];
                $poststedSøkekriterie = $_SESSION['poststedSøkekriterie'];
                mysqli_stmt_bind_param($stmt, 'ss' , $poststedSøkekriterie, $adresseSøkekriterie);
                mysqli_stmt_execute($stmt);
                break;
            case 'rest':
             	$restaurantSøkekriterie = $_SESSION['restaurantSøkekriterie'];
                mysqli_stmt_bind_param($stmt, 's' , $restaurantSøkekriterie);
                mysqli_stmt_execute($stmt);
                break;
            default:
                # code...
                break;
        }
        $svar = mysqli_stmt_get_result($stmt);
        $resultat = $svar->fetch_all(MYSQLI_ASSOC);
            }
            echo "<div class='container'>";
            echo "<div class='page-header'> <h3>Resultat</h3> </div>";
            if (count($resultat) > 0) {                    
                echo (
                    "<table class='table table-hover'>
                        <thead>
                            <th>Navn</th>
                            <th>Adresse</th>
                            <th>Postnummer</th>
                            <th>Poststed</th>
                            <th>Smilefjes</th>
                        </thead>"
                );
                    
                    foreach ($resultat as $rad) {
                        if ($søkTeller >= $sluttSøk) {
                            break;
                        }
                        if ($søkTeller< $startSøk) {
                        $søkTeller++;
                        }
                        else{
                        $søkTeller++;
                        $id = $rad['tilsynsobjektid'];
                        $rNavn = $rad['navn'];
                        $rPostnr = $rad['postnr'];
                        $rAdresse = $rad['adrlinje1'];
                        $rPoststed = $rad['poststed'];
                        $orgnummer = $rad['orgnummer'];

                        //Trenger ikke hindre SQL-injection her, ettersom det er hindret på laget over, der vi henter '$id' fra.
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
                                $bilde = '/bilder/smileys/storSmil.png';
                            }else if ($karakterSisteTilsynSnitt<=1) {
                                $bilde = '/bilder/smileys/liteSmil.png';
                            }else if ($karakterSisteTilsynSnitt<=1.5) {
                                $bilde = '/bilder/smileys/ingenSmil.png';
                            }else{
                                $bilde = '/bilder/smileys/spySmil.png';
                            }
                        /*Legger til alle resultater i en tabell*/
                        echo "<tbody>";
                        echo    "<tr class='clickable-link' data-href='/restaurant.php?res=$id' style='cursor:pointer'>";
                        echo        "<td>$rNavn</td>";
                        echo        "<td>$rAdresse</td>";
                        echo        "<td>$rPostnr</td>";
                        echo        "<td>$rPoststed</td>";
                        echo        "<td><img id ='karakterSmil' src='$bilde' title='smilefjes' width= '30px' height='30px'</td>";
                        echo        "<td>$karakterSisteTilsynSnitt</td>";
                        echo    "</tr>";
                        echo "</tbody>";
                    }
                    }
                if (count($resultat) > $sluttSøk){
                        echo "<tr><td><a href='$nesteSide'><button type='button'>10 neste resultater</button></a><td>";
                        if ($sluttSøk>10) {
                        	echo "<td><a href='$forrigeSide'><button type='button'>10 forrige resultater</button></a><td>";
                        }
                        echo "</tr>";
                }
                else if ($sluttSøk>10) {
                        	echo "<tr><td><a href='$forrigeSide'><button type='button'>10 forrige resultater</button></a><td></tr>";
                        } 
    }
}
    ?>

    </main>
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