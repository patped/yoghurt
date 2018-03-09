<?php
function distanse($resturantLat, $resturantLong) {
    $userLat = $_POST['lat'];
    $userLong = $_POST['long'];
    echo "lat $userLat <br>";
    echo "long $userLong <br>";
    $x = 69.1 * ($resturantLat-$userLat);
    echo "x = $x <br>";
    $y = 69.1 * ($resturantLong-$userLong) * cos(($userLat/57.3));
    $distanseMiles = sqrt(pow($x , 2) + pow($y , 2));
    $distanseKilometer = $distanseMiles*1.609344;
    echo $distanseKilometer;
}
?>