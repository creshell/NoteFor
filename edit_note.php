<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phplogin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in and get their user ID
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page or handle unauthorized access
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Check if form is submitted for editing a note
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title']) && isset($_POST['description']) && isset($_GET['notes_id'])) {
    $notes_id = $_GET['notes_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Update note in the database
    $sql = "UPDATE notes SET title = ?, description = ? WHERE notes_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $title, $description, $notes_id, $user_id);
    
    if ($stmt->execute()) {
        // Redirect back to the dashboard or wherever you want
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating note.";
    }
} else {
    // If the form is not submitted properly, redirect back to the dashboard or handle it accordingly
    header("Location: dashboard.php");
    exit();
}
?>
