<?php
session_start();
if(!$_SESSION['adminrett']) {
	header("Location: /401.php");
}
include_once '../database.php';
include_once '../logginn/logginn.php';
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
	include_once '../header-footer/header.php'; 
    starAlertInnlogg();
    $side = 'Location: /admin/ny-bedrift.php';
    logginn($side);
	?>

	<div class="container text-center">
		
		<h1>Legg til ny bedrift</h1>
		<h2>Fyll ut skjema</h2>

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
								<td><input type="text" name="TilsynsobjektID" ></td>
							</tr>

							<tr>
								<td>Organisasjonsnummer:</td>
								<td><input type="text" name="Organisasjonsnummer" ></td>
							</tr>

							<tr>
								<td>Navn:</td>
									<td><input type="text" name="Navn" ></td>
							</tr>

							<tr>
								<td>Adresselinje1:</td>
								<td><input type="text" name="Adresselinje1" ></td>
							</tr>
							
							<tr>
								<td>Adresselinje2:</td>
								<td><input type="text" name="Adresselinje2" ></td>
							</tr> 

							<tr>
								<td>Postnummer:</td>
								<td><input type="text" name="Postnummer" ></td>
							</tr>

							<tr>
								<td></td>
								<td><input type="submit" name="send" class="pull-right"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>

	<?php include_once '../header-footer/footer.php'; ?>
	

	<script src="/bibloteker/jquery/jquery-3.3.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>