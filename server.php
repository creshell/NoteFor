<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes";

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

// Function to fetch notes for the current user
function getNotes($conn, $user_id) {
    $sql = "SELECT * FROM note WHERE user_id = $user_id ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $notes = array();
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $notes[] = $row;
        }
    }
    return $notes;
}

// Function to edit notes
function editNotes($conn, $user_id, $noteId) {
    // Retrieve note details from the database based on $noteId and $user_id
    $sql = "SELECT * FROM note WHERE note_id = $noteId AND user_id = $user_id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $noteDetails = $result->fetch_assoc();
        echo "<form action='edit_notes.php' method='POST'>";
        echo "<input type='hidden' name='note_id' value='" . $noteId . "'>";
        echo "<label for='title'>Title:</label>";
        echo "<input type='text' name='title' value='" . $noteDetails['title'] . "'><br>";
        echo "<label for='content'>Content:</label>";
        echo "<textarea name='content'>" . $noteDetails['content'] . "</textarea><br>";
        echo "<button type='submit'>Save Changes</button>";
        echo "</form>";
    } else {
        echo "Note not found.";
    }
}

// Function to delete a note
function deleteNote($conn, $user_id, $noteId) {
    $sql = "DELETE FROM note WHERE note_id = $noteId AND user_id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Note deleted successfully";
    } else {
        echo "Error deleting note: " . $conn->error;
    }
}
?>

