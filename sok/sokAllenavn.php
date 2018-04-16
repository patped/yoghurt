<?php
require_once '../div/database.php';
$db = kobleOpp();
$sql="SELECT orgnummer, navn, tilsynsobjektid from Restauranter";
$resultat = mysqli_query($db, $sql);
$alleNavn = $resultat->fetch_all(MYSQLI_ASSOC);
$inNav = $_GET['inNavn'];
		
	foreach ($alleNavn as $nav) {
		$pos = strpos($nav['navn'], $inNav);
			if($pos!==false){
				if($pos==0)
					
					echo "<li>";
					$side = '/restaurant.php?res=' . $nav['tilsynsobjektid']; 
					echo "<a href=" . $side;
					echo ">";
					echo $nav['navn'];
					echo " : ";
					echo $nav['orgnummer'];
					echo "</a>";
					echo "</li>";
					echo "<br>";
					
		}
		
		# code...
	}

?>