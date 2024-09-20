function deleteNote(note_id) {
    // Show confirmation dialog before deleting the note
    if (confirm("Are you sure you want to delete this note?")) {
        // Redirect to delete_note.php with the note_id parameter
        window.location.href = "delete_note.php?note_id=" + note_id;
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
 
 function confirmLogout() {
     // Prompt the user for confirmation
     var confirmLogout = confirm('Do you want to log out?');
    
     // If the user confirms, log them out
     if (confirmLogout) {
         logout();
     }
     // If the user cancels, do nothing
 }
 
 function logout() {
     // Redirect to another page (replace 'new_page.html' with the actual page you want to redirect to)
     window.location.href = 'index.php';
 }
 