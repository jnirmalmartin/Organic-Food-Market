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
            background-color: #618a3d;
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
        <h2>Seller Registeration... </h2>
        <div class="auth-container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="Name" required>

                <label for="age">Age:</label>
                <input type="number" id="age" name="Age" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="Phone" pattern="[0-9]{10}" required placeholder="Enter 10-digit phone number">

                <label for="address">Address:</label>
                <input type="text" id="address" name="Address" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="Email" required placeholder="Enter your email address">

                <label for="new-username">Create a Username:</label>
                <input type="text" id="new-username" name="new-username" required>

                <label for="new-password">Password:</label>
                <input type="password" id="new-password" name="new-password" required>

                <!-- Input for organic farming certificate -->
                <label for="organic-certificate">Upload Organic Farming Certificate (JPG/PNG):</label>
                <input type="file" id="organic-certificate" name="organic-certificate" accept="image/jpeg, image/png" required>

                <button type="submit">Register</button>
                <p>Existing user? <a href="ofm1.php">Login Here</a></p>
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Organic Food Market. All rights reserved.</p>
    </footer>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logindatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['Name'];
        $age = $_POST['Age'];
        $phone = $_POST['Phone'];
        $address = $_POST['Address'];
        $email = $_POST['Email'];
        $username = $_POST['new-username'];
        $password = $_POST['new-password'];

        $certificateName = $_FILES['organic-certificate']['name'];
        $certificateTmpName = $_FILES['organic-certificate']['tmp_name'];
        $certificateType = $_FILES['organic-certificate']['type'];
        $certificateContent = addslashes(file_get_contents($certificateTmpName));


        function generateRandomNumber()
        {
            return str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
        }

        $sellerid = "ORGSELL_" . generateRandomNumber();

        $sql = "INSERT INTO seller (Name, Age, Phone, Address, Email, Username, Password, Organic_Certificate_Content,sellerid)
                VALUES ('$name', '$age', '$phone', '$address', '$email', '$username', '$password', '$certificateContent','$sellerid')";

        if ($conn->query($sql) === TRUE) {
    ?>
            <script>
                alert("Seller registered successfully");
                window.location.href = "ofm1.php";
            </script>
    <?php
        } else {
            echo '<script>alert("Incorrect login details or register your account!")</script>';
        }
    }

    $conn->close();
    ?>
</body>

</html>