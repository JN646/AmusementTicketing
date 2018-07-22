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
  <?php if (isset($_SESSION['message'])): ?>
      <div class="msg">
        <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        ?>
      </div>
    <?php endif ?>
    <h1>Microphone Database <span class='badge'>(<?php echo countMicrophones($mysqli); ?>)</span></h1>
    <p>A database of common microphones, specs and information. A simple programming project.</p>

    <?php
    // initialise variables
    $make = $model = $type = $polarpattern = $price = $notes = $discontinued = "";
    $update = false;

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($mysqli, "SELECT * FROM crud WHERE id=$id");

        if (count($record) == 1) {
            $n = mysqli_fetch_array($record);
            $make = $n['make'];
            $model = $n['model'];
            $type = $n['type'];
            $polarpattern = $n['polarpattern'];
            $price = $n['price'];
            $discontinued = $n['discontinued'];
            $notes = $n['notes'];
        }
    }
    ?>

<div class='border'>
  <div class='col-md-12'>
  <!-- Control Form -->
    <?php if ($update == true): ?>
      <h2>Update</h2>
    <?php else: ?>
      <h2>Add</h2>
    <?php endif ?>
    <form class='' method="post" action="server.php" >
    	<input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class='form-row'>
      <!-- Make -->
    <div class='col'>
        <div class="form-group">
        		<label class="">Make</label><br>
        		<input class='form-control' type="text" name="make" value="<?php echo $make; ?>">
        	</div>
        </div>

        <div class='col'>
          <!-- Model -->
        	<div class="form-group">
        		<label class="">Model</label><br>
        		<input class='form-control' type="text" name="model" value="<?php echo $model; ?>">
        	</div>
        </div>
    </div>

<div class='form-row'>
  <!-- Type -->
    <div class='col'>
      <div class="form-group">
    		<label class="">Type</label><br>
        <select class="form-control" name="type">
          <option value="">Please Select</option>
          <option value="Dynamic">Dynamic</option>
          <option value="Condenser">Condenser</option>
          <option value="Ribbon">Ribbon</option>
        </select>
    	</div>
    </div>

    <div class='col'>
      <!-- Polar Patterns -->
      <div class="form-group">
        <label class="">Polar Pattern</label><br>
        <select class="form-control" name="polarpattern">
          <option value="">Please Select</option>
          <option value="Omnidirectional">Omnidirectional</option>
          <option value="Cardioid">Cardioid</option>
          <option value="Super-Cardioid">Super-Cardioid</option>
        </select>
      </div>
    </div>

    <!-- Price -->
      <div class='col'>
        <div class="form-group">
      		<label class="">Price</label><br>
          <input class='form-control' type="text" name="price" value="<?php echo $price; ?>">
      	</div>
      </div>

      <div class='col'>
        <!-- Discontinued -->
        <div class="form-group">
          <label class="">Discontinued</label><br>
          <input class='form-control' type="text" name="discontinued" value="<?php echo $discontinued; ?>">
        </div>
      </div>
    </div>

      <!-- Notes -->
    	<div class="form-group">
    		<label class="">Notes</label><br>
    		<textarea class="form-control" name="notes"><?php echo $notes; ?></textarea>
    	</div>

      <!-- Submit Buttons -->
    	<div class="form-group">
    		<?php if ($update == true): ?>
    			<button class="btn" type="submit" name="update">Update</button>
    		<?php else: ?>
    			<button class="btn" type="submit" name="save">Add</button>
    		<?php endif ?>
    	</div>
    </form>
  </div>
</div>

    <br>

    <?php
    // ACTIVE RESULTS
    $activesql = "SELECT * FROM crud ORDER BY make, model ASC";
    if ($result = mysqli_query($mysqli, $activesql)) {
        if (mysqli_num_rows($result) > 0) {
            ?>
    <table class='table'>
      <tr>
        <th class='text-center'>Make</th>
        <th class='text-center'>Model</th>
        <th class='text-center'>Type</th>
        <th class='text-center'>Polar Pattern</th>
			  <th class='text-center' colspan="3">Action</th>
      </tr>

      <?php
          while ($row = mysqli_fetch_array($result)) {
              // Draw Table.
              echo "<tr>";
              echo "<td>" . $row['make'] . "</td>";
              echo "<td>" . $row['model'] . "</td>";
              echo "<td>" . $row['type'] . "</td>";
              echo "<td>" . $row['polarpattern'] . "</td>";
              echo "<td><a href='view.php?id=" . $row['id'] . "' class='view_btn'><i class='fas fa-eye'></i></a></td>";
              echo "<td><a href='index.php?edit=" . $row['id'] . "' class='edit_btn'><i class='fas fa-edit'></i></a></td>";
              echo "<td><a href='server.php?del=" . $row['id'] . "' class='del_btn'><i class='far fa-trash-alt'></i></a></td>";
              echo "</tr>";
          }
            echo "</table>";

            // Free result set
            mysqli_free_result($result);
        } else {
            echo "No microphones were found.";
        }
    } else {
        SQLError($mysqli);
    } ?>
  </div>
  </body>
</html>
