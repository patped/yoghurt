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
        $header = "Hvilken smiley har bedriften fått?";
        if (isset($_POST["søkeKnapp"])) {
            $header = "Gjør et nytt søk?";
            $db = kobleOpp($tilsynrapportConfig);
            $status = mysqli_set_charset($db, "utf8");
            $søkeverdi = $_POST["Søkefelt"];
            if (!$status) {
                echo "Feil i pålogging";
                exit;
            } else {
                $sqlSpørring
                    = ("
                    SELECT
                        r.tilsynsobjektid,
                        r.navn,
                        r.postnr,
                        p.poststed,
                        r.orgnummer
                    FROM
                        Restauranter AS r,
                        Poststed AS p
                    WHERE p.postnr = r.postnr
                    AND r.navn
                    LIKE '%$søkeverdi%'
                    ORDER BY r.navn"
                );
                $svar = mysqli_query($db, $sqlSpørring);
                $rad = mysqli_fetch_assoc($svar);
                if ($rad) {
                    echo '<h1>Søkeresultat</h1>';
                    echo "<table name='resultatTabell'><th>Navn</th><th>Postnummer</th><th>Poststed</th>";
                    while ($rad) {
                        $id = $rad['tilsynsobjektid'];
                        $rNavn = $rad['navn'];
                        $rPostnr = $rad['postnr'];
                        $rPoststed = $rad['poststed'];
                        $orgnummer = $rad['orgnummer'];
                        $rad= mysqli_fetch_assoc($svar);
                        echo "<tr class='radMedLink'>";
                        echo "<td><a href='restaurantVisning.php?res=$id'>$rNavn</td>";
                        echo "<td><a href='restaurantVisning.php?res=$id'>$rPostnr</td>";
                        echo "<td><a href='restaurantVisning.php?res=$id'>$rPoststed</td>";
                        echo "</tr>";
                    }
                } else {
                    echo"<p>Ingen varer matcher $søkeverdi </p>";
                }
                echo "</table>";
                mysqli_close($db);
            }
        }

        echo "<h1>$header</h1>";
        if (!isset($_POST["søkeKnapp"])) {
            echo "<h2>Sjekk det her</h2>";
        }
        ?>

        <form action="sokeresultat.php" method="POST">
            <label>
                <input
                    type="checkbox"
                    alt="Skriv inn bedrift"
                    name="text"
                    id="søke"
                    value="knapp"
                >
                knapp
            </label>

            <label>
                <input
                    type="checkbox"
                    name="knapp"
                    id="Søk"
                    value="Knappeti"
                >
                Knappeti
            </label>

            <label>
                <input
                    type="checkbox"
                    name=""
                    value="knapp"
                >
                knapp
            </label>

            <br><br>

            <input
                type="text"
                name="Søkefelt"
                value=""
                placeholder="Søk på spisested"
            >
            <input
                type="submit"
                name="søkeKnapp"
                value="Utfør søk"
            >

        </form>
    </body>
</html>