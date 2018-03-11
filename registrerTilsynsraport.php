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

	       $karakter1_1 = $_POST["karakter1_1"];
	       echo $karakter1_1;
	        

			if(null != $tilsynsobjektid  && null != $tilsynid && null != $sakref && null != $status && null != $dato && null != $total_karakter && null != $tema1_no && null != $karakter1 && null != $tema2_no && null != $karakter2 && null != $tema3_no && null != $karakter3 && null != $tema4_no && null != $karakter4){
				
	       		 $sql = ("INSERT INTO Tilsynsrapporter(tilsynsobjektid, tilsynid, sakref, status, dato, total_karakter, tilsynsbesoektype, tema1_no, karakter1, tema2_no, karakter2, tema3_no, karakter3, tema4_no, karakter4)
	        	    VALUES($tilsynsobjektid, $tilsynid,$sakref,$status, $dato,$total_karakter, $tema1_no, $karakter1, $tema2_no, $karakter2, $ tema3_no, $karakter3, $tema4_no, $karakter4);");
	       		 $resultat = mysqli_query( $db, $sql );
	       	if($resultat == 1){
	       		
	       		echo nl2br ("Vellykket innlegging av Tilsynsraport \n 
	       					Du har lagt inn følgende data; \n
	       					tilsynsobjektid = $tilsynsobjektid \n
	       					tilsynid = $tilsynid \n
	       					sakref = $sakref \n
	       					status = $status \n
	       					dato = $dato \n
	       					total_karakter = $total_karakter \n
	       					tema1_no = $tema1_no \n
	       					karakter1 = $karakter1 \n
	       					tema2_no = $tema2_no \n
	       					karakter2 = $karakter2 \n
	       					tema3_no = $tema3_no \n
	       					karakter3 = $karakter3 \n
	       					tema4_no = $tema4_no \n
	       					karakter4 = $karakter4 \n

	       			");
	       		echo <<< EOF
	    		<form action="leggTilNyTilsynsrapport.php">
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
	    		<form action="leggTilNyTilsynsrapport.php">
    				<input type="submit" value="Går tilbake" />
				</form>
EOF;
	    			
	    	}


        }
    ?>


</body>
</html>
<?php
	lukk($db);
?>