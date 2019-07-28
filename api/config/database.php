<?php

    // get the database connection
function getConnection() {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    $conn = null;

    try {
        $conn = new PDO("mysql:host=" . $server . ";dbname=" . $db, $username, $password);
        $conn->exec("set names utf8");
    } catch(PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
    }

    return $conn;
}

?>