<?php

function iNaerheten($db, $userLat, $userLong) {
    $resultat = [];
    $sql = ("SELECT * FROM Restauranter WHERE latitude IS NOT NULL;");
    $result = mysqli_query($db, $sql);

    while ($rad = mysqli_fetch_assoc($result)) {
        $latitude = $rad['latitude'];
        $longitude = $rad['longitude'];
        $distanse = distanse($userLat, $userLong, $latitude, $longitude);
        echo $distanse;
        if ($distanse < 5) {
            $resultat[] = $rad;
        }
    }
    return $resultat;
}

function distanse($userLat, $userLong, $resturantLat, $resturantLong) {
    $x = 69.1 * ($resturantLat-$userLat);
    $y = 69.1 * ($resturantLong-$userLong) * cos(($userLat/57.3));
    $distanseMiles = sqrt(pow($x , 2) + pow($y , 2));
    $distanseKilometer = $distanseMiles*1.609344;
    return $distanseKilometer;
}

?>