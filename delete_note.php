<?php
// Function to connect to the database
function connectDB() {
    $host = "localhost";
    $dbname = "phplogin";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return null;
}

// Function to delete a note
function deleteNote($conn, $note_id) {
    $sql = "DELETE FROM notes WHERE notes_id = :note_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':note_id', $note_id, PDO::PARAM_INT);
    
    try {
        $stmt->execute();
        return true; // Note deleted successfully
    } catch (PDOException $e) {
        echo "Error deleting note: " . $e->getMessage();
        return false; // Error deleting note
    }
}

// Establish database connection
$conn = connectDB();

// Check if note_id is set in the URL
if(isset($_GET['note_id'])) {
    // Get the note ID from the URL
    $note_id = $_GET['note_id'];

    // Attempt to delete the note
    if(deleteNote($conn, $note_id)) {
        // Note deleted successfully, redirect back to the dashboard or any other desired page
        header("Location: dashboard.php");
        exit();
    } else {
        // Error occurred while deleting the note
        echo "Error deleting note.";
    }
} else {
    // Redirect to a default page if note_id is not provided in the URL
    header("Location: dashboard.php");
    exit();
}
?>
