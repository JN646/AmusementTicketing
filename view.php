<?php include 'partials/_header.php' ?>
<div class='fluid-container'>
<br>
<?php
$id = $_GET["id"];

// ACTIVE RESULTS
$activesql = "SELECT * FROM codes WHERE user_id = $id";

// Person SQL
$personsql = "SELECT * FROM crud WHERE id = $id";
$personresult = mysqli_query($mysqli, $personsql);
$person = mysqli_fetch_array($personresult);

// Assign Person Values
$personFName = $person['first_name'];
$personLName = $person['last_name'];

$personName = $personFName . " " . $personLName;
 ?>
<div class='row'>
  <?php include 'partials/_sidebar.php' ?>
<div class='col-md-11'>
  <?php if (isset($_SESSION['message'])): ?>
      <div class="msg">
        <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        ?>
      </div>
    <?php endif ?>
    <h1><?php echo $personName ?></h1>
    <p>Shows all barcodes linked to a user.</p>

    <br>

    <?php
    if ($result = mysqli_query($mysqli, $activesql)) {
        if (mysqli_num_rows($result) > 0) {
            ?>
    <table class='table table-hover'>
      <tr>
        <th class='text-center'>ID</th>
        <th class='text-center'>Credits</th>
        <th class='text-center'>Expiry</th>
        <th class='text-center'>Status</th>
      </tr>

      <?php
          while ($row = mysqli_fetch_array($result)) {
              $codeExpiry = $row['expiry'];

              // Draw Table.
              echo "<tr>";
              echo '<td class="text-center">' . $row['id'] . '</td>';
              echo '<td class="text-center">' . $row['credits'] . '</td>';
              echo '<td class="text-center">' . $row['expiry'] . '</td>';
              echo '<td class="text-center">' . codeActive($mysqli, $codeExpiry) . '</td>';
              echo "</tr>";
          }
            echo "</table>";

            // Free result set
            mysqli_free_result($result);
        } else {
            echo "<p class='text-center'><strong>No codes were found.</strong></p>";
        }
    } else {
        SQLError($mysqli);
    } ?>
  </div>
</div>
<?php include 'partials/_footer.php' ?>
