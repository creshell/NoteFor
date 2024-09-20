<?php
// Include function to get favorite notes
include 'favorite_process.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <script src="dashscript.js"></script>
    <title>Favorites</title>
</head>
<body>
<div class="container">
    
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
        <div class="favorite-search">
            <input type="text" name="query" placeholder="Search your notes here..." class="favorite-search-box" id="searchBox">
        </div>
        </div>
       
      
        <div class="notes-container">
        <?php foreach ($favorite_notes as $note): ?>
                <div class="note">
                    <h2><?php echo htmlspecialchars($note['title']); ?></h2>
                    <p><?php echo htmlspecialchars($note['description']); ?></p>
                    <p class="createdAt">Created at: <?php echo htmlspecialchars($note['created_at']); ?></p>
                    <!-- Additional note content or actions can be added here -->
                    <div class="settings">....
                        <i onclick="showMenu(this)" class="uil uil-ellipsis-h"></i>
                        <ul class="menu">
                            <li onclick="confirmUnfavorite(<?php echo $note['notes_id']; ?>)">Unfavorite</li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    
</div>

</body>
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
</html>
