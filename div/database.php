<?php

// Etablerer forbindelse til databasen
function kobleOpp() {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    
    $dblink = new mysqli($server, $username, $password, $db);

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    
    mysqli_set_charset($dblink, 'utf8');
    return $dblink;
}

// Lukker forbindelsen til databasen
function lukk($dblink) {
    mysqli_close($dblink);
}

?>