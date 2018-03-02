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

	</div>
	<h1>Hvilken smiley har bedriften fått?</h1>

	<h2>Sjekk det her</h2>


</body>
</html>

<?php
    lukk($db);
?>