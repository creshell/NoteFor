<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    // Could not get the data that should have been sent.
    exit('Please complete the registration form!');
}

$errors = array(); // Array to hold validation errors

// Make sure the submitted registration values are not empty.
if (empty($_POST['username'])) {
    $errors['username'] = 'Please enter a username';
}

if (empty($_POST['password'])) {
    $errors['password'] = 'Please enter a password';
}

if (empty($_POST['email'])) {
    $errors['email'] = 'Please enter an email';
}

// Check if passwords match
if ($_POST['password'] !== $_POST['confirmpass']) {
    $errors['confirmpass'] = 'Passwords do not match';
}

// If there are any errors, display them
if (!empty($errors)) {
    echo json_encode($errors); // Output errors as JSON for JavaScript to handle
    exit(); // Stop further execution of the script
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT user_id, password FROM accounts WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    // Store the result so we can check if the account exists in the database.
    if ($stmt->num_rows > 0) {
        // Username already exists
        $errors['username'] = 'Username already exists, please choose another';
        echo json_encode($errors); // Output errors as JSON for JavaScript to handle
        exit(); // Stop further execution of the script
    } else {
        // Username doesn't exists, insert new account
        if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
            echo "<script>alert('register successfully!')</script>"; 
            echo "<script>window.location.href = '../notefor/index.php';</script>"; // Redirect to dashboard.php
        } else {
            // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
            $errors['general'] = 'Could not prepare statement';
            echo json_encode($errors); // Output errors as JSON for JavaScript to handle
            exit(); // Stop further execution of the script
        }
    }
    $stmt->close();
} else {
    // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
    $errors['general'] = 'Could not prepare statement';
    echo json_encode($errors); // Output errors as JSON for JavaScript to handle
    exit(); // Stop further execution of the script
}
$con->close();
?>
