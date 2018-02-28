<?php

// Oppkoblingsparametre (konstanter)
define("TJENER",  "itfag.usn.no");
define("BRUKER",  "v18u125");
define("PASSORD", "pw125");
define("DB",      "v18db125");

// Etablerer forbindelse til databasen
function kobleOpp() {
    $dblink = mysqli_connect(TJENER, BRUKER, PASSORD, DB);
    if (!$dblink) {
        die('Klarte ikke å koble til databasen: ' . mysql_error($dblink));
    }
    mysqli_set_charset($dblink, 'utf8');
    return $dblink;
}

// Lukker forbindelsen til databasen
function lukk($dblink) {
    mysqli_close($dblink);
}

?>