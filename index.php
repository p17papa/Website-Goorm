<?php
session_start();
?>
<?php
$current_page = 'about';
?>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="homeS.css">
	
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
		}
		
		h1 {
			text-align: center;
			margin-top: 100px;
		}
		
		.btn-container {
			display: flex;
			justify-content: center;
			margin-top: 30px;
		}
		
		.btn {
			padding: 10px 20px;
			margin: 0 10px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 3px;
			font-size: 16px;
			cursor: pointer;
			transition: all 0.3s ease-in-out;
		}
		
		.btn:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
	<div class="topnav">
	  <img src="search_logo.png" width="200" height="auto" class='search_logo'>
	  <a class="<?php if ($current_page == 'home') {echo 'active';} ?>" href="home.php">Home</a>
	  <a class="<?php if ($current_page == 'about') {echo 'active';} ?>" href="about.php">About</a>
	  <a class="<?php if ($current_page == 'profile') {echo 'active';} ?>" href="profile.php">My Profile</a>
	  <a href="logout.php">Log Out</a>
	  <form action="search.php" method="get" style="float:right;">
		  <input type="text" name="query" placeholder="Search..."><br>
		  <button type="submit" style="margin-right:80px;">Search</button>

		</form>
	  
	</div>
	
<body>
	<?php if(isset($_SESSION['success'])) : ?>
		<div>
			<h3>
				<?php
				echo $_SESSION['success'];
				unset($_SESSION['success']);
				?>
			</h3>
		</div>
	<?php endif ?>

	<?php if(isset($_SESSION['username'])) : ?>
		<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
		<a href="logout.php" class="btn">Logout</a>
	<?php else : ?>
		<h1>You are not logged in</h1>
		<div class="btn-container">
			<a href="login.html" class="btn">Login</a>
			<a href="register.php" class="btn">Register</a>
		</div>
	<?php endif ?>
</body>
</html>
