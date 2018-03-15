<?php
require_once "../database.php";

// Funksjoner
function hentTemaer() {
    $sql = (
        "SELECT DISTINCT `tema1_no`, `tema2_no`, `tema3_no`, `tema4_no` 
        FROM `Tilsynsrapporter` 
        WHERE `tema1_no` IS NOT NULL 
        AND  `tema2_no` IS NOT NULL 
        AND `tema3_no`  IS NOT NULL 
        AND `tema4_no` IS NOT NULL"
    );
    $db = kobleOpp();
    $svar = mysqli_query($db, $sql);
    lukk($db);
    $rad = mysqli_fetch_assoc($svar);
    if ($rad) {
        //TODO!
    } else {
        echo "OBS! Det skjedde en feil!";
    }
}

function hentKravpunkter() {
    $tilsynid = $_GET['tilsynid'];
    $sql = (
        "SELECT `ordingsverdi`, `kravpunktnavn_no`, `karakter`, `tekst_no` 
        FROM `Kravpunkter` 
        WHERE `tilsynid` LIKE '$tilsynid'"
    );
    $db = kobleOpp();
    $svar = mysqli_query($db, $sql);
    lukk($db);
    $kravpunkter = $svar->fetch_all(MYSQLI_ASSOC);
    if ($kravpunkter) {
        return $kravpunkter;
    } else {
        echo "OBS! Det skjedde en feil!";
    }
}

function hentDato() {
    return $_GET['dato'];
}
?>