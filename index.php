<?php
session_start();
require_once 'database.php';
require_once 'hjelpefunksj.php';
require_once 'sok/sok.php';
?>

<!doctype html>
<html lang="no">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bibloteker/bootstrap-4.0.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="stilark.css" type="text/css">
</head>
<body>
    <?php include_once 'header.php'; ?>
    <?php 
    starAlertInnlogg();
    $side = 'Location: index.php';
    logginn($side);
    ?>
    <main>    
        <h1>Hvilken smiley har bedriften fått?</h1>
        <h2>Velg hva du vil søke på</h2>
        <?php sok(); ?>
    </main>
    <?php include_once 'footer.php'; ?>


    <script src="sok/sok.js"></script>
    <script src="bibloteker/jquery/jquery-3.3.1.js"></script>
    <script src="bibloteker/bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
</body>
</html>