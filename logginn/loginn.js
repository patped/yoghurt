function sjekkInnhold(){
    if (document.getElementById("pass").value.length > 0 && document.getElementById("brukernavn").value.length > 0) {
        return true;
    } else {
        alert("Du har glemt å fylle ut passord eller brukernavn!")
        return false;
    }
}