<?php
require_once 'div/database.php';
$db = kobleOpp();
$sql="SELECT orgnummer from Restauranter";
$resultat = mysqli_query($db, $sql);
$alleOrg = $resultat->fetch_all(MYSQLI_ASSOC);
$inOrg = $POST('innOrg');
	foreach ($alleOrg as $org) {
		print($org);
		# code...
	}

?>