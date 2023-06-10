<?php
session_start();

// Connect to the database
$db = mysqli_connect("localhost", "phpmyadmin", "admin", "UserData");

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: home.php");
    exit();
}

// Retrieve the logged-in user's ID
$user_id = $_SESSION["user_id"];

// Generate random values for email, password, first name, and last name
$random_email = generateRandomString() . "deleted@.com";
$random_password = generateRandomString();
$random_first_name = generateRandomString();
$random_last_name = generateRandomString();

// Update the user's profile with random values
$query = "UPDATE user SET email = '$random_email', password = '$random_password', first_name = '$random_first_name', last_name = '$random_last_name' WHERE id = '$user_id'";
$result = mysqli_query($db, $query);

if ($result) {
    // Profile updated successfully with random values
    // Redirect to home page or display a success message
    $_SESSION['success'] = "Profile deleted successfully!";
    header('location: homeOFF.php');
} else {
    // Error updating profile
    echo "Error updating profile: " . mysqli_error($db);
}

// Close the database connection
mysqli_close($db);

// Function to generate a random string
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>
