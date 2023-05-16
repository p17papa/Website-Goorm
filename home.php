<?php
$current_page = 'home';
?>
<html>
<head>
    <title>Home</title>
	<link rel="stylesheet" type="text/css" href="homeS.css">
	<!-- <link rel="stylesheet" type="text/css" href="homeS.css"> -->
	

	</head>	
<body>
	<div class="topnav">
	  <img src="search_logo.png" width="200" height="auto" class='search_logo'>
	  <a class="<?php if ($current_page == 'home') {echo 'active';} ?>" href="home.php">Home</a>
	  <a class="<?php if ($current_page == 'about') {echo 'active';} ?>" href="index.php">About</a>
	  <a class="<?php if ($current_page == 'profile') {echo 'active';} ?>" href="profile.php">My Profile</a>
	  <a href="logout.php">Log Out</a>
	  <form action="search.php" method="get" style="float:right;">
		  <input type="text" name="query" placeholder="Search..."><br>
		  <button type="submit" style="margin-right:80px;">Search</button>
		</form>
	  
	</div>
	
	<?php
	include 'db_connect.php';
	
	?>
    <?php
    // Start the session and check if the user is logged in
    session_start();
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit();
    }
	
    // Retrieve the logged-in user's name
    $user_id = $_SESSION["user_id"];
    $sql_user = "SELECT username FROM user WHERE id = '$user_id'";
    $result_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);
    $username = $row_user["username"];
    ?>
    
      <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        
      
	<h2 class="question">Ask a question:</h2>
	<div class="form-container">
	
  <form action="post_question.php" method="post">
		<label for="question_title">Title:</label>
		<input type="text" id="question_title" name="question_title"><br><br>
		
		<label for="question_body">Question:</label><br>
		<textarea id="question_body" name="question_body"></textarea><br><br>
		
		<input type="submit" value="Post Question">
		
	</form>
		</div>
	
	<h1 class="question">Recent Questions</h1>
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
$sql = "SELECT question.*, user.username FROM question LEFT JOIN user ON question.user_id = user.id ORDER BY date_added DESC";
$result = mysqli_query($conn, $sql);

// Display the questions
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='question-container'>";
    echo "<h3 class='question-heading'>" . $row["title"] . "</h3>";
    echo "<div class='question-content'>";
    echo "<p class='username'>By: " . $row["username"] . "</p>";
    echo "<p class='content'>" . $row["content"] . "</p>";
    echo "<p class='date'>Submitted on: " . $row["date_added"] . "</p>";

    // Display the answers to the question
    $question_id = $row["id"];
    $sql_answer = "SELECT * FROM answer WHERE question_id = '$question_id' ORDER BY date_added ASC";
    $result_answer = mysqli_query($conn, $sql_answer);

    echo "<div class='answer-wrapper'>";
    while ($row_answer = mysqli_fetch_assoc($result_answer)) {
        echo "<div class='answer'>";
        echo "<p class='username'>Answer by " . $row_user["username"] . ":</p>";
        echo "<p class='content'>" . $row_answer["answer_text"] . "</p>";
        echo "<p class='date'>Submitted on: " . $row_answer["date_added"] . "</p>";
        echo "</div>";
    }
    echo "</div>";

    // Display the answer form
    echo '<form class="answer-form" action="post_answer.php" method="post">';
    echo '<input type="hidden" name="question_id" value="' . $question_id . '">';
    echo '<label for="answer">Your answer:</label><br>';
    echo '<textarea id="answer_text" name="answer_text"></textarea><br><br>';
    echo '<input type="submit" value="Post Answer">';
    echo '</form>';

    echo "</div>"; // question-content
    echo "</div>"; // question-container
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Add the following JavaScript code after the PHP code above -->
<script>
    const questionContainers = document.querySelectorAll('.question-container');
    questionContainers.forEach((questionContainer) => {
        const questionHeading = questionContainer.querySelector('.question-heading');
        const answerWrapper = questionContainer.querySelector('.answer-wrapper');
        questionHeading.addEventListener('click', () => {
            answerWrapper.classList.toggle('active');
        });
    });
</script>
</body>
</html>
