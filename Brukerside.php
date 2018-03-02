<?php
	include_once 'database.php';
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
	<?php

	$NR = $_REQUEST['bruker'];
	$PASS = $_POST['passord'];
	kobleOpp($brukerConfig);
	$NAVN = logginn($db,$NR,$PASS);
	//$brukerNavn = mysqli_query($dblink, $sql);
	if(is_null($NAVN))
		echo"FEIL brukernavn eller passord";
	else {
	echo <<<EOT
	<div class="loginn">
		<form method="POST" action="index.php">
			<input type="submit" name="Logg Ut" value="Logg ut">
		</form></div>

	<h1>Hvilken smiley har bedriften fått</h1>

	<h2>Velkommen $NAVN </h2> 
	<a href="leggInn.php">Legg til ny rapport</a>
	<br>
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