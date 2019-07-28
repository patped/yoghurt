<?php
session_start();
require_once '../div/session-kapring.php';
include_once '../div/database.php';
include_once 'logginn.php';
$db = kobleOpp();
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
		
	# 	Workaround for localhost. 
	# 	Får ikke procedyren til å fungere på mysql localt.
	# 	Legge logiken i php istedet?
	# 	$adminrettighet = $svarAdminRes['@admin'];
		$adminrettighet = true;
		$_SESSION['adminrett'] = $adminrettighet;
		
	    
		if ($adminrettighet == false) {
			$sideJegSkalTil = $_SESSION['sideJegSkalTil'];
			$_SESSION['loggetInn'] = false;
			header($sideJegSkalTil);
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
lukk($db)
?>