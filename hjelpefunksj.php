<?php 
function logginn($sideSkalJegTil){
    $_SESSION['sideJegSkalTil'] = $sideSkalJegTil;
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
        <form method="POST" action="brukerside.php" onsubmit="return sjekkInnhold()">
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
            <form method="POST" action="brukerside.php" onsubmit="return sjekkInnhold()">
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
    $_SESSION['brukernavn'] = $brukernavn;
    $sqlSpørring = 
                ("SELECT b.passord,
                    FROM Brukere AS b
                    WHERE b.brukernavn LIKE ?");
    $stmt = mysqli_prepare($db, $sqlSpørring);
    mysqli_stmt_bind_param($stmt, 's' , $brukernavn);
    mysqli_stmt_execute($stmt);
    $spørringSvar = mysqli_stmt_get_result($stmt);
    if ($spørringSvar) {
        $passordFraBaseSvar = mysqli_fetch_assoc($spørringSvar);
        $passordFraBase = $passordFraBaseSvar['passord'];
        $brukersAdminTall = $passordFraBaseSvar['adminrettighet'];
    $passordFraBruker = crypt($passord, "a1k9sg2kg $52dm2mvøa'¨213'¨11£$1dcwqegg543@€{2 sd3");

    if ($passordFraBruker == $passordFraBase) {
        return true;
    }
    return false;
    }
    

}
function starAlertInnlogg(){
    if (isset($_SESSION['loggInnAlert'])) {
            if ($_SESSION['loggInnAlert'] == true) {
                $_SESSION['loggInnAlert'] = false;
                echo '<script language="javascript">';
                echo 'alert("Du er nå logget inn som administrator på nettsiden!")';
                echo '</script>';
            }
        }
    if (isset($_SESSION['altertFeilInnLogg'])) {
    
        if ($_SESSION['altertFeilInnLogg'] == true) {
            $_SESSION['altertFeilInnLogg'] = false;
            echo '<script language="javascript">';
            echo 'alert("Du tastet feil brukernavn eller passord!")';
            echo '</script>';
        }
    }
    
}

 ?>
