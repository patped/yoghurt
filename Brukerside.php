<?php
	include_once 'database.php';
	include_once 'hjelpefunksj.php';
	$db = kobleOpp();
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Forside youghurt</title>
	<link rel="stylesheet" href="stilark.css" type="text/css">
</head>
<body>
	<?php
	//denne løsninga her kan kanskje omgjøres?
	if(isset($_POST['innlogg'])){
		$_SESSION['loggetInn'] = loggInn($db, $_POST['bruker'] , $_POST['passord']);
	}
	
	if($_SESSION['loggetInn'] == true){
	$navn = $_SESSION['fornavn'] . ' ' . $_SESSION['etternavn'];
	sjekkInnlogg();
	echo <<<EOT

	<h1>Hvilken smiley har bedriften fått</h1>

	<h2>Velkommen $navn</h2> 
	<a href="leggTilBedrift.php">Legg til ny Bedrift</a>
	<br>
	<a href="leggTilNyTilsynsrapport.php">Legg til ny tilsynsrapport</a>
	<br>
	<a href="oppdaterTilsynsrapport.php">Oppdater tilsynsrapport</a>
	<br>

	<a href="nyBruker.php">Legg til ny bruker(krever adminrettigheter)</a>
	<h1>Søk opp eksisterende rapport</h1>
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
EOT;
	}
	else
		echo " Ikke logget inn";

	?>	


</body>
</html>
<?php
	lukk($db)
?>