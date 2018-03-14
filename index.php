<?php
	session_start();
    require_once 'database.php';
    require_once 'hjelpefunksj.php';
    $db = kobleOpp($tilsynrapportConfig);
?>

<!doctype html>
<html lang="no">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bibloteker/bootstrap-4.0.0-dist/css/bootstrap.css">
        <link rel="stylesheet" href="stilark.css" type="text/css">
    </head>
    <body>


	     <?php 
	     $loginnBoolean = false;
	     logginn($loginnBoolean);
	     ?>
        
        <h1>Hvilken smiley har bedriften fått?</h1>
        
        <h2>Velg hva du vil søke på</h2>

        <form action="sokeresultat.php" method="POST" onsubmit="return sjekkForm()">
            <label><input type="checkbox" onclick="orgKlikk()" name="orgnr" id="orgnr" value="">Søk på organisasjonsnummer</label>
            <label><input type="checkbox" onclick="adresseKlikk()" name="adresse" id="adresse" value="">Søk på adresse</label>
            <label><input type="checkbox" onclick="restaurantKlikk()" name="restaurant" id="restaurant" value="">Søk på spisested</label>
			<label><input type="checkbox" onclick="geoKlikk()" name="geolokasjon" id="geolokasjon" value="">Søk på spisested i nærheten</label>
			<input type="hidden" name="latitude" id="latitude" value="">
			<input type="hidden" name="longitude" id="longitude" value="">
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
        function sjekkInnhold(){
        if (document.getElementById("pass").value.length > 0 && document.getElementById("brukernavn").value.length > 0) {
            return true;
        }else{
            alert("Du har glemt å fylle ut passord eller brukernavn!")
            return false;
            }
    	}	
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
					document.getElementById("geolokasjon").checked = false;
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
					document.getElementById("geolokasjon").checked = false;
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
					document.getElementById("geolokasjon").checked = false;
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

			function geoKlikk() {
				if(document.getElementById("geolokasjon").checked) {
					document.getElementById("orgnr").checked = false;
					document.getElementById("orgnr").disabled = false;
					document.getElementById("adresse").checked = false;
					document.getElementById("adresse").disable = false;
					document.getElementById("restaurant").checked = false;
					document.getElementById("restaurant").disable = false;
					document.getElementById("utforSok").disabled = false;
					document.getElementById("spisestedSokefelt").value = "";
					document.getElementById("spisestedLabel").hidden = true;
					document.getElementById("spisestedSokefelt").hidden = true;
					document.getElementById("poststedLabel").hidden = true;
					document.getElementById("poststedInput").hidden = true;
					document.getElementById("sokeFelt").hidden = true;
					document.getElementById("sokeFelt").value = "";
					document.getElementById("poststedInput").value = "";
					document.getElementById("adresseLabel").hidden = true;
					getLocation();
				} else {
					document.getElementById("utforSok").disabled = true;
				}
				
			}
			
			function getLocation() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				} else { 
					lokasjon = "Geolocation is not supported by this browser.";
				}
			}
				
			function showPosition(position) {
				latitude.value = position.coords.latitude; 
				longitude.value = position.coords.longitude;
			}

        </script>
        <script src="bibloteker/jquery/jquery-3.3.1.js"></script>
        <script src="bibloteker/bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>

<?php
    lukk($db);
?>