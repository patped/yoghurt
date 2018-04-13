<?php

function tilsynsbesoektype($tilsynsbesoektype) {
    if($tilsynsbesoektype == 0) {
        echo "<option value='0' selected disabled hidden>Ordinært</option>";
    } else if ($tilsynsbesoektype == 1) {
        echo "<option value='1' selected disabled hidden>Oppfølgings-tilsyn</option>";
    }
}

function status($status) {
    if ($status == 0) {
        echo "<option value='0' selected disabled hidden>utestående avvik finnes</option>";
    } else if ($status == 1) {
        echo "<option value='1' selected disabled hidden>alle avvik lukket</option>";
    }
}

function kravpunkter($tilsynsrapport, $tilsynid){
    $kravpunkter = $tilsynsrapport->kravpunkter;
    foreach ($kravpunkter as $kravpunkt) {
        $ordingsverdi = $kravpunkt->ordningsverdi;
        $kravpunktnavn_no = $kravpunkt->kravpunktnavn;
        $karakter = $kravpunkt->karakter;
        $tekst_no = $kravpunkt->tekst;
        
        $temaOrdingsverdi = substr($ordingsverdi,0,1).'_'.substr($ordingsverdi,2,2);
        echo (
            "<tr>
                <td>$ordingsverdi:</td>
                <td>$kravpunktnavn_no:</td>
                <td>
                    <select class='karakter' name='karakter$temaOrdingsverdi'>"
        );
        if ($tilsynid) {
            echo "      <option value='$karakter' selected disabled hidden>$karakter</option>";
        }
        echo (
                        "<option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                    </select>
                </td>
                <td><input class='xssKontroll' type='text' name='beskrivelse$temaOrdingsverdi' style='width: 100%;' value = '$tekst_no'></td>
            </tr>"
        );
    }
}

?>