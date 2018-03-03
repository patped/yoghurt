<?php
	include_once 'database.php';
	$db = kobleOpp($tilsynrapportConfig);
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
		if (isset($_POST['Søk'])) {
			$søkeord = $_POST['textbox'];

		}else {
			$søkeord = ":)";
		}
	?>
	<div class="loginn">
		<input type="text" name="" id="Brukernavn" style="width: 75px; height: 15px">
		<br>
		<input type="passord" name="" id="passord"
		style="width: 75px; height: 15px">
		<br>
		<input type="submit" name="" value="logg inn" style=" width: 65px; height: 20px">

	</div>
	<h1>Legg til ny beddrift</h1>

	<h2>Fyll ut skjema</h2>

	<div>
		<form>
			<table>
			
	  			<tr>
	    			<td>TilsynsobjektID:</td>
	    			<td><input type="text" name="TilsynsobjektID" ></td>
	  			</tr>>   

	  			<tr>
	    			<td>Navn:</td>
	   				 <td><input type="text" name="Navn" ></td>
	  			</tr>>  

	  			<tr>
	    			<td>Organisasjonsnummer:</td>
	   				<td><input type="text" name="Organisasjonsnummer" ></td>
	  			</tr>>   

	  			<tr>
	   				 <td>Adresselinje: 1</td>
	   				 <td><input type="text" name="Adresselinje1" ></td>
	 			 </tr>> 
	 			
	 			 <tr>
	    			<td>Adresselinje 2:</td>
	    			<td><input type="text" name="Adresselinje2" ></td>
	  			</tr>>  

	 			<tr>
	    			<td>Postnummer:</td>
	    			<td><input type="text" name="Postnummer" ></td>
	  			</tr>>  

				<tr>
				    <td>Poststed:</td>
				    <td><input type="text" name="Poststed" ></td>
				</tr>>   
			 
			</table>
		</form>
    </div>

</body>
</html>

<?php
    lukk($db);
?>