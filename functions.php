<?php
// Include Libraries
include('lib/phpqrcode/qrlib.php');

// Count Users.
function countUsers($mysqli)
{
  // SELECT requests WHERE id = GET
  $query = "SELECT COUNT(*) FROM crud";
  $result = mysqli_query($mysqli, $query);
  $rows = mysqli_fetch_row($result);

  // Return Value.
  return $rows[0];
}

// Random String Generator
function generateRandomString($length = 15) {
    $characters = '!#?£$%^&*0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
 ?>
