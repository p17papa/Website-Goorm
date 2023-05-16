<?php
$current_page = 'profile';
?>
<?php
  include 'db_connect.php';
  // Start the session and check if the user is logged in
  session_start();
  if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
  }
  // Retrieve the logged-in user's name and email
  $user_id = $_SESSION["user_id"];
  $sql = "SELECT username, email FROM user WHERE id = '$user_id'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    // query failed
    echo "Error: " . mysqli_error($conn);
  } else if (mysqli_num_rows($result) > 0) {
    // user exists, retrieve user credentials
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
  } else {
    // user doesn't exist
    echo "User not found in database.";
  }
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="home_tempCSS.css">
<div class="topnav">
  <img src="search_logo.png" width="200" height="auto" class='search_logo'>
  <a class="<?php if ($current_page == 'home') {echo 'active';} ?>" href="home.php">Home</a>
  <a class="<?php if ($current_page == 'about') {echo 'active';} ?>" href="about.php">About</a>
  <a class="<?php if ($current_page == 'profile') {echo 'active';} ?>" href="profile.php">My Profile</a>
  <a href="logout.php">Log Out</a>	
  <input type="text" placeholder="Search..">
</div>

	<title>My profile</title>
	 <link rel="stylesheet" type="text/css" href="profileS.css">
	</head>	
	<body>
		
<div class="profile-container">	
	<div>
  		<h2>My Profile</h2>
  		<p>Username: <?php echo $username; ?></p>
  		<p>Email: <?php echo $email; ?></p>
	</div>
	
	
	<form action="update_profile.php" method="post">
	  <label for="username">New Username:</label>
	  <input type="text" id="username" name="username"><br>

	  <label for="email">New Email:</label>
	  <input type="email" id="email" name="email"><br>

	  <label for="password">New Password:</label>
	  <input type="password" id="password" name="password"><br>

	  <input type="submit" value="Save Changes">
	</form>
	
</div>	
</body>

</html>
