<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindatabase";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$seller_id = $_POST['seller_id'];
$product_name = $_POST['product_name'];


$category_tables = array('fruits', 'vegetables', 'honey', 'oil', 'meatandegg', 'saltandsugar');

foreach ($category_tables as $category_table) {
    $sql = "DELETE FROM $category_table WHERE sellerid = '$seller_id' AND productname = '$product_name'";
    if ($conn->query($sql) !== TRUE) {
        echo "Error deleting record: " . $conn->error;
        exit();
    }
}

$conn->close();
