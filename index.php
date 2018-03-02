<?php
	include_once 'database.php';
	$db = kobleOpp($tilsynrapportConfig);
?>

<!doctype html>
<html lang="no">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bibloteker/bootstrap-4.0.0-dist/css/bootstrap.css">
        <link rel="stylesheet" href="stilark.css" type="text/css">

        <title>Forside youghurt</title>

    </head>
    <body>
        <?php
        if (isset($_POST['Søk'])) {
            $søkeord = $_POST['textbox'];

        } else {
            $søkeord = ":)";
        }
        ?>
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

        <br>

        <div class="container-fluid">
            <a data-role="button" name="navn" id="navn">Navn</a>
            <a data-role="button" name="orgnummer" id="orgnummer">Org.nummer</a>
            <a data-role="button" name="adrlinje" id="adrlinje">Adresse</a>
            <a data-role="button" name="postnr" id="postnr">Post.nr</a>
        </div>

        <br>
        <br>

        <div class="container-floid">
            <input type="text" name="Søkefelt" value="Søkefelt">
        </div>


        <script src="bibloteker/jquery/jquery-3.3.1.js"></script>
        <script src="bibloteker/bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>

<?php
    lukk($db);
?>