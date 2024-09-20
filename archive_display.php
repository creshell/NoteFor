<?php include 'archive_process.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <script src="dashscript.js"></script>
    <title>Archive </title>
</head>
<body>
<div class="container">
    
  <!-- Sidebar -->
  <div class="sidebar">
        <img src="img/logo.png" alt="Logo" width="150">
        <a href="profile.php"></a> <!-- Add your link here -->
        <ul>
            <li><a href="dashboard.php">
                <i class="fas fa-allnotes"></i>
                <span class="nav-item">All Notes</span>
            </a></li>
            <li><a href="favorites.php">
                <i class="fas fa-favorites"></i>
                <span class="nav-item">Favorites</span>
            </a></li>
            <li><a href="archive_display.php">
                <i class="fas fa-archive"></i>
                <span class="nav-item">Archive</span>
            </a>
           
            <li class="logout" onclick="logout()">Logout</li>
        </ul>


        
    </div>

    <!-- Content -->
    <div class="content">
        <div class="header" id="header">
        <div class="user">
               
               </div>
        <div class="archive-search">
            <input type="text" name="query" placeholder="Search your notes here..." class="archive-search-box" id="searchBox">
        </div>
        </div>
       
        <!-- Display archived notes -->
        <div class="notes-container">
        <?php foreach ($notes as $note): ?>
                <div class="note">
                <h2><?php echo substr($note['title'], 0, 20); ?></h2>
                <p><?php echo wordwrap($note['description'], 20); ?></p>
                    
                    <p class="createdAt">Created at: <?php echo $note['created_at']; ?></p>
                    
                    <div class="settings">....
                                   <i onclick="showMenu(this)" class="uil uil-ellipsis-h"></i>
                                   <ul class="menu">
                                <li onclick="confirmUnarchive(<?php echo $note['notes_id']; ?>)">Unarchive</li>

                                   </ul>
                               </div>
                </div>
                
                
            <?php endforeach; ?>
        </div>
    </div>
                <!-- Add note popup -->
<div class="popup-box" id="add-note-popup">
    <div class="popup">
        <h2>Add Note</h2>
        <div class="container1">
        <h1>Add New Note</h1>
        <button onclick="closePopup('add-note-popup')">Close</button>
        <form action="add_process.php" method="post" onsubmit="return validateForm(this)">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="4" required></textarea>
            <input type="submit" value="Add Note">
        </form>
       
    </div>
        
    </div>
</div>

<!-- View note popup -->
<?php foreach ($notes as $note): ?>
<div class="popup-box" id="view-note-popup-<?php echo $note['notes_id']; ?>">
    <div class="popup">
        <h2>View Note</h2>
        <div class="container1">
        <h1>View Note</h1>
        <p><strong>Title: </strong><?php echo $note['title']; ?></p>
        <p><strong>Content: </strong><?php echo $note['description']; ?></p>
        <p><strong>Created at: </strong><?php echo $note['created_at']; ?></p>
        <button onclick="openPopup('edit-note-popup-<?php echo $note['notes_id']; ?>')">Edit Note</button>
        
        <button onclick="showConfirmation(<?php echo $note['notes_id']; ?>)">Delete</button>

    </div>
        <button onclick="closePopup('view-note-popup-<?php echo $note['notes_id']; ?>')">Close</button>
    </div>
</div>
<?php endforeach; ?>

<!-- Edit note popup -->
<?php foreach ($notes as $note): ?>
<div class="popup-box" id="edit-note-popup-<?php echo $note['note_id']; ?>">
    <div class="popup">
        <h2>Edit Note</h2>
        <div class="container1">
            <h1>Update Note</h1>
            <form method="post" action="edit_notes.php?note_id=<?php echo $note['note_id']; ?>">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($note['title']); ?>"><br>
                <label for="content">Content:</label><br>
                <textarea id="content" name="content"><?php echo htmlspecialchars($note['content']); ?></textarea><br>
                <input type="submit" value="Update Note">
            </form>
        </div>
        <button onclick="closePopup('edit-note-popup-<?php echo $note['note_id']; ?>')">Close</button>
    </div>
</div>
<?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    // JavaScript to set the username in the user class
    document.addEventListener('DOMContentLoaded', function() {
        <?php
        if (isset($_SESSION['username'])) {
            echo "document.querySelector('.user').innerText = 'User: " . $_SESSION['username'] . "';";
        }
        ?>
    });
</script>
</body>
</html>

