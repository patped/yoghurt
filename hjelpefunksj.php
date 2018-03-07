<?php 



function logginn($dblink,$nr,$pass){
    $ok = false;
    $sql = "SELECT * FROM
    BrukerDatabase WHERE BrukerID = $nr";
    $res = mysqli_query($dblink, $sql);
    $antall = mysqli_num_rows($res);
    if($antall==1){
        $ret = mysqli_fetch_assoc($res);
        $kryptert = $ret['Passord'];
    }
    else if($antall==0){
        echo "finner ikke bruker";
        return false;
    }

    if($pass == $kryptert){
        $_SESSION['BrukerID'] = $ret['BrukerID'];
        $_SESSION['fornavn'] = $ret['fornavn'];
        $_SESSION['etternavn'] = $ret['etternavn'];
        $_SESSION['adm'] = $ret['adminrettighet'];
        return true;
    }
    return false;
}
function sjekkInnLogg(){
    if($_SESSION['loggetInn']==true){
        echo<<< EOT
        <div class="loginn">
        <<form method="POST" action="loggut.php">
            <input type="submit" name="Logg Ut" value="Logg ut">

    </div>
EOT;
    }
    else{
        echo<<< EOT
    }
    <div class="loginn">
        <form method="POST" action=<?php loggUt() ?>>
        <input type="text" name="bruker" id="Brukernavn"  style="width: 75px; height: 15px">
        <br>
        <input type="password" name="passord" id="pass"
        style="width: 75px; height: 15px">
        <br>
        <input type="submit" name="" value="logg inn" style=" width: 65px; height: 20px">
        </form>
    </div>
EOT;
}
}

 ?>
