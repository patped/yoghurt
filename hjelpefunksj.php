<?php 
function logginn(){
    if(isset($_SESSION['loggetInn'])){
        if ($_SESSION['loggetInn'] == true) {
            echo<<< EOT
        <div class="loginn">
        <form method="POST" action="loggut.php">
            <input type="submit" name="Logg Ut" value="Logg ut">
            </form>
        </div>
EOT;
        }else{
        echo<<< EOT
    <div class="loginn">
        <form method="POST" action="Brukerside.php" onsubmit="return sjekkInnhold()">
        <input type="text" name="brukernavn" id="brukernavn"  style="width: 75px; height: 15px">
        <br>
        <input type="password" name="passord" id="pass" style="width: 75px; height: 15px">
        <br>
        <input type="submit" name="submit" value="logg inn" style=" width: 65px; height: 20px">
        </form>
    </div>
EOT;
}
    }else{
            echo<<< EOT
        <div class="loginn">
            <form method="POST" action="Brukerside.php" onsubmit="return sjekkInnhold()">
            <input type="text" name="brukernavn" id="brukernavn"  style="width: 75px; height: 15px">
            <br>
            <input type="password" name="passord" id="pass" style="width: 75px; height: 15px">
            <br>
            <input type="submit" name="submit" value="logg inn" style=" width: 65px; height: 20px">
            </form>
        </div>
EOT;
    }
}
function sjekkInnLogg($db, $brukernavn, $passord){

    $sqlSpørring = 
                ("SELECT b.Passord
                    FROM BrukerDatabase AS b
                    WHERE b.BrukerID = $brukernavn");
    $spørringSvar = mysqli_query($db, $sqlSpørring);
    if ($spørringSvar) {
        $passordFraBaseSvar = mysqli_fetch_assoc($spørringSvar);
    $passordFraBase = $passordFraBaseSvar['Passord'];

    if ($passordFraBase == $passord) {
        return true;
    }
    else{ return false;}
    }
    

}
 ?>
