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
    }
    return password_verify($passord, $passordFraBase);
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

    if (isset($_SESSION['adminrett']) && $_SESSION['adminrett'] == false) {
        unset($_SESSION['adminrett']);
        echo '<script language="javascript">';
        echo 'alert("Du har ikke administratorrettigheter dette kan være fordi datoen har utløpt. Kontakt admin")';
        echo '</script>';
    }
    
}

function admin(){
    $bruker = $_SESSION['bruker'];
    echo<<< EOT
        <div id="logginn">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">$bruker<span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right pull-right">
                    <li><a href="/admin/ny-bedrift.php">Legg til bedrift</a></li>
                    <li><a href="/tilsynsrapport/endre.php">Legg til tilynsrapport</a></li>
                    <li><a href="/admin/ny-bruker.php">Legg til ny bruker</a></li>
                    <li><button type='button' class='btn btn-primary' id='loggUtKnapp' onclick="window.location.href='/logginn/loggut.php'">Logg Ut</button></li>
                </ul>
            </div>
        </div>
EOT;
}

function loggeinn(){
    echo<<< EOT
        <div id="logginn">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Logg inn <span class="caret"></span></button>
                <div class="dropdown-menu dropdown-menu-right pull-right ">
                    <p class="text-center">Logg inn</p>
                    <form method="POST" action="/logginn/logginn-landingside.php" onsubmit="return sjekkInnhold()">
                        <input class="centerLgIn" type="text" name="brukernavn" placeholder="Brukernavn" id="brukernavn"  style="margin-top: 5px">
                        <input class="centerLgIn" type="password" name="passord" placeholder="Passord" id="pass" style="margin-top: 5px">
                        <input id="liBtn" type="submit" name="submit" value=" Logg inn " style=" width: 80px; height: 30px">
                    </form>
                </div>
            </div>
        </div>
EOT;
}

?>