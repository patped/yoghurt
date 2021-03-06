<?php
session_start();
require_once 'database.php';
require_once '../logginn/logginn.php';
?>

<!doctype html>
<html lang="no">

<head>
    <title>Ingen tilgang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bibloteker/bootstrap-3.3.7-dist/css/bootstrap.min.css"> 
</head>
<body>
    <?php include_once 'header.php'; ?>
    <div class="container">
        <?php 
        starAlertInnlogg();
        $side = 'Location: /index.php';
        logginn($side);
        ?>
        <main>    
            <h1>Du har ikke adminrett til denne siden</h1>
            <h2>Tilbake til <a href="/index.php">Hovedside</a></h2>
        </main>
    </div>
    <?php include_once 'footer.php'; ?>

    <script src="/bibloteker/jquery/jquery-3.3.1.min.js"></script>
    <script src="/bibloteker/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>