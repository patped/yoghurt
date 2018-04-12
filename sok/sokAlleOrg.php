<?php
require_once 'div/database.php';
$db = kobleOpp();
$sql="SELECT orgnummer from Restauranter";
$resultat = mysqli_query($db, $sql);
$alleOrg = $resultat->fetch_all(MYSQLI_ASSOC);
$inOrg = $_POST('innOrg');
	foreach ($alleOrg as $org) {
		$pos = strpos($postnr, $inOrg);
		if($pos!==false){
			if($pos==0)
				print($org['orgnummer']);
		}
		
		# code...
	}

?>