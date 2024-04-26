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

// Fetch seller queries from the database
$sql = "SELECT Name AS sellerName, Issue AS issue, Description AS description FROM sellerissue";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    $sellerQueries = array();
    while ($row = $result->fetch_assoc()) {
        $sellerQueries[] = $row;
    }
    // Return the data as JSON
    echo json_encode($sellerQueries);
} else {
    // Return an empty array if no data is found
    echo json_encode([]);
}

// Close connection
$conn->close();
?>