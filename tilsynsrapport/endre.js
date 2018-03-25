settFelterDisablet();

function settFelterDisablet() {
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