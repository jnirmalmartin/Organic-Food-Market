<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Organic Food Market</title>
    <link rel="stylesheet" type="text/css" href="userdashboard-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: cursive;
            background-color: #618a3d;
        }

        #productimg {
            height: 100px;
            width: 100px
        }
    </style>
</head>

<body>
    <header style="background-color: #618a3d;">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="user-index.html" class="navbar-brand ">
                    <h3 class="fw-bold" style="text-align:center;"><img src="img/logo.png" style="height: 52px;  background-color: lightyellow; color:black; margin-right:10px;">ORGANIC FOOD MARKET</h3>

                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="./userindex.php" style="color: white">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="userindex.php#products" style="color: white">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="userindex.php" style="color: white"><i class="fas fa-home"></i>Home</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section class="container my-5">
        <div class="row">
            <div id="cart-items-container" class="col-md-8">
                <?php include 'displaycart.php'; ?>
            </div>
            <div class="col-md-4">
                <div class="border p-3 mb-3">
                    <h3 class="mb-3">Cart Summary</h3>

                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span class="subtotal-amount">₹0.00</span>
                    </div>


                    <div class="d-flex justify-content-between">
                        <span>Gst</span>
                        <span class="gst-amount">₹0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <span class="total-amount">₹0.00</span>
                    </div>
                    <a class="btn btn-warning w-100 mt-3" href="./checkoutform.php">Proceed to Checkout</a>

                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="row">
        </div>
    </section>

    <footer class="bg-dark text-light py-4 mt-5 cartfooter">
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12  mb-3 mb-md-0">
                        &copy; <a href="#">Organic Food Market</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        function updateCartSummary() {
            var quantities = document.getElementsByClassName('quantity');
            var prices = document.getElementsByClassName('price');

            var subtotal = 0;
            var gst = 0;
            var total = 0;
            for (var i = 0; i < quantities.length; i++) {
                var quantity = parseInt(quantities[i].value);
                var price = parseFloat(prices[i].textContent.replace('₹', ''));
                var itemSubtotal = quantity * price;
                subtotal += itemSubtotal;
                gst += itemSubtotal * 0.05;
            }

            total = subtotal + gst;

            document.querySelector('.subtotal-amount').textContent = "₹" + subtotal.toFixed(2);
            document.querySelector('.gst-amount').textContent = "₹" + gst.toFixed(2);
            document.querySelector('.total-amount').textContent = "₹" + total.toFixed(2);

            var amount = JSON.parse(sessionStorage.getItem('amount')) || [];
            var amountData = {
                Subtotal: subtotal,
                gstAmount: gst,
                total: total
            };
            amount.push(amountData);
            sessionStorage.setItem('payment', JSON.stringify(amountData));
        }

        var quantityInputs = document.querySelectorAll('.quantity');
        quantityInputs.forEach(function(input) {
            var previousValue = parseInt(input.value);
            input.addEventListener('input', function() {
                var currentValue = parseInt(input.value);
                if (currentValue > previousValue) {
                    updateQuantity(this, 'increment');
                } else if (currentValue < previousValue) {
                    updateQuantity(this, 'decrement');
                }
                previousValue = currentValue;
            });
        });

        updateCartSummary();
        
        function updateQuantity(input, action) {
            var quantity = parseInt(input.value);
            var productname = input.closest('.cart-item').querySelector('.product').textContent;
            var sellerid = input.closest('.cart-item').querySelector('.sellerid').textContent;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'updatecart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Quantity updated successfully');
                        updateCartSummary();
                        if (action === 'decrement' && quantity === 0) {
                            removeProductFromCart(input);
                        }
                    } else {
                        console.error('Failed to update quantity:', xhr.responseText);
                    }
                }
            };
            const params = 'productname=' + encodeURIComponent(productname) + '&quantity=' + quantity + '&sellerid=' + sellerid;
            if (action === 'increment') {
                xhr.send(params + '&action=increment');
            } else if (action === 'decrement') {
                xhr.send(params + '&action=decrement');
            }
        }

        function removeProductFromCart(input) {
            var productName = input.closest('.cart-item').querySelector('.product').textContent;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'removefromcart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var cartItem = input.closest('.cart-item');
                        cartItem.parentNode.removeChild(cartItem);
                        updateCartSummary();
                    } else {
                        console.error('Failed to remove product from cart:', xhr.responseText);
                    }
                }
            };
            xhr.send('productName=' + productName);
        }
        var removeButtons = document.querySelectorAll('.btn-remove');
        removeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var productName = button.dataset.productName;
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'removefromcart.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var cartItem = button.closest('.cart-item');
                            cartItem.parentNode.removeChild(cartItem);
                            updateCartSummary();
                        } else {
                            console.error('Failed to remove product from cart:', xhr.responseText);
                        }
                    }
                };
                xhr.send('productName=' + productName);
            });
        });
    </script>


</body>

</html>