geolocationSupport();
function sjekkForm(){
    var orgInnhold = document.getElementById("sokeFelt").value;
    if (document.getElementById("orgnr").checked && orgInnhold =="") {
        alert("Du må fylle inn organisasjonsnummer");
        return false;
    }
}

function katKlikk(){
    if (document.getElementById("kategoriCheckbox").checked) {
        document.getElementById("italiensk").disabled = false;
        document.getElementById("indisk").disabled = false;
        document.getElementById("kinesisk").disabled = false;
        document.getElementById("asiatisk").disabled = false;
        document.getElementById("burger").disabled = false;
    }
    else{
        document.getElementById("italiensk").checked = false;
        document.getElementById("indisk").checked = false;
        document.getElementById("kinesisk").checked = false;
        document.getElementById("asiatisk").checked = false;
        document.getElementById("burger").checked = false;
        document.getElementById("italiensk").disabled = true;
        document.getElementById("indisk").disabled = true;
        document.getElementById("kinesisk").disabled = true;
        document.getElementById("asiatisk").disabled = true;
        document.getElementById("burger").disabled = true;
    }
}

function orgKlikk(){
    if(document.getElementById("orgnr").checked) {
        document.getElementById("adresseLabel").hidden = false; 
        document.getElementById("adresseLabel").innerHTML = "Organisasjonsnummer:";
        document.getElementById("sokeFelt").pattern = "[0-9]{9}";
        document.getElementById("sokeFelt").title = "Et organisasjonsnummer består av 9 siffer";
        document.getElementById("adresse").checked = false;
        document.getElementById("restaurant").checked = false;
        document.getElementById("sokeFelt").placeholder="Søk på orgnummer";
        document.getElementById("sokeFelt").hidden = false;
        document.getElementById("poststedLabel").hidden = true;
        document.getElementById("poststedInput").hidden = true;
        document.getElementById("geolokasjon").checked = false;
        document.getElementById("kategoriCheckbox").checked = false;
        document.getElementById("spisestedSokefelt").value = "";
        document.getElementById("spisestedLabel").hidden = true;
        document.getElementById("spisestedSokefelt").hidden = true;
        katKlikk();
    }
    else{
        document.getElementById("adresseLabel").hidden = true; 
        document.getElementById("adresseLabel").innerHTML = "Organisasjonsnummer:"; 
        document.getElementById("sokeFelt").placeholder="Spisested";
        document.getElementById("sokeFelt").value = "";
        document.getElementById("sokeFelt").hidden = true;
        document.getElementById("sokeFelt").removeAttribute("pattern");
        document.getElementById("sokeFelt").removeAttribute("title");
        katKlikk();
    }

}

function adresseKlikk(){
    if(document.getElementById("adresse").checked) {
        document.getElementById("orgnr").checked = false;
        document.getElementById("sokeFelt").placeholder="Adresse";
        document.getElementById("sokeFelt").hidden = false;
        document.getElementById("poststedLabel").hidden = false;
        document.getElementById("adresseLabel").hidden = false;
        document.getElementById("adresseLabel").innerHTML = "Adresse";
        document.getElementById("poststedInput").hidden = false;
        document.getElementById("geolokasjon").checked = false;
    }else{
        document.getElementById("sokeFelt").placeholder="Spisested";
        document.getElementById("poststedLabel").hidden = true;
        document.getElementById("poststedInput").hidden = true;
        document.getElementById("sokeFelt").hidden = true;
        document.getElementById("sokeFelt").value = "";
        document.getElementById("poststedInput").value = "";
        document.getElementById("adresseLabel").hidden = true;
    }
}

function restaurantKlikk(){
    if(document.getElementById("restaurant").checked) {
        document.getElementById("orgnr").checked = false;
        document.getElementById("spisestedLabel").hidden = false;
        document.getElementById("spisestedSokefelt").hidden = false;
        document.getElementById("spisestedSokefelt").placeholder="Spisested";
        document.getElementById("geolokasjon").checked = false;
    }
    else{
        document.getElementById("spisestedSokefelt").value = "";
        document.getElementById("spisestedLabel").hidden = true;
        document.getElementById("spisestedSokefelt").hidden = true;
        
    }
}

function geoKlikk() {
        document.getElementById("orgnr").checked = false;
        document.getElementById("adresse").checked = false;
        document.getElementById("restaurant").checked = false;
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
}

function getLocation() {
    navigator.geolocation.getCurrentPosition(showPosition, error);
}

function showPosition(position) {
    latitude.value = position.coords.latitude; 
    longitude.value = position.coords.longitude;
}

function error() {
    sessionStorage.geoSupport = false;
    alert("Kunne ikke hente geolokasjonen din");
    document.getElementById("geolokasjon").checked = false;
    document.getElementById("geolokasjon").hidden = true;
    document.getElementById("geolokasjonTekst").hidden = true;
    geoKlikk();
}

function geolocationSupport() {
    if (typeof sessionStorage.geoSupport === 'undefined') {
        if (navigator.geolocation) {
            sessionStorage.geoSupport = true;
        } else {
            sessionStorage.geoSupport = false;
        }
    }
    if (sessionStorage.geoSupport === 'false') {
        document.getElementById("geolokasjon").hidden = true;
        document.getElementById("geolokasjonTekst").hidden = true;
    }

}

function visOrgNr(str){
    var xmlhttp;
  
  // Blank ut listen hvis søkeordet er tomt
    if (str.length==0) {
    document.getElementById("sokeFelt").innerHTML="";

    return;
}
    if(!xmlhttp){
        document.getElementById("txtOrg").hidden=true;
        document.getElementById("dropdownDisplay").style.display="none";
    }
    // IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    
    
  
  xmlhttp.onreadystatechange=function() {
    
    if (this.readyState==4 && this.status==200) {
        document.getElementById("txtOrg").innerHTML=xmlhttp.responseText;
      
    }
  }
  if(str.length>3){
    xmlhttp.open("GET", "/sok/sokAlleOrg.php?innOrg="+str, true);
    document.getElementById("txtOrg").hidden=false;
    document.getElementById("dropdownDisplay").style.display="block";
    xmlhttp.send();
}


}
function visNavn(str){
    var xmlhttp;
    str = str.toUpperCase();

  
  // Blank ut listen hvis søkeordet er tomt
    if (str.length==0) {
    document.getElementById("spisestedSokefelt").innerHTML="";
    return;
}
    if(!xmlhttp){
        document.getElementById("txtOrg").hidden=true;
        document.getElementById("dropdownDisplay").style.display="none";
    }
    // IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    
    
  
  xmlhttp.onreadystatechange=function() {
    
    if (this.readyState==4 && this.status==200) {
        document.getElementById("txtOrg").innerHTML=xmlhttp.responseText;
      
    }
  }
  if(str.length>3){
    xmlhttp.open("GET", "/sok/sokAllenavn.php?inNavn="+str, true);
    if(xmlhttp){
    document.getElementById("txtOrg").hidden=false;
    document.getElementById("dropdownDisplay").style.display="block";
}
    xmlhttp.send();
}

}

function visAjax(org){
    var test = org;
    if(document.getElementById("orgnr").checked){
        visOrgNr(test);
    } 
    else if(document.getElementById("restaurant").checked){
        visNavn(test);
    }
}
function visSøkeFelt(){
    document.getElementById("søkeFeltDiv").style.display = "block";
}
