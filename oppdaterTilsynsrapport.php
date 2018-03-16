 <?php
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
	<?php
	starAlertInnlogg();
    $side = 'Location: oppdaterTilsynsrapport.php';
    logginn($side);
    ?>
	<h1>Legg til ny Tilsynsrapport</h1>

	<h2>Fyll ut skjema</h2>
	
	 <?php 
    
		echo <<<EOT

	<div>
		<form method="POST" action="registrerTilsynsraport.php">
			<table>
			
	  			<tr>
	    			<td>TilsynsobjektID:</td>
	    			<td><input type="text" name="tilsynsobjektid" ></td>
	  			</tr>

	  			<tr>
	    			<td>TilsynsID:</td>
	   				<td><input type="text" name="tilsynid" ></td>
	  			</tr>

	  			<tr>
	    			<td>Sakref:</td>
	   				 <td><input type="text" name="sakref" ></td>
	  			</tr>

	  			<tr>
	   				 <td>Status:</td>
	   				 <td><input type="text" name="status" ></td>
	 			 </tr>
	 			
	 			 <tr>
	    			<td>Dato:</td>
	    			<td><input type="text" name="dato" ></td>
	  			</tr> 

	 			<tr>
	    			<td>Total karakter:</td>
	    			<td><input type="text" name="total_karakter" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Tilsynsbesoektype:</td>
	    			<td><input type="text" name="tilsynsbesoektype" ></td>
	  			</tr> 

	  			<tr>
	    			<td>tema1_no:</td>
	    			<td><input type="text" name="tema1_no" ></td>
	  			</tr> 


	  			<tr>
	    			<td>karakter1:</td>
	    			<td><input type="text" name="karakter1" ></td>
	  			</tr> 

	  			<tr>
	    			<td>tema2_no:</td>
	    			<td><input type="text" name="tema2_no" ></td>
	  			</tr> 


	  			<tr>
	    			<td>karakter2:</td>
	    			<td><input type="text" name="karakter2" ></td>
	  			</tr> 

	  			<tr>
	    			<td>tema3_no:</td>
	    			<td><input type="text" name="tema4_no" ></td>
	  			</tr> 


	  			<tr>
	    			<td>karakter3:</td>
	    			<td><input type="text" name="karakter3" ></td>
	  			</tr> 

	  			<tr>
	    			<td>tema4_no:</td>
	    			<td><input type="text" name="tema4_no" ></td>
	  			</tr> 


	  			<tr>
	    			<td>karakter4:</td>
	    			<td><input type="text" name="karakter4" ></td>
	  			</tr> 

				<td></td><td></td><td><input type="submit" name="send"></td>
			 
			</table>
		</form>
    </div>

EOT;
	

	

	function leggTilNY(){
		$TilsynsobjektID = $_Request['TilsynsobjektID'];
		echo $TilsynsobjektID;
	}
	?>

</body>
</html>
<?php
	lukk($db);
?>