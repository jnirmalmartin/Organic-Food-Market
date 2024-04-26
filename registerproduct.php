<?php
session_start(); // Start the session

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
    $category = $_POST['category'];
    $price = $_POST['price'];
    $sellerId = $_POST['sellerid'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    // Check if the username is set in the session
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Check if the product already exists for the user in the respective table
        $existing_product_query = "SELECT * FROM $category WHERE productname = '$productName' AND sellerName = '$username'";
        $existing_product_result = $conn->query($existing_product_query);

        if ($existing_product_result) {
            if ($existing_product_result->num_rows > 0) {
                $existing_product_data = $existing_product_result->fetch_assoc();
                $existing_quantity = $existing_product_data['quantity'];
                $new_quantity = $existing_quantity + $quantity;

                $update_query = "UPDATE $category SET quantity = '$new_quantity' WHERE productname = '$productName' AND sellerName = '$username'";

                if ($conn->query($update_query) === TRUE) {
                    echo '<script>alert("Product quantity updated successfully!!"); window.location.href = "sellerdashboard.php";</script>';
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                $sql = "INSERT INTO $category (productname, sellerid, price, sellerName, quantity, description) VALUES ('$productName', '$sellerId', '$price', '$username', '$quantity', '$description')";

                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Product registered successfully!!"); window.location.href = "sellerdashboard.php";</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Error in query: " . $conn->error;
        }
    } else {
        echo '<script>alert("Session username is not set."); window.location.href = "sellerdashboard.php";</script>';
    }
}

$conn->close();
?>