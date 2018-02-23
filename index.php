<?php
//include_once "fil.php";
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
		<input type="text" name="" id="Brukernavn" style="width: 75px; height: 15px">
		<br>
		<input type="passord" name="" id="passord"
		style="width: 75px; height: 15px">
		<br>
		<input type="submit" name="" value="logg inn" style=" width: 65px; height: 20px">
		
	</div>
	<h1>Hvilken smiley har bedriften fått?</h1>

	<h2>Sjekk det her</h2>
	
	
	<input type="submit" alt="Skriv inn bedrift" name="text" id="søke" value="knapp">
	<input type="submit" name="knapp" id="Søk" value="Knappeti">
	<input type="submit" name="" value="knapp">

	<br><br>

	<input type="text" name="Søkefelt" value="Søkefelt">
	<br>

	<p>Skriv inn bedriften du ønsker å søke etter</p>

	<table align="center" width="40%" border="1" cellspacing="1" cellpadding="0">
	<!--
	<?php
	// Eksempel inndata
	// ID, navn på bedrift, smilefjes/vurdering
	
	$bedrifter = array 
	(
		array(1, "McDonalds", ":("),
		array(2, "Burger King", ":|"),
		array(3, "BullInn", ":)"),
		array(4, "Naboen", ":)")
	);

	foreach ($bedrifter as $bedrift) {
		if (in_array($søkeord, $bedrift)) {
			echo " <tr> <td>$bedrift[0]</td> <td>$bedrift[1]</td> <td>$bedrift[2]</td> </tr> ";
		}
	}
	?>
	</table>

	-->
</body>
</html>
