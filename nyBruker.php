<?php
	include_once 'database.php';
	$db = kobleOpp($tilsynrapportConfig);
	session_start();
	sjekkInnlogging();
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
		<form method="POST" action="index.php">
			<input type="submit" name="Logg Ut" value="Logg ut"></div>
	<?php
	$adm = $_SESSION['adm'];
	$fornavn = $_SESSION['fornavn'];
	if($_SESSION["loggetInn"]==true){
	if($adm==false)
		echo "Du har ikke tilgang";
	else{
	//$brukerNavn = mysqli_query($dblink, $sql);
	echo <<<EOT

	

	<h2>Velkommen $fornavn </h2>
	<p> legg til en ny bruker</p>
	<form method="POST" action="leggtilNy()">
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
		<input type="checkbox" name="admi" value="adm rett">
		<br>
		<input type="submit" name="registrer" value="registrer"></p>

	</form> 
 
	
EOT;
}
}
	?>	


</body>
</html>
<?php
	lukk($db)
	?>