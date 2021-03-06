<?php
session_start();
require_once '../div/session-kapring.php';
include_once '../div/database.php';
$db = kobleOpp();
if (isset($_POST["submit"])) {
	$tilsynsobjektid = $_POST["tilsynsobjektid"];
	$tilsynid = htmlentities($_POST["tilsynid"]);
	$status = $_POST["status"];
	$tilsynsbesoektype = $_POST["tilsynsbesoektype"];
	$dato = $_POST["dato"];
	$dato = substr($dato,0,2).substr($dato,3,2).substr($dato,6,4);
	$formSvarTab = array(array());

	$formSvarTab[0][0] = $_POST["beskrivelse1_1"];
	$formSvarTab[0][1] = $_POST["karakter1_1"];
	$formSvarTab[1][0] = $_POST["beskrivelse1_2"];
	$formSvarTab[1][1] = $_POST["karakter1_2"];
	$formSvarTab[2][0] = $_POST["beskrivelse1_3"];
	$formSvarTab[2][1] = $_POST["karakter1_3"];
	$formSvarTab[3][0] = $_POST["beskrivelse1_4"];
	$formSvarTab[3][1] = $_POST["karakter1_4"];
	$formSvarTab[4][0] = $_POST["beskrivelse1_5"];
	$formSvarTab[4][1] = $_POST["karakter1_5"];
	$formSvarTab[5][0] = $_POST["beskrivelse1_6"];
	$formSvarTab[5][1] = $_POST["karakter1_6"];
	$formSvarTab[6][0] = $_POST["beskrivelse2_1"];
	$formSvarTab[6][1] = $_POST["karakter2_1"];
	$formSvarTab[7][0] = $_POST["beskrivelse2_2"];
	$formSvarTab[7][1] = $_POST["karakter2_2"];
	$formSvarTab[8][0] = $_POST["beskrivelse2_3"];
	$formSvarTab[8][1] = $_POST["karakter2_3"];
	$formSvarTab[9][0] = $_POST["beskrivelse2_4"];
	$formSvarTab[9][1] = $_POST["karakter2_4"];
	$formSvarTab[10][0] = $_POST["beskrivelse2_5"];
	$formSvarTab[10][1] = $_POST["karakter2_5"];
	$formSvarTab[11][0] = $_POST["beskrivelse2_6"];
	$formSvarTab[11][1] = $_POST["karakter2_6"];
	$formSvarTab[12][0] = $_POST["beskrivelse2_7"];
	$formSvarTab[12][1] = $_POST["karakter2_7"];
	$formSvarTab[13][0] = $_POST["beskrivelse3_1"];
	$formSvarTab[13][1] = $_POST["karakter3_1"];
	$formSvarTab[14][0] = $_POST["beskrivelse3_2"];
	$formSvarTab[14][1] = $_POST["karakter3_2"];
	$formSvarTab[15][0] = $_POST["beskrivelse3_3"];
	$formSvarTab[15][1] = $_POST["karakter3_3"];
	$formSvarTab[16][0] = $_POST["beskrivelse3_4"];
	$formSvarTab[16][1] = $_POST["karakter3_4"];
	$formSvarTab[17][0] = $_POST["beskrivelse3_5"];
	$formSvarTab[17][1] = $_POST["karakter3_5"];
	$formSvarTab[18][0] = $_POST["beskrivelse3_6"];
	$formSvarTab[18][1] = $_POST["karakter3_6"];
	$formSvarTab[19][0] = $_POST["beskrivelse3_7"];
	$formSvarTab[19][1] = $_POST["karakter3_7"];
	$formSvarTab[20][0] = $_POST["beskrivelse3_8"];
	$formSvarTab[20][1] = $_POST["karakter3_8"];
	$formSvarTab[21][0] = $_POST["beskrivelse3_9"];
	$formSvarTab[21][1] = $_POST["karakter3_9"];
	$formSvarTab[22][0] = $_POST["beskrivelse3_10"];
	$formSvarTab[22][1] = $_POST["karakter3_10"];
	$formSvarTab[23][0] = $_POST["beskrivelse4_1"];
	$formSvarTab[23][1] = $_POST["karakter4_1"];
	$formSvarTab[24][0] = $_POST["beskrivelse4_2"];
	$formSvarTab[24][1] = $_POST["karakter4_2"];

	$sql = (
		"SELECT *
		FROM Restauranter
		WHERE tilsynsobjektid LIKE '$tilsynsobjektid'"
	);
	$svar = mysqli_query($db, $sql);
	$svar = mysqli_fetch_assoc($svar);
	if (!$svar) {
		lukk($db);
		$feil = "Restauranten eksisterer ikke.";
		header("Location: endre.php?tilsynid=$tilsynid&feil=$feil");
		exit;
	}
	$sql = (
		"SELECT *
		FROM Tilsynsrapporter
		WHERE tilsynid LIKE '$tilsynid'
		AND tilsynsobjektid LIKE '$tilsynsobjektid'"
	);
	$eksisterendeTilsynsrapport = mysqli_query($db, $sql );
	$eksisterendeTilsynsrapport = mysqli_fetch_assoc($eksisterendeTilsynsrapport);

	$querys = [];
	mysqli_begin_transaction($db);
	
	if(!$eksisterendeTilsynsrapport) {
		$sql = ("INSERT INTO Tilsynsrapporter (tilsynsobjektid, tilsynid, tema1_no, tema2_no, tema3_no, tema4_no, dato, status, tilsynsbesoektype) 
				VALUES (?, ?, 'Rutiner og ledelse', 'Lokaler og utstyr', 'Mat-håndtering og tilberedning', 'Merking og sporbarhet', ?, ?, ?);");
		$stmt = mysqli_prepare($db, $sql);
		mysqli_stmt_bind_param($stmt, 'ssiii' , $tilsynsobjektid, $tilsynid, $dato, $status, $tilsynsbesoektype);
		$querys[] = mysqli_stmt_execute($stmt);
	}

	//henter kravpunktnavn og ordningsverdi fra kravpunkter. Trenger ikke forhindre SQL-inj. på denne
	$sql = (
		"SELECT DISTINCT ordingsverdi, kravpunktnavn_no 
		FROM Kravpunkter 
		ORDER BY SUBSTRING(ordingsverdi, 1 , 1), 
		LENGTH(ordingsverdi), ordingsverdi"
	);
	$svar = mysqli_query($db, $sql);
	
	//bygger opp og sender 25 spøringer for å sette inn i kravpunkter
	$rad = mysqli_fetch_assoc($svar);
	$teller = 0;
	$karakter1 = 0;
	$karakter2 = 0;
	$karakter3 = 0;
	$karakter4 = 0;
	$totalkarakter = 0;
	while ($rad) {
		$ordingsverdi = $rad['ordingsverdi'];
		$kravpunktnavn_no = $rad['kravpunktnavn_no'];
		$tekst_no = $formSvarTab[$teller][0];
		$karakter = $formSvarTab[$teller][1];
		if(!$eksisterendeTilsynsrapport){
			$sql = ("INSERT INTO Kravpunkter (tilsynid, dato, ordingsverdi, kravpunktnavn_no, karakter, tekst_no) 
						VALUES (?, ?, ?, ?, ?, ?);");
			$stmt = mysqli_prepare($db, $sql);
			mysqli_stmt_bind_param($stmt, 'sissis' , $tilsynid, $dato, $ordingsverdi, $kravpunktnavn_no, $karakter, $tekst_no);
			$querys[] = mysqli_stmt_execute($stmt);
		} else {
			$sql = ("UPDATE Kravpunkter
			SET karakter=?, tekst_no=?
			WHERE tilsynid LIKE ? AND ordingsverdi like ?;");
			$stmt = mysqli_prepare($db, $sql);
			mysqli_stmt_bind_param($stmt, 'isss', $karakter, $tekst_no, $tilsynid, $ordingsverdi);
			$querys[] = mysqli_stmt_execute($stmt);
		}

		$rad = mysqli_fetch_assoc($svar);

		$tema = substr( $ordingsverdi, 0, 1 );
		
		switch ($tema) {
			case '1':
				if ($karakter > $karakter1 && $karakter<4) {
					$karakter1 = $karakter;
				}
				break;
			case '2':
				if($karakter > $karakter2 && $karakter<4) {
					$karakter2 = $karakter;
				}
				break;
			case '3':
				if($karakter > $karakter3 && $karakter<4) {
					$karakter3 = $karakter;
				}
				break;
			case '4':
				if ($karakter > $karakter4 && $karakter<4) {
					$karakter4 = $karakter;
				}
				break;
		}
		if ($karakter > $totalkarakter) {
			if($karakter <4){
				$totalkarakter = $karakter;
			}
		}
		
		$teller++;
	}

	$sql = ("UPDATE Tilsynsrapporter
			SET karakter1 =?, karakter2 =?, karakter3=?, karakter4 = ?, total_karakter = ?
			WHERE tilsynid LIKE ?");
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, 'iiiiis' , $karakter1, $karakter2, $karakter3, $karakter4, $totalkarakter, $tilsynid);
	$querys[] = mysqli_stmt_execute($stmt);
	
	$ok = true;
	foreach ($querys as $query) {
		if (!$query) {
			$ok = false;
			break;
		}
	}
	if ($ok) {
		unset($_SESSION['tilsynsrapport']);
		mysqli_commit($db);
		lukk($db);		
		header("Location: tilsyn.php?tilsynid=$tilsynid");
	} else {
		mysqli_rollback($db);
		$feil = "Feil ved insetting i databasen. Kan være at tilsynid allerede eksisterer";
		header("Location: endre.php?tilsynid=$tilsynid&feil=$feil");
	}
}
?>
