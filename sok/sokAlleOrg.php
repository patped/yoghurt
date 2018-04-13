<?php
require_once '../div/database.php';
$db = kobleOpp();
$sql="SELECT orgnummer from Restauranter";
$resultat = mysqli_query($db, $sql);
$alleOrg = $resultat->fetch_all(MYSQLI_ASSOC);
$inOrg = $_GET['innOrg'];
		
	foreach ($alleOrg as $org) {
		$pos = strpos($org['orgnummer'], $inOrg);
			if($pos!==false){
				if($pos==0)
					echo "<li>";
					echo $org['orgnummer'];
					echo "</li>";
		}
		
		# code...
	}

?>