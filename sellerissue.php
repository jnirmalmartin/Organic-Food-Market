<?php
session_start();
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $issuetype = $_POST['issue'];
    $issuedescription = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO sellerissue (Name, issue, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $issuetype, $issuedescription);
    
    if ($stmt->execute() === TRUE) {
        echo '<script>alert("Issue submitted successfully!!"); window.location.href = "sellerdashboard.php";</script>'; 
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>