<?php
session_start();
require "tilsyn-modell.php";
require_once '../logginn/logginn.php';
?>

<!DOCTYPE html>
<html lang="no">
<head>
  <title>Yoghurt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <?php include_once '../div/header.php'; ?>
  <?php 
    $til = $_GET['tilsynid'];
    starAlertInnlogg();
    $side = 'Location: /tilsynsrapport/tilsyn.php?tilsynid=' . $til . '&dato=' . $_GET['dato'];
    logginn($side);
    ?>

  <div class="container">
    <div class="jumbotron">
      <h1 class="text-center">Tilsynsrapport</h1>
    </div>
  </div>

  <div class="container">
    <?php 
    echo <<<EOT
    <div class="page-header"> <h2>Tilsynsrapport for dato: $dato</h2>
EOT;
      if(isset($_SESSION['adminrett']))
        if(($_SESSION['adminrett'])){
          echo <<< EOT
          <h3>ID: $til</h3><br>
          <a href='endre.php'><button type='button'>Oppdater</button></a></h2>
          <br>
EOT;
}

  
      ?> </div>
    <div class="table-responsive">"
      <?php tilsynsrapport(); ?>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>