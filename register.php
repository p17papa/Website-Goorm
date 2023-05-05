<?php
session_start();

// Connect to the database
$db = mysqli_connect("localhost", "phpmyadmin", "admin", "UserData");

// Check for form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	// Insert user into database
	$query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
	mysqli_query($db, $query);

	// Display success message and redirect to index page
	$_SESSION['success'] = "You have successfully registered!";
	header('location: index.php');
}
?>

<html>
<script>
function checkUsername() {
    var username = document.getElementById("username").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "check_username.php?username=" + username, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            if (response === "exists") {
                document.getElementById("username-error").innerHTML = "Username already exists";
            } else {
                document.getElementById("username-error").innerHTML = "";
            }
        }
    };
    xhr.send();
}

function checkEmail() {
    var email = document.getElementById("email").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "check_email.php?email=" + email, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            if (response === "exists") {
                document.getElementById("email-error").innerHTML = "Email already exists";
            } else {
                document.getElementById("email-error").innerHTML = "";
            }
        }
    };
    xhr.send();
}
</script>
<head>
	<title>Register Page</title>
</head>
<body>
	<h2>Register</h2>
	<form action="register.php" method="post">
		<div>
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required onkeyup="checkUsername()"><span id="username-error"></span>
		</div>
		<div>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required onkeyup="checkEmail()"><span id="email-error"></span>
		</div>
		<div>
			<label>Password:</label>
			<input type="password" name="password" required>
		</div>
		<button type="submit">Register</button>
	</form>
	<p>Already have an account? <a href="login.html">Login here.</a></p>
</body>
</html>
