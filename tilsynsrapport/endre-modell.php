<?php

function tilsynsrapport($tilsynid) {
	require_once '../database.php';
	$db = kobleOpp();
	$sql = "SELECT tilsynsobjektid, status, dato, tilsynsbesoektype FROM Tilsynsrapporter WHERE tilsynid LIKE ?;";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, 's', $tilsynid);
	mysqli_stmt_execute($stmt);
	$svar = mysqli_stmt_get_result($stmt);
	lukk($db);
	return mysqli_fetch_assoc($svar);
}

function tilsynsbesoektype($tilsynsbesoektype) {
    if($tilsynsbesoektype == 0) {
        echo "<option value='0'>Ordinært</option>";
    } else if ($tilsynsbesoektype == 1) {
        echo "<option value='1'>oppfølgings -tilsyn</option>";
    }
}

function status($status) {
    if ($status == 0) {
        echo "<option value='0'>utestående avvik finnes</option>";
    } else if ($status == 1) {
        echo "<option value='1'>alle avvik lukket</option>";
    }
}

function kravpunkter($tilsynid){
    $db = kobleOpp();
    if($tilsynid){
        $sqlspørring = ("SELECT * FROM `Kravpunkter` WHERE `tilsynid` like '$tilsynid';");
        
    }
    else{
        $sqlspørring = ("SELECT DISTINCT ordingsverdi,kravpunktnavn_no
        FROM Kravpunkter;");
    }
    
    $svar = mysqli_query( $db, $sqlspørring );
    lukk($db);
    
    $rad = mysqli_fetch_assoc($svar);
    while ($rad) {
        $ordingsverdi = $rad['ordingsverdi'];
        $kravpunktnavn_no = $rad['kravpunktnavn_no'];
        $karakter;
        $tekst_no;
        if($tilsynid){
            $karakter = $rad['karakter'];
            $tekst_no = $rad['tekst_no'];
        }
        
        $temaOrdingsverdi = substr($ordingsverdi,0,1).'_'.substr($ordingsverdi,2,3);
        echo"
        <tr>
        <td>$ordingsverdi:</td>
        <td>$kravpunktnavn_no:</td>
        <td>
        <select class='karakter' name='karakter$temaOrdingsverdi'>
        <option value='' selected disabled hidden>$karakter</option>
        <option value='0'>0</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
        </select>
        </td>
        <td><input type='text' name='beskrivelse$temaOrdingsverdi' style='width: 100%;' value = '$tekst_no'></td>
        </tr>
        ";
        $rad= mysqli_fetch_assoc($svar);
        
    }
}

function bedrift($tilsynsobjektid) {
    $sql = "SELECT navn FROM Restauranter WHERE tilsynsobjektid like '$tilsynsobjektid';";
    $db = kobleOpp();
    $svar = mysqli_query($db, $sql);
    $rad = mysqli_fetch_assoc($svar);
    $bedrift = $rad['navn'];
    echo "$bedrift";
}

?>