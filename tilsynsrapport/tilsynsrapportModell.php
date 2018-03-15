<?php
require_once "tilsynsrapportKontroller.php";

$dato = hentDato();

function kravpunkter() {
    $kravpunkter = hentKravpunkter();
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
?>