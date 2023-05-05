<?php
session_start();

// Connect to the database
$db = mysqli_connect ("localhost", "phpmyadmin", "admin", "UserData");

// Check for form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Query to check if user exists in database
	$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
	$result = mysqli_query($db, $query);

	if(mysqli_num_rows($result) == 1){
		// User exists, log them in
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: home.php');
		$user_id = $_SESSION['user_id']; 
	} else{
		// User doesn't exist, show error message
		echo "Invalid username or password";
	}
}
?>
