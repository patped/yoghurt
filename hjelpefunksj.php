<<?php 



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
    if($pass == $kryptert){
        $_SESSION['BrukerID'] = $ret['BrukerID'];
        $_SESSION['fornavn'] = $ret['fornavn'];
        $_SESSION['etternavn'] = $ret['etternavn'];
        $_SESSION['adm'] = $ret['adminrettighet'];
        $ok = true;

    }
    return false;
}
function loggUt(){
	$_SESSION["loggetInn"]=false;


 ?>}
