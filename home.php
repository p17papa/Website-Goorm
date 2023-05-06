<html>
<head>
    <title>Home</title>
	<style>
		#user-info {
			position: absolute;
			top: 0;
			right: 0;
		}
	</style>
</head>
<body>
    <?php
    // Start the session and check if the user is logged in
    session_start();
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit();
    }
    // Connect to the database
    $servername = "localhost";
    $username = "phpmyadmin";
    $password = "admin";
    $dbname = "UserData";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Retrieve the logged-in user's name
    $user_id = $_SESSION["user_id"];
    $sql_user = "SELECT username FROM user WHERE id = '$user_id'";
    $result_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);
    $username = $row_user["username"];
    ?>
    
	
	<h2>Ask a question:</h2>
	<form action="post_question.php" method="post">
		<label for="question_title">Title:</label>
		<input type="text" id="question_title" name="question_title"><br><br>
		
		<label for="question_body">Question:</label><br>
		<textarea id="question_body" name="question_body"></textarea><br><br>
		
		<input type="submit" value="Post Question">
		<a href="logout.php">Logout</a>
	</form>
	
	<h1>Recent Questions</h1>
	<?php
	// Connect to the database
	$servername = "localhost";
	$username = "phpmyadmin";
	$password = "admin";
	$dbname = "UserData";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Retrieve the questions from the database
	//$sql = "SELECT * FROM question ORDER BY date_added DESC";
	$sql = "SELECT question.*, user.username FROM question LEFT JOIN user ON question.user_id = user.id ORDER BY date_added DESC";
	$result = mysqli_query($conn, $sql);

	// Display the questions
	while ($row = mysqli_fetch_assoc($result)) {
	    echo "<h3>" . $row["title"] . "</h3>";
	    echo "<p>By: " . $row["username"] . "</p>";
	    echo "<p>" . $row["content"] . "</p>";
	    echo "<p>Submitted on: " . $row["date_added"] . "</p>";
	    
	    // Display the answers to the question
	    $question_id = $row["id"];
	    $sql_answer = "SELECT * FROM answer WHERE question_id = '$question_id' ORDER BY date_added ASC";
	    $result_answer = mysqli_query($conn, $sql_answer);
	    
	    // Display the answer form
	    echo '<form action="post_answer.php" method="post">';
	    echo '<input type="hidden" name="question_id" value="' . $question_id . '">';
	    echo '<label for="answer">Your answer:</label><br>';
	    echo '<textarea id="answer_text" name="answer_text"></textarea><br><br>';
	    echo '<input type="submit" value="Post Answer">';
	    echo '</form>';
	    
	    // Display the answers to the question
	    while ($row_answer = mysqli_fetch_assoc($result_answer)) {
    echo "<p>Answer by " . $row["username"] . ":</p>";
    echo "<p>" . $row_answer["answer_text"] . "</p>";
    echo "<p>Submitted on: " . $row_answer["date_added"] . "</p>";
    echo "<hr>";
}

	    
	    echo "<hr>";
	}

	// Close the database connection
	mysqli_close($conn);
	?>
</body>
</html>
