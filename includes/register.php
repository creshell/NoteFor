<?php
include 'includes/db_mydatabase.php'; // Adjust the path if necessary

// Initialize variables
$username = $email = $password = $confirmpass = $error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpass = $_POST['confirmpass'];

    // Validate form data
    if (empty($username) || empty($email) || empty($password) || empty($confirmpass)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $confirmpass) {
        $error_message = "Passwords do not match.";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Use the function to get a PDO connection
            $conn = connectDB();

            // Check if username or email already exists
            $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $error_message = "Username or email already exists.";
            } else {
                // Insert user data into the database
                $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->execute();

                // Redirect to login page after successful registration
                header("Location: login.php");
                exit();
            }
        } catch (PDOException $e) {
            // Handle database connection errors
            $error_message = "Database error: " . $e->getMessage();
        } finally {
            // Always close the connection
            if ($conn) {
                $conn = null;
            }
        }
    }
}

// If there are errors, redirect back to the registration page with error messages
if (!empty($error_message)) {
    session_start();
    $_SESSION['error_message'] = $error_message;
    $_SESSION['old_input'] = $_POST;
    header("Location: registration.php");
    exit();
}
?>

