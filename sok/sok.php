<?php
function finnKategori(){
    if (isset($_POST["kategori"])) {
        return $_POST["kategori"];
    }
    return;
}
function finnTabellEllerView($kat){
    switch ($kat) {
        case 'Italiensk':
            return 'katItalia';
            break;
        case 'Indisk':
            return 'katIndia';
            break;
        case 'Kinesisk':
            return 'katKina';
            break;
        case 'Annen Asiatisk':
            return 'katAsia';
            break;
        case 'Burger og Kebab':
            return 'katBurger';
            break;      
        default:
            return 'Restauranter';
            break;
    }
}
function hentOrgSpørring($tabellEllerView){
    return  ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
            FROM $tabellEllerView AS r, Poststed AS p
            WHERE p.postnr = r.postnr
            AND r.orgnummer LIKE ?
            ORDER BY r.navn");
}
function hentAdresseSpisestedSpørring($tabellEllerView){
    return  ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
            FROM $tabellEllerView AS r, Poststed AS p
            WHERE p.postnr = r.postnr
            AND p.poststed LIKE ?
            AND r.adrlinje1 LIKE ?
            AND r.navn LIKE ?
            ORDER BY r.navn");
}
function hentAdresseSpørring($tabellEllerView){
    return  ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
            FROM $tabellEllerView AS r, Poststed AS p
            WHERE p.postnr = r.postnr
            AND p.poststed LIKE ?
            AND r.adrlinje1 LIKE ?
            ORDER BY r.navn");
}
function hentSpisestedSpørring($tabellEllerView){
    return  ("SELECT r.tilsynsobjektid, r.navn, r.adrlinje1, r.postnr, p.poststed, r.orgnummer
            FROM $tabellEllerView AS r, Poststed AS p
            WHERE p.postnr = r.postnr
            AND r.navn LIKE ?
            ORDER BY r.navn");
}
function hentKarakterSpørring($id){
    return ("SELECT t.total_karakter FROM
            Tilsynsrapporter AS t
            WHERE t.tilsynsobjektid LIKE '$id'
            ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC");
}
function smilefjesBilde($karakterSisteTilsynSnitt){
    if ($karakterSisteTilsynSnitt<0.5) {
        return '/bilder/smileys/storSmil.png';
    }else if ($karakterSisteTilsynSnitt<=1) {
        return '/bilder/smileys/liteSmil.png';
    }else if ($karakterSisteTilsynSnitt<=1.5) {
        return '/bilder/smileys/ingenSmil.png';
    }else{
        return '/bilder/smileys/spySmil.png';
    }
}

function skrivUtSøkeresultat($rad, $db){
    $id = $rad['tilsynsobjektid'];
    $rNavn = $rad['navn'];
    $rAdresse = $rad['adrlinje1'];
    $rPoststed = $rad['poststed'];
    $orgnummer = $rad['orgnummer'];
    //Trenger ikke hindre SQL-injection her, ettersom det er hindret på laget over, der vi henter '$id' fra.
    //Du kommer ikke inn i denne spørringen om du ikke har mottatt et resultat som har count>0. 
    $sqlSpørringHenteKarakter = hentKarakterSpørring($id);
    $utførSpørringMedKarakter = mysqli_query($db, $sqlSpørringHenteKarakter);
    $svarKarakter = mysqli_fetch_assoc($utførSpørringMedKarakter);
    $karakterSisteTilsyn = $teller = 0;
    while ($svarKarakter && $teller<3) {
    $karakterSisteTilsyn = $karakterSisteTilsyn + $svarKarakter['total_karakter'];
    $teller = $teller + 1;
    $svarKarakter = mysqli_fetch_assoc($utførSpørringMedKarakter);
    }
    $karakterSisteTilsynSnitt = $karakterSisteTilsyn/$teller;
    $bilde = smilefjesBilde($karakterSisteTilsynSnitt);
    /*Legger til alle resultater i en tabell*/
    echo "<tbody>";
    echo    "<tr class='clickable-link' data-href='/restaurantVisning/restaurant.php?res=$id' style='cursor:pointer'>";
    echo        "<td>$rNavn</td>";
    echo        "<td>$rAdresse</td>";
    echo        "<td>$rPoststed</td>";
    echo        "<td><img id ='karakterSmil' src='$bilde' title='smilefjes' width= '25px' height='25px'</td>";
    echo    "</tr>";
    echo "</tbody>";
}
function nesteForrigeSideButton($resultat, $sluttSøk, $nesteSide, $forrigeSide){
    echo "<div id='knappeDiv'>";
    if ($sluttSøk>10) {
        echo "<a href='$forrigeSide'><button type='button' id='bakoverKnapp' class='btn btn-primary'>10 forrige resultater</button></a>";
    }
    echo "<a href='$nesteSide'><button type='button' id='fremoverKnapp' class='btn btn-primary'>10 neste resultater</button></a></div>";
}
function sok() {
    echo (
        "<form action='/sok/sokeresultat.php?start=0' method='POST' onsubmit='return sjekkForm()'>
            <label><input type='checkbox' onclick='orgKlikk()' name='orgnr' id='orgnr' value=''>Søk på organisasjonsnummer</label>
            <label><input type='checkbox' onclick='adresseKlikk()' name='adresse' id='adresse' value=''>Søk på adresse</label>
            <label><input type='checkbox' onclick='restaurantKlikk()' name='restaurant' id='restaurant' value=''>Søk på spisested</label>
            <label id='geolokasjonTekst'><input type='checkbox' onclick='geoKlikk()' name='geolokasjon' id='geolokasjon' value=''>Søk på spisested i nærheten</label>
            <input type='hidden' name='latitude' id='latitude' value=''>
            <input type='hidden' name='longitude' id='longitude' value=''>
            <br>
            <label for='kategoriCheckbox'>Velge kategori? </label><input type='checkbox' onclick='katKlikk()' name='kategoriCheckbox' id='kategoriCheckbox'>
            <br>
            <input type='radio' disabled='true' name='kategori' id='italiensk' value='Italiensk'>Italiensk
            <input type='radio' disabled='true' name='kategori' id='indisk' value='Indisk'>Indisk
            <input type='radio' disabled='true' name='kategori' id='kinesisk' value='Kinesisk'>Kinesisk
            <input type='radio' disabled='true' name='kategori' id='asiatisk' value='Annen Asiatisk'>Annen Asiatisk
            <input type='radio' disabled='true' name='kategori' id='burger' value='Burger og Kebab'>Burger og Kebab
            <br>
            <label hidden='true' id='spisestedLabel'>Navn på spisested: </label><input type='text' id='spisestedSokefelt' name='spisestedSokefelt' value='' placeholder='Søk på navnet til spisested' hidden='true'>
            <br>
            <label hidden='true' id='spisestedLabel'>Navn på spisested: </label><input type='text' id='spisestedSokefelt' name='spisestedSokefelt' value='' placeholder='Søk på navnet til spisested' onkeyup = 'visAjax(this.value)'; hidden='true'>
            <br>
            <label hidden='true' id='adresseLabel'>Adresse: </label><input type='text' id='sokeFelt' name='Søkefelt' value='' placeholder='Søk på navnet til spisested' hidden='true' onkeyup= 'visAjax(this.value)';>
            <p id='txtOrg'></p>
            <br>
            <label hidden='true' id='poststedLabel'>Poststed: </label><input type='text' id='poststedInput' name='poststedInput' value='' placeholder='Poststed' hidden='true'><br>
            <input type='submit' id='utforSok' name='søkeKnapp' value='Utfør søk' disabled='true'>
        </form>"
    );
}
?>