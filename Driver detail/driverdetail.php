<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style2.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>
  <title>CTMS</title>
</head>
<body>
<?php
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

    // Retrieve data from the "driver_details" table
    $sql = "SELECT name, bus_no, mobile_number FROM driver_details";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th><center>Name</center></th><th><center>Bus No</center></th><th><center>Mobile Number</center></th></tr></center>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><center>" . $row["name"] . "</center></td>";
            echo "<td><center>" . $row["bus_no"] . "</center></td>";
            echo "<td><center>" . $row["mobile_number"] . "</center></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    // Close database connection
    $conn->close();
    ?>
  
  
  <script src="javas.js">
  </script>
  <script>
    $(document).ready(function() {
      $("#gfg").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#geeks tr").filter(function() {
          $(this).toggle($(this).text()
          .toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
</body>
</html>