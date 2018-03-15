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
	$_SESSION['loggetInn']=true;
	if($_SESSION['loggetInn']==true){
		echo '

	<div>
		<form method="POST" action="registrerTilsynsraport.php">
			<table>

				<tr>
	    			<td>TilsynsobjektID:</td>
	    			<td><input type="text" name="tilsynsobjektid"></td>
	  			</tr>

	  			<tr>
	    			<td>TilsynsID:</td>
	    			<td><input type="text" name="tilsynid"></td>
	  			</tr>

				<tr>
	    			<td>TilsynsBesøksType:</td>
	    			<td>
		    			<select name="tilsynsbesoektype">
				    		<option value="0">Ordinært</option>
				    		<option value="1">oppfølgings -tilsyn</option>
		  				</select>
	  				</td>
	  			</tr>

				<tr>
	    			<td>dato:</td>
	    			<td><input type="text" name="dato"></td>
	  			</tr>
			
				<tr>
	    			<td>Kravpunkt:</td>
	    			<td>Karakter:</td>
	    			<td>Beskrivelse:</td>
	  			</tr>

	  			<tr>
	    			<td>Synlig rapport for smilefjes:</td>
	    			<td>
		    			<select name="karakter1_1">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	  				</td>
	    			<td><input type="text" name="beskrivelse1_1" ></td>
	  			</tr>

	  			<tr>
	    			<td>Meldeplikt for virksomheten:</td>
	   				<td>
	   					<select name="karakter1_2">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	   				<td><input type="text" name="beskrivelse1_2" ></td>
	  			</tr>

	  			<tr>
	    			<td>Ansvaret til driftsansvarlige:</td>
	    			<td>
	   					<select name="karakter1_3">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	   				<td><input type="text" name="beskrivelse1_3" ></td>
	  			</tr>

	  			<tr>
	   				 <td>Internkontroll:</td>
	   				 <td>
	   					<select name="karakter1_4">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	   				 <td><input type="text" name="beskrivelse1_4" ></td>
	 			 </tr>
	 			
	 			 <tr>
	    			<td>Farevurdering og styringstiltak:</td>
	    			<td>
	   					<select name="karakter1_5">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse1_5" ></td>
	  			</tr> 

	 			<tr>
	    			<td>Opplæring og kompetanse:</td>
	    			<td>
	   					<select name="karakter1_6">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse1_6" ></td>
	  			</tr> 
	  			
	  			<tr>
	    			<td>Generelt - planløsning, standard og vedlikehold:</td>
	    			<td>
	   					<select name="karakter2_1">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse2_1" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Lokaler - spesielle krav ved tilberedning, bearbeiding og foredling:</td>
	    			<td>
	   					<select name="karakter2_2">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse2_2" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Renhold:</td>
	    			<td>
	   					<select name="karakter2_3">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse2_3" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Håndtering av avfall:</td>
	    			<td>
	   					<select name="karakter2_4">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse2_4" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Bekjempe skadedyr:</td>
	    			<td>
	   					<select name="karakter2_5">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse2_5" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Håndvask:</td>
	    			<td>
	   					<select name="karakter2_6">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse2_6" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Personaltoalett og garderobe:</td>
	    			<td>
	   					<select name="karakter2_7">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse2_7" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Råvarer:</td>
	    			<td>
	   					<select name="karakter3_1">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_1" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Vann og is:</td>
	    			<td>
	   					<select name="karakter3_2">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_2" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Forurensningsfare:</td>
	    			<td>
	   					<select name="karakter3_3">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_3" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Lagring:</td>
	    			<td>
	   					<select name="karakter3_4">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_4" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Transport:</td>
	    			<td>
	   					<select name="karakter3_5">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_5" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Personalets helse og hygiene:</td>
	    			<td>
	   					<select name="karakter3_6">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_6" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Kjølekjeden:</td>
	    			<td>
	   					<select name="karakter3_7">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_7" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Varmebehandling:</td>
	    			<td>
	   					<select name="karakter3_8">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_8" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Nedkjøling:</td>
	    			<td>
	   					<select name="karakter3_9">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_9" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Tining:</td>
	    			<td>
	   					<select name="karakter3_10">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse3_10" ></td>
	  			</tr> 

	  			<tr>
	    			<td>porbarhet og merking:</td>
	    			<td>
	   					<select name="karakter4_1">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse4_1" ></td>
	  			</tr> 

	  			<tr>
	    			<td>Merking av allergeningredienser;:</td>
	    			<td>
	   					<select name="karakter4_2">
				    		<option value="0">0</option>
				    		<option value="1">1</option>
				    		<option value="2">2</option>
				    		<option value="3">3</option>
				    		<option value="4">4</option>
				    		<option value="5">5</option>
		  				</select>
	   				</td>
	    			<td><input type="text" name="beskrivelse4_2" ></td>
	  			</tr> 

	  			<tr>
	    			<td>status:</td>
	    			<td>
		    			<select name="status">
				    		<option value="0">utestående avvik finnes</option>
				    		<option value="1">alle avvik lukket</option>
		  				</select>
	  				</td>
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