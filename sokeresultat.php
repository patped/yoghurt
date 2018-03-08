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
        $header = "Resultat";
            $db = kobleOpp($tilsynrapportConfig);
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
                echo "<h1>$header</h1>";
                $svar = mysqli_query($db, $sqlSpørring);
                $rad = mysqli_fetch_assoc($svar);
                if ($rad) {                    
                    echo "<table name='resultatTabell'><th>Navn</th><th>Adresse</th><th>Postnummer</th><th>Poststed</th><th>Smilefjes</th>";
                    while ($rad) {
                        $id = $rad['tilsynsobjektid'];
                        $rNavn = $rad['navn'];
                        $rPostnr = $rad['postnr'];
                        $rAdresse = $rad['adrlinje1'];
                        $rPoststed = $rad['poststed'];
                        $orgnummer = $rad['orgnummer'];
                        $rad= mysqli_fetch_assoc($svar);

                        $sqlSpørringHenteKarakter = (
		                "SELECT t.total_karakter FROM
		                    Restauranter AS r,
		                    Poststed AS p,
		                    Tilsynsrapporter AS t
		                WHERE p.postnr = r.postnr
		                AND t.tilsynsobjektid = r.tilsynsobjektid
		                AND r.tilsynsobjektid
		                LIKE '$id'
		                ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC" 
		            	);
		            	$utførSpørringMedKarakter = mysqli_query($db, $sqlSpørringHenteKarakter);
		            	$svarKarakter = mysqli_fetch_assoc($utførSpørringMedKarakter);
		            	$karakterSisteTilsyn = 0;
		            	$teller = 0;
		            	while ($svarKarakter) {
		            	$karakterSisteTilsyn = $karakterSisteTilsyn + $svarKarakter['total_karakter'];
		            	$teller = $teller + 1;
		            	$svarKarakter = mysqli_fetch_assoc($utførSpørringMedKarakter);
		            	}
		            	$karakterSisteTilsynSnitt = $karakterSisteTilsyn/$teller;
		            	switch ($karakterSisteTilsynSnitt) {
                    	case 0:
                       	$bilde = './bilder/smileys/storSmil.png';
                        break;
                    	case 1:
                        $bilde = './bilder/smileys/liteSmil.png';
                        break;
                        case 2:
                        $bilde = './bilder/smileys/ingenSmil.png';
                        break;
                    	default:
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
        $header = "Gjør et nytt søk?";
        echo "<h1>$header</h1>";
        if (!isset($_POST["søkeKnapp"])) {
            echo "<h2>Sjekk det her</h2>";
        }
        ?>

        <form action="sokeresultat.php" method="POST" onsubmit="return sjekkForm()">
            <label><input type="checkbox" onclick="orgKlikk()" name="orgnr" id="orgnr" value="">Søk på organisasjonsnummer</label>
            <label><input type="checkbox" onclick="adresseKlikk()" name="adresse" id="adresse" value="">Søk på adresse</label>
            <label><input type="checkbox" onclick="restaurantKlikk()" name="restaurant" id="restaurant" value="">Søk på spisested</label>

            <br><br>
            <label hidden="true" id="spisestedLabel">Navn på spisested: </label><input type="text" id="spisestedSokefelt" name="spisestedSokefelt" value="" placeholder="Søk på navnet til spisested" hidden="true">
            <br>
            <label hidden="true" id="adresseLabel">Adresse: </label><input type="text" id="sokeFelt" name="Søkefelt" value="" placeholder="Søk på navnet til spisested" hidden="true">
            <br>
            <label hidden="true" id="poststedLabel">Poststed: <input type="text" id="poststedInput" name="poststedInput" value="" placeholder="Poststed" hidden="true"></label>
            <br>
            <input type="submit" id="utforSok" name="søkeKnapp" value="Utfør søk" disabled="true">
        </form>

        <br>

        <script type="text/javascript">
            function sjekkForm(){
                var orgInnhold = document.getElementById("sokeFelt").value;
                if (document.getElementById("orgnr").checked && orgInnhold =="") {
                    alert("Du må fylle inn organisasjonsnummer");
                    return false;
                }
            }
            function orgKlikk(){
                if(document.getElementById("orgnr").checked) {
                    document.getElementById("sokeFelt").pattern = "[0-9]{9}";
                    document.getElementById("sokeFelt").title = "Et organisasjonsnummer består av 9 siffer"
                    document.getElementById("adresse").checked = false;
                    document.getElementById("restaurant").checked = false;
                    document.getElementById("sokeFelt").placeholder="Søk på orgnummer";
                    document.getElementById("sokeFelt").hidden = false;
                    document.getElementById("poststedLabel").hidden = true;
                    document.getElementById("poststedInput").hidden = true;
                    document.getElementById("adresse").disabled = true;
                    document.getElementById("restaurant").disabled = true;
                    document.getElementById("utforSok").disabled = false;
                }
                else{
                    document.getElementById("sokeFelt").placeholder="Søk på navnet til spisested";
                    document.getElementById("sokeFelt").value = "";
                    document.getElementById("restaurant").disabled = false;
                    document.getElementById("adresse").disabled = false;
                    document.getElementById("sokeFelt").hidden = true;
                    document.getElementById("utforSok").disabled = true;
                    document.getElementById("sokeFelt").removeAttribute("pattern");
                    document.getElementById("sokeFelt").removeAttribute("title");
                }
            }
            function adresseKlikk(){
                if(document.getElementById("adresse").checked) {
                    document.getElementById("orgnr").checked = false;
                    document.getElementById("sokeFelt").placeholder="Søk på adresse";
                    document.getElementById("sokeFelt").hidden = false;
                    document.getElementById("poststedLabel").hidden = false;
                    document.getElementById("adresseLabel").hidden = false;
                    document.getElementById("poststedInput").hidden = false;
                    document.getElementById("orgnr").disabled = true;
                    document.getElementById("utforSok").disabled = false;
                }else{
                    if (!document.getElementById("restaurant").checked) {
                        document.getElementById("orgnr").disabled = false;
                    }
                    document.getElementById("sokeFelt").placeholder="Søk på navnet til spisested";
                    document.getElementById("poststedLabel").hidden = true;
                    document.getElementById("poststedInput").hidden = true;
                    document.getElementById("sokeFelt").hidden = true;
                    document.getElementById("sokeFelt").value = "";
                    document.getElementById("poststedInput").value = "";
                    document.getElementById("adresseLabel").hidden = true;
                    if (!document.getElementById("restaurant").checked && !document.getElementById("orgnr").checked) {
                        document.getElementById("utforSok").disabled = true;
                    }
                }
            }
            function restaurantKlikk(){
                if(document.getElementById("restaurant").checked) {
                    document.getElementById("orgnr").checked = false;
                    document.getElementById("spisestedLabel").hidden = false;
                    document.getElementById("spisestedSokefelt").hidden = false;
                    document.getElementById("spisestedSokefelt").placeholder="Søk på navnet til spisested";
                    document.getElementById("orgnr").disabled = true;
                    document.getElementById("utforSok").disabled = false;
                }
                else{
                    if (!document.getElementById("adresse").checked) {
                        document.getElementById("orgnr").disabled = false;
                    }
                    document.getElementById("spisestedSokefelt").value = "";
                    document.getElementById("spisestedLabel").hidden = true;
                    document.getElementById("spisestedSokefelt").hidden = true;
                    if (!document.getElementById("adresse").checked && !document.getElementById("orgnr").checked) {
                        document.getElementById("utforSok").disabled = true;
                    }
                    
                }
            }
        </script>
        </form>

    </body>
</html>