<?php
session_start();
include_once '../database.php';
include_once 'logginn.php';
$db = kobleOpp();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Forside youghurt</title>
</head>
<body>
	<?php include_once 'header-footer/header.php'; ?>
	<main>
	
	<?php
	//denne løsninga her kan kanskje omgjøres?
	if (isset($_POST['submit'])) {
		$brukernavn = $_POST['brukernavn'];
		$_SESSION['bruker'] = $brukernavn; 
		$passord = $_POST['passord'];
		$_SESSION['loggetInn'] = sjekkInnlogg($db, $brukernavn, $passord);
		if ($_SESSION['loggetInn'] == true) {
			$sqlCall = ("CALL rettighet_sjekk(?, @admin)");
			$stmtCall = mysqli_prepare($db, $sqlCall);
		    mysqli_stmt_bind_param($stmtCall, 's' , $brukernavn);
		    mysqli_stmt_execute($stmtCall);
		    $sqlSpørring = ("
					SELECT @admin");
		    $utførAdminRes = mysqli_query($db, $sqlSpørring);
		    $svarAdminRes = mysqli_fetch_assoc($utførAdminRes);
		    $testSvar = $svarAdminRes['@admin'];
		    $_SESSION['adminrett'] = $testSvar;

    		if ($testSvar == false) {
    			echo "<p><b>$brukernavn</b> har ikke administratorrettighet på denne nettsiden. Kontakt sjefen ;)</p>
    				<p>Administrasjonsrettighet til <b>$brukernavn</b> er nå: $testSvar </p>
    				<br><br><p><b>DET KAN VÆRE FORDI SLUTTDATOEN DIN HAR GÅTT UT PÅ PASSORDET I BASEN<b></p>" ;
    				$_SESSION['loggetInn'] = false;
    		}else{
    			$sideSkalJegTil = $_SESSION['sideJegSkalTil'];
    			$_SESSION['loggInnAlert'] = true;
				header($sideSkalJegTil);
			}
		}else{
			$side = $_SESSION['sideJegSkalTil'];
			$_SESSION['altertFeilInnLogg'] = true;
			header($side);
		}
	}

	?>	

</main>
<?php include_once 'header-footer/footer.php'; ?>
</body>
</html>
<?php
	lukk($db)
?>