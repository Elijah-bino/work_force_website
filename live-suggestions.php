<?php
// Database connection details
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "work";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["q"])) {
    $q = $_GET["q"];

    if (strlen($q) > 0) {
        $sql = "SELECT distinct service_name FROM service_providers WHERE service_name LIKE '$q%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $hint = "<div class='suggestions'>"; // Wrapping suggestions in a div for styling
            while ($row = $result->fetch_assoc()) {
                $hint .= "<p class='suggestion' onclick='selectSuggestion(\"" . $row['service_name'] . "\")'>" . $row['service_name'] . "</p>";
            }
            $hint .= "</div>";
        } else {
            $hint = "No suggestion";
        }
        echo $hint;
    }
} else {
    echo "No search query received.";
}

$conn->close();
?>
