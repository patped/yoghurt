<?php
require "tilsynsrapportModell.php";
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

  <div class="container">
    <div class="jumbotron">
      <h1 class="text-center">Tilsynsrapport</h1>
    </div>
  </div>

  <div class="container">
    <div class="page-header"> <h3>Tilsynsrapport for dato: <?php echo $dato; ?> </h3> </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
        <th>#</th>
          <th>Kravpunktnavn</th>
          <th>Karakter</th>
          <th>Kommentar</th>
        </thead>
        <tbody>
            <?php kravpunkter(); ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>