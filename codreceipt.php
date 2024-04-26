<?php
session_start(); // Start the session

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

if (isset($_SESSION['username'])) { // Check if 'username' index is set in $_SESSION array
    $username = $_SESSION['username'];

    // Fetch data from cart table
    $cart_sql = "SELECT product, quantity, price FROM cart WHERE userName = '$username'";
    $cart_result = $conn->query($cart_sql);

    if ($cart_result->num_rows > 0) {
        // Insert data into paymenthistory table
        while ($row = $cart_result->fetch_assoc()) {
            $product = $row['product'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $insert_sql = "INSERT INTO paymenthistory (userName, product, quantity, price) VALUES ('$username', '$product', '$quantity', '$price')";
            if ($conn->query($insert_sql) !== TRUE) {
                echo "Error: " . $insert_sql . "<br>" . $conn->error;
            }       
        }

        $delete_sql = "DELETE FROM cart WHERE username = '$username'";
        if ($conn->query($delete_sql) !== TRUE) {
            echo "Error: " . $delete_sql . "<br>" . $conn->error;
        }
    } else {
        echo "No items in the cart.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bill</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="./billreceipt-style.css">
</head>

<body>

    <div class="container">
        <div class="confetti">
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
            <div class="confetti-piece"></div>
        </div>

        <div class="receipt">
            <p class="receipt__title">Thank you for shopping with us!!</p>
            <p class="receipt__subtitle">Your order is on its way!! <br> <i>Cash on delivery!📦🚚</i></p>
            <ul class="receipt__lines">
                <li class="receipt__line">
                    <span class="receipt__label">Subtotal:</span>
                    <span class="receipt__value subtotal"></span>
                </li>
                <li class="receipt__line">
                    <span class="receipt__label">GST:</span>
                    <span class="receipt__value gst"></span>
                </li>
                <li class="receipt__line">
                    <span class="receipt__label">Total:</span>
                    <span class="receipt__value total"></span>
                </li>
            </ul>

            <p class="receipt__total"> Total amount to be paid : <span class="receipt__total total"></span></p>
            <p class="receipt__back">
                <a href="./userindex.php" id="returnToShopLink">Return to shop</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var subtotalElement = document.querySelector('.receipt__value.subtotal');
            var gstElement = document.querySelector('.receipt__value.gst');
            var totalElement = document.querySelector('.receipt__value.total');
            var paymentData = JSON.parse(sessionStorage.getItem('payment')) || {};
            var subtotal = paymentData.Subtotal || 0;
            var gstAmount = paymentData.gstAmount || 0;
            var total = paymentData.total || 0;
            subtotalElement.textContent = "₹" + subtotal.toFixed(2);
            gstElement.textContent = gstAmount;
            totalElement.textContent = "₹" + total.toFixed(2);
            document.querySelector('.receipt__total.total').textContent = "₹" + total.toFixed(2);

            var returnToShopLink = document.getElementById('returnToShopLink');

            returnToShopLink.addEventListener("click", function (event) {
                sessionStorage.clear();
            });
        });
    </script>
</body>

</html>