<?php
if (isset($_SESSION['HTTP_USER_AGENT'])) {
    if ($_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
        session_destroy();
        header("Location: /index.php");
    }
} else {
    $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
}
?>