<?php
session_start();
$sideSkalJegTil = $_SESSION['sideJegSkalTil'];
unset($_SESSION['loggetInn']);
unset($_SESSION['altertFeilInnLogg']);
unset($_SESSION['brukernavn']);
unset($_SESSION['altertFeilInnLogg']);
unset($_SESSION['bruker']);
header($sideSkalJegTil);
?>