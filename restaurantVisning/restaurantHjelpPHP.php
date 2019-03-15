<?php  
function restaurantSpørring(){
    return (
            "SELECT * FROM
                Restauranter AS r,
                Poststed AS p,
                Tilsynsrapporter AS t
            WHERE p.postnr = r.postnr
            AND t.tilsynsobjektid = r.tilsynsobjektid
            AND r.tilsynsobjektid
            LIKE ?
            ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC"
        );
}
function tilsynsrapportSpørring(){
    return (
            "SELECT * FROM
                Tilsynsrapporter AS t
            WHERE t.tilsynsobjektid LIKE ?
            ORDER BY MOD(t.dato, 10) DESC, MOD((t.dato/10000), 100) DESC, t.dato/1000000 DESC" 
            );
}
function bildeSnittKarakter($karakterSisteTilsynSnitt){
    if ($karakterSisteTilsynSnitt<0.5) {
         return $bilde = '../bilder/smileys/storSmil.png';
     }else if ($karakterSisteTilsynSnitt<=1) {
         return $bilde = '../bilder/smileys/liteSmil.png';
     }else if ($karakterSisteTilsynSnitt<=1.5) {
         return $bilde = '../bilder/smileys/ingenSmil.png';
     }else{
         return $bilde = '../bilder/smileys/spySmil.png';
     }
}
function mattilsynSmil($svarTilsynsrapport){
        switch ($svarTilsynsrapport['total_karakter']) {
            case '0':
                return $mattilsynetSmil = '../bilder/smileys/liteSmil.png';
                break;
            case '1':
                return $mattilsynetSmil = '../bilder/smileys/liteSmil.png';
                break;
            case '2':
                return $mattilsynetSmil = '../bilder/smileys/ingenSmil.png';
                break;
            case '3':
                return $mattilsynetSmil = '../bilder/smileys/spySmil.png';
                break;
            default:
                return  $mattilsynetSmil = '../bilder/smileys/spySmil.png';
                break;
        }
}
function tilsynsrapportAntallDagerSiden($tilsynDato){
    date_default_timezone_set('Europe/Oslo');
    $datoIDag = time();
    return floor(($datoIDag - $tilsynDato)/86400);
}
?>