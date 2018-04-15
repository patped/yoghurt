function visKarakterInfo(){

    if (document.getElementById("smileBilde").src == 'http://localhost/bilder/smileys/storSmil.png'){
        document.getElementById("hoverText").innerHTML = "Stort smil:<br>Hipp hurra! Vi anbefaler dette spisestedet på det sterkeste!"
    }
    else if (document.getElementById("smileBilde").src == 'http://localhost/bilder/smileys/liteSmil.png') {
        document.getElementById("hoverText").innerHTML = "Vanlig smil:<br>Godkjent snitt på siste tilsynsrapporter. Vi anbefaler dette spisestedet!"
    }
    else if (document.getElementById("smileBilde").src == 'http://localhost/bilder/smileys/ingenSmil.png') {
        document.getElementById("hoverText").innerHTML = "Ingen smil:<br>Vi anbefaler ikke dette spisestedet grunnet et dårlig snitt på siste tilsyn"
    }
    else if (document.getElementById("smileBilde").src == 'http://localhost/bilder/smileys/spySmil.png') {
        document.getElementById("hoverText").innerHTML = "Spysmil:<br>Vi anbefaler ikke dette spisestedet! Her er det dårlig historikk."
    }
    document.getElementById("hoverText").style.display = "block";
}
function skjulKarakterInfo(){
    document.getElementById("hoverText").style.display = "none";
}