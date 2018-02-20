<?php
//include_once "fil.php";
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Forside</title>
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
	<h1>Hvilken smiley har bedriften fått?</h1>
	<h2>Sjekk det her</h2>
	<p>Skriv inn bedriften du ønsker å søke etter</p>
	
	<input type="textbox" alt="Skriv inn bedrift" name="textbox" id="textbox">
	<input type="submit" name="Søk" id="Søk" value="Søk"> <br> <br>

	<table align="center" width="40%" border="1" cellspacing="1" cellpadding="0">
	
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

	
</body>
</html>
