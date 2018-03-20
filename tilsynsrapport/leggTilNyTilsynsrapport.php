 <?php
	include_once '../database.php';
	include_once '../hjelpefunksj.php';
	session_start();
?>

<!doctype html>
<html lang="no">
<head>
  <title>Yoghurt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	 <?php 
    starAlertInnlogg();
    $side = 'Location: leggTilNyTilsynsrapport.php';
    logginn($side);
    ?>

	<?php
	//henter kravpunktnavn og ordningsverdi fra kravpunkter

	       	function kravpunkter(){
	       		$db = kobleOpp();
				$sqlspørring = ("SELECT DISTINCT ordingsverdi,kravpunktnavn_no
								 FROM Kravpunkter;");
				$svar = mysqli_query( $db, $sqlspørring );
				lukk($db);

		       	$rad = mysqli_fetch_assoc($svar);
		       	while ($rad) {
		       		$ordingsverdi = $rad['ordingsverdi'];
	                $kravpunktnavn_no = $rad['kravpunktnavn_no'];
	                $temaOrdingsverdi = substr($ordingsverdi,0,1).'_'.substr($ordingsverdi,2,3);
	                echo"
	                <tr>
	                	<td>$ordingsverdi:</td>
		    			<td>$kravpunktnavn_no:</td>
		    			<td>
			    			<select class='karakter' name='karakter$temaOrdingsverdi'>
					    		<option value='0'>0</option>
					    		<option value='1'>1</option>
					    		<option value='2'>2</option>
					    		<option value='3'>3</option>
					    		<option value='4'>4</option>
					    		<option value='5'>5</option>
			  				</select>
		  				</td>
		    			<td><input type='text' name='beskrivelse$temaOrdingsverdi' style='width: 100%;'></td>
		  			</tr>
		  			";
	                $rad= mysqli_fetch_assoc($svar);

	       		}
	       }

	?>

	<div class="container">
    	<div class="jumbotron">
      		<h1 class="text-center">Tilsynsrapport</h1>
    	</div>
  	</div>

  	<div class="container">
    	<div class="page-header"> <h2>bedrift...</h2> </div>
		<div class="table-responsive">
			
			<form method="POST" action="registrerTilsynsraport.php">
				<div class="col-xs-4">
					<table class="table">
						<thead>
							<th></th>
							<th></th>
						</thead>
						<tbody>
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
			  			</tbody>
			  		</table>
		  		</div>	
		  		<table class="table">
		  				<thead>
		  					<th class="col-xs-1">#</th>
		  					<th class="col-xs-5">Kravpunkt</th>
		  					<th class="col-xs-1">Karakter</th>
		  					<th class="col-xs-5">Komentar</th>
		  				</thead>
		  				<tbody>
							<?php kravpunkter(); ?>
							<tr>
				    			<td></td>
				    			<td></td>
				  				<td>Status:</td>    
				  				<td> 
				  					<select name="status">
							    		<option value="0">utestående avvik finnes</option>
							    		<option value="1">alle avvik lukket</option>
					  				</select>

					  				<input type="submit" name="submit" class="pull-right" >	
				  				</td>
				  			</tr>
		  				</tbody>
		  		</table>
		  	</form>
  		</div>
	</div>

	<script type="text/javascript">
		var karakter = document.getElementsByClassName("karakter");
		for (var i = karakter.length - 1; i >= 0; i--) {
			karakter[i].addEventListener("change", sjekkForm);
		}
		function sjekkForm(){
        		if (this.value ==5) {
                    var tekstfelt = this.parentElement.nextElementSibling.firstChild;
                    tekstfelt.value = "Ikke vurdert";
        			return false;
        		}
        		if (this.value ==4) {
                    var tekstfelt = this.parentElement.nextElementSibling.firstChild;
                    tekstfelt.value = "Ikke aktuelt";
        			return false;
        		}	
        	}	
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>