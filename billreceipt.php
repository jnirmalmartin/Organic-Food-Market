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
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>bill</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="./billreceipt-style.css">
    <style>
        #totalmoney{
           height: 50px
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="confetti">
        </div>

        <div class="receipt">
            <p class="receipt__title">Thank you for shopping with us!!</p>
            <p class="receipt__subtitle">Your order is on its way!! <br> Here is your receipt:</p>
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

            <p class="receipt__total"> Total amount paid : <span class="receipt__total total" id="totalmoney"></span></p>
            <p class="receipt__back">
                <a href="userindex.php" id="returnToShopLink">Return to shop</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            debugger
            var paymentData = JSON.parse(sessionStorage.getItem('payment')) || {};
            var subtotal = paymentData.Subtotal || 0;
            var gstAmount = paymentData.gstAmount || 0;
            var total = paymentData.total || 0;
            document.querySelector('.receipt__value.subtotal').textContent = "₹" + subtotal.toFixed(2);
            document.querySelector('.receipt__value.gst').textContent = "₹" + gstAmount.toFixed(2);
            document.querySelector('.receipt__value.total').textContent = "₹" + total.toFixed(2);
            document.querySelector('.receipt__total.total').textContent = "₹" + total.toFixed(2);

            // Add event listener to "Return to shop" link
            var returnToShopLink = document.getElementById('returnToShopLink');
            returnToShopLink.addEventListener("click", function(event) {
                clearCart();
                sessionStorage.clear();
            });

            function clearCart() {
                var cartItemsContainer = document.getElementById('cart-items-container');
                cartItemsContainer.innerHTML = '';
            }
        });
    </script>
</body>

</html>