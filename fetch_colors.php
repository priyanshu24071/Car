<?php
// Establish database connection
$servername = "localhost";
$username = "root"; 
$password = "Hihellobye@7"; 
$dbname = "carInfo"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<p>Connected</p>";
//Fetch colors from the color table
$sql = "SELECT * FROM color";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
