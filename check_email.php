<?php
// Connect to the database
$db = mysqli_connect("localhost", "phpmyadmin", "admin", "UserData");

// Check if the username already exists in the database
$email = $_GET["email"];
$query = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    echo "exists";
} else {
    echo "available";
}
?>
