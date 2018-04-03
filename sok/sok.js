function sjekkForm(){
    var orgInnhold = document.getElementById("sokeFelt").value;
    if (document.getElementById("orgnr").checked && orgInnhold =="") {
        alert("Du må fylle inn organisasjonsnummer");
        return false;
    }
}

function orgKlikk(){
    if(document.getElementById("orgnr").checked) {
        document.getElementById("sokeFelt").pattern = "[0-9]{9}";
        document.getElementById("sokeFelt").title = "Et organisasjonsnummer består av 9 siffer"
        document.getElementById("adresse").checked = false;
        document.getElementById("restaurant").checked = false;
        document.getElementById("sokeFelt").placeholder="Søk på orgnummer";
        document.getElementById("sokeFelt").hidden = false;
        document.getElementById("poststedLabel").hidden = true;
        document.getElementById("poststedInput").hidden = true;
        document.getElementById("adresse").disabled = true;
        document.getElementById("restaurant").disabled = true;
        document.getElementById("utforSok").disabled = false;
        document.getElementById("geolokasjon").checked = false;
    }
    else{
        document.getElementById("sokeFelt").placeholder="Søk på navnet til spisested";
        document.getElementById("sokeFelt").value = "";
        document.getElementById("restaurant").disabled = false;
        document.getElementById("adresse").disabled = false;
        document.getElementById("sokeFelt").hidden = true;
        document.getElementById("utforSok").disabled = true;
        document.getElementById("sokeFelt").removeAttribute("pattern");
        document.getElementById("sokeFelt").removeAttribute("title");
    }
}

function adresseKlikk(){
    if(document.getElementById("adresse").checked) {
        document.getElementById("orgnr").checked = false;
        document.getElementById("sokeFelt").placeholder="Søk på adresse";
        document.getElementById("sokeFelt").hidden = false;
        document.getElementById("poststedLabel").hidden = false;
        document.getElementById("adresseLabel").hidden = false;
        document.getElementById("poststedInput").hidden = false;
        document.getElementById("orgnr").disabled = true;
        document.getElementById("utforSok").disabled = false;
        document.getElementById("geolokasjon").checked = false;
    }else{
        if (!document.getElementById("restaurant").checked) {
            document.getElementById("orgnr").disabled = false;
        }
        document.getElementById("sokeFelt").placeholder="Søk på navnet til spisested";
        document.getElementById("poststedLabel").hidden = true;
        document.getElementById("poststedInput").hidden = true;
        document.getElementById("sokeFelt").hidden = true;
        document.getElementById("sokeFelt").value = "";
        document.getElementById("poststedInput").value = "";
        document.getElementById("adresseLabel").hidden = true;
        if (!document.getElementById("restaurant").checked && !document.getElementById("orgnr").checked) {
            document.getElementById("utforSok").disabled = true;
        }
    }
}

function restaurantKlikk(){
    if(document.getElementById("restaurant").checked) {
        document.getElementById("orgnr").checked = false;
        document.getElementById("spisestedLabel").hidden = false;
        document.getElementById("spisestedSokefelt").hidden = false;
        document.getElementById("spisestedSokefelt").placeholder="Søk på navnet til spisested";
        document.getElementById("orgnr").disabled = true;
        document.getElementById("utforSok").disabled = false;
        document.getElementById("geolokasjon").checked = false;
    }
    else{
        if (!document.getElementById("adresse").checked) {
            document.getElementById("orgnr").disabled = false;
        }
        document.getElementById("spisestedSokefelt").value = "";
        document.getElementById("spisestedLabel").hidden = true;
        document.getElementById("spisestedSokefelt").hidden = true;
        if (!document.getElementById("adresse").checked && !document.getElementById("orgnr").checked) {
            document.getElementById("utforSok").disabled = true;
        }
        
    }
}

function geoKlikk() {
    if(document.getElementById("geolokasjon").checked) {
        document.getElementById("orgnr").checked = false;
        document.getElementById("orgnr").disabled = false;
        document.getElementById("adresse").checked = false;
        document.getElementById("adresse").disable = false;
        document.getElementById("restaurant").checked = false;
        document.getElementById("restaurant").disable = false;
        document.getElementById("utforSok").disabled = false;
        document.getElementById("spisestedSokefelt").value = "";
        document.getElementById("spisestedLabel").hidden = true;
        document.getElementById("spisestedSokefelt").hidden = true;
        document.getElementById("poststedLabel").hidden = true;
        document.getElementById("poststedInput").hidden = true;
        document.getElementById("sokeFelt").hidden = true;
        document.getElementById("sokeFelt").value = "";
        document.getElementById("poststedInput").value = "";
        document.getElementById("adresseLabel").hidden = true;
        getLocation();
    } else {
        document.getElementById("utforSok").disabled = true;
    }
    
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        lokasjon = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    latitude.value = position.coords.latitude; 
    longitude.value = position.coords.longitude;
}