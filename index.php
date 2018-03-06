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
            <label><input type="checkbox" onclick="orgKlikk()" name="orgnr" id="orgnr" value="">Søk på organisasjonsnummer</label>
            <label><input type="checkbox" onclick="adresseKlikk()" name="adresse" id="adresse" value="">Søk på adresse</label>
            <label><input type="checkbox" onclick="restaurantKlikk()" name="restaurant" id="restaurant" value="">Søk på spisested</label>

            <br><br>
            <input type="text" id="sokeFelt" name="Søkefelt" value="" placeholder="Søk på navnet til spisested">	
            <br>
            <label hidden="true" id="poststedLabel">Poststed: <input type="text" id="poststedInput" name="poststedInput" value="" placeholder="Poststed" hidden="true"></label>
            <br>
            <input type="submit" id="utforSok" name="søkeKnapp" value="Utfør søk">
        </form>

        <br>

        <script type="text/javascript">
			function orgKlikk(){
				if(document.getElementById("orgnr").checked) {
					document.getElementById("adresse").checked = false;
					document.getElementById("restaurant").checked = false;
					document.getElementById("sokeFelt").placeholder="Søk på orgnummer";
					document.getElementById("poststedLabel").hidden = true;
					document.getElementById("poststedInput").hidden = true;
				}
				else{
					document.getElementById("sokeFelt").placeholder="Søk på navnet til spisested";

				}
			}
			function adresseKlikk(){
				if(document.getElementById("adresse").checked) {
					document.getElementById("orgnr").checked = false;
					document.getElementById("restaurant").checked = false;
					document.getElementById("sokeFelt").placeholder="Søk på adresse";
					document.getElementById("poststedLabel").hidden = false;
					document.getElementById("poststedInput").hidden = false;
				}else{
					document.getElementById("sokeFelt").placeholder="Søk på navnet til spisested";
					document.getElementById("poststedLabel").hidden = false;
					document.getElementById("poststedInput").hidden = false;
				}
			}
			function restaurantKlikk(){
				if(document.getElementById("restaurant").checked) {
					document.getElementById("orgnr").checked = false;
					document.getElementById("adresse").checked = false;
					document.getElementById("sokeFelt").placeholder="Søk på navnet til spisested";
					document.getElementById("poststedLabel").hidden = true;
					document.getElementById("poststedInput").hidden = true;
				}
			}
        </script>
    </body>
</html>

<?php
    lukk($db);
?>