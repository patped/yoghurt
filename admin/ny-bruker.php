<?php
session_start();
require_once '../div/session-kapring.php';
if(!$_SESSION['loggetInn']) {
	header("Location: /div/401.php");
}
include_once '../div/database.php';
include_once '../logginn/logginn.php';
?>

<!doctype html>
<html lang="no">

<head>
	<title>Ny bruker</title>
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

		<div class="jumbotron">
			<h1 class="text-center">Legg til en ny bruker</h1>	
		</div>
		<h2 class="text-center">Fyll ut skjema</h2>  

		<form method="POST" action="ny-bruker-landingside.php">
			<div class="table-responsive">
				<div class="col-xs-4 col-xs-offset-4">
					<table class="table">
						<thead>
						</thead>
						<tbody>
							<tr>
								<td><p>Brukernavn</p></td>
								<td><input type="text" name="brukernavn" required placeholder="Brukernavn"></td>
							</tr>
							<tr>
								<td><p>Passord</p></td>
								<td><input type="password" name="passord" required placeholder="Passord"></td>
							</tr>
							<tr>
								<td><p>Telefonnummer</p></td>
								<td><input type="text" name="tlf" required placeholder="Telefonnummer"></td>
							</tr>
							<tr>
								<td><p>Adminrett?</p></td>
								<td><input type="checkbox" name="admi" value="admRett"></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="registrer" value="Registrer" class="pull-right"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</form> 
	</div>
	<?php include_once '../div/footer.php';	 ?>

    <script src="/bibloteker/jquery/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>