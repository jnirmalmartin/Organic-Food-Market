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
    $description = $_POST['description'];
    $issue = $_POST['issue'];
   

    $stmt = $conn->prepare("INSERT INTO customerissue (Name, issue, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $issue,$description);

    if ($stmt->execute() === TRUE) {
        echo '<script>alert("Issue submitted successfully!!"); window.location.href = "userindex.php";</script>'; 
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>