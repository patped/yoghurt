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
    $side = 'Location: leggTilBedrift.php';
    logginn($side);
    ?>

	<h1>Legg til ny bedrift</h1>

	<h2>Fyll ut skjema</h2>
	
	    <?php 
   

		echo <<<EOT


	<div>
		<form method="POST" action="registrerBedrift.php">
			<table>
			
	  			<tr>
	    			<td>TilsynsobjektID:</td>
	    			<td><input type="text" name="TilsynsobjektID" ></td>
	  			</tr>

	  			<tr>
	    			<td>Organisasjonsnummer:</td>
	   				<td><input type="text" name="Organisasjonsnummer" ></td>
	  			</tr>

	  			<tr>
	    			<td>Navn:</td>
	   				 <td><input type="text" name="Navn" ></td>
	  			</tr>

	  			<tr>
	   				 <td>Adresselinje1:</td>
	   				 <td><input type="text" name="Adresselinje1" ></td>
	 			 </tr>
	 			
	 			 <tr>
	    			<td>Adresselinje2:</td>
	    			<td><input type="text" name="Adresselinje2" ></td>
	  			</tr> 

	 			<tr>
	    			<td>Postnummer:</td>
	    			<td><input type="text" name="Postnummer" ></td>
	  			</tr> 

				<td></td><td></td><td><input type="submit" name="send"></td>
			 
			</table>
		</form>
    </div>

EOT;
	

	?>

</body>
</html>
<?php
	lukk($db);
?>