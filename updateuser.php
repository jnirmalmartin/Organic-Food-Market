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
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["Name"];
            $email = $row["Email"];
            $phone = $row["Phone"];
            $address = $row["Address"];
        }
    } else {
        echo "0 results";
    }
} else {
    echo "Session username is not set.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Food Market - Register</title>
    <!-- Add your styles or link to a stylesheet if needed -->
    <style>
        body {
            font-family: cursive;
            margin: 0;
            padding: 0;
            background: url('https://familydoctor.org/wp-content/uploads/2016/11/52141462_l-scaled.jpg') center/cover no-repeat fixed;
        }

        header {
            background-color: coral;
            color: black;
            text-align: center;
            padding: 1em;
        }

        section {
            padding: 20px;
            text-align: center;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .auth-container {
            max-width: 400px;
            color: black;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0);
        }

        .auth-container form {
            text-align: center;
        }

        .auth-container label {
            display: block;
            margin-bottom: 8px;
        }

        .auth-container input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 12px;
        }

        .auth-container button {
            width: 100%;
            padding: 10px;
            background-color: coral;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .auth-container .google-signin {
            background-color: #4285F4;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        footer {
            background-color: #333;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.5);
            text-align: center;
            padding: 70px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Organic Food Market</h1>
    </header>

    <section>
        <h2>Update your details here... </h2>
        <div class="auth-container">
            <form method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="Name" value="<?php echo $name; ?>" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="Phone" pattern="[0-9]{10}" value="<?php echo $phone; ?>" required placeholder="Enter 10-digit phone number">

                <label for="address">Address:</label>
                <input type="text" id="address" name="Address" value="<?php echo $address; ?>" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="Email" value="<?php echo $email; ?>" required placeholder="Enter your email address">
                <button type="submit">Update Details</button>
            </form>
        </div>
    </section>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $phone = $_POST['Phone'];
        $address = $_POST['Address'];

        $sql = "UPDATE users SET Name='$name', Email='$email', Phone='$phone', Address='$address' WHERE username='$username'";

        if ($conn->query($sql) === TRUE) {
    ?>
            <script>
                alert("Details updated successfully");
                window.location.href = "user-dashboard.php";
            </script>
    <?php
        } else {
            echo "Error updating seller details: " . $conn->error;
        }
    }
    ?>

    <footer>
        <p>&copy; 2024 Organic Food Market. All rights reserved.</p>
    </footer>
</body>

</html>