<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindatabase";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM fruits";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      echo "<div class='col-md-3'>
                    <div class='card h-80'>
                      <img src='img/{$row['productname']}.jpg' class='card-img-top' alt='{$row['productname']}'>
                      <div class='card-body'>
                        <h5 class='card-title fw-bold'>{$row['productname']}</h5>
                        <p class='card-text'> Price : {$row['price']}/quantity</p>
                        <p class='card-text'> Seller Name : {$row['sellerName']}</p>
                        <p class='card-text'> Seller id : {$row['sellerid']}</p>
                        <p class='card-text'>Description : {$row['description']}</p>
                        <form action='addToCart.php' method='POST' id='cartform'>
                          <input type='hidden' name='product' value='{$row['productname']}'>
                          <input type='hidden' name='price' value='{$row['price']}'>
                          <input type='hidden' name='sellerid' value='{$row['sellerid']}'>
                          <button type='button' class='btn btn-warning' onclick='onSubmit(this)'>Add to Cart</button>
                        </form>
                      </div>
                    </div>
                  </div>";

    
  }
} else {
  echo "No products available!!";
}
$conn->close();
