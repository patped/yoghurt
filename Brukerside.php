<?php
	include_once 'database.php';
	$db = kobleOpp($tilsynrapportConfig);
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
	sjekkInnlogging();
	$NR = $_REQUEST['bruker'];
	$PASS = $_REQUEST['passord'];
	kobleOpp($brukerConfig);

	$fraDB = logginn($db,$NR,$PASS);
	$navn = $_SESSION['fornavn'] . ' ' . $_SESSION['etternavn'];
	//$adm = $fraDB['adminrettighet'];
	//$etternavn = $fraDB['etternavn'];
	//setcookie("fornavn",$fornavn);
	//setcookie("adm",$adm);
	//setcookie("etternavn",$etternavn);

	//$brukerNavn = mysqli_query($dblink, $sql);
	if($fraDB == false)
		echo"<h1>FEIL brukernavn eller passord</h1>";
	else if(isset($navn)){
	echo <<<EOT
	<div class="loginn">
		<form method="POST" action="index.php">
			<input type="submit" name="Logg Ut" value="Logg ut"></div>

	<h1>Hvilken smiley har bedriften fått</h1>

	<h2>Velkommen $navn</h2> 
	<a href="leggTilBedrift.php">Legg til ny rapport</a>
	<br>
	<a href="nyBruker.php">Legg til ny bruker(krever adminrettigheter)</a>
	<h1>Søk opp eksisterende rapport</h1>
	<form method="POST" action="Søke.php">
		<input type="text" name="Varenummer">
		<br>
		<input type="submit" name="Søk">

	</form>
EOT;
	}?>	


</body>
</html>
<?php
	lukk($db)
	?>