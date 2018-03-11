 <?php
	include_once 'database.php';
	include_once 'hjelpefunksj.php';
	$db = kobleOpp($tilsynrapportConfig);
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
	<div class="loginn">
		<form method="POST" action="index.php">
			<input type="submit" name="Logg Ut" value="Logg ut">
		</form>
	</div>

	<h1>Legg til ny Tilsynsrapport</h1>

	<h2>Fyll ut skjema</h2>
	
	<?php 
	$fornavn= $_SESSION['fornavn'];
	$adm = $_SESSION['adm'];
	if($_SESSION['loggetInn']==true){
		echo '

	<div>
		<form method="POST" action="registrerTilsynsraport.php">
			<table>
			
	  			<tr>
	    			<td>Synlig rapport for smilefjes:</td>
	    			<td>
		    			<select name="1.1 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	  				</td>
	    			<td><input type="text" name="1.1 beskrivelse" ></td>
	  			</tr>

	  			<tr>
	    			<td>Meldeplikt for virksomheten:</td>
	   				<td>
	   					<select name="1.2 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	   				<td><input type="text" name="1.2 beskrivelse" ></td>
	  			</tr>

	  			<tr>
	    			<td>Ansvaret til driftsansvarlige:</td>
	    			<td>
	   					<select name="1.3 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	   				<td><input type="text" name="1.3 beskrivelse" ></td>
	  			</tr>

	  			<tr>
	   				 <td>Internkontroll:</td>
	   				 <td>
	   					<select name="1.4 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	   				 <td><input type="text" name="1.4 beskrivelse" ></td>
	 			 </tr>
	 			
	 			 <tr>
	    			<td>Farevurdering og styringstiltak:</td>
	    			<td>
	   					<select name="1.5 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="1.5 beskrivelse" ></td>
	  			</tr> 

	 			<tr>
	    			<td>Opplæring og kompetanse:</td>
	    			<td>
	   					<select name="1.6 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="1.6 beskrivelse" ></td>
	  			</tr> 
	  			
	  			<tr>
	    			<td>Generelt - planløsning, standard og vedlikehold:</td>
	    			<td>
	   					<select name="2.1 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="2.1 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Lokaler - spesielle krav ved tilberedning, bearbeiding og foredling:</td>
	    			<td>
	   					<select name="2.2 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="2.2 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Renhold:</td>
	    			<td>
	   					<select name="2.3 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="2.3 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Håndtering av avfall:</td>
	    			<td>
	   					<select name="2.4 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="2.4 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Bekjempe skadedyr:</td>
	    			<td>
	   					<select name="2.5 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="2.5 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Håndvask:</td>
	    			<td>
	   					<select name="2.6 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="2.6 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Personaltoalett og garderobe:</td>
	    			<td>
	   					<select name="2.7 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="2.7 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Råvarer:</td>
	    			<td>
	   					<select name="3.1 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.1 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Vann og is:</td>
	    			<td>
	   					<select name="3.2 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.2 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Forurensningsfare:</td>
	    			<td>
	   					<select name="3.3 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.3 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Lagring:</td>
	    			<td>
	   					<select name="3.4 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.4 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Transport:</td>
	    			<td>
	   					<select name="3.5 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.5 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Personalets helse og hygiene:</td>
	    			<td>
	   					<select name="3.6 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.6 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Kjølekjeden:</td>
	    			<td>
	   					<select name="3.7 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.7 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Varmebehandling:</td>
	    			<td>
	   					<select name="3.8 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.8 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Nedkjøling:</td>
	    			<td>
	   					<select name="3.9 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.9 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Tining:</td>
	    			<td>
	   					<select name="3.10 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="3.10 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>porbarhet og merking:</td>
	    			<td>
	   					<select name="4.1 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="4.1 beskrivelse" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Merking av allergeningredienser;:</td>
	    			<td>
	   					<select name="4.2 karakter">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="4.2 beskrivelse" ></td>
	  			</tr> 

				<td></td><td></td><td><input type="submit" name="send"></td>
			 
			</table>
		</form>
    </div>

';
	}

	else {
		echo "du har ikke adminrettigheter";
	}

	function leggTilNY(){
		$TilsynsobjektID = $_Request['TilsynsobjektID'];
		echo $TilsynsobjektID;
	}

	function dropdown($navn){
		echo '
			<select name=$navn>
		    	<option value="0">0</option>
		    	<option value="1">1</option>
		    	<option value="2">2</option>
		    	<option value="3">3</option>
		    	<option value="4">4</option>
		    	<option value="5">5</option>
	  		</select>';
	}
	?>

</body>
</html>
<?php
	lukk($db);
?>