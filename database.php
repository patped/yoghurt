<?php

// Oppkoblingsparametre (konstanter)

// brukerdatabasen
$tilsynrapportConfig=array(
    'TJENER'=>'itfag.usn.no',
    'BRUKER'=>'v18u125',
    'PASSORD'=>'pw125',
    'DB'=>'v18db125'
);

// tilsynsrapportdatabasen
$brukerConfig=array(
    'TJENER'=>'itfag.usn.no',
    'BRUKER'=>'h17u402',
    'PASSORD'=>'pw402',
    'DB'=>'h17db402'
);

// Etablerer forbindelse til databasen
function kobleOpp() {
    $tilsynrapportConfig=array(
        'TJENER'=>'itfag.usn.no',
        'BRUKER'=>'v18u125',
        'PASSORD'=>'pw125',
        'DB'=>'v18db125'
    );
    $dblink = mysqli_connect(
        $tilsynrapportConfig['TJENER'],
        $tilsynrapportConfig['BRUKER'],
        $tilsynrapportConfig['PASSORD'],
        $tilsynrapportConfig['DB']
    );
    if (!$dblink) {
        die('Klarte ikke å koble til databasen: ' . mysql_error($dblink));
    }
    mysqli_set_charset($dblink, 'utf8');
    return $dblink;
}

function leggInnBed($dblink){

}


// Lukker forbindelsen til databasen
function lukk($dblink) {
    mysqli_close($dblink);
}

?>