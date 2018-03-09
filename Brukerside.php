<?php
	include_once 'database.php';
	include_once 'hjelpefunksj.php';
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
	<?php include_once 'header.php'; ?>
	<?php
	if(isset($_POST['bruker'])){
		$_SESSION['loggetInn'] = loggInn($db, $_POST['bruker'] , $_POST['passord']);
	}
	
	if($_SESSION['loggetInn'] == true){
	$navn = $_SESSION['fornavn'] . ' ' . $_SESSION['etternavn'];
	sjekkInnlogg();
	echo <<<EOT

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
	}
	else
		echo " Ikke logget inn";

	?>	


</body>
</html>
<?php
	lukk($db)
?>