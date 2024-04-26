<?php
// Connect to your database (Replace placeholders with actual values)
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

$products = array();

$products_query = "SELECT userName AS customer_name,product As product, price AS price, quantity AS quantity, purchasedate as dateofpurchase   FROM paymenthistory";
$products_result = $conn->query($products_query);

if ($products_result) {
    while ($product_row = $products_result->fetch_assoc()) {
        $products[] = $product_row;
    }
} else {
    echo "Error: " . $products_query . "<br>" . $conn->error;
}


// Close connection
$conn->close();

// Return products as JSON response
echo json_encode($products);
