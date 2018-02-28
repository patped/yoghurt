<?php

// Oppkoblingsparametre (konstanter)

// brukerdatabasen
$brukerConfig=array(
    'TJENER'=>'itfag.usn.no',
    'BRUKER'=>'v18u125',
    'PASSORD'=>'pw125',
    'DB'=>'v18db125'
);

// tilsynsrapportdatabasen
$tilsynrapportConfig=array(
    'TJENER'=>'itfag.usn.no',
    'BRUKER'=>'h17u402',
    'PASSORD'=>'pw402',
    'DB'=>'h17db402'
);

// Etablerer forbindelse til databasen
function kobleOpp($config) {
    $dblink = mysqli_connect(
        $config['TJENER'],
        $config['BRUKER'],
        $config['PASSORD'],
        $config['DB']
    );
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