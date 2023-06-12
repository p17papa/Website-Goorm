<?php
$current_page = 'home';

// Check if the user has toggled the dark theme
if (isset($_GET['theme']) && $_GET['theme'] === 'dark') {
    $theme = 'dark';
} else {
    $theme = 'light';
}
?>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="homeNS.css">
    <link rel="stylesheet" type="text/css" href="topnavS.css">
    <link rel="stylesheet" type="text/css" href="footerS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <?php if ($theme === 'dark'): ?>
        <link rel="stylesheet" type="text/css" href="dark-theme.css">
    <?php endif; ?>
</head>
<!-- temp styles -->

<body>
<div class="topnav">
    <a href="home.php" class="search_logo" style="background-color: transparent; ">
        <img src="stack-removebg-preview.png" width="250" height="auto"></a>
    <a class="<?php if ($current_page == 'home') {echo 'active';} ?>" href="home.php">Home</a>
    <a class="<?php if ($current_page == 'about') {echo 'active';} ?>" href="index.php">About</a>
    <a class="<?php if ($current_page == 'profile') {echo 'active';} ?>" href="profile.php">My Profile</a>
    <a href="logout.php">Log Out</a>
    <form action="search.php" method="get" style="float:right;">
        <input type="text" name="query" placeholder="Search..."><br>
        <!-- <button type="submit" style="margin-right:80px;">Search</button> -->
    </form>
</div>

<?php
include 'db_connect.php';
?>

<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
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

<div id="content" class="<?php echo $theme === 'dark' ? 'dark-theme' : ''; ?>">
    <div class="question-section">
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
            echo "<p class='date'>Submitted on: " . date("d/m/Y", strtotime($row["date_added"])) . "</p>";


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
            echo '<label for="answer">Your answer:</label><br>';
            echo '<textarea id="answer_text" name="answer_text"></textarea><br><br>';
            echo '<input type="submit" value="Post Answer" style="background-color: #8d96ff; color: white; border-color: #8d96ff;">';
            echo "<br>";
            echo "<br>";
            echo '</form>';

            echo "</div>"; // question-content
            echo "</div>"; // question-container
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
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
</div>

<button onclick="toggleTheme()">Toggle Theme</button>
<script>
    function toggleTheme() {
        const content = document.getElementById('content');
        if (content.classList.contains('dark-theme')) {
            content.classList.remove('dark-theme');
            window.history.replaceState({}, '', '?theme=light');
        } else {
            content.classList.add('dark-theme');
            window.history.replaceState({}, '', '?theme=dark');
        }
        location.reload(); // Reload the page
    }
</script>


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
                <li><a href="https://webstuff.run-eu-central1.goorm.site/my_repo/home.php">Home</a></li>
                <li><a href="https://webstuff.run-eu-central1.goorm.site/my_repo/index.php">About</a></li>
                <li><a href="https://webstuff.run-eu-central1.goorm.site/my_repo/profile.php">My profile</a></li>
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
</body>
</html>
