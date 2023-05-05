<?php
// Get the data from the form
$question_title = $_POST['question_title'];
$question_body = $_POST['question_body'];

// Get the user ID from the session
session_start();
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // If the user ID is missing, redirect to the login page
    header('Location: login.html');
    exit;
}

// Insert the question into the database
$db = new mysqli('localhost', 'phpmyadmin', 'admin', 'UserData');
$query = "INSERT INTO question (user_id, title, content, date_added) VALUES ('$user_id', '$question_title', '$question_body', NOW())";
$result = $db->query($query);

if ($result) {
    // Redirect the user to the home page
    header('Location: home.php');
    exit;
} else {
    // Display an error message
    echo "Error: " . $db->error;
}
?>
