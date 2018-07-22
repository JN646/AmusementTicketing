<!DOCtype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Amusement Manangement System</title>
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
    <h1>Amusement Management System <span class='badge'>(<?php echo countUsers($mysqli); ?>)</span></h1>
    <p>Users and Credits of a venue. Work in progress system.</p>

    <?php
    // initialise variables
    $first_name = $last_name = $email = $credits = $password = "";
    $update = false;

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($mysqli, "SELECT * FROM crud WHERE id=$id");

        if (count($record) == 1) {
            $n = mysqli_fetch_array($record);
            $id = $n['id'];
            $first_name = $n['first_name'];
            $last_name = $n['last_name'];
            $email = $n['email'];
            $credits= $n['credits'];
            $password = $n['password'];
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
      <!-- first_name -->
    <div class='col'>
        <div class="form-group">
        		<label class="">first_name</label><br>
        		<input class='form-control' type="text" name="first_name" value="<?php echo $first_name; ?>">
        	</div>
        </div>

        <div class='col'>
          <!-- last_name -->
        	<div class="form-group">
        		<label class="">last_name</label><br>
        		<input class='form-control' type="text" name="last_name" value="<?php echo $last_name; ?>">
        	</div>
        </div>
    </div>

<div class='form-row'>
  <!-- email -->
    <div class='col'>
      <div class="form-group">
    		<label class="">email</label><br>
        <input class='form-control' type="text" name="email" value="<?php echo $email; ?>">
    	</div>
    </div>

    <div class='col'>
      <div class="form-group">
        <label class="">Password</label><br>
        <input class='form-control' type="password" name="password" value="<?php echo $password; ?>">
      </div>
    </div>
  </div>

  <div class='form-row'>
    <!-- Crerdits -->
      <div class='col'>
        <div class="form-group">
      		<label class="">Credits</label><br>
          <input class='form-control' type="text" name="credits" value="<?php echo $credits; ?>">
      	</div>
      </div>
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
    $activesql = "SELECT * FROM crud ORDER BY id";
    if ($result = mysqli_query($mysqli, $activesql)) {
        if (mysqli_num_rows($result) > 0) {
            ?>
    <table class='table'>
      <tr>
        <th class='text-center'>ID</th>
        <th class='text-center'>First Name</th>
        <th class='text-center'>Last Name</th>
        <th class='text-center'>Email</th>
        <th class='text-center'>Credits</th>
			  <th class='text-center' colspan="3">Action</th>
      </tr>

      <?php
          while ($row = mysqli_fetch_array($result)) {
              // Draw Table.
              echo "<tr>";
              echo "<td>" . $row['id'] . "</td>";
              echo "<td>" . $row['first_name'] . "</td>";
              echo "<td>" . $row['last_name'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['credits'] . "</td>";
              echo "<td><a href='view.php?id=" . $row['id'] . "' class='view_btn'><i class='fas fa-eye'></i></a></td>";
              echo "<td><a href='index.php?edit=" . $row['id'] . "' class='edit_btn'><i class='fas fa-edit'></i></a></td>";
              echo "<td><a href='server.php?del=" . $row['id'] . "' class='del_btn'><i class='far fa-trash-alt'></i></a></td>";
              echo "</tr>";
          }
            echo "</table>";

            // Free result set
            mysqli_free_result($result);
        } else {
            echo "No users were found.";
        }
    } else {
        SQLError($mysqli);
    } ?>
  </div>
  </body>
</html>
