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
<html lang="no">
<head>
	<title>Yoghurt</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
    	#nyBrukerError{
    		text-align: center;
    	}
    	#tabellError{
    		margin: auto;
    	}
    </style>
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
				$sql=("INSERT INTO Brukere(brukernavn , Passord, telefonnummer, adminrettighet) VALUES (?,?,?,'$admrett');");
				$stmt = mysqli_prepare($db, $sql);
				$resultat = mysqli_query($db,$sql);
				mysqli_stmt_bind_param($stmt, 'sss' , $brukerNavn, $passord, $tlf);
				mysqli_stmt_execute($stmt);
				$error = mysqli_stmt_error($stmt);
				if (mysqli_errno($db)<> 0) {
					$errno = mysqli_errno($db);
					$sqlstate = mysqli_sqlstate($db);
					$sqlerror = mysqli_error($db);
					echo <<<EOT
					<div class='jumbotron'>
					<h1 class='text-center'>Feil ved brukernavn</h1>	
					</div>
					<div id='nyBrukerError'><table id='tabellError' class='table-striped'><tr><th>Feil oppstått</th><th>Feilkoden</th></tr>
					<tr><td>$sqlerror</td><td>$sqlstate</td></tr>
					<tr><td colspan='2'><button type='button' onclick="window.location.href='/admin/ny-bruker.php'">Prøv på nytt</td></tr></table></div>"
EOT;

				}



				else if(!$error){
				echo <<<EOT
				<div class="jumbotron">
			<h1 class="text-center">Suksess!</h1>	
			</div>
				<div class="container text-center">
					<h1>Suksess</h1>
					<h2>Du har registrert følgende bruker: </h2>
					<table class='table table-hover'>

						
					
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
else if($error){
	echo <<<EOT
	<div class="jumbotron">
			<h1 class="text-center">Noe gikk galt</h1>	
		</div>
	<p>Ooops, her skjedde det noe feil og bruker er ikke registrert</p>
	
EOT;
}
}
else {
	echo "<h3>En bruker med samme brukernavn eksisterer <a href='ny-bruker.php'>Registrer</a> med ett annet Brukernavn</h3>";
	}



		
	include_once '../div/footer.php';	 ?>

    <script src="/bibloteker/jquery/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
<?php
function sjekkBrukerNavn($brukernavn, $db){
	$sqlSjekkBruker = "SELECT brukernavn FROM Brukere WHERE brukernavn = ?";
	$stmt = mysqli_prepare($db,$sqlSjekkBruker);
	mysqli_stmt_bind_param($stmt, 's' , $brukernavn);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	return !(mysqli_fetch_assoc($result));
}
lukk($db);
?>