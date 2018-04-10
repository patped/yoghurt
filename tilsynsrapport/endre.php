<?php
session_start();
require_once '../div/session-kapring.php';
if(!$_SESSION['adminrett']) {
	header("Location: ../div/401.php");
}
require_once '../div/database.php';
require_once '../logginn/logginn.php';
require_once 'endre-modell.php';
require_once 'Tilsynsrapport.class.php';

$tilsynid = false;
$tilsynsobjektid = false;
if (isset($_GET['tilsynid'])) {
	$tilsynid = $_GET['tilsynid'];
	$tilsynsrapport = new Tilsynsrapport($tilsynid);
} else if (isset($_GET['tilsynsobjektid'])) {
	$tilsynsobjektid = $_GET['tilsynsobjektid'];
}

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
	include_once '../div/header.php';
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
    	<div class="page-header"> <h2> <?php if($tilsynid) echo $tilsynsrapport->restaurant; else if ($tilsynsobjektid) echo bedrift($tilsynsobjektid); ?> </h2> </div>
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
				    			<td>
									<input 
										type="text" 
										name="tilsynsobjektid" 
										<?php 
										if($tilsynid) 
											echo "value='$tilsynsrapport->tilsynsobjektid'";
										else if ($tilsynsobjektid) 
											echo "value='$tilsynsobjektid'";
										?>>
									</td>
				  			</tr>

				  			<tr>
				    			<td>TilsynsID:</td>
				    			<td>
									<input 
										type="text" 
										name="tilsynid" 
										<?php if($tilsynid) echo "value='$tilsynsrapport->tilsynid'"; ?>
									>
								</td>
				  			</tr>

							<tr>
				    			<td>TilsynsBesøksType:</td>
				    			<td>
					    			<select name="tilsynsbesoektype">
										<?php if($tilsynid) tilsynsbesoektype($tilsynsrapport->tilsynsbesoektype); ?>
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
										<?php if($tilsynid) {echo "value='".$tilsynsrapport->dato()."'";} ?>
									>
								</td>
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
                        <?php if($tilsynid) kravpunkter($tilsynsrapport->tilsynid); ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Status:</td>    
                            <td> 
                                <select name="status">
                                    <?php if($tilsynid) status($tilsynsrapport->status); ?>
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="endre.js"></script>
</body>
</html>