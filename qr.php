<?php
  // Included Libraries
  include('lib/phpqrcode/qrlib.php');

  // Get Encoding Values
  $UserID = $_GET["id"];

  QRcode::png($UserID);
?>
