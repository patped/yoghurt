<?php
session_start();
?>
 <?php
	include_once '../database.php';
	include_once '../hjelpefunksj.php';
	include_once 'endre-modell.php';
	$tilsynid = $_SESSION['tilsynid'];
	$tilsynsrapport = false;
	if ($tilsynid) {
		$tilsynsrapport = tilsynsrapport($tilsynid);
	}
	$tilsynsobjektid = $tilsynsrapport['tilsynsobjektid'];
	$dato = $tilsynsrapport['dato'];
	$dato = substr($dato,0,2).".".substr($dato,2,2).".".substr($dato,4,4);
	$tilsynsbesoektype = $tilsynsrapport['tilsynsbesoektype'];
	$status = $tilsynsrapport['status'];
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
	include_once '../header.php';
    starAlertInnlogg();
    $side = 'Location: /tilsynsrapport/endre.php';
	logginn($side);
    ?>
    
	<div class="container">
    	<div class="jumbotron">
      		<h1 class="text-center">Tilsynsrapport</h1>
    	</div>
  	</div>

  	<div class="container">
    	<div class="page-header"> <h2> <?php bedrift($tilsynsobjektid); ?> </h2> </div>
		<div class="table-responsive">
			<form method="POST" action="endre-kontroller.php">
				<div class="col-xs-4">
					<table class="table">
						<thead>
							<th></th>
							<th></th>
						</thead>
						<tbody>
							<tr>
				    			<td>TilsynsobjektID:</td>
				    			<td><input type="text" name="tilsynsobjektid" <?php if($tilsynsobjektid) echo "value='$tilsynsobjektid'"; ?>></td>
				  			</tr>

				  			<tr>
				    			<td>TilsynsID:</td>
				    			<td>
								<input type="text" name="tilsynid" <?php if($tilsynid) echo "value='$tilsynid'"; ?>></td>
				  			</tr>

							<tr>
				    			<td>TilsynsBesøksType:</td>
				    			<td>
					    			<select name="tilsynsbesoektype">
										<?php tilsynsbesoektype($tilsynsbesoektype); ?>
							    		<option value="0">Ordinært</option>
							    		<option value="1">oppfølgings -tilsyn</option>
					  				</select>
				  				</td>
				  			</tr>

							<tr>
				    			<td>dato:</td>
				    			<td><input type="text" name="dato" pattern="[0-3]{1}[0-9]{1}[.]{1}[0-1]{1}[0-9]{1}[.]{1}[1-9]{4}" placeholder="dd.mm.åååå" <?php if($tilsynid) {echo "value='$dato'";} ?>></td>
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
                        <?php kravpunkter($tilsynid); ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Status:</td>    
                            <td> 
                                <select name="status">
                                    <?php status($status); ?>
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
                tekstfelt.disabled = true;
                return false;
            }
            if (this.value ==4) {
                var tekstfelt = this.parentElement.nextElementSibling.firstChild;
                tekstfelt.value = "Ikke aktuelt";
                tekstfelt.disabled = true;
                return false;
            }
        }	
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>