<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment-Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="checkoutform.css">
    <style>
        body{
            font-family: cursive;
        }
    </style>
</head>

<body>
    <div class="container" style="font-family: cursive;">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row">
                <div class="col">
                    <h3 class="title">Billing Address</h3>
                    <div class="inputBox">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="Name" placeholder="Enter your full name" required>
                    </div>
                    <div class="inputBox">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="inputBox">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" placeholder="Enter address" required>
                    </div>
                    <div class="inputBox">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" placeholder="Enter city" required>
                    </div>
                    <div class="flex">
                        <div class="inputBox">
                            <label for="state">State:</label>
                            <input type="text" id="state" name="state" placeholder="Enter state" required>
                        </div>
                        <div class="inputBox">
                            <label for="zip">Zip Code:</label>
                            <input type="number" id="zip" name="pincode" placeholder="123 456" required>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <h3 class="title">Payment</h3>
                    <div style="margin: 10px 0px;">
                        <input type="checkbox" id="cashOnDelivery" value="cashOnDelivery" name="paymentMethod">
                        <label for="cashOnDelivery">Cash on Delivery</label>
                    </div>

                    <div class="inputBox">
                        <div class="icon-container">Card Accepted:
                            <i class="fa fa-cc-visa" style="color:navy; margin-left: 5px;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                        </div>
                    </div>

                    <div class="inputBox onlinePaymentFields">
                        <label for="cardName">Name On Card:</label>
                        <input type="text" id="cardName" name="cardname" placeholder="Enter card name" required>
                    </div>
                    <div class="inputBox onlinePaymentFields">
                        <label for="cardNum">Credit Card Number:</label>
                        <input type="text" id="cardNum" name="cardnumber" placeholder="1111-2222-3333-4444" maxlength="19" required>
                    </div>
                    <div class="inputBox onlinePaymentFields">
                        <label for="">Expiry Month:</label>
                        <select name="" id="" name="month">
                            <option value="">Choose month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                    <div class="flex">
                        <div class="inputBox onlinePaymentFields">
                            <label for="">Exp Year:</label>
                            <select name="" id="" name="expiryyear">
                                <option value="">Choose Year</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                        <div class="inputBox onlinePaymentFields">
                            <label for="cvv">CVV</label>
                            <input type="number" id="cvv" name="cvv" placeholder="1234" required>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Proceed to Checkout" class="submit_btn" id="checkoutBtn">
        </form>
    </div>

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
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];

        if (isset($_POST['paymentMethod'])) {
            $paymentMethod = "Cash on Delivery";
            $sql = "INSERT INTO payment (Name, email, address, city, state, pincode)
                VALUES ('$name', '$email', '$address', '$city', '$state', '$pincode')";
            echo '<script>window.location.href = "codreceipt.php"</script>';
        } else {
            $cardname = $_POST['cardname'];
            $cardnumber = $_POST['cardnumber'];
            $cvv = $_POST['cvv'];
            $sql = "INSERT INTO payment (Name, email, address, city, state, pincode, cardname, cardnumber, cvv)
                VALUES ('$name', '$email', '$address', '$city', '$state', '$pincode', '$cardname', '$cardnumber','$cvv')";
            echo '<script>window.location.href = "billreceipt.php"</script>';
        }

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

    <script type="text/javascript">
        let cardNumInput = document.querySelector('#cardNum')

        cardNumInput.addEventListener('keyup', () => {
            let cNumber = cardNumInput.value
            cNumber = cNumber.replace(/\s/g, "")
            if (Number(cNumber)) {
                cNumber = cNumber.match(/.{1,4}/g)
                cNumber = cNumber.join(" ")
                cardNumInput.value = cNumber
            }
        })

        var cashOnDeliveryRadio = document.getElementById('cashOnDelivery');
        var onlinePaymentFields = document.querySelectorAll('.onlinePaymentFields input, .onlinePaymentFields select');
        cashOnDeliveryRadio.addEventListener('change', function() {
            if (this.checked) {
                onlinePaymentFields.forEach(function(field) {
                    field.disabled = true;
                });
            } else {
                onlinePaymentFields.forEach(function(field) {
                    field.disabled = false;
                });
            }
        });

        var modal = document.getElementById("myModal");
        var btn = document.getElementById("checkoutBtn");

        btn.onclick = function(event) {
            var requiredFields = document.querySelectorAll('input[required], select[required]');
            var isEmpty = false;

            requiredFields.forEach(function(field) {
                if (field.disabled) {
                    return;
                }
                if (!field.value.trim()) {
                    isEmpty = true;
                }
            });

            if (isEmpty && !cashOnDeliveryRadio.checked) {
                alert("Please fill out all required fields.");
                event.preventDefault(); // Prevent form submission
                return false;
            }
            modal.style.display = "block";
        }
    </script>
</body>

</html>

