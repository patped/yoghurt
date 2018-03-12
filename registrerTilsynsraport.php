<?php
	include_once 'database.php';
	$db = kobleOpp($tilsynrapportConfig);
	session_start();
	sjekkInnlogging();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>velykket</title>
	<link rel="stylesheet" href="stilark.css" type="text/css">
</head>
<body>
	
	<?php
        if (isset($_POST["send"])) {
           $tilsynsobjektid = $_POST["tilsynsobjektid"];
	       $tilsynid = $_POST["tilsynid"];
	       $status = $_POST["status"];
	       $tilsynsbesoektype = $_POST["tilsynsbesoektype"];
	       $dato = $_POST["dato"];
	       $karakter1_1 = $_POST["karakter1_1"];
	       $beskrivelse1_1 = $_POST["beskrivelse1_1"];
	       $karakter1_2 = $_POST["karakter1_2"];
	       $beskrivelse1_2 = $_POST["beskrivelse1_2"];
	       $karakter1_3 = $_POST["karakter1_3"];
	       $beskrivelse1_4 = $_POST["beskrivelse1_4"];
	       $karakter1_4 = $_POST["karakter1_4"];
	       $beskrivelse1_5 = $_POST["beskrivelse1_5"];
	       $karakter1_5 = $_POST["karakter1_5"];
	       $beskrivelse1_6 = $_POST["beskrivelse1_6"];
	       $karakter1_6 = $_POST["karakter1_6"];
	       $beskrivelse1_7 = $_POST["beskrivelse1_7"];
	       $karakter1_7 = $_POST["karakter1_7"];
	       $beskrivelse2_1 = $_POST["beskrivelse2_1"];
	       $karakter2_1= $_POST["karakter2_1"];
	       $beskrivelse2_2 = $_POST["beskrivelse2_2"];
	       $karakter2_2= $_POST["karakter2_2"];
	       $beskrivelse2_3 = $_POST["beskrivelse2_3"];
	       $karakter2_3 = $_POST["karakter2_3"];
	       $beskrivelse2_4 = $_POST["beskrivelse2_4"];
	       $karakter2_4= $_POST["karakter2_4"];
	       $beskrivelse2_5 = $_POST["beskrivelse2_5"];
	       $karakter2_5 = $_POST["karakter2_5"];
	       $beskrivelse2_6= $_POST["beskrivelse2_6"];
	       $karakter2_6 = $_POST["karakter2_6"];
	       $beskrivelse2_7= $_POST["beskrivelse2_7"];
	       $karakter2_7 = $_POST["karakter2_7"];
	       $beskrivelse3_1= $_POST["beskrivelse3_1"];
	       $karakter3_1 = $_POST["karakter3_1"];
	       $beskrivelse3_2 = $_POST["beskrivelse3_2"];
	       $karakter3_2= $_POST["karakter3_2"];
	       $beskrivelse3_3 = $_POST["beskrivelse3_3"];
	       $karakter3_3= $_POST["karakter3_3"];
	       $beskrivelse3_4= $_POST["beskrivelse3_4"];
	       $karakter3_4 = $_POST["karakter3_4"];
	       $beskrivelse3_5 = $_POST["beskrivelse3_5"];
	       $karakter3_5 = $_POST["karakter3_5"];
	       $beskrivelse3_6 = $_POST["beskrivelse3_6"];
	       $karakter3_6= $_POST["karakter3_6"];
	       $beskrivelse3_7 = $_POST["beskrivelse3_7"];
	       $karakter3_7= $_POST["karakter3_7"];
	       $beskrivelse3_8 = $_POST["beskrivelse3_8"];
	       $karakter3_8 = $_POST["karakter3_8"];
	       $beskrivelse3_9 = $_POST["beskrivelse3_9"];
	       $karakter3_9 = $_POST["karakter3_9"];
	       $beskrivelse3_10 = $_POST["beskrivelse3_10"];
	       $karakter3_10 = $_POST["karakter3_10"];
	       $beskrivelse4_1 = $_POST["beskrivelse4_1"];
	       $karakter4_1 = $_POST["karakter4_1"];
	       $beskrivelse4_2 = $_POST["beskrivelse4_2"];
	       $karakter4_2 = $_POST["karakter4_2"];
				
		   $sql = ("INSERT INTO Tilsynsrapporter(tilsynsobjektid, tilsynid,status, dato, total_karakter, 
		   	                    tilsynsbesoektype, tema1_no, karakter1, tema2_no, karakter2, tema3_no, karakter3, tema4_no, karakter4)
			        VALUES($tilsynsobjektid, $tilsynid,$status, $dato,NULL, NULL, NULL, NULL,
			               NULL, NULL, NULL, NULL, NULL);");
			
			$resultat = mysqli_query( $db, $sql );
	       	
	       	if($resultat == 1){
	       		echo "velykket insetting av tilsynsraport";	
	       		
	       	}
	       	else{
	       		echo "feil med insetting av tilsynsraport mot db";
	       	}

	       	$sql = ("INSERT INTO `Kravpunkter` (`tilsynid`, `dato`, `ordingsverdi`, `kravpunktnavn_no`, `karakter`, `tekst_no`) 
	       			 VALUES
					('Z1601041508412850239LCXIE_TilsynAvtale', 4012016, '01.apr', 'Internkontroll', 0, '');")
			
			$resultat = mysqli_query( $db, $sql );
	    	
	    			
	    	}


        
    ?>


</body>
</html>
<?php
	lukk($db);
?>