<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="style1.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container">
      <div class="form">
        <div class="contact-info">
          <h3 class="title">How Can We Help?</h3>
          <p class="text">
            Email us with any question or inquiries. We would be happy to answer your questions and set up a meeting with you.
          </p>

          <div class="info">
            <div class="information">
              <p>Address: ISI - 2, Poornima Marg, Sitapura, Jaipur, Rajasthan 302022</p>
            </div>
            <div class="information">
              <p>Mail: Info@poornima.org</p>
            </div>
            <div class="information">
              <p>Phone no: +91-9928666222</p>
            </div>
          </div>

          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div><br>
          </div>
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form method="POST" action="contactus.php" autocomplete="off">
            <h3 class="title">Contact us</h3>
            <div class="input-container">
              <input type="text" name="username" class="input" required />
              <label for="">Username</label>
              <span>Username</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" required />
              <label for="">Email</label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="phone_no" class="input" required />
              <label for="">Phone</label>
              <span>Phone</span>
            </div>
            <div class="input-container textarea">
              <textarea name="message" class="input" required></textarea>
              <label for="">Message</label>
              <span>Message</span>
            </div>
            <input type="submit" value="Submit" class="btn" />
          </form>
          <?php
          // Assuming you have a MySQL database set up

          // Database connection configuration
          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "ctms";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $database);

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Handle form submission
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              // Retrieve form data
              $username = $_POST["username"];
              $email = $_POST["email"];
              $phone_no = $_POST["phone_no"];
              $message = $_POST["message"];

              // Prepare SQL statement
              $sql = "INSERT INTO contacts (username, email, phone_no, message) VALUES ('$username', '$email', '$phone_no', '$message')";

              // Execute SQL statement
              if ($conn->query($sql) === TRUE) {
                  echo "<p class='success-message'>Thank you for contacting us!</p>";
              } else {
                  echo "<p class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
              }
          }

          // Close database connection
          $conn->close();
          ?>
        </div>
      </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>
