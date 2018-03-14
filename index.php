<?php
    require_once 'database.php';
    $db = kobleOpp($tilsynrapportConfig);
    $_SESSION["loggetInn"]=false;
?>

<!doctype html>
<html lang="no">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="stilark.css" type="text/css">
    </head>
    <body>
	      <div class="loginn">
		        <form method="POST" action="Brukerside.php">
		            <input type="text" name="bruker" id="Brukernavn" placeholder="BrukerID" style="width: 75px; height: 15px">
		            <br>
		            <input type="password" name="passord" id="pass" placeholder="Passord" style="width: 75px; height: 15px">
		            <br>
		            <input type="submit" name="" value="Logg inn" style=" width: 65px; height: 20px">
		        </form>
        </div>
        
        <h1>Hvilken smiley har bedriften fått?</h1>
        
        <h2>Velg hva du vil søke på</h2>

        <form action="sokeresultat.php" method="POST" onsubmit="return sjekkForm()">
            <label><input type="checkbox" onclick="orgKlikk()" name="orgnr" id="orgnr" value=""> Søk på organisasjonsnummer</label>
            <label><input type="checkbox" onclick="adresseKlikk()" name="adresse" id="adresse" value="">Søk på adresse</label>
            <label><input type="checkbox" onclick="restaurantKlikk()" name="restaurant" id="restaurant" value=""> Søk på spisested</label>

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

        <script src="js/index.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </body>
</html>

<?php
    lukk($db);
?>