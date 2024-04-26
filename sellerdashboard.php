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
  $sql = "SELECT * FROM seller WHERE username = '$username'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $Name = $row["Name"];
      $email = $row["Email"];
      $phone = $row["Phone"];
      $address = $row["Address"];
      $sellerId = $row["sellerid"]; // Fetch Seller ID
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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <title>Seller dashboard</title>
  <link rel="stylesheet" href="./sellerdashboard-style.css" />
</head>

<body>
  <header style="background-color: #b4a43e;">
    <div class="logosec">
      <i class="fa-solid fa-bars fa-2x" id="menuicn"></i>
      <h2 class="fw-bold m-0 " style="padding-left:5px;margin-bottom: 20px;"><img src="img/logo.png" style="position: relative;top: 10px;height: 52px;">ORGANIC FOOD MARKET</h2>
    </div>
    <div class="message">
      <div>
        <i class="fa-regular fa-bell fa-lg icon" style="color: white;"></i>
      </div>
      <div class="dropdown">
        <?php
        if (isset($_SESSION['username'])) {
          echo '<i class="fa-solid fa-user  icon" style="color: white;"> ' .   $_SESSION['username'] . '</i>';
        } else {
          echo '<i class="fa-solid fa-user icon" style="color: white;"></i>';
        }
        ?>
        <div class="dropdown-content">
          <button class="tablinks" onclick="openPage('sellerProfile', this)">Profile</button>
          <button class="tablinks" onclick="openPage('contactform', this)">Contact</button>
          <button class="tablinks separatebtn"><a href="ofm1.php">Log-out</a></button>
        </div>
      </div>

    </div>

  </header>
  <div class="tab ">
    <button class="tablinks" onclick="openPage('sellform', this)" id="defaultOpen">Listings</button>
    <button class="tablinks" onclick="openPage('Products', this)">Stocks</button>
    <button class="tablinks" onclick="openPage('sellerProfile', this)">Profile</button>
    <button class="tablinks" onclick="openPage('contactform', this)">Contact</button>
  </div>

  <div id="sellform" class="tabcontent" style="font-size: 18px;">
    <h3 class="formregister">Register your product!</h3>
    <form method="POST" id="registerationform" action="registerproduct.php">
      <div class="row">
        <div class="col-25">
          <label for="category">Product Category</label>
        </div>
        <div class="col-75">
          <select id="category" name="category" style="color: black; font-size:18px" onchange="updateProductList()">
            <option value="0">Select the category</option>
            <option value="fruits">Fruits</option>
            <option value="vegetables">Vegetables</option>
            <option value="dairy">Dairy</option>
            <option value="meatandegg">Meat&Egg</option>
            <option value="honey">Honey</option>
            <option value="oil">Oil</option>
            <option value="saltandsugar">Salt&Sugar</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="product">Product Name</label>
        </div>
        <div class="col-75">
          <select id="product" name="productname" style="color: black; font-size:18px">
            <option value="0">Select Product</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Quantity of products</label>
        </div>
        <div class="col-75">
          <input type="number" name="quantity" id="sellingproducts" style="color: black; font-size:18px">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Price of the product</label>
        </div>
        <div class="col-75">
          <input type="number" name="price" id="Price" style="color: black; font-size:18px">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Expiring Date</label>
        </div>
        <div class="col-75">
          <input type="date" name="expdate" id="expdate" style="color: black; font-size:18px">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Seller Id</label>
        </div>
        <div class="col-75">
          <input type="text" name="sellerid" id="sellerid" style="color: black; font-size:18px" value="<?php echo $sellerId; ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="subject">Description of Product</label>
        </div>
        <div class="col-75">
          <textarea id="subject" name="description" placeholder="Write about your product.." style="height:100px; color: black; font-size:18px"></textarea>
        </div>
      </div>
      <br>
      <div class="row">
        <input type="submit" value="Submit" style="font-size:18px; margin-left: 25%;">
      </div>
    </form>
  </div>

  <div id="Products" class="tabcontent">
    <h2 class="recent-Articles">List of your products</h2>
    <table id="productsTable" style="margin-top:50px; width:100%">
      <thead>
        <tr>
          <th>Seller Name</th>
          <th>Product Name</th>
          <th>Quantity</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>


  <div id="contactform" class="tabcontent">
    <h2 class="formregister">Service Desk- Please raise your queries!!</h2>
    <form method="POST" action="sellerissue.php">
      <div class="row">
        <div class="col-25">
          <label for="fname">Seller Name</label>
        </div>
        <div class="col-75">
          <input type="text" id="fname" name="sellername" placeholder="Enter seller name.." style="color:black;font-size: 18px;" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname" style="font-size: 18px;">Issue Type</label>
        </div>
        <div class="col-75" style="font-size: 18px;">
          <select id="query" name="issue" style="font-size: 18px;">
            <option value="Product">Product related</option>
            <option value="Payment">Payment related</option>
            <option value="Account">Account related</option>
            <option value="general">general queries</option>
            <option value="Others">Others</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Description of the issue</label>
        </div>
        <div class="col-75">
          <textarea id="subject" name="description" placeholder="Explain the issue here.." style="height:100px;font-size: 18px;"></textarea>
        </div>
      </div>
      <br>
      <div class="row">
        <input type="submit" value="Submit Request" style="font-size: 18px; margin-left: 25%;">
      </div>
    </form>
  </div>

  <div id="sellerProfile" class="tabcontent">
    <h2 style="text-align:center; margin-top: 20px;">User Profile!</h2>
    <div class="card" style=" background-color: #618a3d;">
      <img src="img/user.jpg" alt="User Image" style="width:50%">
      <h2 style="margin-top:20px">Seller name👤 : <?php echo $Name ?></h2>
      <h3 style="margin-top:20px">Email Id📧 : <?php echo $email; ?></h3>
      <h3 style="margin-top:20px">Contact No📱 : <?php echo $phone; ?></h3>
      <h3 style="margin-top:20px">Address🏠 : <?php echo $address; ?></h3>
      <p style="margin-top:20px"><a href="updateseller.php" target="_blank"> <button class="open-button" style="font-size: 20px;  background-color:black;">Edit</button></a></p>
    </div>
  </div>



  <script>
    function updateProductList() {
      var category = document.getElementById("category").value;
      var productSelect = document.getElementById("product");
      productSelect.innerHTML = ""; // Clear existing options
      var productList = {
        fruits: ["Select Product", "Alphonso mangoes", "Banganapalli mangoes", "Malgova mangoes", "Robusta bananas", "Poovan bananas", "Nendran bananas", "Papayas", "Guavas", "Sapotas", "Jackfruits", "Sitaphal custard apples", "Pomegranates", "Pineapples", "Thompson Seedless grapes", "Bangalore Blue grapes", "Watermelons", "Mandarin oranges", "Nagpur oranges", "Mosambi sweet lime", "Muskmelons"],
        vegetables: ["Select Product", "Tomatoes", "Brinjals (Eggplants)", "Okra (Lady's finger)", "Bottle gourd", "Bitter gourd", "Ridge gourd", "Snake gourd (Pudalangai)", "Cucumbers", "Green beans (French beans)", "Spinach (Palak)", "Amaranth leaves (Mulai keerai)", "Fenugreek leaves (Methi)", "Radishes", "Carrots", "Beetroot", "Cauliflower", "Cabbage", "Capsicum", "Green chilies", "Drumsticks (Murungakkai)"],
        dairy: ["Select Product", "Cow Milk", "Buffalo Milk", "Ghee", "Curd", "Paneer", "Butter", "Buttermilk", "Cheese Cheddar", "Cheese Mozzarella"],
        meatandegg: ["Select Product", "Country chicken", "Duck meat", "Turkey meat", "Goat meat", "Beef meat", "Country egg", "Duck egg"],
        honey: ["Select Product", "Forest honey", "Natural honey"],
        oil: ["Select Product", "Coconut oil", "Groundnut oil"],
        saltandsugar: ["Select Product", "Brown sugar", "Jaggery", "Rock salt"]
      };
      if (category !== "0") {
        productList[category].forEach(function(product) {
          var option = document.createElement("option");
          option.text = product;
          option.value = product;
          productSelect.add(option);
        });
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      // Fetch products data from fetch_products.php
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'fetchsellerproducts.php', true);
      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
          var response = JSON.parse(xhr.responseText);
          if (response.length > 0) {
            var tableBody = document.querySelector('#productsTable tbody');
            response.forEach(function(product) {
              var row = document.createElement('tr');
              row.innerHTML = '<td >' + product.sellerName + '</td><td>' + product.productName + '</td><td>' + product.quantity + '</td>';
              tableBody.appendChild(row);
            });
          } else {
            document.querySelector('#productsTable tbody').innerHTML = '<tr><td colspan="3">No products found</td></tr>';
          }
        } else {
          console.error('Request failed. Status: ' + xhr.status);
        }
      };
      xhr.onerror = function() {
        console.error('Request failed');
      };
      xhr.send();
    });


    function openPage(pageName, elmnt, color) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(pageName).style.display = "block";
      elmnt.className += " active";
    }
    document.getElementById("defaultOpen").click();

    let menuicn = document.querySelector("#menuicn");
    let nav = document.querySelector(".tab");

    menuicn.addEventListener("click", () => {
      nav.classList.toggle("navclose");
    })
  </script>
</body>

</html>