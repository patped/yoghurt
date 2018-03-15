<?php
require_once "tilsynsrapportKontroller.php";

$dato = hentDato();

function tema(){

}

function kravpunkter($ordningsverdi) {
    $kravpunkter = hentKravpunkter($ordningsverdi);
    foreach ($kravpunkter as $data) {
        $ordningsverdi = $data['ordingsverdi'];
        $kravpunktnavn_no = $data['kravpunktnavn_no'];
        $karakter = $data['karakter'];
        $tekst_no = $data['tekst_no'];
        echo ("
            <tr>
                <td>$ordningsverdi</td>
                <td>$kravpunktnavn_no</td>
                <td>$karakter</td>
                <td>$tekst_no</td>
            </tr>
        ");
    }
}

function tilsynsrapport() {
    $temaer = hentTemaer();
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
        kravpunkter($ordningsverdi);
        echo (
                "</tbody>
            </table>"
        );    
        $ordningsverdi++;
    }
}
?>