<?php
session_start();
?>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="homeNS.css">
	<link rel="stylesheet" type="text/css" href="topnavS.css">
	<link rel="stylesheet" type="text/css" href="footerS.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Add the necessary CSS file for styling -->
    <style>
        body {
            background-color: #f7edf4;
        }
    </style>
</head>
<body>
    <div class="topnav">
        <a href="homeOFF.php" class="search_logo" style="background-color: transparent; ">
            <img src="stack-removebg-preview.png" width="250" height="auto">
        </a>
        <a class="active" href="homeOFF.php">Home</a>
        <a href="indexOFF.php">About</a>

        <?php if (!isset($_SESSION['user_id'])) : ?>
            <a href="login.html" style="float: right; color: white;">Sign In</a>
            <a href="register.php" style="float: right; color: white;">Sign Up</a>
        <?php else : ?>
            <a href="logout.php" style="float: right;">Log Out</a>
        <?php endif; ?>
        <form action="search.php" method="get" style="float: right;">
            <input type="text" name="query" placeholder="Search..."><br>
        </form>
    </div>


  <div class="recent-questions">
    <h1 class="question">Recent Questions</h1>
	<br>
	<br>
	<br>
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
        echo "<p class='date'>Submitted on: " . date("d/m/Y", strtotime($row_answer["date_added"])) . "</p>";


        // Display the answers to the question
        $question_id = $row["id"];
        $sql_answer = "SELECT * FROM answer WHERE question_id = '$question_id' ORDER BY date_added ASC";
        $result_answer = mysqli_query($conn, $sql_answer);

        echo "<div class='answer-wrapper'>";
        while ($row_answer = mysqli_fetch_assoc($result_answer)) {
            echo "<div class='answer'>";
            echo "<p class='username'>Answer by " . $row_user["username"] . ":</p>";
            echo "<p class='content'>" . $row_answer["answer_text"] . "</p>";
            echo "<p class='date'>Submitted on: " . date("d/m/Y", strtotime($row_answer["date_added"])) . "</p>";

            echo "</div>";
			echo "<br>";
        }
        echo "</div>";

        // Display the answer form
        echo '<form class="answer-form" action="post_answer.php" method="post">';
        echo '<input type="hidden" name="question_id" value="' . $question_id . '">';
		echo "<br>";
		echo "<br>";
		echo "<br>";
        //echo '<label for="answer">Your answer:</label><br>';
        // echo '<textarea id="answer_text" name="answer_text"></textarea><br><br>';
        // echo '<input type="submit" value="Post Answer" style="background-color: #8d96ff; color: white; border-color: #8d96ff;">';
        
		echo '</form>';

        echo "</div>"; // question-content
        echo "</div>"; // question-container
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</div>
    
    <!-- Add the JavaScript code for toggling answers -->
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
	<br>
		<footer>
  <div class="footer-container">
    <div class="footer-section">
      <h3>About</h3>
      <p>An academic project.</p>
    </div>
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="https://webstuff.run-eu-central1.goorm.site/my_repo/homeOFF.php">Home</a></li>
        <li><a href="https://webstuff.run-eu-central1.goorm.site/my_repo/indexOFF.php">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Contact</h3>
      <p>123 Street, City</p>
      <p>Email: info@example.com</p>
      <p>Phone: 123-456-7890</p>
    </div>
  </div>
</footer>
</html>
