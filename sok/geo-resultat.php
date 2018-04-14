<?php

function iNaerheten($tabellEllerView, $db, $userLat, $userLong) {
    $resultat = [];
    //$sql = ("SELECT * FROM $tabellEllerView WHERE latitude IS NOT NULL;");
    $sql = ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer, r.latitude, r.longitude
        FROM $tabellEllerView AS r, Poststed AS p
        WHERE p.postnr = r.postnr
        AND latitude IS NOT NULL");
    $result = mysqli_query($db, $sql);


    while ($rad = mysqli_fetch_assoc($result)) {
        $latitude = $rad['latitude'];
        $longitude = $rad['longitude'];
        $distanse = distanse($userLat, $userLong, $latitude, $longitude);
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