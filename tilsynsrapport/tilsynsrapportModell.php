<?php
session_start();
$dato = $_SESSION['dato'];

function kravpunkter() {
    $kravpunkter = $_SESSION['kravpunkter'];
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