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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginType = $_POST['loginType'];

    if ($loginType == 'user') {
        $table = 'users';
    } elseif ($loginType == 'admin') {
        $table = 'admin';
    } elseif ($loginType == 'seller') {
        $table = 'seller';
    }

    $sql = "SELECT * FROM $table WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        $_SESSION['username'] = $username;
        if ($loginType == 'user') {
            header("Location: userindex.php");
        } elseif ($loginType == 'admin') {
            header("Location: admindashboard.php");
        } elseif ($loginType == 'seller') {
            header("Location: sellerdashboard.php");
        }
        exit();
    } else {
        echo '<script>alert("Incorrect login details or register your account!")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./userdashboard-style.css">
    <title>Organic Food Market - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: cursive;
            margin: 0;
            padding: 0;
            background: url('img/view.jpg') center/cover no-repeat fixed;
        }

        header {
            background-color: seagreen;
            color: black;
            text-align: center;
            padding: 0.55em;
        }

        .product-container {
            max-height: 550px;
            overflow-y: auto;
        }

        section {
            height: 600px;
            text-align: center;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.75);
            margin: auto;
            width: 600px;
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 50px;
            padding: 30px;
            border-radius: 10px;
            border: 5px solid #618a3d;
        }

        select {
            text-align: center;
            width: 200px;
            margin-bottom: 10px;
        }

        .formheading {
            color: #618a3d;
            font-weight: 600;
            padding: 5px;
        }

        .shadow-lg {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.5) !important;
        }

        .featured {
            background-color: #618a3d;
            padding: 100px;
        }

        .featuredd {
            background-color: #618a3d;
            padding: 100px;
            padding-top: 50px;

        }

        .fresh {
            font-size: larger;
            color: beige;
        }

        .auth-container {
            max-width: 400px;
            color: white;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0);
            opacity: 0.8;
            background: #2d2a2a;
            box-shadow: 0 26px 42px rgba(0, 0, 0, 0.1);
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

        .card {
            box-shadow: 1px 1px 15px 92cc9f;
        }

        .product-container .col-md-3{
            margin-bottom: 10px;
        }

        .card img {
            padding: 20px;
            height: 225px;
            width: 225px;
            margin-left: auto;
            margin-right: auto;
        }


        .card-title a {
            color: #333;
            text-decoration: none;
        }

        footer {
            background-color: #333;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 70px;
        }
    </style>
</head>

<body>
    <header style="background-color: #6fa63e;">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="userindex.php" class="navbar-brand ">
                    <h2 class="fw-bold m-0 " style="background-color: lightyellow; padding: 7px;border: 2px solid black;"><img src="img/logo.png" style="height: 52px;">ORGANIC FOOD MARKET</h2>
                </a>
                <div class="collapse navbar-collapse" style="font-size: large;">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="ofm1.php" style="color: black; " >🏠 Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Feature" style="color: black;">🎯Our Features</a></li>
                        <li class="nav-item"><a class="nav-link" href="#products" style="color: black;">📦Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact" style="color: black;">📱Contact us</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section>
        <h3 class="formheading">Welcome to our Organic Food Market!</h3>
        <div class="auth-container">
            <p style="font-size: larger;font-weight: 600;color: yellow;">Existing User/Seller? Login here!💻</p>
            <form id="loginForm" method="POST">
                <label for="username">Enter the username: 👤</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Enter Password: ⌨️</label>
                <input type="password" id="password" name="password" required>
                <label for="loginType">Login As:</label>
                <select id="loginType" name="loginType">
                    <option value="user">User</option>
                    <option value="seller">Seller</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="button" onclick="login()" style="margin-top: 10px;">Login</button>
            </form>

            <p style="margin-top: 20px;">New user? <a href="user-register.php" style="color: yellow;  text-decoration:none">Register here!🔔</a></p>
        </div>
    </section>

    <div class="container-fluid featured">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid w-100" src="img/abou.jpg">
                </div>
                <div class="col-lg-6 wow fadeIn" style="font-weight: 500;" data-wow-delay="0.5s">
                    <h1 class="display-5 mb-4" style="font-size: 40px;">Discover Freshness: Organic Fruits And Vegetables</h1>
                    <h4 class="mb-4 fresh">Indulge in nature's bounty with our selection of the freshest organic fruits and vegetables. Experience the true essence of flavor and health in every bite.</h4>
                    <p><i class="fa fa-check text-warning me-3"></i>Handpicked for optimum freshness and taste</p>
                    <p><i class="fa fa-check text-warning me-3"></i>Locally sourced to support sustainable farming</p>
                    <p><i class="fa fa-check text-warning me-3"></i>Packed with nutrients for a healthy lifestyle</p>
                    <a class="btn btn-warning rounded-pill py-3 px-5 mt-3" href="#products">Explore our products</a>
                </div>
            </div>
        </div>
    </div>
    <hr />

    <div class="container-fluid featured">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-5 mb-3" id="Feature" style="padding-top: 15px;">Discover Our Features</h1>
                <p>Explore what sets us apart from the rest and why our products are the best choice for you.</p>
            </div>
            <div class="row g-4" style="padding-bottom: 30px;">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="shadow-lg bg-white text-center h-100 p-4 p-xl-5" style="border-radius:10px">
                        <img class="img-fluid mb-4" src="img/green.png" style="height:100px" alt="">
                        <h4 class="mb-3">Natural Process</h4>
                        <p class="mb-4">Experience the purity of nature with our products crafted through natural processes.</p>
                        <a class="btn btn-outline-success border-2 py-2 px-4 rounded-pill" href="#products">Our Products</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="shadow-lg bg-white text-center h-100 p-4 p-xl-5" style="border-radius:10px">
                        <img class="img-fluid mb-4" src="img/organicc.png" style="height:100px" alt="">
                        <h4 class="mb-3">Organic Products</h4>
                        <p class="mb-4">Indulge in products cultivated with care, free from harmful chemicals and pesticides.</p>
                        <a class="btn btn-outline-success border-2 py-2 px-4 rounded-pill" href="#products">Our Products</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="shadow-lg bg-white text-center h-100 p-4 p-xl-5" style="border-radius:10px">
                        <img class="img-fluid mb-4" src="img/food.png" style="height:100px" alt="">
                        <h4 class="mb-3">Biologically Safe</h4>
                        <p class="mb-4">Trust in our commitment towards providing biologically safe products for you and your family.</p>
                        <a class="btn btn-outline-success border-2 py-2 px-4 rounded-pill" href="#products">Our Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />

    <div class="container-fluid featuredd">
        <div class="container my-5" id="products" style="height: 100%;margin: 0; justify-content:center;">
            <h2 class="display-5 underline text-center mb-5">Our Products</h2>
            <div class="product-container row">
                <?php include 'displayproduct.php'; ?>
            </div>
        </div>
    </div>
    <hr>

    <section id="contact" class="container my-5">
        <div class="row">
            <div class="col-12 mb-4">
                <h2 class="text-center fw-bold">Contact Us</h2>
            </div>
            <div class="col-md-8 mx-auto border rounded p-4 shadow-sm">
                <form>
                    <div class="mb-3">
                        <label for="contactName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="contactName" name="customername" placeholder="Enter your name" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contactEmail" class="form-label">Contact number</label>
                        <input type="text" class="form-control" id="contactName" name="customername" placeholder="Enter the number for contact" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contactMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="contactMessage" rows="3" name="description" placeholder="Your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning" onclick="submitofm1()">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <hr>


    <footer class="container-fluid bg-dark text-light " id="contactus">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="fw-bold m-0 " style="text-align:center; padding: 7px;"><img src="img/logo.png" style="height: 52px;  background-color: lightyellow; color:black; margin-right:10px;margin-top:10px;">ORGANIC FOOD MARKET</h3>
                </div>
                <div class="col-md-3">
                    <h3>Navigation</h3>
                    <hr class="my-4">
                    <ul class="list-unstyled">
                        <li><a href="ofm1.php" class="text-decoration-none text-light">🏠Home</a></li>
                        <li><a href="#products" class="text-decoration-none text-light">📦Products</a></li>
                        <li><a href="#contact" class="text-decoration-none text-light">📱Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>Useful Links</h3>
                    <hr class="my-4">
                    <ul class="list-unstyled">
                        <li><a href="newsletters.html" class="text-decoration-none text-light">📃Newsletters</a></li>
                        <li><a href="#Feature" class="text-decoration-none text-light">🎯Features </a></li>
                        <li><a href="returnpolicy.html" class="text-decoration-none text-light">📃Return Policy </a></li>
                        <li><a href="joinus.html" class="text-decoration-none text-light">🧑🏽‍🏭Join us</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3>Follow Us</h3>
                    <hr class="my-4">
                    <ul class="list-unstyled">
                        <li><img src="img/facebook.png"><a href="https://www.facebook.com/" class="text-decoration-none text-light"> Facebook</a></li>
                        <li><img src="img/twitter.png"><a href="https://twitter.com/" class="text-decoration-none text-light"> Twitter</a></li>
                        <li><img src="img/instagram.png"><a href="https://www.instagram.com/" class="text-decoration-none text-light"> Instagram</a></li>
                        <li><img src="img/youtube.png"><a href="https://www.youtube.com/" class="text-decoration-none text-light"> YouTube</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">&copy; Copyright 2024 - Organic Food Market.</div>
        </div>
    </footer>
    <script>
        function login() {
            document.getElementById('loginForm').submit();
        }

        function loginuser(){
            window.location.href = 'ofm1.php';
        }

        function displayErrorMessage(message) {
            document.getElementById('errorMessage').innerHTML = '<p>' + message + '</p>';
        }

        function submitofm1(){
            alert("Message sent successfully!!");
        }
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "displayErrorMessage('Invalid login credentials');";
        }
        ?>
    </script>
</body>

</html>