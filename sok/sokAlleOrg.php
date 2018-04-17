<?php
require_once '../div/database.php';
$db = kobleOpp();
$sql="SELECT orgnummer, navn, tilsynsobjektid from Restauranter";
$resultat = mysqli_query($db, $sql);
$alleOrg = $resultat->fetch_all(MYSQLI_ASSOC);
$inOrg = $_GET['innOrg'];
$teller = 0;
	foreach ($alleOrg as $org) {
				$pos = strpos($org['orgnummer'], $inOrg);
			if($pos!==false){
				$teller++;
			}
				
			}
	if($teller==0){
		echo "<p>Ingen resultater i Orgnummer</p>";
	}

	else{				
		foreach ($alleOrg as $org) {
			$pos = strpos($org['orgnummer'], $inOrg);
				if($pos!==false){
					if($pos==0){
						
						echo "<li>";
						$side = '/restaurantVisning/restaurant.php?res=' . $org['tilsynsobjektid']; 
						echo "<a href=" . $side;
						echo ">";
						echo $org['orgnummer'];
						echo " : ";
						echo $org['navn'];
						echo "</a>";
						echo "</li>";
					
		}
		}
	}
	}

?>