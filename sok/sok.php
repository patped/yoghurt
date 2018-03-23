<?php
function sok() {
    echo (
        "<form action='/sok/sokeresultat.php?start=0' method='POST' onsubmit='return sjekkForm()'>
            <label><input type='checkbox' onclick='orgKlikk()' name='orgnr' id='orgnr' value=''>Søk på organisasjonsnummer</label>
            <label><input type='checkbox' onclick='adresseKlikk()' name='adresse' id='adresse' value=''>Søk på adresse</label>
            <label><input type='checkbox' onclick='restaurantKlikk()' name='restaurant' id='restaurant' value=''>Søk på spisested</label>
            <label><input type='checkbox' onclick='geoKlikk()' name='geolokasjon' id='geolokasjon' value=''>Søk på spisested i nærheten</label>
            <input type='hidden' name='latitude' id='latitude' value=''>
            <input type='hidden' name='longitude' id='longitude' value=''>
            <br><br>
            <label hidden='true' id='spisestedLabel'>Navn på spisested: </label><input type='text' id='spisestedSokefelt' name='spisestedSokefelt' value='' placeholder='Søk på navnet til spisested' hidden='true'>
            <br>
            <label hidden='true' id='adresseLabel'>Adresse: </label><input type='text' id='sokeFelt' name='Søkefelt' value='' placeholder='Søk på navnet til spisested' hidden='true'>
            <br>
            <label hidden='true' id='poststedLabel'>Poststed: </label><input type='text' id='poststedInput' name='poststedInput' value='' placeholder='Poststed' hidden='true'>
            <br>
            <input type='submit' id='utforSok' name='søkeKnapp' value='Utfør søk' disabled='true'>
        </form>"
    );
}
?>