<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="styles.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <title>College Transport Management System</title>
  <style>
    .p{
      text-align:center;
    }
    </style>
</head>

<body>
  <div class="wrapper">
    <div class="sidebar">
      <!-- Sidebar content here -->
    </div>
  </div>

  <div class="container">
    <div class="form">
      <div class="btn">
        <!-- Buttons content here -->
      </div>
      <center><?php
      // Database connection details
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "ctms";

      // Create a new database connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check the connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve the submitted username and password
        $submittedUsername = $_POST["email"];
        $submittedPassword = $_POST["password"];
        $keepSignedIn = isset($_POST["checkbox"]);

        // Check if the email domain is allowed
        if (strpos($submittedUsername, "@poornima.org") !== false) {
          // Email domain is allowed
          // Proceed with the login logic

          // Prepare and execute the SQL query to check if the user exists
          $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
          $stmt->bind_param("s", $submittedUsername);
          $stmt->execute();

          $result = $stmt->get_result();

          if ($result->num_rows == 1) {
            // User found, verify the password
            $row = $result->fetch_assoc();
            $storedPassword = $row["password"];

            if ($submittedPassword === $storedPassword) {
              // Password is correct, log in the user
              session_start();
              $_SESSION["username"] = $submittedUsername;
              if ($keepSignedIn) {
                // Set a long session expiration time (e.g., 30 days)
                ini_set('session.cookie_lifetime', 30 * 24 * 60 * 60);
              }
              // Redirect to the home page
              header("Location: index.php");
              exit();
            } else {
              // Password is incorrect
              $errorMessage = '<br><center><span style="color:white;"> Invalid password </center>';
            }
          } else {
            // User not found
            $errorMessage = '<br><center><span style="color:white;"> Invalid username or password </center> ';
          }

          // Close the prepared statement
          $stmt->close();
        } else {
          // Email domain is not allowed
         echo '<span style="color:white;"> invalid address';
        }
      }

      // Close the database connection
      $conn->close();
      ?></center>
      <form class="signUp" action="" method="POST">
        <div class="formGroup">
          <input type="email" placeholder="Email ID" name="email" required autocomplete="off">
        </div>
        <div class="formGroup">
          <input type="password" id="password" placeholder="Password" name="password" required autocomplete="off">
        </div>
        <div class="checkBox">
          <input type="checkbox" name="checkbox" id="checkbox">
          <span class="text">Keep me signed in on this device</span>
        </div>
        <div class="formGroup">
          <button type="submit" class="btn2">Sign In</button>
        </div>
      </form>
      <?php
      // Display error message if exists
      if (isset($errorMessage)) {
        echo '<p class="error">' . $errorMessage . '</p>';
      }
      ?>
    </div>
  </div>
</body>

</html>