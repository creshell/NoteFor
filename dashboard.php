<?php include 'function.php';
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <script src="dashscript.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>NoteFor</title>
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
            <div class="addbtn" onclick="openPopup('add-note-popup')">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                    </svg> 
                    Add Note
                </span>
            </div>
            <div class="search">
            <input type="text" name="query" placeholder="Search your notes here..." class="search-box" id="searchBox">
        </div>
          
        </div>
        <div class="notes-container">
            <?php foreach ($notes as $note): ?>
                <div class="note">
                    <h2><?php echo $note['title']; ?></h2>
                    <p><?php echo substr($note['description'], 0, 100); ?></p>
                    <p class="createdAt"><strong>Created at: </strong><?php echo $note['created_at']; ?></p>
                    <div class="settings">...
                    <div class="menu">
                        <li  onclick="openPopup('view-note-popup-<?php echo $note['notes_id']; ?>')" >View Notes</li>
                        <li onclick="openPopup('edit-note-popup-<?php echo $note['notes_id']; ?>')" >Edit</li>
                        <li onclick="deleteNote(<?php echo $note['notes_id']; ?>)">Delete</li>
                         <li onclick="archiveNote(<?php echo $note['notes_id']; ?>)">Archive</li>
                        <li onclick="favoriteNote(<?php echo $note['notes_id']; ?>)">Favorite</li>

                    </div>
                    </div>
              


                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="popup-box" id="add-note-popup">
                <div class="popup">
                    <h2>Add Note</h2>
                    <button class="closeBtn" onclick="closePopup('add-note-popup')">X</button>
                    <div class="container1">
                        <form action="add_process.php" method="post" onsubmit="return validateForm(this)">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" >
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" rows="4" ></textarea>
                            <input type="submit" value="Add Note">
                        </form>
                    </div>
                
                </div>
    </div>

    <!-- View note popups -->
    <?php foreach ($notes as $note): ?>
        <div class="popup-box" id="view-note-popup-<?php echo $note['notes_id']; ?>">
    <div class="popup">

        <div class="notes-container">
        <h1>View Note</h1>
        <p><strong>Title: </strong><?php echo $note['title']; ?></p>
        <p><strong>Content: </strong><?php echo $note['description']; ?></p>
        <p><strong>Created at: </strong><?php echo $note['created_at']; ?></p>
    
    </div>
    <div class="submit_container">
    <button onclick="closePopup('view-note-popup-<?php echo $note['notes_id']; ?>')">X</button>
             </div> 
     
    </div>
</div>
    <?php endforeach; ?>

    <!-- Edit note popups -->
    <?php foreach ($notes as $note): ?>
        <div class="popup-box" id="edit-note-popup-<?php echo $note['notes_id']; ?>">
    <div class="popup">
        <div class="container1">
            <h1>Update Note</h1>
            <form method="post" action="edit_note.php?notes_id=<?php echo $note['notes_id']; ?>">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($note['title']); ?>"><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description"><?php echo htmlspecialchars($note['description']); ?></textarea><br>
                <div class="submit_container">
                <input type="submit" value="Update Note">
                <button class="closeBtn" onclick="closePopup('edit_note-popup')">X</button>
             </div> 
            </form>
        </div>

    </div>
</div>
    <?php endforeach; ?>

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
    function validateForm(form) {
    var title = form.title.value.trim();
    var description = form.description.value.trim();

    if (title === '' || description === '') {
        alert("Title and Description cannot be empty.");
        return false;
    }
    return true;
}
</script>
</body>
</html>
