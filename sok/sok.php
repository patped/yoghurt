<?php
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
            <br><br>
            <label hidden='true' id='spisestedLabel'>Navn på spisested: </label><input type='text' id='spisestedSokefelt' name='spisestedSokefelt' value='' placeholder='Søk på navnet til spisested' hidden='true'>
            <br>
            <div id='content'>
            <div id='searchfield'><label hidden='true' id='adresseLabel'>Adresse: </label><input type='text' id='sokeFelt' name='Søkefelt' value='' placeholder='Søk på navnet til spisested' onkeyup = 'visOrgnr(this.value)' hidden='true'></div>

            <div id= 'outputbox'><p id='txtOrg' hidden='true'></p></div></div>
            <label hidden='true' id='poststedLabel'>Poststed: </label><input type='text' id='poststedInput' name='poststedInput' value='' placeholder='Poststed' hidden='true'>
            <br>
            
            <input type='submit' id='utforSok' name='søkeKnapp' value='Utfør søk' disabled='true'>
        </form>"
    );
}


?>