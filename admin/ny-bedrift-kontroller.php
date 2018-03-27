<?php
session_start();
include_once '../div/database.php';
$db = kobleOpp();

if (isset($_POST["send"])) {
	$TilsynsobjektID = $_POST["TilsynsobjektID"];
	$Organisasjonsnummer = $_POST["Organisasjonsnummer"];
	$Navn = htmlentities($_POST["Navn"]);
	$Adresselinje1 = htmlentities($_POST["Adresselinje1"]);
	$Adresselinje2 = htmlentities($_POST["Adresselinje2"]);
	$Postnummer = $_POST["Postnummer"];

	if(null != $TilsynsobjektID  && null != $Organisasjonsnummer && null != $Navn && null != $Adresselinje1 && null != $Postnummer){
			$sql = ("INSERT INTO Restauranter (tilsynsobjektid, orgnummer, navn, adrlinje1, adrlinje2, postnr)
			VALUES(?, ?, ?, ?, ?, ?);");
			//'$TilsynsobjektID', '$Organisasjonsnummer','$Navn','$Adresselinje1', '$Adresselinje2','$Postnummer'
		$stmt = mysqli_prepare($db, $sql);
		mysqli_stmt_bind_param($stmt, 'sissss' , $TilsynsobjektID, $Organisasjonsnummer, $Navn, $Adresselinje1, $Adresselinje2, $Postnummer);
		mysqli_stmt_execute($stmt);
		$error = mysqli_stmt_error($stmt);
		lukk($db);
		header("Location: ../tilsynsrapport/endre.php?tilsynsobjektid=$TilsynsobjektID");
	}
}
?>;