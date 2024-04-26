<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./userdashboard-style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: cursive;
            background-color: #618a3d;
        }
        .newproduct {
            color: red;
            font-style: italic;
            animation: animate 1.5s linear infinite;
        }
        @keyframes animate {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 0.7;
            }
            100% {
                opacity: 0;
            }
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
    <header style="background-color: #618a3d;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="userindex.php" class="navbar-brand">
                <h3 class="fw-bold" style="text-align:center;"><img src="img/logo.png" style="height: 52px;  background-color: lightyellow; color:black; margin-right:10px;">ORGANIC FOOD MARKET</h3>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="./userindex.php" style="color: white">🏠 Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products" style="color: white">🥗 Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact" style="color: white">📱 Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php" style="color: white">🛒 Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="./order.html" style="color: white">📦 Orders</a></li>

                    <li class="nav-item dropdown">
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo '<a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false" style="color: white"><i class="fas fa-user"></i> ' .   $_SESSION['username'] . '</a>';
                        } else {
                            echo '<a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false" style="color: white"><i class="fas fa-user"></i> User</a>';
                        }
                        ?>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="./user-dashboard.php">Profile</a></li>
                            <li><a class="dropdown-item" href="#contact">Contact us</a></li>
                            <li><a class="dropdown-item" href="logout.php">Log-out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

    </header>

    <section class="container-fluid">
        <div class="row" style="height: 700px;">
            <div class="col-md-6 d-flex align-items-center justify-content-center text-white p-5" style="background-color: #ab495b;">
                <div>
                    <h1 style="color: black;">Discover the pure Organic Products!</h1>
                    <h4 class="mb-4">Join the organic revolution!<br>Taste the difference,feel the change!</h4>
                    <a href="#products" class="btn btn-warning btn-lg">Shop Now &#10142;</a>
                </div>
            </div>
            <div class="col-md-6 banner-image"></div>
        </div>
    </section>


    <div class="container-fluid my-5" id="products" style="height: 100%;margin: 0; justify-content:center;">
        <h2 class="text-center mb-5 fw-bold">Our Products</h2>
        <div class="tabs-container" style="width: 1400px;margin-right: auto; margin-left: auto;">
            <div class="tab-buttons">
                <button class="tab-button fruits" onclick="openTab('fruits')">🍎 Fruits</button>
                <button class="tab-button vegetables" onclick="openTab('vegetables')">🥦 Vegetables</button>
                <button class="tab-button dairy" onclick="openTab('dairy')">🧀 Dairy Products</button>
                <button class="tab-button meat & egg" onclick="openTab('meat & egg')">🥩 Meat & Egg</button>
                <button class="tab-button honey" onclick="openTab('honey')">🍯 Honey</button>
                <button class="tab-button oil" onclick="openTab('oil')">🥑 Oil</button>
                <button class="tab-button salt & sugar" onclick="openTab('salt & sugar')">🧂 Salt & Sugar</button>
                <a class="tab-button checkout" href="./cart.php" style="position: absolute;text-align:center; right: 60px;background-color:green;width:150px;color:white;font-size: 20px;">Checkout</a>

            </div>
            <div id="fruits" class="tab-content">
                <h2>Fruits</h2>
                <div class="product-container row">
                    <?php include 'displayfruits.php'; ?>
                </div>
            </div>
            <div id="vegetables" class="tab-content">
                <h2>Vegetables</h2>
                <div class="product-container row">
                    <?php include 'vegetables.php'; ?>
                </div>
            </div>
            <div id="dairy" class="tab-content">
                <h2>Dairy Products</h2>
                <div class="product-container row">
                    <?php include 'dairy.php'; ?>
                </div>
            </div>
            <div id="meat & egg" class="tab-content">
                <h2>Meat & Egg</h2>
                <div class="product-container row">
                    <?php include 'meatandegg.php'; ?>
                </div>
            </div>
            <div id="honey" class="tab-content">
                <h2>Honey</h2>
                <div class="product-container row">
                    <?php include 'honey.php'; ?>
                </div>
            </div>
            <div id="oil" class="tab-content">
                <!-- Vegetables content goes here -->
                <h2>Oil</h2>
                <div class="product-container row">
                    <?php include 'oil.php'; ?>
                </div>
            </div>
            <div id="salt & sugar" class="tab-content">
                <h2>Salt & Sugar</h2>
                <div class="product-container row">
                    <?php include 'saltandsugar.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <img src="img/Rock salt.jpg" class="img-fluid" alt="New Product">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h1 class="newproduct">Our Newest Product!!📢</h1>
                    <br>
                    <h3>Pure Rock Salt</h3>
                    <p>This special type of salt has a unique combination of minerals, including magnesium, calcium, and potassium, that help to stimulate circulation and detoxify the body</p>
                    <br>
                    <button type="button" class="btn btn-warning"><a href="#products" class="btn-warning">Checkout the Products</a></button>
                </div>
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
                <form method="POST" action="customerissue.php">
                    <div class="mb-3">
                        <label for="contactName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="contactName" name="customername" placeholder="Enter your name" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contactEmail" class="form-label">Type of issue</label>
                        <select class="form-control" id="contactEmail" name="issue">
                            <option value="0">Select the issue</option>
                            <option value="Product">Product related</option>
                            <option value="Payment">Payment related</option>
                            <option value="Account">Account related</option>
                            <option value="general">general queries</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="contactMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="contactMessage" rows="3" name="description" placeholder="Your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <hr>
    <footer class="container-fluid bg-dark text-light ">
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
                        <li><img src="img/instagram.png"><a href="#" class="text-decoration-none text-light"> Instagram</a></li>
                        <li><img src="img/youtube.png"><a href="https://www.youtube.com/" class="text-decoration-none text-light"> YouTube</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">&copy; Copyright 2023 - Organic Food Market.</div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            openTab('fruits');
        });

        function openTab(tabName) {
            event.preventDefault();
            var btns = document.getElementsByClassName("tab-button");
            for (var i = 0; i < btns.length; i++) {
                if (document.getElementsByClassName("tab-button")[i].classList.contains(tabName)) {
                    document.getElementsByClassName("tab-button")[i].classList.add('active')
                } else {
                    document.getElementsByClassName("tab-button")[i].classList.remove('active')
                }
            }

            var tabContents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].style.display = "none";
                tabContents[i].classList.remove("active");
            }
            document.getElementById(tabName).classList.add("active");
            document.getElementById(tabName).style.display = "block";
        }

        function onSubmit(event) {
            var form = event.closest('form');
            var formData = new FormData(form);
            debugger
            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Product added to cart');
                } else {
                    alert('Error adding product to cart');
                }
            };
            xhr.send(formData);
        }
    </script>
</body>

</html>


<!-- fruits table:

CREATE TABLE fruits (
    fruitname VARCHAR(100),
    sellerid VARCHAR(50),
    price DECIMAL(10, 2),
    description TEXT
);

vegetable table:

CREATE TABLE vegetables (
    vegetablename VARCHAR(100),
    sellerid VARCHAR(50),
    price DECIMAL(10, 2),
    description TEXT
); -->