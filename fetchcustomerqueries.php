<?php
// Connect to the database (Replace placeholders with actual values)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer queries from the database
$sql = "SELECT Name AS customerName, Issue AS issue, Description AS description FROM customerissue";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    $customerQueries = array();
    while ($row = $result->fetch_assoc()) {
        $customerQueries[] = $row;
    }
    // Return the data as JSON
    echo json_encode($customerQueries);
} else {
    // Return an empty array if no data is found
    echo json_encode([]);
}

// Close connection
$conn->close();
?>