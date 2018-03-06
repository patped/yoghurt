<?php
	include_once 'database.php';
	$db = kobleOpp($tilsynrapportConfig);
	session_start();
	sjekkInnlogging();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Forside youghurt</title>
	<link rel="stylesheet" href="stilark.css" type="text/css">
</head>
<body>
	<div class="loginn">
		<<form method="POST" action="index.php">
			<input type="submit" name="Logg Ut" value="Logg ut">

	</div>
	<h1>Legg til ny bedrift</h1>

	<h2>Fyll ut skjema</h2>
	
	<?php 
	$fornavn= $_SESSION['fornavn'];
	$adm = $_SESSION['adm'];
	if($adm==true){
		echo <<<EOT


	<div>
		<form method="POST" action="function leggTilNy()">
			<table>
			
	  			<tr>
	    			<td>TilsynsobjektID:</td>
	    			<td><input type="text" name="TilsynsobjektID" ></td>
	  			</tr>

	  			<tr>
	    			<td>Navn:</td>
	   				 <td><input type="text" name="Navn" ></td>
	  			</tr>

	  			<tr>
	    			<td>Organisasjonsnummer:</td>
	   				<td><input type="text" name="Organisasjonsnummer" ></td>
	  			</tr>

	  			<tr>
	   				 <td>Adresselinje: 1</td>
	   				 <td><input type="text" name="Adresselinje1" ></td>
	 			 </tr>
	 			
	 			 <tr>
	    			<td>Adresselinje 2:</td>
	    			<td><input type="text" name="Adresselinje2" ></td>
	  			</tr> 

	 			<tr>
	    			<td>Postnummer:</td>
	    			<td><input type="text" name="Postnummer" ></td>
	  			</tr> 

				<tr>
				    <td>Poststed:</td>
				    <td><input type="text" name="Poststed" ></td>
				</tr>   
				<td></td><td></td><td><input type="submit" name="send"></td>
			 
			</table>
		</form>
    </div>

EOT;
}

else
echo "du har ikke adminrettigheter";

function leggTilNY(){
	$TilsynsobjektID = $_Request['TilsynsobjektID'];
	echo $TilsynsobjektID;
}
	?>

</body>
</html>