lytterKontroll();

function lytterKontroll() {
    var karakter = document.getElementsByClassName("xssKontroll");
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

