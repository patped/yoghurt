<?php 
function logginn($logInBoolean){
    if($logInBoolean==true){
        echo<<< EOT
        <div class="loginn">
        <<form method="POST" action="loggut.php">
            <input type="submit" name="Logg Ut" value="Logg ut">
            </form>
    </div>
EOT;
    }
    else{
        echo<<< EOT
    <div class="loginn">
        <form method="POST" action="Brukerside.php" onsubmit="return sjekkInnhold()">
        <input type="text" name="bruker" id="brukernavn"  style="width: 75px; height: 15px">
        <br>
        <input type="password" name="passord" id="pass" style="width: 75px; height: 15px">
        <br>
        <input type="submit" name="submit" value="logg inn" style=" width: 65px; height: 20px">
        </form>
    </div>
EOT;
}
}
function sjekkInnLogg(){

    $pw = "";
    $brukernavn = "";

    if($pass == $brukernavn){
        return true;
    }
    return false;
}
 ?>
