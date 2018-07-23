<?php
  // Included Libraries
  include('lib/phpqrcode/qrlib.php');

  // Get Encoding Values
  $UserID = $_GET["id"];
  $VenueName = "MyBigAmusement";
  $VenueNumber = "420";

  // Concatenated Code
  $ConcatCode = $VenueNumber.$UserID.$VenueName;

  QRcode::png($ConcatCode);
?>
