<?php
// Database connection
include_once 'includes/db_connect.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $note_id = $_GET['id'];

    // Insert the note ID into the favorite table
    $favorite_sql = "INSERT INTO favorite_note (notes_id, fav_id) VALUES ($note_id, 1)";
    if ($conn->query($favorite_sql) === TRUE) {
        echo "Note marked as favorite successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error marking note as favorite: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
