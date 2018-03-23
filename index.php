<?php
session_start();
require_once 'database.php';
require_once 'logginn.php';
require_once 'sok/sok.php';
?>

<!doctype html>
<html lang="no">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    
    <?php include_once 'header.php'; ?>
    <div class="container text-center">
        <?php 
        starAlertInnlogg();
        $side = 'Location: index.php';
        logginn($side);
        ?>
        <h1>Hvilken smiley har bedriften fått?</h1>
        <h2>Velg hva du vil søke på</h2>
        <?php sok(); ?>
    </div>
    <?php include_once 'footer.php'; ?>

    <script src="sok/sok.js"></script>
    <script src="bibloteker/jquery/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>