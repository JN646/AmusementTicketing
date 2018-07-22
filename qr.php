<?php
  include('lib/phpqrcode/qrlib.php');

  $UserID = $_GET["id"];
  $VenueName = "MyBigAmusement";
  $VenueNumber = "420";

  $ConcatCode = $VenueNumber.$UserID.$VenueName;

  QRcode::png($ConcatCode);
?>
