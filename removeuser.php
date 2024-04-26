<?php
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


$userName = $_POST['userName'];
$pageName = $_POST['pageName'];

// Define the table name based on the pageName
$tableName = ($pageName == 'Sellers') ? 'seller' : 'users';

$sql = "DELETE FROM $tableName WHERE Username = ?";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userName);

// Execute the statement
if ($stmt->execute()) {
    echo '<script>alert("User removed successfully!!")</script>';

} else {
    echo '<script>alert("UserName not available in database")</script>';

}

$stmt->close();
$conn->close();
