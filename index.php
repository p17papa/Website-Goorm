<?php
session_start();
?>

<html>
<head>
	<title>Home Page</title>
</head>
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
		<a href="logout.php">Logout</a>
	<?php else : ?>
		<h1>You are not logged in</h1>
		<a href="login.html">Login</a>
	<?php endif ?>
</body>
</html>
