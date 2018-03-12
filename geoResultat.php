<?php
function distanse($resturantLat, $resturantLong) {
    $userLat = $_POST['lat'];
    $userLong = $_POST['long'];
    $x = 69.1 * ($resturantLat-$userLat);
    $y = 69.1 * ($resturantLong-$userLong) * cos(($userLat/57.3));
    $distanseMiles = sqrt(pow($x , 2) + pow($y , 2));
    $distanseKilometer = $distanseMiles*1.609344;
}
?>