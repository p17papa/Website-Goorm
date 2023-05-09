<?php
  include 'db_connect.php';
  // Start the session and check if the user is logged in
  session_start();
  if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
  }
  // Retrieve the new user credentials from the form
  $user_id = $_SESSION["user_id"];
  $new_username = $_POST["username"];
  $new_email = $_POST["email"];
  $new_password = $_POST["password"];
  // Build the UPDATE statement based on which fields are being changed
  $update_sql = "UPDATE user SET";
  $updates = array();
  if (!empty($new_username)) {
    $updates[] = "username = '$new_username'";
  }
  if (!empty($new_email)) {
    $updates[] = "email = '$new_email'";
  }
  if (!empty($new_password)) {
    $updates[] = "password = '$new_password'";
  }
  if (count($updates) > 0) {
    $update_sql .= " " . implode(", ", $updates) . " WHERE id = '$user_id'";
    $result = mysqli_query($conn, $update_sql);
    if (!$result) {
      // query failed
      echo "Error: " . mysqli_error($conn);
    } else {
      // update successful
      header("Location: profile.php");
      exit();
    }
  } else {
    // nothing to update
    header("Location: profile.php");
    exit();
  }
?>
