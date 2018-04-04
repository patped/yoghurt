<?php
session_start();
require_once '../div/session-kapring.php';
if(!$_SESSION['adminrett']) {
	header("Location: /div/401.php");
}
include_once '../div/database.php';
include_once '../logginn/logginn.php';
?>

<!doctype html>

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	
	<?php include_once '../div/header.php'; ?>
	<div class="container text-center">
		
		<?php 
		starAlertInnlogg();
		$side = 'Location: /admin/ny-bruker.php';
		logginn($side);
		?>
		<h2>Legg til en ny bruker</h2>
		<table class='table table-hover'>
		<form method="POST" action="ny-bruker-landingside.php">
			<tr><input type="required" name="brukernavn" value="Brukernavn"></tr>
			<tr><p>Brukernavn</p></tr>
			<tr><input type="password" name="passord" value="Passord"></tr>
			<tr><p>Passord</p><tr>
			<tr><input type="required" name="tlf" value="Telefonnummer"></tr>
			<tr><p>Telefonnummer</p><tr>
			<tr><input type="checkbox" name="admi" value="admRett"></tr>
			<tr><br><p>Adminrett?</p></tr>
			<tr><input type="submit" name="registrer" value="registrer"></p></tr>
		</form> 
	</table>
	<div>
	<?php include_once '../div/footer.php';	 ?>

    <script src="/bibloteker/jquery/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>