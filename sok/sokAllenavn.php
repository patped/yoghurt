<?php
require_once '../div/database.php';
$db = kobleOpp();
$sql="SELECT upper(navn) as navnOpp,navn, tilsynsobjektid from Restauranter order by navn";
$resultat = mysqli_query($db, $sql);
$maxRes = 10;
$alleNavn = $resultat->fetch_all(MYSQLI_ASSOC);
$inNav = $_GET['inNavn'];
$teller = 0;
	foreach ($alleNavn as $nav) {
		$pos = strpos($nav['navnOpp'], $inNav);
		if($pos!==false){
			$teller++;
		}
	}
	if($teller==0){
		echo "<p>Ingen søkeresultat</p>";
	}
	else if($teller<$maxRes){
		foreach ($alleNavn as $nav) {
			$pos = strpos($nav['navnOpp'], $inNav);
			if($pos!==false){
				if($pos==0){
					echo "<li>";
					$side = '/restaurantVisning/restaurant.php?res=' . $nav['tilsynsobjektid']; 
					echo "<a href=" . $side;
					echo ">";
					echo $nav['navn'];
					echo "</a>";
					echo "</li>";
				}
			}
		}
	}
	else{
		echo "Over ti søkeresultat";
	}
?>