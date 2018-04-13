<?php
require_once '../div/database.php';
$db = kobleOpp();
$sql="SELECT orgnummer, navn from Restauranter";
$resultat = mysqli_query($db, $sql);
$alleOrg = $resultat->fetch_all(MYSQLI_ASSOC);
$inOrg = $_GET['innOrg'];
		
	foreach ($alleOrg as $org) {
		$pos = strpos($org['orgnummer'], $inOrg);
			if($pos!==false){
				if($pos==0)
					
					echo "<li>";
					echo "<a href= index.php>";
					echo $org['orgnummer'];
					echo " : ";
					echo $org['navn'];
					echo "<a>";
					echo "</li>";
					
		}
		
		# code...
	}

?>