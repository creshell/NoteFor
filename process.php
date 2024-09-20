<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "phplogin"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM notes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<form method='post'>";
    echo "<select name='note_dropdown'>";
    while($note = $result->fetch_assoc()) {
        echo "<option value='" . $note['notes_id'] . "'>" . $note['title'] . "</option>";
    }
    echo "</select>";
    echo "<input type='submit' name='view_note_submit' value='View Note'>";
    echo "</form>";
} else {
    echo "No notes found";
}

if(isset($_POST['view_note_submit'])){
    $selected_note_id = $_POST['note_dropdown'];

    $selected_note_sql = "SELECT * FROM notes WHERE notes_id = $selected_note_id";
    $selected_note_result = $conn->query($selected_note_sql);
    if ($selected_note_result->num_rows > 0) {
        $selected_note = $selected_note_result->fetch_assoc();
        echo "<div class='note'>";
        echo "<h2>" . $selected_note['title'] . "</h2>";
        echo "<p>" . $selected_note['description'] . "</p>";
        echo "<p>Created at: " . $selected_note['created_at'] . "</p>";
        echo "<p>username: " . $selected_note['notes_username'] . "</p>";
        echo "</div>";
    } else {
        echo "Selected note not found";
    }
}


if(isset($_POST['update_notes_username_submit'])){
 
    $selected_username = $_POST['dropdown'];  
    
    $sql = "UPDATE notes SET notes_username = ? WHERE notes_id = 19"; 

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selected_username);

    // Execute the statement
    if ($stmt->execute()) {
        // Note updated successfully, redirect to dashboard or any other desired page
        header("Location: process.php");
        exit();
    } else {
        // Error occurred while updating note
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dropdown from Database</title>
</head>
<body>

<form method="post" action="">
    <select name="dropdown">
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "phplogin";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the database
        $sql = "SELECT user_id, username FROM accounts";
        $result = $conn->query($sql);

   
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='". $row["username"] ."'>". $row["username"] ."</option>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </select>
    <input type="submit" name="update_notes_username_submit" value="Update Notes Username">
</form>

</body>
</html>
