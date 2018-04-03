<?php
session_start();
require_once '../div/session-kapring.php';
include_once '../div/database.php';
include_once '../logginn/logginn.php';
$db = kobleOpp();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<?php
	$BrukerNavn = htmlentities($_POST['Brukernavn']);
	$pass = htmlentities($_POST['passord']);
	$passord = password_hash($pass, PASSWORD_DEFAULT);
	$tlf = htmlentities($_POST['tlf']);
	if(isset($_REQUEST['admi']))
		$admrett = 1;
	else
		$admrett = 0;

		include_once '../div/header.php';
		
		starAlertInnlogg();
		$side = 'Location: /admin/ny-bruker¨-landingside.php';
		logginn($side);
		
		$sql=("INSERT INTO Brukere(brukernavn , Passord, telefonnummer, adminrettighet) VALUES ('$BrukerNavn','$passord','$tlf','$admrett');");

		$resultat = mysqli_query($db,$sql);
		if($resultat == 1){
		echo <<<EOT
		<main>
			<h1>Suksess</h1>
			<p>Du har registrert følgende bruker: </p>

				<table>
			
	  			<tr>
	    			<td>BrukerNavn:</td>
	    			<td>$BrukerNavn</td>
	  			</tr>

	  			<tr>
	    			<td>Telefon</td>
	   				<td>$tlf</td>
	  			</tr>
	 			
	 			 <tr>
	    			<td>passord</td>
	    			<td>$passord</td>
	  			</tr> 

			 
			</table>
			<a href="ny-bruker.php">Registrer en ny</a>	
			</main>
EOT;
}
else if($resultat==0){
	echo <<<EOT
	<p>Ikke registrert</p>
	<a href="ny-bruker.php">Prøv på nytt</a>
EOT;
}


		
	include_once '../div/footer.php';	 ?>

    <script src="/bibloteker/jquery/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
<?php
	lukk($db)
?>