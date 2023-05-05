<html>
<head>
	<title>Home</title>
</head>
<body>
	<h1>Welcome to the site!</h1>
	<h2>Ask a question:</h2>
	<form action="post_question.php" method="post">
		<label for="question_title">Title:</label>
		<input type="text" id="question_title" name="question_title"><br><br>
		
		<label for="question_body">Question:</label><br>
		<textarea id="question_body" name="question_body"></textarea><br><br>
		
		<input type="submit" value="Post Question">
	</form>
</body>
	
</html>

<?php
//echo $_SESSION['user_id'];
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
$sql = "SELECT * FROM question ORDER BY date_added DESC";
$result = mysqli_query($conn, $sql);

// Display the questions
echo "<h1>Recent Questions</h1>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<h3>" . $row["title"] . "</h3>";
    echo "<p>By: " . $row["user_id"] . "</p>";
    echo "<p>" . $row["question_text"] . "</p>";
    echo "<hr>";
}

// Close the database connection
mysqli_close($conn);
?>

