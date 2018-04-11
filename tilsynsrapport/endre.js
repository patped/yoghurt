lytterKarakter();
lytterBeskrivelse();
function lytterKarakter() {
    var karakter = document.getElementsByClassName("karakter");
    for (var i = karakter.length - 1; i >= 0; i--) {
        karakter[i].addEventListener("change", sjekkKarakter);
        sjekkKarakter.call(karakter[i]);
    }
}

function sjekkKarakter(){
    if (this.value ==5) {
        var tekstfelt = this.parentElement.nextElementSibling.firstChild;
        tekstfelt.value = "Ikke vurdert";
        tekstfelt.disabled = true;
        return false;
    } else if (this.value ==4) {
        var tekstfelt = this.parentElement.nextElementSibling.firstChild;
        tekstfelt.value = "Ikke aktuelt";
        tekstfelt.disabled = true;
        return false;
    } else {
        var tekstfelt = this.parentElement.nextElementSibling.firstChild;
        tekstfelt.disabled = false;
        return false;
    }
}

function lytterBeskrivelse() {
    var karakter = document.getElementsByClassName("Beskrivelse");
    for (var i = karakter.length - 1; i >= 0; i--) {
        karakter[i].addEventListener('focusout', xssKontroll);
    }
}

function xssKontroll(){
    var str = this.value;
    var length = this.value.length
    var re = new RegExp('[<>$&@\^]');
    var string ="Dette er tegn vi ikke tilater: ";
    for(i =0;i<length;i++){
        var char = str.substr(i,1);
        if(re.test(char)){
            string +=char;
        }
    }
    if(string.length>31){
        alert(""+string);   
    }
}
