<?php
// Connect to your database (Replace placeholders with actual values)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category_tables = array('fruits', 'vegetables', 'honey', 'oil', 'meatandegg', 'saltandsugar');
$products = array();

foreach ($category_tables as $category_table) {
    $products_query = "SELECT productname AS product_name,sellerName As seller_name, sellerid AS seller_id, quantity FROM $category_table";
    $products_result = $conn->query($products_query);

    if ($products_result) {
        while ($product_row = $products_result->fetch_assoc()) {
            $products[] = $product_row;
        }
    } else {
        echo "Error: " . $products_query . "<br>" . $conn->error;
    }
}

$conn->close();
echo json_encode($products);


