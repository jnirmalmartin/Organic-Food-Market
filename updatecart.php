<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productname'];
    $newQuantity = $_POST['quantity'];
    $sellerid = $_POST['sellerid'];

    $previousQuantitySql = "SELECT quantity FROM cart WHERE product = '$productName'";
    $previousQuantityResult = $conn->query($previousQuantitySql);
    if ($previousQuantityResult->num_rows > 0) {
        $previousQuantity = $previousQuantityResult->fetch_assoc()['quantity'];
        if ($newQuantity > $previousQuantity) {
            $operation = "-";
        } elseif ($newQuantity < $previousQuantity) {
            $operation = "+";
        }
    }

    $category_tables = array('fruits', 'vegetables', 'honey', 'oil', 'meatandegg', 'saltandsugar');
    foreach ($category_tables as $category_table) {
        $update_sql = "UPDATE $category_table SET quantity = quantity $operation 1 WHERE productname = '$productName' AND sellerid = '$sellerid'";
        if ($conn->query($update_sql) === FALSE) {
            echo "Error updating record: " . $conn->error;
            exit();
        }
    }

    $sql = "UPDATE cart SET quantity = '$newQuantity' WHERE product = '$productName'";
    if ($conn->query($sql) === TRUE) {
        echo "<script> alert('Product updated to cart')</script>";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }
}

$conn->close();
?>