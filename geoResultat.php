<?php
require_once 'database.php';

$db = kobleOpp($tilsynrapportConfig);
$status = mysqli_set_charset($db, "utf8");
$sql = ("SELECT * FROM Restauranter WHERE latitude IS NOT NULL;");
if ($status) {
    $result = mysqli_query($db, $sql);

    while ($rad = mysqli_fetch_assoc($result)) {
        $latitude = $rad['latitude'];
        $longitude = $rad['longitude'];
        $distanse = distanse($latitude, $longitude);
        if ($distanse < 5) {
            $navn = $rad['navn'];
            echo $navn." distanse: ".$distanse."<br>";
        }
    }
} else {
    echo "DB FEIL!";
    exit;
}


function distanse($resturantLat, $resturantLong) {
    $userLat = $_POST['lat'];
    $userLong = $_POST['long'];
    $x = 69.1 * ($resturantLat-$userLat);
    $y = 69.1 * ($resturantLong-$userLong) * cos(($userLat/57.3));
    $distanseMiles = sqrt(pow($x , 2) + pow($y , 2));
    $distanseKilometer = $distanseMiles*1.609344;
    return $distanseKilometer;
}
lukk($db);
?>