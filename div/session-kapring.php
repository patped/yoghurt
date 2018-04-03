<?php
if (isset($_SESSION['HTTP_USER_AGENT'])) {
    if ($_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
        session_destroy();
        echo ('
            <script language="javascript"> 
                alert("OBS! Noe gikk galt.");
                window.location.href="/index.php";
            </script>
        ');
    }
} else {
    $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
}
?>