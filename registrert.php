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
	$brukerID = $_POST['brukerID'];
	$fornavn = $_POST['fornavn'];
	$etternavn = $_POST['etternavn'];
	$passord = $_POST['passord'];
	$tlf = $_POST['tlf'];
	if(isset($_REQUEST['admi']))
		$admrett = 1;
	else
		$admrett = 0;


	sjekkInnlogg();
	if($_SESSION['adm']){
		$sql=("INSERT INTO BrukerDatabase(BrukerID, fornavn, etternavn, Passord, telefonnummer, adminrettighet) VALUES ($brukerID,
			'$fornavn','$etternavn','$passord',$tlf,$admrett);");

		$resultat = mysqli_query($db,$sql);
		if($resultat == 1){
		echo <<<EOT
			<h1>Suksess</h1>
			<p>Du har registrert følgende bruker: </p>

				<table>
			
	  			<tr>
	    			<td>BrukerID:</td>
	    			<td>$brukerID</td>
	  			</tr>

	  			<tr>
	    			<td>Fornavn</td>
	   				<td>$fornavn</td>
	  			</tr>



	  			<tr>
	   				 <td>etternavn</td>
	   				 <td>$etternavn</td>
	 			</tr>

	 			<tr>
	    			<td>Telefonnummer:</td>
	   				<td>$tlf</td>
	  			</tr>
	 			
	 			 <tr>
	    			<td>passord</td>
	    			<td>$passord</td>
	  			</tr> 

			 
			</table>
			<a href="nyBruker.php">Registrer en ny</a>
			<br>
			<a href="Brukerside.php">Hjem</a>
 
	
EOT;
}
else if($resultat==0){
	echo <<<EOT
	<p>Ikke registrert</p>
	<a href="nyBruker.php">Prøv på nytt</a>
	<br>
	<a href="Brukerside.php">Hjem</a>
EOT;
}
}
else{
	echo <<<EOT
	<p>Dette krever admintilgang</p>
	<a href="Brukerside.php">Hjem</a>
EOT;
}

	?>	


</body>
</html>
<?php
	lukk($db)
	?>