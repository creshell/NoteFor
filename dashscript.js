function deleteNote(note_id) {
    // Show confirmation dialog before deleting the note
    if (confirm("Are you sure you want to delete this note?")) {
        // Redirect to delete_note.php with the note_id parameter
        window.location.href = "delete_note.php?note_id=" + note_id;
    }
}
function confirmRecovery(note_id) {
    var confirmRecovery = confirm("Are you sure you want to recover this note?");
    if (confirmRecovery) {
        // If user confirms, redirect to the PHP script with note_id
        window.location.href = "recover_note.php?note_id=" + note_id;
    } else {
        // If user cancels, do nothing
        return false;
    }
}

function confirmUnarchive(note_id) {
    var confirmRecovery = confirm("Are you sure you want to Unarchive this note?");
    if (confirmRecovery) {
        // If user confirms, redirect to the PHP script with note_id
        window.location.href = "unarchive.php?note_id=" + note_id;
    } else {
        // If user cancels, do nothing
        return false;
    }
}

function favoriteNote(noteId) {
    if (confirm("Are you sure you want to add this note to favorites?")) {
        window.location.href = "favorite_notes.php?id=" + noteId;
    }
}
function archiveNote(noteId) {
    if (confirm("Are you sure you want to archive this note?")) {
    // If user confirms, call archive_notes.php with the note ID
    window.location.href = "archive_notes.php?id=" + note_id;
    }
     }
    

 function validateForm(form) {
     var title = form.title.value.trim();
     var content = form.content.value.trim();
 
     if (title === '' || content === '') {
         alert('Please fill in all fields.');
         return false;
     }
 
     return true;
 }
 
 function openPopup(popupId) {
     document.getElementById(popupId).style.display = "block";
 }
 
 function closePopup(popupId) {
     document.getElementById(popupId).style.display = "none";
 }
 
 function archiveNote(noteId) {
    if (confirm("Are you sure you want to archive this note?")) {
        // If user confirms, call archive_notes.php with the note ID
        window.location.href = "archive_notes.php?notes_id=" + noteId;
    }
}
 
 function showLogoutPopup() {
     document.getElementById("logoutPopup").style.display = "block";
 }
 
 function closeLogoutPopup() {
     document.getElementById("logoutPopup").style.display = "none";
 }
// Function to handle logout
function logout() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Redirect to login page after successful logout
            window.location.href = "index.php";
        }
    };
    xhr.send();
}
 function confirmUnarchive(note_id) {
    var confirmRecovery = confirm("Are you sure you want to Unarchive this note?");
    if (confirmRecovery) {
        // If user confirms, redirect to the PHP script with note_id
        window.location.href = "unarchive.php?notes_id=" + note_id;
    } else {
        // If user cancels, do nothing
        return false;
    }
}

function confirmUnfavorite(note_id) {
    var confirmRecovery = confirm("Are you sure you want to Unarchive this note?");
    if (confirmRecovery) {
        // If user confirms, redirect to the PHP script with note_id
        window.location.href = "unfavorite.php?notes_id=" + note_id;
    } else {
        // If user cancels, do nothing
        return false;
    }
}
document.addEventListener("DOMContentLoaded", function() {
    var searchBox = document.getElementById("searchBox");

    searchBox.addEventListener("input", function() {
        var searchTerm = this.value.trim().toLowerCase();
        var notes = document.querySelectorAll(".note");

        notes.forEach(function(note) {
            var title = note.querySelector("h2").textContent.trim().toLowerCase();
            var content = note.querySelector("p").textContent.trim().toLowerCase();
            if (title.includes(searchTerm) || content.includes(searchTerm)) {
                note.style.display = "block";
            } else {
                note.style.display = "none";
            }
        });
    });
});
