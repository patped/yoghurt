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

function matTilsynetSmilefjes($karakter) {
    if ($karakter<2) {
        return '/bilder/smileys/liteSmil.png';
    } else if ($karakter>2) {
        return '/bilder/smileys/spySmil.png';
    } else {
        return '/bilder/smileys/ingenSmil.png';
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
    $matTilsynkarakter = $svarKarakter['total_karakter'];
    $karakterSisteTilsyn = $teller = 0;
    while ($svarKarakter && $teller<3) {
        $karakterSisteTilsyn = $karakterSisteTilsyn + $svarKarakter['total_karakter'];
        $teller = $teller + 1;
        $svarKarakter = mysqli_fetch_assoc($utførSpørringMedKarakter);
    }
    $karakterSisteTilsynSnitt = $karakterSisteTilsyn/$teller;
    $bilde = smilefjesBilde($karakterSisteTilsynSnitt);
    $mattilsynBilde = matTilsynetSmilefjes($matTilsynkarakter);
    /*Legger til alle resultater i en tabell*/
    echo "<tbody>";
    echo    "<tr class='clickable-link' data-href='/restaurantVisning/restaurant.php?res=$id' style='cursor:pointer'>";
    echo        "<td>$rNavn</td>";
    echo        "<td>$rAdresse</td>";
    echo        "<td>$rPoststed</td>";
    echo        "<td><img alt='smilefjes' src='$bilde' title='Yoghurts smilefjes' width= '25px' height='25px'</td>";
    echo        "<td><img alt='smilefjes' src='$mattilsynBilde' title='Mattilsynets smilefjes' width= '25px' height='25px'</td>";
    echo    "</tr>";
    echo "</tbody>";
}
function nesteForrigeSideButton($resultat, $sluttSøk, $nesteSide, $forrigeSide){
    echo "<div id='knappeDiv'>";
    if ($sluttSøk>10) {
        echo "<a href='$forrigeSide'><button type='button' id='bakoverKnapp' class='btn btn-primary'>10 forrige resultater</button></a>";
    }
    if (count($resultat) > $sluttSøk) {
        echo "<a href='$nesteSide'><button type='button' id='fremoverKnapp' class='btn btn-primary'>10 neste resultater</button></a>";
    }
    echo"</div>";
    
}
function sok() { // Setter en timer på id='sokeFelt' og d='spisestedSokefelt' fordi vi ellers ikke rekker å klikker på linken
    echo (
        "<form action='/sok/sokeresultat.php?start=0' id='heleSokeTabellForm' method='POST' onsubmit='return sjekkForm()'>
            <table id='sokeValg' class='table-padding'>
                <input type='hidden' name='latitude' id='latitude' value=''>
                <input type='hidden' name='longitude' id='longitude' value=''>
                <tr>
                    <td>
                        <input type='hidden' name='latitude' id='latitude' value=''>
                        <input type='hidden' name='longitude' id='longitude' value=''>
                    </td>
                </tr>
                <tr>
                    <td><label><input type='checkbox' onclick='orgKlikk()' name='orgnr' id='orgnr' value=''>Søk på organisasjonsnummer</label></td>
                    <td><label><input type='checkbox' onclick='adresseKlikk()' name='adresse' id='adresse' value=''>Søk på adresse eller poststed</label></td>
                    <td><label><input type='checkbox' onclick='restaurantKlikk()' name='restaurant' id='restaurant' value=''>Søk på spisested</label></td>
                    <td><label id='geolokasjonTekst'><input type='checkbox' onclick='geoKlikk()' name='geolokasjon' id='geolokasjon' value=''>Søk på spisested i nærheten</label></td>
                </tr> 
                <tr>
                    <td colspan='4'><input type='checkbox' onclick='katKlikk()' name='kategoriCheckbox' id='kategoriCheckbox'> 
                    <label for='kategoriCheckbox'>Velg kategori </label></td>
                </tr> 
            </table>

            <table id='kategoriValg' class='table-padding'>
                <tr>
                    <td><input type='radio' disabled name='kategori' id='italiensk' value='Italiensk' hidden=''> 
                    <label id='italienskL' hidden=''>Italiensk</label></td>
 
                    <td><input type='radio' disabled name='kategori' id='indisk' value='Indisk' hidden=''> 
                    <label id='indiskL' hidden=''>Indisk</label> </td>
         
                    <td><input type='radio' disabled name='kategori' id='kinesisk' value='Kinesisk' hidden=''> 
                    <label id='kinesiskL' hidden=''>Kinesisk</label> </td>
         
                    <td><input type='radio' disabled name='kategori' id='asiatisk' value='Annen Asiatisk' hidden=''> 
                    <label id='asiatiskL' hidden=''>Annen Asiatisk</label> </td>
         
                    <td><input type='radio' disabled name='kategori' id='burger' value='Burger og Kebab' hidden=''> 
                    <label id='burgerL' hidden=''>Burger og Kebab</label> </td>
                </tr>
            </table>
            <table id='sokefeltOgLabels' class='table-padding'>
                <div class='dropdown'>
                    <tr>
                        <td><label hidden='' id='spisestedLabel'>Spisested: </label></td>
                        <td><input type='text' id='spisestedSokefelt' name='spisestedSokefelt' placeholder='Søk på navnet til spisested' onkeyup = 'visAjax(this.value)'onfocusout='setTimeout(fjernResultater, 200)'; hidden=''></td>
                    </tr>
                    <tr>
                        <td><label hidden='' id='adresseLabel'>Adresse: </label><td>
                            <input type='text' id='sokeFelt' name='Søkefelt' placeholder='Søk på navnet til spisested' hidden='' onkeyup= 'visAjax(this.value)' onfocusout='setTimeout(fjernResultater, 200)';>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' style='padding: 0'>
                            <div class='dropdown-content' id='dropdownDisplay' style='display:none'>
                            <ul id='txtOrgUl'><p id='txtOrg'></p></ul>
                        </td>
                    </tr>

                </div>
                <tr>
                    <td><label hidden='' id='poststedLabel'>Poststed: </label></td>
                    <td><input type='text' id='poststedInput' name='poststedInput' placeholder='Poststed' hidden=''><br></td>
                </tr>
                <tr id='sokeKnappTr'>
                    <td id='sokeKnappTd' colspan='2'><input type='submit' id='utforSok' name='søkeKnapp' value='Utfør søk' disabled></td>
                </tr>
            </table>

        </form>"
    );
}
?>