<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style2.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>
    <script src="Login/jquery-3.7.0.min.js"></script>
  <title>CTMS</title>
</head>
<style>
    .highlight {
        background-color: yellow;
    }
</style>
<body>
  <section>
    <!--for demo wrap-->
    <h1>Transport Facility & Fee</h1>
    <?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ctms";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the "transport_fees" table
$sql = "SELECT sno, pickup_point, fare FROM transport_fees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display search input field
    echo '<center><input type="text" id="searchInput" placeholder="Search..." /></center>';

    // Create the table header
    echo "<table>";
    echo "<tr><th>Sno</th><th>Pickup Point</th><th>Fare</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["sno"] . "</td>";
        echo "<td>" . $row["pickup_point"] . "</td>";
        echo "<td>" . $row["fare"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();

?>


<script>
    $(document).ready(function() {
        // Capture keyup event on the search input
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();

            // Filter the table rows based on the search term and highlight the matching results
            $("table tr").filter(function() {
                var rowText = $(this).text().toLowerCase();
                var matchIndex = rowText.indexOf(value);
                var matchLength = value.length;

                // Remove previous highlighting
                $(this).find("td").removeClass("highlight");

                if (matchIndex > -1) {
                    // Highlight the matching part of the row
                    var highlightedText = rowText.substr(matchIndex, matchLength);
                    var regex = new RegExp(highlightedText, "gi");
                    var highlightedRowText = rowText.replace(regex, '<span class="highlight">' + highlightedText + '</span>');
                    $(this).html($(this).html().replace(rowText, highlightedRowText));
                }

                $(this).toggle(rowText.indexOf(value) > -1);
            });
        });
    });
</script>    
</body>
</html>