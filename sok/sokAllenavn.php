<?php
require_once '../div/database.php';
$db = kobleOpp();
$sql="SELECT orgnummer, upper(navn) as navnOpp,navn, tilsynsobjektid from Restauranter order by navn";
$resultat = mysqli_query($db, $sql);
$alleNavn = $resultat->fetch_all(MYSQLI_ASSOC);
$inNav = $_GET['inNavn'];
		
	foreach ($alleNavn as $nav) {
		$pos = strpos($nav['navnOpp'], $inNav);
			if($pos!==false){
				if($pos==0)
					
					echo "<li>";
					$side = '/restaurantVisning/restaurant.php?res=' . $nav['tilsynsobjektid']; 
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