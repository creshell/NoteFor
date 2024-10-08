<?php
// Start PHP block
session_start(); // Start session (if not already started)

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or display an error message
    header("Location: index.php"); // Replace login.php with your actual login page
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "phplogin";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to delete records from archive table
function deleteNoteFromArchive($conn, $note_id) {
    // SQL statement to delete records
    $sql = "DELETE FROM archive WHERE notes_id = ?";
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $note_id);
    // Execute the delete statement
    if ($stmt->execute()) {
        echo "Note deleted from archive successfully";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting note from archive: " . $conn->error;
    }
    // Close statement
    $stmt->close();
}

// Check if note_id is provided
if(isset($_GET['notes_id'])) {
    $note_id_to_delete = $_GET['notes_id'];
    deleteNoteFromArchive($conn, $note_id_to_delete);
} else {
    echo "Note ID not provided.";
}
?>
