<?php
require_once 'Tilsynsrapport.class.php';
session_start();
require_once '../div/session-kapring.php';
require_once 'tilsyn-modell.php';
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
  <?php require_once '../div/header.php'; ?>
  <?php 
    starAlertInnlogg();
    $side = "Location: /tilsynsrapport/tilsyn.php?tilsynid=$tilsynid";
    logginn($side);
  ?>

  <div class="container">
      <div class="jumbotron">
        <h1 class="text-center"><?php echo $tilsynsrapport->restaurant; ?></h1>
      </div>
    <div class='page-header'> <h2>Tilsynsrapport for dato: <?php echo $tilsynsrapport->dato(); ?></h2>
      <?php adminrett($tilsynsrapport); ?>
    </div>
    <div class="table-responsive">
      <?php tilsynsrapport($tilsynsrapport); ?>
    </div>
  </div>
  <br>
  <?php require_once '../div/footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>