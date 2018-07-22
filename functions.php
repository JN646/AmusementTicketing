<?php
// Count Microphones.
function countUsers($mysqli)
{
    // SELECT requests WHERE id = GET
    $query = "SELECT COUNT(*) FROM crud";
    $result = mysqli_query($mysqli, $query);
    $rows = mysqli_fetch_row($result);

    // Return Value.
    return $rows[0];
}
 ?>
