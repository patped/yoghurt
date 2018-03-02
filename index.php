<?php
	include_once 'database.php';
	$db = kobleOpp($tilsynrapportConfig);
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
		if (isset($_POST['Søk'])) {
			$søkeord = $_POST['textbox'];

		}else {
			$søkeord = ":)";
		}
	?>
	<div class="loginn">
		<form method="POST" action="Brukerside.php">
		<input type="text" name="bruker" id="Brukernavn"  style="width: 75px; height: 15px">
		<br>
		<input type="text" name="passord" id="pass"
		style="width: 75px; height: 15px">
		<br>
		<input type="submit" name="" value="logg inn" style=" width: 65px; height: 20px">
		</form>

	</div>
	<h1>Hvilken smiley har bedriften fått?</h1>

	<h2>Sjekk det her</h2>


	<input type="submit" alt="Skriv inn bedrift" name="text" id="søke" value="knapp">
	<input type="submit" name="knapp" id="Søk" value="Knappeti">
	<input type="submit" name="" value="knapp">

	<br><br>

	<input type="text" name="Søkefelt" value="Søkefelt">
	<br>

	</table>

</body>
</html>

<?php
    lukk($db);
?>