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

        <h1>Hvilken smiley har bedriften fått?</h1>

        <h2>Sjekk det her</h2>

        <form action="sokeresultat.php" method="POST">
            <label><input type="checkbox" alt="Skriv inn bedrift" name="text" id="søke" value="knapp">knapp</label>
            <label><input type="checkbox" name="knapp" id="Søk" value="Knappeti">Knappeti</label>
            <label><input type="checkbox" name="" value="knapp">knapp</label>

            <br><br>

            <input type="text" name="Søkefelt" value="" placeholder="Søk på spisested">
            <input type="submit" name="søkeKnapp" value="Utfør søk">
        </form>

        <br>

    </body>
</html>

<?php
    lukk($db);
?>