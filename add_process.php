<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phplogin"; // Use the same database name as in your main file

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    
    // Prepare SQL statement
    $sql = "INSERT INTO notes (user_id, title, description, created_at) VALUES (?, ?, ?, NOW())"; // Use 'note' table instead of 'notes'
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $title, $description);
    
    // Set user_id
    session_start();
    $user_id = $_SESSION['user_id'];
    
    // Execute the statement
    if ($stmt->execute()) {
        // Note added successfully, redirect to dashboard or any other desired page
        header("Location: dashboard.php");
        exit();
    } else {
        // Error occurred while adding note
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>