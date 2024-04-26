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

// Fetch products from each category table
$category_tables = array('fruits', 'vegetables', 'honey', 'oil', 'meatandegg', 'saltandsugar');

$products = array();

foreach ($category_tables as $category_table) {
    $products_query = "SELECT productname AS product_name, price AS price, description AS description, SUM(quantity) AS total_quantity FROM $category_table GROUP BY product_name";
    $products_result = $conn->query($products_query);

    if ($products_result) {
        while ($product_row = $products_result->fetch_assoc()) {
            $products[] = $product_row;
        }
    } else {
        // Handle SQL error
        echo "Error: " . $products_query . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();

// Display products
foreach ($products as $row) {
    echo "<div class='col-md-3'>
            <div class='card h-80'>
              <img src='img/{$row['product_name']}.jpg' class='card-img-top' alt='{$row['product_name']}'>
              <div class='card-body'>
                <h5 class='card-title'>{$row['product_name']}</h5>
                <p class='card-text'>Price: {$row['price']} /quantity</p>
                <p class='card-text'>Available quantity: {$row['total_quantity']}</p>
                <p class='card-text'>Description: {$row['description']}</p>
                <button style='width: 100%; text-align:center; background:#ffc107; padding: 5px; border: none; border-radius: 7px;'; onclick='loginuser()'>Login to order!!🔔</button>
              </div>
            </div>
          </div>";
}
?>