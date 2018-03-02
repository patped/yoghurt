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

	$BRUKER = $_REQUEST['bruker'];
	$PASS = $_POST['passord'];


	echo <<<EOT
	<div class="loginn">
		<form method="POST" action="index.php">
			<input type="submit" name="Logg Ut" value="Logg ut">
		</form></div>

	<h1>Hvilken smiley har bedriften fått</h1>

	<h2>Velkommen $BRUKER </h2> 
	<h1>$PASS </h1>
	<a href="leggInn.php">Legg til ny rapport</a>
	<br>
	<h1>Søk opp eksisterende rapport</h1>
	<form method="POST" action="Søke.php">
		<input type="text" name="Varenummer">
		<br>
		<input type="submit" name="Søk">
	</form>
EOT;
	?>	


</body>
</html>
<?php
	lukk($db)
	?>