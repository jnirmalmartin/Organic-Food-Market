<?php
// Start session
session_start();


// Establish database connection
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
$sql = "SELECT * FROM users WHERE Username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userDetails = $result->fetch_assoc();
} else {
    echo "User details not found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Food Market - User Profile</title>
    <style>
        body {
            font-family: cursive;
            margin: 0;
            padding: 0;
            background: url('https://familydoctor.org/wp-content/uploads/2016/11/52141462_l-scaled.jpg') center/cover no-repeat fixed;
        }

        button{
            padding: 10px;
            width:100px;
            background-color: #ab495b;
        }
        .order-card {
            border: 1px solid black;
            border-radius: 5px;
            margin-bottom: 10px;
            width: 300px;
            margin-right: 10px;
            text-align: center;
            background: #618a3d;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
        }

        header {
            background-color: #618a3d;
            color: black;
            text-align: center;
            padding: 10px;
        }

        footer {
            background-color: #333;
            color: #fff;
            bottom: 0px;
            position: fixed;
            width: 100%;
            text-align: center;
            padding: 20px 0;
        }

        #order-details {
            margin-top: 20px;
            justify-content: center;
            align-items: center;
            display: flex;
            
        }

        .order-card p {
            margin: 5px 0;
            padding: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Organic Food Market</h1>
    </header>
    <div id="order-details">
        <div class="order-card">
            <header style="background-color: #ab495b;">
                <h3>User Profile</h3>
            </header>
            <p>Name: <?php echo isset($userDetails['Name']) ? $userDetails['Name'] : ''; ?></p>
            <p>Age: <?php echo isset($userDetails['Age']) ? $userDetails['Age'] : ''; ?></p>
            <p>Phone: <?php echo isset($userDetails['Phone']) ? $userDetails['Phone'] : ''; ?></p>
            <p>Address: <?php echo isset($userDetails['Address']) ? $userDetails['Address'] : ''; ?></p>
            <p>Email: <?php echo isset($userDetails['Email']) ? $userDetails['Email'] : ''; ?></p>
            <p style="margin-top:20px"><a href="updateuser.php" target="_blank"> <button >Edit</button></a></p>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Organic Food Market. All rights reserved.</p>
    </footer>
</body>

</html>