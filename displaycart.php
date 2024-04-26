<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cart";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='cart-item'>
                <div class='row'>
                    <div class='col-md-2'>
                        <img src='img/{$row['product']}.jpg' class='img-fluid' id='productimg' alt='{$row['product']}'>
                    </div>
                    <div class='col-md-4' style='margin-top: 10px;'>
                        <p class='product'><b>{$row['product']}</b></p>
                        <p class='sellerid'>{$row['sellerid']}</p>
                        <p class='price'>₹{$row['price']}</p>
                    </div>
                    <div class='col-md-2'style='margin-top: 10px;'>
                    <input type='number' class='form-control quantity' value='{$row['quantity']}' />                    </div>
                    <div class='col-md-2' style='margin-top: 10px;'>
                        <button class='btn btn-danger btn-remove' data-product-name='{$row['product']}'>Remove</button>
                    </div>
                    <div class='col-md-2' style='margin-top: 10px;'>
                        <h3 type='number' class='form-control' value=''>{$row['price']}/unit</h3>
                    </div>
                </div>
            </div>";
    }
} else {
    echo "0 results";
}
$conn->close();
