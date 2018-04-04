<?php
session_start();
include_once '../div/database.php';
$db = kobleOpp();

if (isset($_POST["send"])) {
	$tilsynsobjektID = $_POST["tilsynsobjektID"];
	$organisasjonsnummer = $_POST["organisasjonsnummer"];
	$navn = htmlentities($_POST["navn"]);
	$adresselinje1 = htmlentities($_POST["adresselinje1"]);
	$adresselinje2 = htmlentities($_POST["adresselinje2"]);
	$postnummer = $_POST["postnummer"];

	$sql = ("INSERT INTO Restauranter (tilsynsobjektid, orgnummer, navn, adrlinje1, adrlinje2, postnr)
	VALUES(?, ?, ?, ?, ?, ?);");
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, 'sissss' , $tilsynsobjektID, $organisasjonsnummer, $navn, $adresselinje1, $adresselinje2, $postnummer);
	mysqli_stmt_execute($stmt);
	$error = mysqli_stmt_error($stmt);
	lukk($db);
	header("Location: ../tilsynsrapport/endre.php?tilsynsobjektid=$tilsynsobjektID");
	
}
?>;