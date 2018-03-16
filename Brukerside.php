<?php
	session_start();
	include_once 'database.php';
	include_once 'hjelpefunksj.php';
	$db = kobleOpp();
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Forside youghurt</title>
	<link rel="stylesheet" href="stilark.css" type="text/css">
</head>
<body>
	<?php include_once 'header.php'; ?>
	<main>
	
	<?php
	//denne løsninga her kan kanskje omgjøres?
	if (isset($_POST['submit'])) {
		$brukernavn = $_POST['brukernavn'];
		$passord = $_POST['passord'];
		$_SESSION['loggetInn'] = sjekkInnlogg($db, $brukernavn, $passord);
		if ($_SESSION['loggetInn'] == true) {
			$sqlSpørring = ("
					SELECT b.adminrettighet
                    FROM Brukere AS b
                    WHERE b.brukernavn LIKE '$brukernavn'");
    		$spørringSvar = mysqli_query($db, $sqlSpørring);
    		if ($spørringSvar) {
    			$adminrettighet = mysqli_fetch_assoc($spørringSvar);
    			$adminrettighetSvar = $adminrettighet['adminrettighet'];
    		}else{
    			echo "<p>Noe gikk galt på siden! <a href='index.php'>Tilbake til søkesiden</a></p>";
    		}
    		if ($adminrettighetSvar == false) {
    			echo "$brukernavn har ikke administratorrettighet på denne nettsiden. Kontakt sjefen ;)" ;
    		}else{
    			$sideSkalJegTil = $_SESSION['sideJegSkalTil'];
    			$_SESSION['loggInnAlert'] = true;
			header($sideSkalJegTil);
			}
		}else{
			$_SESSION['altertFeilInnLogg'] = true;
			header('Location: index.php');
		}
	}

	?>	

</main>
<?php include_once 'footer.php'; ?>
</body>
</html>
<?php
	lukk($db)
?>