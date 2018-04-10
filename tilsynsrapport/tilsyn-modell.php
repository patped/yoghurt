<?php
require_once "tilsyn-kontroller.php";
require_once 'Tilsynsrapport.class.php';

$dato = hentDato();
$tilsynid = $_GET['tilsynid'];
$tilsynsrapport = new Tilsynsrapport($tilsynid);


function kravpunkter($tilsynsrapport, $ordningsverdi) {
    $kravpunkter = $tilsynsrapport->kravpunkter;
    foreach ($kravpunkter as $kravpunkt) {
        if (preg_match("/^$ordningsverdi/", $kravpunkt->ordningsverdi)) {
            echo ("
                <tr>
                    <td>$kravpunkt->ordningsverdi</td>
                    <td>$kravpunkt->kravpunktnavn</td>
                    <td>$kravpunkt->karakter</td>
                    <td>$kravpunkt->tekst</td>
                </tr>
            ");
        }
    }
}

function tilsynsrapport($tilsynsrapport) {
    $temaer = $tilsynsrapport->temaer;
    $ordningsverdi = 1;
    foreach ($temaer as $tema) {
        echo (
            "<div class='page-header'> <h3>$tema</h3> </div>
            <table class='table'>
                <thead>
                    <th class='col-xs-1'>#</th>
                    <th class='col-xs-5'>Kravpunktnavn</th>
                    <th class='col-xs-1'>Karakter</th>
                    <th class='col-xs-5'>Kommentar</th>
                </thead>
                <tbody>"
        );
        kravpunkter($tilsynsrapport, $ordningsverdi);
        echo (
                "</tbody>
            </table>"
        );    
        $ordningsverdi++;
    }
}
function adminrett($tilsynid){
    if(isset($_SESSION['adminrett']))
        if(($_SESSION['adminrett'])){
          echo <<< EOT
            <h3>ID: $tilsynid</h3><br>
            <a href='endre.php?tilsynid=$tilsynid'><button type='button'>Oppdater</button></a></h2><br>
EOT;
        }
}
?>