<?php
session_start(); // Start session

include 'includes/db_mydatabase.php'; // Adjust the path if necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error_messages = array(); // Initialize array for error messages

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Prepare and execute the SQL query
        $sql = "SELECT * FROM accounts WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Check if a row is found with the given username
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify the password using password_verify function
            if (password_verify($password, $row['password'])) {
                // Login successful
                $_SESSION['user_id'] = $row['user_id']; // Store user_id in session
                $_SESSION['username'] = $username; // Store username in session
            
                // Return success message
                echo json_encode(array("success" => true));
                exit();
            } else {
                // Incorrect password
                $error_messages['password'] = "Invalid password.";
            }
        } else {
            // Username not found
            $error_messages['username'] = "Username not found.";
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        $error_messages['database'] = "Database error: " . $e->getMessage();
    } finally {
        // Always close the connection
        if ($conn) {
            $conn = null;
        }
    }

    // Return error messages
    echo json_encode($error_messages);
    exit();
}
?>
