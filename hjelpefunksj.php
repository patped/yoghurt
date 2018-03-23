<link rel="stylesheet" href="/stilark.css" type="text/css">
<?php 
function logginn($sideSkalJegTil){
    $_SESSION['sideJegSkalTil'] = $sideSkalJegTil;
    if(isset($_SESSION['loggetInn'])){
        if ($_SESSION['loggetInn'] == true) {
            admin();
        }else{
        loggeinn();
}
    }else{
        loggeinn();
    }
}
function sjekkInnLogg($db, $brukernavn, $passord){
    $_SESSION['brukernavn'] = $brukernavn;
    $sqlSpørring = 
                ("SELECT b.passord
                    FROM Brukere AS b
                    WHERE b.brukernavn LIKE ?");
    $stmt = mysqli_prepare($db, $sqlSpørring);
    mysqli_stmt_bind_param($stmt, 's' , $brukernavn);
    mysqli_stmt_execute($stmt);
    $spørringSvar = mysqli_stmt_get_result($stmt);
    if ($spørringSvar) {
        $passordFraBaseSvar = mysqli_fetch_assoc($spørringSvar);
        $passordFraBase = $passordFraBaseSvar['passord'];
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

function admin(){
    $bruker = $_SESSION['bruker'];
    echo<<< EOT
        <div class="loginn">
        <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">$bruker
  <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right pull-right">
        <li><a href="/leggTilBedrift.php">Legg til Bedrift</a></li>
        <li><a href="tilsynsrapport/leggTilNyTilsynsrapport.php">Legg til Tilsynsrapport</a></li>
        <form method="POST" action="/loggut.php">
            <li><input id="luBtn" type="submit" name="Logg Ut" value="Logg ut">
            </form></li>
        </ul>
        </div>
        </div>
EOT;
}
function loggeinn(){
    echo<<< EOT
        <div class="loginn">
            <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Logg Inn <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-right pull-right">
            <h4 class="mgli"> Logg inn</h4>
            <li><form method="POST" action="/Brukerside.php" onsubmit="return sjekkInnhold()"></li>
            <li><input type="text" name="brukernavn" placeholder="Brukernavn" id="sp_uname"  style="margin-top: 5px"></li>
            <input type="password" name="passord" placeholder="Passord" id="sp_ps" style="margin-top: 5px">
            <li><input id="liBtn" type="submit" name="submit" value=" Logg inn " style=" width: 80px; height: 30px"></li>
            </form>
            </ul>
        </div>
        </div>
EOT;
}

 ?>
