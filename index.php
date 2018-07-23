<?php include 'partials/_header.php' ?>
<div class='fluid-container'>
<br>
<div class='row'>
  <div class="col-md-1">
    <div class='col-md-12'>
      <h3>Navigation</h3>
      <ul>
        <li>Link 1</li>
        <li>Link 2</li>
        <li>Link 3</li>
      </ul>
    </div>
  </div>
<div class='col-md-11'>
  <?php if (isset($_SESSION['message'])): ?>
      <div class="msg">
        <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        ?>
      </div>
    <?php endif ?>
    <h1>Credit Management System <span class='badge'>(<?php echo countUsers($mysqli); ?>)</span></h1>
    <p>Users and Credits of a venue. Work in progress system.</p>

    <?php
    // initialise variables
    $first_name = $last_name = $email = $credits = $password = $dob = $IDHash = "";
    $update = false;

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $record = mysqli_query($mysqli, "SELECT * FROM crud WHERE id=$id");

        if (count($record) == 1) {
            $n = mysqli_fetch_array($record);
            $IDHash = $n['hash'];
            $id = $n['id'];
            $first_name = $n['first_name'];
            $last_name = $n['last_name'];
            $email = $n['email'];
            $dob = $n['dob'];
            $credits= $n['credits'];
            $password = $n['password'];
        }
    }
    ?>

<div class='border border-primary col-md-6'>
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
      		<label class="">First Name</label><br>
      		<input class='form-control' type="text" name="first_name" value="<?php echo $first_name; ?>">
          <small class="form-text text-muted">User first name.</small>
      	</div>
      </div>

      <div class='col'>
        <!-- last_name -->
      	<div class="form-group">
      		<label class="">Last Name</label><br>
      		<input class='form-control' type="text" name="last_name" value="<?php echo $last_name; ?>">
          <small class="form-text text-muted">User last name.</small>
      	</div>
      </div>
    </div>

    <div class='form-row'>
      <!-- email -->
        <div class='col'>
          <div class="form-group">
        		<label class="">Email</label><br>
            <input class='form-control' type="text" name="email" value="<?php echo $email; ?>">
            <small class="form-text text-muted">User email address.</small>
        	</div>
        </div>

        <div class='col'>
          <div class="form-group">
            <label class="">Password</label><br>
            <input class='form-control' type="password" name="password" value="<?php echo $password; ?>">
            <small class="form-text text-muted">User password.</small>
          </div>
        </div>
      </div>

      <div class='form-row'>
        <!-- Credits -->
        <div class='col'>
          <div class="form-group">
        		<label class="">Credits</label><br>
            <input class='form-control' type="text" name="credits" value="<?php echo $credits; ?>">
            <small class="form-text text-muted">Number of credits.</small>
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
    <table class='table table-hover'>
      <tr>
        <th class='text-center'>QR</th>
        <th class='text-center'>ID</th>
        <th class='text-center'>Hash</th>
        <th class='text-center'>First Name</th>
        <th class='text-center'>Last Name</th>
        <th class='text-center'>Email</th>
        <th class='text-center'>DOB</th>
        <th class='text-center'>Credits</th>
			  <th class='text-center' colspan="4">Action</th>
      </tr>

      <?php
          while ($row = mysqli_fetch_array($result)) {
              // Draw Table.
              echo "<tr>";
              echo '<td class="text-center"><img src=qr.php?id="' . $row['hash'] . '" /></td>';
              echo "<td class='text-center'>" . $row['id'] . "</td>";
              echo "<td class='text-center'>" . $row['hash'] . "</td>";
              echo "<td>" . $row['first_name'] . "</td>";
              echo "<td>" . $row['last_name'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td class='text-center'>" . $row['dob'] . "</td>";
              echo "<td class='text-center'>" . $row['credits'] . "</td>";
              echo "<td class='text-center'><a href='qr.php?id=" . $row['id'] . "' class='view_btn'><i class='fas fa-eye'></i></a></td>";
              echo "<td class='text-center'><a href='index.php?edit=" . $row['id'] . "' class='edit_btn'><i class='fas fa-edit'></i></a></td>";
              echo "<td class='text-center'><a href='server.php?del=" . $row['id'] . "' class='del_btn'><i class='far fa-trash-alt'></i></a></td>";
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
</div>
  <br>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>
