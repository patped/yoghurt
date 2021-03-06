<?php
session_start();
require_once '../div/session-kapring.php';
if(!$_SESSION['loggetInn']) {
	header("Location: ../div/401.php");
}
require_once '../div/database.php';
require_once '../logginn/logginn.php';
require_once 'endre-modell.php';
require_once 'Tilsynsrapport.class.php';

$tilsynid = false;
$tilsynsobjektid = false;
if (isset($_GET['tilsynsobjektid'])) {
	$tilsynsobjektid = $_GET['tilsynsobjektid'];
	$tilsynsrapport = Tilsynsrapport::medTilsynobjektid($tilsynsobjektid);
} else if (isset($_SESSION['tilsynsrapport']) && isset($_GET['tilsynid'])) {
	$tilsynid = $_GET['tilsynid'];
	$tilsynsrapport = Tilsynsrapport::medTilsynid($tilsynid);
} else {
	$tilsynsrapport = new Tilsynsrapport();
}

?>

<!doctype html>
<html lang="no">
<head>
	<title>Endre/legg til tilsysnsrapport</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/bibloteker/bootstrap-3.3.7-dist/css/bootstrap.min.css"> 
	</head>
<body>
	<?php
	if(isset($_GET['feil'])){
		$feil = $_GET['feil'];
		echo (
			"<script>alert('$feil')</script>"
		);
	}
	include_once '../div/header.php';
    starAlertInnlogg();
    $side = 'Location: /tilsynsrapport/endre.php';
	logginn($side);
    ?>
    	
	<div class="container">
		<div class="jumbotron">
			  <h1 class="text-center">Tilsynsrapport</h1>
		</div>
		<h2 class="text-center">Fyll ut skjema</h2>
		<div class="page-header"> <h2><?php echo $tilsynsrapport->restaurant; ?> </h2> </div>
		<div class="table-responsive">
			<form method="POST" action="endre-kontroller.php">
				<div class="col-xs-4">
					<table class="table">
						<tbody>
							<tr>
				    			<td>TilsynsobjektID:</td>
				    			<td><input type="text" name="tilsynsobjektid"  pattern="[A-Za-z0-9_]+" <?php echo "value='$tilsynsrapport->tilsynsobjektid'"; ?>></td>
				  			</tr>

				  			<tr>
				    			<td>TilsynsID:</td>
				    			<td><input type="text" name="tilsynid" pattern="[A-Za-z0-9_]+" <?php echo "value='$tilsynsrapport->tilsynid'"; ?> ></td>
				  			</tr>

							<tr>
				    			<td>TilsynsBesøksType:</td>
				    			<td>
					    			<select name="tilsynsbesoektype">
										<?php tilsynsbesoektype($tilsynsrapport->tilsynsbesoektype); ?>
							    		<option value="0">Ordinært</option>
							    		<option value="1">oppfølgings -tilsyn</option>
					  				</select>
				  				</td>
				  			</tr>

							<tr>
				    			<td>Dato:</td>
				    			<td>
									<input 
										type="text" 
										name="dato" 
										pattern="[0-3]{1}[0-9]{1}[.]{1}[0-1]{1}[0-9]{1}[.]{1}[0-9]{4}" 
										placeholder="dd.mm.åååå" 
										<?php if (strlen($tilsynsrapport->dato) > 0) echo "value='".$tilsynsrapport->dato()."'"; ?>
									>
								</td>
				  			</tr>
			  			</tbody>
			  		</table>
		  		</div>	
		  		<table class="table">
                    <thead>
						<tr>
							<th class="col-xs-1">#</th>
							<th class="col-xs-5">Kravpunkt</th>
							<th class="col-xs-1">Karakter</th>
							<th class="col-xs-5">Komentar</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php kravpunkter($tilsynsrapport, $tilsynid); ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Status:</td>    
                            <td> 
                                <select name="status">
                                    <?php status($tilsynsrapport->status); ?>
                                    <option value="0">utestående avvik finnes</option>
                                    <option value="1">alle avvik lukket</option>
                                </select>

                                <input type="submit" name="submit" value="Registrer" class="pull-right" >	
                            </td>
                        </tr>
                    </tbody>
		  		</table>
		  	</form>
  		</div>
	</div>

	<?php include_once '../div/footer.php'; ?>

	<script src="/bibloteker/jquery/jquery-3.3.1.min.js"></script>
    <script src="/bibloteker/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script src="endre.js"></script>
	<script src="../div/xssKontroll.js"></script>
</body>
</html>