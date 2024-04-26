<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindatabase";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['product'];
    $price = $_POST['price'];
    $sellerid = $_POST['sellerid'];
    $username = $_SESSION['username'];

    $category_tables = array('fruits', 'vegetables', 'honey', 'oil', 'meatandegg', 'saltandsugar');
    foreach ($category_tables as $category_table) {
        $check_sql = "SELECT * FROM $category_table WHERE productname = '$product' AND sellerid = '$sellerid'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc();
            $quantity = $row['quantity'];
            $updated_quantity = $quantity - 1;
            $update_sql = "UPDATE $category_table SET quantity = $updated_quantity WHERE productname = '$product' AND sellerid = '$sellerid'";
            if ($conn->query($update_sql) === FALSE) {
                echo "Error updating record: " . $conn->error;
                exit();
            }
            break; 
        }
    }


    $sql = "INSERT INTO cart (product, price, sellerid, quantity, userName)
            VALUES ('$product', '$price', '$sellerid', 1, '$username')";

    if ($conn->query($sql) === TRUE) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();