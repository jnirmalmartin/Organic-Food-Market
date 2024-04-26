<?php
session_start();

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

// Retrieve the username from the session
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare SQL query to fetch order details for the logged-in user
    $sql = "SELECT * FROM paymenthistory WHERE userName = '$username'";
    $result = $conn->query($sql);

    $orderDetails = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orderItem = array(
                'product' => $row['product'],
                'quantity' => $row['quantity'],
            );
            array_push($orderDetails, $orderItem);
        }
    }

    
    echo json_encode($orderDetails);
} else {
    // Redirect to login page if user is not logged in
    header("Location: ofm1.php");
}

$conn->close();
?>