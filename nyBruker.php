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
    starAlertInnlogg();
    $side = 'Location: index.php';
    logginn($side);
	echo <<<EOT
	

	<p> legg til en ny bruker</p>
	<form method="POST" action="registrert.php">
		<p>brukerId</p>
		<input type="bruker" name="brukerID" value="brukerID">
		<br><p>fornavn</p><br>
		<input type="text" name="fornavn" value="Fornavn">
		<br><p>etternavn</p><br>
		<input type="text" name="etternavn" value="Etternavn">
		<br><p>Passord</p><br>
		<input type="password" name="passord" value="passord">
		<br><p>telefonnummer</p><br>
		<input type="text" name="tlf" value="tlf">
		<br><p>adminrettighet?</p><br>
		<input type="checkbox" name="admi" value="admRett">
		<br>
		<input type="submit" name="registrer" value="registrer"></p>

	</form> 
 
	
EOT;


	?>	


</body>
</html>
<?php
	lukk($db)
	?>