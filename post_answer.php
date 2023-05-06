<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('location: login.php');
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

// Get the question id and answer text from the form submission
$question_id = $_POST['question_id'];
$answer_text = $_POST['answer_text'];
$user_id = $_SESSION['user_id'];

// Insert the answer into the database
$sql = "INSERT INTO answer (question_id, user_id, answer_text) VALUES ('$question_id', '$user_id', '$answer_text')";
if (mysqli_query($conn, $sql)) {
    header("location: home.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
