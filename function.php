<?php

session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Enter your database password here
$dbname = "phplogin"; // Enter your database name here

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if user is logged in and get their user ID

if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page or handle unauthorized access
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Function to fetch notes for the current user
function getNotes($conn, $user_id) {
    $sql = "SELECT * FROM notes 
            WHERE user_id = $user_id 
            AND notes_id NOT IN (SELECT notes_id FROM archive) 
            AND notes_id NOT IN (SELECT notes_id FROM trashnote) 
            ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $notes = array();
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $notes[] = $row;
        }
    }
    return $notes;
}





// Display notes
$notes = getNotes($conn, $user_id);

// Function to display notes
function displayNotes($notes) {
    foreach ($notes as $note) {
        echo "<div class='note'>";
        echo "<h2>" . $note['title'] . "</h2>";
        echo "<p>" . substr($note['description'], 0, 100) . "</p>";
        echo "<div class='note-actions'>";
        echo "<button onclick='viewNote(" . $note['notes_id'] . ")'>View</button>";
        echo "<button onclick='editNote(" . $note['notes_id'] . ")'>Edit</button>";
        echo "<button onclick='deleteNote(" . $note['notes_id'] . ")'>Delete</button>";
        echo "</div>";
        echo "<p>Created at: " . $note['created_at'] . "</p>";
        echo "</div>";
    }
}

// Function to edit notes
function editNotes($noteId) {
    // Retrieve note details from the database based on $noteId
    global $conn;
    $sql = "SELECT * FROM notes WHERE notes_id = $noteId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $noteDetails = $result->fetch_assoc();
        echo "<form action='edit_notes.php' method='POST'>";
        echo "<input type='hidden' name='note_id' value='" . $noteId . "'>";
        echo "<label for='title'>Title:</label>";
        echo "<input type='text' name='title' value='" . $noteDetails['title'] . "'><br>";
        echo "<label for='content'>Content:</label>";
        echo "<textarea name='content'>" . $noteDetails['description'] . "</textarea><br>";
        echo "<button type='submit'>Save Changes</button>";
        echo "</form>";
    } else {
        echo "Note not found.";
    }
}

function archiveNote($noteId) {
    global $conn;
    $sql = "UPDATE notes SET archived = 1 WHERE notes_id = $noteId";
    if ($conn->query($sql) === TRUE) {
        echo "Note archived successfully";
    } else {
        echo "Error archiving note: " . $conn->error;
    }
}

