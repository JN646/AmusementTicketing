<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Microphone Database</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <?php include 'DBConfig.php'; ?>
    <?php include 'functions.php'; ?>
  </head>
  <body>
<div class='container'>
  <?php
    $id = $_GET["id"];

    $activesql = "SELECT * FROM crud WHERE id = $id";
    $result = mysqli_query($mysqli, $activesql);
    $microphone = mysqli_fetch_array($result);

    $make = $microphone['make'];
    $model = $microphone['model'];
    $type = $microphone['type'];
    $price = $microphone['price'];
    $discontinued = $microphone['discontinued'];
    $polarpattern = $microphone['polarpattern'];
    $notes = $microphone['notes'];
   ?>

    <h1><?php echo $make . " " . $model ?></h1>
    <p><strong>Type:</strong> <?php echo $type ?></p>
    <p><strong>Price:</strong> <?php echo $price ?></p>
    <p><strong>Discontinued:</strong> <?php echo $discontinued ?></p>
    <p><strong>Polar Pattern:</strong> <?php echo $polarpattern ?></p>
    <img src="img/<?php echo polarPatternImage($polarpattern); ?>" width=100px alt="">
    <h3>Notes:</h3>
    <p><?php echo $notes ?></p>
    <br>
    <p><a href="index.php">Back</a></p></div>
  </body>
</html>
