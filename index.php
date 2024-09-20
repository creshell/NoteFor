<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>NoteFor</title>
</head>
<body>
    <div class="container" id="main">
        <div class="sign-up">
            <br>
         <form id="registrationForm" action="register.php" method="post" autocomplete="off">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username">
            <div id="usernameError" class="error-message"></div> <!-- Username error message -->
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password">
            <div id="passwordError" class="error-message"></div> <!-- Password error message -->
            <label for="confirmpass">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="confirmpass" placeholder="Confirm Password" id="confirmpass">
            <div id="confirmPasswordError" class="error-message"></div> <!-- Confirm password error message -->
            <label for="email">
                <i class="fas fa-envelope"></i>
            </label>
            <input type="email" name="email" placeholder="Email" id="email">
            <div id="emailError" class="error-message"></div> <!-- Email error message -->
            <input type="submit" value="Register" class=input-register>
        </form>

        </div>
        <div class="sign-in">
            <form action="login_connect.php" method="post" class="loginForm">
                    <p>Sign in to your existing account</p>
                    <img src="images/user4.png" alt="" class="regImg" style="margin-top: 7px;">
                    <input type="text" name="username" placeholder="USERNAME" >
                    <div class="errorMessage" id="errorMessage1"></div> <!-- Username error message -->
                    <img src="images/password.png" alt="" class="regImg" style="width: 27px;">
                    <input type="password" name="password" placeholder="PASSWORD" >
                    <div class="errorMessage" id="errorMessage2"></div> <!-- Password error message -->
                    <a href="#" id="forgotPassword">Forgot Password?</a>
                    <button type="submit" class="submit">Login</button>
                </form>
     </div>
     <div class="overlay-container">
      <div class="overlay">
          <div class="overlay-left">
              <h1>Hello users!</h1>
              <p>Log in with your existing account here</p>
              <button id="signIn" onclick="toggleOverlay()">Sign In</button>
          </div>
          <div class="overlay-right">
              <h1>WELCOME!</h1>
              <br>
              <br>
              <div class="social-container">
                  <a href="#" class="socail"><i ><img src="img/logo.png" alt=""></i></a>
              </div>
              <br>
              <br>
              <p>Don't have account? Register Here!</p>
              <button id="signUp" onclick="toggleOverlay()">Register</button>
          </div>
      </div>
   </div>
     
  </div>
  <script>
   document.querySelector(".loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Gather form data
    var formData = new FormData(this);

    // Send form data via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login_connect.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Set content type
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Parse response JSON
            var response = JSON.parse(xhr.responseText);

            // Clear previous error messages
            document.querySelectorAll(".errorMessage").forEach(function(element) {
                element.innerHTML = "";
            });

            // Display validation errors, if any
            if (response.success) {
                // If login is successful, redirect to dashboard
                window.location.href = "dashboard.php";
            } else {
                // Display error messages
                if (response.username) {
                    document.getElementById("errorMessage1").innerHTML = response.username;
                }
                if (response.password) {
                    document.getElementById("errorMessage2").innerHTML = response.password;
                }
                // Additional error handling if needed
            }
        }
    };
    xhr.send(new URLSearchParams(formData)); // Send form data as URL encoded string
});

    document.getElementById("registrationForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Gather form data
        var formData = new FormData(this);

        // Send form data via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "register.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Parse response JSON
                var response = JSON.parse(xhr.responseText);

                // Clear previous error messages
                document.querySelectorAll(".error-message").forEach(function (element) {
                    element.innerHTML = "";
                });

                // Display validation errors, if any
                if (response) {
    // Check if the response contains errors
                if (response.username) {
                    document.getElementById("usernameError").innerHTML = response.username;
                }
                if (response.password) {
                    document.getElementById("passwordError").innerHTML = response.password;
                }
                if (response.confirmpass) {
                    document.getElementById("confirmPasswordError").innerHTML = response.confirmpass;
                }
                if (response.email) {
                    document.getElementById("emailError").innerHTML = response.email;
                }
                // Additional error handling if needed
            } else {
                // If no errors, show a success message
                alert("Registration successful! You can now log in.");
                // Redirect to a different page if needed
             
            }
            }
        };
        xhr.send(formData);
    });
</script>


</body>
</html>

