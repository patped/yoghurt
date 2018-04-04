<?php
session_start();
require_once '../div/session-kapring.php';
include_once '../div/database.php';
include_once '../logginn/logginn.php';
if(!$_SESSION['adminrett']) {
	header("Location: /div/401.php");
	}
$db = kobleOpp();
?>

<!doctype html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<?php

	include_once '../div/header.php';
		
	starAlertInnlogg();
	$side = 'Location: /admin/ny-bruker-landingside.php';
	logginn($side);


	$brukerNavn = htmlentities($_POST['brukernavn']);
	$pass = htmlentities($_POST['passord']);
	$passord = password_hash($pass, PASSWORD_DEFAULT);
	$tlf = htmlentities($_POST['tlf']);
	if(isset($_REQUEST['admi']))
		$admrett = 1;
	else
		$admrett = 0;

			if (sjekkBrukerNavn($brukerNavn, $db)){
				$sql=("INSERT INTO Brukere(brukernavn , Passord, telefonnummer, adminrettighet) VALUES ('$brukerNavn','$passord','$tlf','$admrett');");

				$resultat = mysqli_query($db,$sql);
				if($resultat == 1){
				echo <<<EOT
				<div class="container text-center">
					<h1>Suksess</h1>
					<table class='table table-hover'>
					<h2>Du har registrert følgende bruker: </h2>

						
					
			  			<tr>
			    			<td>BrukerNavn:</td>
			    			<td>$brukerNavn</td>
			  			</tr>

			  			<tr>
			    			<td>Telefon</td>
			   				<td>$tlf</td>
			  			</tr>
			 			

					 
					</table>
					<a href="ny-bruker.php">Registrer en ny</a>	
					</div>
EOT;
}
else if($resultat==0){
	echo <<<EOT
	<p>Ikke registrert</p>
	<a href="ny-bruker.php">Prøv på nytt</a>
EOT;
}
}
else {
	echo "samme brukernavn";
	}



		
	include_once '../div/footer.php';	 ?>

    <script src="/bibloteker/jquery/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
<?php
function sjekkBrukerNavn($brukernavn, $db){
	$sqlSjekkBruker = "SELECT brukernavn FROM Brukere where brukernavn = '$brukernavn'";
	$result = mysqli_query($db,$sqlSjekkBruker);
	$finnes = mysqli_fetch_assoc($result);
	if($finnes == 0)
		return true;
	else if ($finnes>0)
		return false;


	
}
lukk($db);
?>