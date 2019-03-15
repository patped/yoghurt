<?php
session_start();
require_once 'div/database.php';
require_once 'logginn/logginn.php';
require_once 'sok/sok.php';
?>

<!doctype html>
<html lang="no">

<head>
    <title>Yoghurt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bibloteker/bootstrap-3.3.7-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="/sok/stil.css">
</head>
<body>
    
    <?php include_once 'div/header.php';?>
    <div class="container text-center">
        <?php 
        starAlertInnlogg();
        $side = 'Location: /index.php';
        logginn($side);
        ?>
        <div class="jumbotron text-center">
            <h1>Hvilken smiley har bedriften fått?</h1>
        </div>
        
        <h2>Velg hva du ønsker å søke på</h2>
        
        <div class="container text-center">
 
            <?php sok(); ?>
 
        </div>
    </div>
    <?php include_once 'div/footer.php'; ?>

    <script src="sok/sok.js"></script>
    <script src="/bibloteker/jquery/jquery-3.3.1.min.js"></script>
    <script src="/bibloteker/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>