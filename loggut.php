<?php
	$_SESSION['loggetInn']=false;
    session_destroy();
    header('Location: index.php');
    ?>