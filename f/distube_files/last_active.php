<?php
// Connect to your database
$servername = "mysql2.serv00.com";
$username = "riot";
$password = "password";
$dbname = "distube";

// Create connection //
$conn = new mysqli($servername, $username, $password, $dbname);
  
  // i dont know if you can access this, it's just people's active //

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve last users online
$sql = "SELECT * FROM users ORDER BY last_online DESC LIMIT 10"; // Change the limit as per your requirement

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "User ID: " . $row["id"]. " - Username: " . $row["username"]. " - Last Online: " . $row["last_online"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
