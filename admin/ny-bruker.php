<?php
session_start();
require_once '../div/session-kapring.php';
include_once '../div/database.php';
include_once '../logginn/logginn.php';
?>

<!doctype html>
<html lang="no">

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	
	<?php
	if($_SESSION['adminrett'])
	{ 
	include_once '../div/header.php'; ?>
	<div class="container text-center">
		
		<?php 
		starAlertInnlogg();
		$side = 'Location: /admin/ny-bruker.php';
		logginn($side);
		?>
		<p>Legg til en ny bruker</p>
		<form method="POST" action="ny-bruker-landingside.php">
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
	<div>
	<?php include_once '../div/footer.php';

	}else{
 	header("Location: /div/401.php");
 }
	 ?>

    <script src="/bibloteker/jquery/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>