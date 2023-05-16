<?php
$current_page = 'home';
?>
<html>
<head>
    <title>Home</title>
	<link rel="stylesheet" type="text/css" href="homeS.css">
	<style>
		/* 	Styles for the header of the search results	 */
		.result-heading{
			cursor:pointer;
		}
		.result-content{
			display:none;
		}
	</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.result-heading').click(function() {
    $(this).siblings('.result-content').slideToggle();
  });
});
</script>


	</head>	
<body>
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
	</body>
</html>
<?php
include 'db_connect.php';


// Retrieve the search query from the GET request
$query = $_GET['query'];

// Create a new instance of the Search class
$search = new Search($conn);

// Perform the search and retrieve the results
$results = $search->searchQuestionsAndAnswers($query);

// Display the search results
if (count($results) > 0) {
foreach ($results as $result) {
    echo "<div class='search-result'>";
    echo "<h3 class='result-heading'>" . $result['title'] . "</h3>";
    echo "<p class='result-user'>Posted by: " . $result['username'] . " on: " . $result['date_added'] . "</p>";
    echo "<p class='result-content'>" . $result['content'] . "</p>";
    echo "</div>";
}


} else {
    echo "No results found.";
}
?>

<?php
class Search {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

public function searchQuestionsAndAnswers($query) {
    // Perform the search query
    $sql = "SELECT * FROM question WHERE title LIKE '%$query%' OR content LIKE '%$query%'";
    $result = mysqli_query($this->conn, $sql);
    $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql = "SELECT * FROM answer WHERE answer_text LIKE '%$query%'";
    $result = mysqli_query($this->conn, $sql);
    $answers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $sql = "SELECT question.*, user.username FROM question LEFT JOIN user ON question.user_id = user.id WHERE user.username LIKE '%$query%' OR user.email LIKE '%$query%'";
    $result = mysqli_query($this->conn, $sql);
    $userQuestions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Combine the question, answer, and user question results
    $results = array_merge($questions, $answers, $userQuestions);

    return $results;
}


}
?>
