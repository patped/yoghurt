<?php
session_start();
require_once '../div/session-kapring.php';
include_once '../div/database.php';
include_once '../logginn/logginn.php';
if(!$_SESSION['loggetInn']) {
	header("Location: /div/401.php");
}

?>
<!doctype html>
<html lang="no">
<head>
	<title>Yoghurt</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
</head>
<body>
	
	<?php
	include_once '../div/header.php'; 
    starAlertInnlogg();
    $side = 'Location: /admin/ny-bedrift.php';
    logginn($side);
	?>


	<div class="container text-center">
	
		<div class="jumbotron">
			<h1>Legg til ny bedrift</h1>
		</div>
		<h2 class="text-center">Fyll ut skjema</h2>

		<form method="POST" action="ny-bedrift-kontroller.php">
			<div class="table-responsive">
				<div class="col-xs-4 col-xs-offset-4">
					<table class="table">
						<thead>
							<th></th>
							<th></th>
						</thead>
						<tbody>
							<tr>
								<td>TilsynsobjektID:</td>
								<td><input type="text" name="tilsynsobjektID" pattern="[A-Za-z0-9_]+" required></td>
							</tr>

							<tr>
								<td>Organisasjonsnummer:</td> <!--  pattern="\d*" begrenser input til tall og gir finere feilmld enn type="number" -->
								<td><input type="text" name="organisasjonsnummer" pattern="\d*" minlength="9" maxlength="9" required></td>
							</tr>

							<tr>
								<td>Navn:</td>
									<td><input class="xssKontroll" type="text" name="navn" required></td>
							</tr>

							<tr>
								<td>Adresselinje1:</td>
								<td><input class="xssKontroll" type="text" name="adresselinje1" required></td>
							</tr>
							
							<tr>
								<td>Adresselinje2:</td>
								<td><input class="xssKontroll" type="text" name="adresselinje2"></td>
							</tr> 

							<tr>
								<td>Postnummer:</td>
								<td><input type="text" name="postnummer" pattern="\d*" minlength="4" maxlength="4" required></td>
							</tr>

							<tr>
								<td></td>
								<td><input type="submit" name="send" value="Registrer" class="pull-right"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>

	<?php include_once '../div/footer.php'; ?>
	

	<script src="/bibloteker/jquery/jquery-3.3.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../div/xssKontroll.js"></script>
</body>
</html>