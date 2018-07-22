<?php
// Count Microphones.
function countMicrophones($mysqli)
{
    // SELECT requests WHERE id = GET
    $query = "SELECT COUNT(*) FROM crud";
    $result = mysqli_query($mysqli, $query);
    $rows = mysqli_fetch_row($result);

    // Return Value.
    return $rows[0];
}

function polarPatternImage($polarpattern) {
  if ($polarpattern == "Omnidirectional") {
    // Omni...
    return "omni.png";
  }

  if ($polarpattern == "Cardioid") {
    // Cardioid...
    return "cardioid.png";
  }

  if ($polarpattern == "Super-Cardioid") {
    // SuperCardioid...
    return "super.png";
  }
}

 ?>
