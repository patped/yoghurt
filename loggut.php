<?php
	session_start();
	$sideSkalJegTil = $_SESSION['sideJegSkalTil'];
    $_SESSION = array();
    session_unset();
    session_destroy();
    header($sideSkalJegTil);
    ?>