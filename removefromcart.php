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

// Get the product name from the request
$productName = $_POST['productName'];

// Prepare and execute SQL query to delete the product from the cart table
$sql = "DELETE FROM cart WHERE product = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $productName);

if ($stmt->execute()) {
    // Product deleted successfully
    echo "Product removed from cart successfully";
} else {
    // Error occurred
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>