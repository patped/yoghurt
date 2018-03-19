<?php
	include_once 'database.php';
	$db = kobleOpp();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>velykket</title>
	<link rel="stylesheet" href="stilark.css" type="text/css">
</head>
<body>
	<?php include_once 'header.php'; ?>
	<main>
	
	<?php
        if (isset($_POST["send"])) {
	        $TilsynsobjektID = $_POST["TilsynsobjektID"];
	        $Organisasjonsnummer = $_POST["Organisasjonsnummer"];
			$Navn = $_POST["Navn"];
			$Adresselinje1 = $_POST["Adresselinje1"];
			$Adresselinje2 = $_POST["Adresselinje2"];
			$Postnummer = $_POST["Postnummer"];
			if(null != $TilsynsobjektID  && null != $Organisasjonsnummer && null != $Navn && null != $Adresselinje1 && null != $Postnummer){
	       		 $sql = ("INSERT INTO Restauranter (tilsynsobjektid, orgnummer, navn, adrlinje1, adrlinje2, postnr)
	        	    VALUES(?, ?, ?, ?, ?, ?);");
	       		 //'$TilsynsobjektID', '$Organisasjonsnummer','$Navn','$Adresselinje1', '$Adresselinje2','$Postnummer'
	       		$stmt = mysqli_prepare($db, $sql);
	            mysqli_stmt_bind_param($stmt, 'sissss' , $TilsynsobjektID, $Organisasjonsnummer, $Navn, $Adresselinje1, $Adresselinje2, $Postnummer);
	            mysqli_stmt_execute($stmt);
	       		$error = mysqli_stmt_error($stmt);
	       	if(!$error){
	       		
	       		echo nl2br ("Vellykket inlegging av bedrift \n 
	       					Du har lagt inn følgende data; \n
	       					TilsynsobjektID = $TilsynsobjektID \n
	       					Organisasjonsnummer = $Organisasjonsnummer \n
	       					Navn = $Navn \n
	       					Adresselinje1 = $Adresselinje1 \n
	       					Adresselinje2 = $Adresselinje2 \n
	       					Postnummer = $Postnummer \n

	       			");
	       		echo <<< EOF
	    		<form action="leggTilBedrift.php">
    				<input type="submit" value="Går tilbake" />
				</form>
EOF;
	       		
	       		
	       	}
	       	else{
	       		echo "feil med insetting mot db";
	       	}
	    	}
	    	else {
	    		echo "Alle feltene må mære fylt ut!";
	 			echo <<< EOF
	    		<form action="leggTilBedrift.php">
    				<input type="submit" value="Går tilbake" />
				</form>
EOF;
	    			
	    	}


        }
        else
        	echo "her";
    ?>

</main>
<?php include_once 'footer.php'; ?>
</body>
</html>
<?php
	lukk($db);
?>