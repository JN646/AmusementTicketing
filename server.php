<?php
// Link to DB
include 'DBConfig.php';
include 'functions.php';

// Start Session
session_start();

// initialise variables
$first_name = $last_name = $email = $credits = $password = "";
$update = false;
$id = 0;

// Add
if (isset($_POST['save'])) {
  $id = $_POST['id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $credits = $_POST['credits'];
  $password = $_POST['password'];
  $IDHash = "";

  $IDHash = generateRandomString();

  if(mysqli_query($mysqli, "INSERT INTO crud (hash, first_name, last_name, email, credits, password) VALUES ('$IDHash', '$first_name', '$last_name', '$email', '$credits', '$password')")) {
    $_SESSION['message'] = "User Saved";
    header('location: index.php');
  } else {
    echo mysqli_error($mysqli);
    $_SESSION['message'] = mysqli_error($mysqli);
    header('location: index.php');
  }
}

// Edit
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $credits = $_POST['credits'];
  $password = $_POST['password'];
  $IDHash = $_POST['hash'];

  // Generate a hash if one doesnt already exist.
  if ($IDHash !== NULL) {
    $IDHash = generateRandomString();
    mysqli_query($mysqli, "UPDATE crud SET hash='$IDHash' WHERE id=$id");
  }

  if(mysqli_query($mysqli, "UPDATE crud SET first_name='$first_name', last_name='$last_name', email='$email', credits='$credits', password='$password' WHERE id=$id")) {
    $_SESSION['message'] = "User Updated";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($mysqli);
    header('location: index.php');
  }
}

// Delete
if (isset($_GET['del'])) {
	$id = $_GET['del'];

  if(mysqli_query($mysqli, "DELETE FROM crud WHERE id=$id")) {
    $_SESSION['message'] = "User Deleted";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($mysqli);
    header('location: index.php');
  }
}
?>
