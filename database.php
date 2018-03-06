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
function logginn($dblink,$nr,$pass){
    $ok = false;
    $sql = "SELECT * FROM
    BrukerDatabase WHERE BrukerID = $nr";
    $res = mysqli_query($dblink, $sql);
    $antall = mysqli_num_rows($res);
    if($antall==1){
        $ret = mysqli_fetch_assoc($res);
        $kryptert = $ret['Passord'];
    }
    if($pass == $kryptert){
        $ok = true;
        $_SESSION['BrukerID'] = $ret['BrukerID'];
        $_SESSION['fornavn'] = $ret['fornavn'];
        $_SESSION['etternavn'] = $ret['etternavn'];
        $_SESSION['adm'] = $ret['adminrettighet'];

    }
    return $ok;


}
function sjekkInnlogging(){
    if(!isset($_SESSION['BrukerID'])){
        header("Location: index.php");
        return true;
}
}

function leggInnBed($dblink){

}


// Lukker forbindelsen til databasen
function lukk($dblink) {
    mysqli_close($dblink);
}

?>