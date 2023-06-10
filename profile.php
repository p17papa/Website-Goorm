<?php
$current_page = 'profile';
?>
<?php
  include 'db_connect.php';
  // Start the session and check if the user is logged in
  session_start();
  if (!isset($_SESSION["user_id"])) {
    header("Location: home.php");
    exit();
  }
  // Retrieve the logged-in user's name and email
  $user_id = $_SESSION["user_id"];
  $sql = "SELECT username, email, first_name, last_name FROM user WHERE id = '$user_id'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    // query failed
    echo "Error: " . mysqli_error($conn);
  } else if (mysqli_num_rows($result) > 0) {
    // user exists, retrieve user credentials
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
	$firstname = $row['first_name'];
	$lastname = $row['last_name'];  
  } else {
    // user doesn't exist
    echo "User not found in database.";
  }
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="homeNS.css">
	<link rel="stylesheet" type="text/css" href="topnavS.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

	
<div class="topnav">
		<a href="home.php" class="search_logo" style="background-color: transparent; ">    
		<img src="stack-removebg-preview.png" width="250" height="auto" ></a>
		<a class="<?php if ($current_page == 'home') {echo 'active';} ?>" href="home.php">Home</a>
		<a class="<?php if ($current_page == 'about') {echo 'active';} ?>" href="index.php">About</a>
		<a class="<?php if ($current_page == 'profile') {echo 'active';} ?>" href="profile.php">My Profile</a>
		<a href="logout.php">Log Out</a>
		<form action="search.php" method="get" style="float:right;">
		<input type="text" name="query" placeholder="Search..."><br>
			<!-- <button type="submit" style="margin-right:80px;">Search</button> -->
	</form>
	</div>

	<title>My profile</title>
	 <link rel="stylesheet" type="text/css" href="profileS.css">
	</head>	
	<body>
		
<div class="profile-container">	
	<div>
  		<h2>My Profile</h2>
  		<p>First Name: <?php echo $firstname; ?></p>
		<p>Last Name: <?php echo $lastname; ?></p>
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
	<form action="delete_profile.php" method="post" onsubmit="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">
  <input type="submit" value="Delete Profile">
</form>

	
</div>	
</body>

</html>
