<?php

$servername = "localhost"; // Change "your_servername" to "localhost"
$username = "root";
$password = "";
$database = "phplogin";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'notes_id' parameter is set and not empty
if (isset($_GET['notes_id']) && !empty($_GET['notes_id'])) {
    $notes_id = $_GET['notes_id'];

    // Check if the database connection is established
    if ($conn) {
        // Insert the note ID into the archive table
        $archive_sql = "INSERT INTO archive (notes_id) VALUES (?)"; // Removed 'archive_id' from the query
        
        // Create a prepared statement
        $stmt = $conn->prepare($archive_sql);
        
        // Check if statement preparation succeeded
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("i", $notes_id); // Changed to a single 'i' for a single parameter
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "Note archived successfully.";
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error archiving note: " . $stmt->error;
            }
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Failed to establish database connection.";
    }
} else {
    echo "Invalid request: 'notes_id' parameter is missing or empty.";
}
?>
