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

$seller_query = "SELECT COUNT(*) AS total_sellers FROM seller";
$seller_result = $conn->query($seller_query);
if ($seller_result->num_rows > 0) {
  $seller_row = $seller_result->fetch_assoc();
  $total_sellers = $seller_row["total_sellers"];
}

$customer_query = "SELECT COUNT(*) AS total_customers FROM users";
$customer_result = $conn->query($customer_query);
if ($customer_result->num_rows > 0) {
  $customer_row = $customer_result->fetch_assoc();
  $total_customers = $customer_row["total_customers"];
}

$total_quantity = 0;
$product_categories = array('dairy', 'fruits', 'honey', 'meatandegg', 'oil', 'saltandsugar', 'vegetables');

foreach ($product_categories as $category) {
  $category_query = "SELECT SUM(quantity) AS total_quantity FROM $category";
  $category_result = $conn->query($category_query);
  if ($category_result->num_rows > 0) {
    $category_row = $category_result->fetch_assoc();
    $total_quantity += $category_row['total_quantity'] ? $category_row['total_quantity'] : 0;
  }
}

$order_query = "SELECT COUNT(*) AS total_orders FROM paymenthistory";
$order_result = $conn->query($order_query);
$total_new_orders = 0;

if ($order_result->num_rows > 0) {
  $order_row = $order_result->fetch_assoc();
  $total_new_orders = $order_row["total_orders"];
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, 
				initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Admin dashboard</title>
  <link rel="stylesheet" href="./admindashboard-style.css" />
  <style>
    table {
      margin-top: 20px;
      width: 100%;
      padding: 15px;
      text-align: center
    }

    body {
      background: url('img/sample.jpg') center/cover no-repeat fixed;

    }

    th {
      background-color: #7dba48;
      padding: 10px;
      border-color: seagreen;
    }

    td {
      padding: 10px;
      border-color: seagreen;
      background-color: #618a3d;

    }

    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;

    }
  </style>
</head>

<body>
  <header>
    <div class="logosec">
      <i class="fa-solid fa-bars fa-2x" id="menuicn"></i>
      <a href="userindex.php" class="navbar-brand ">
        <h2 class="fw-bold m-0 "><img src="img/logo.png" style="position: relative;top: 10px;height: 52px;">ORGANIC FOOD MARKET</h2>
      </a>
    </div>

    <div class="message">
      <div>
        <i class="fa-regular fa-bell fa-lg icon" style="color:white" onclick="redirectToOrderDetails()"></i>
        <span class="badge" id="badgeCount"><?php echo $total_new_orders; ?></span>
      </div>
      <div class="dropdown">
        <i class="fa-solid fa-user fa-lg icon" style="color:white"></i>
        <div class="dropdown-content">
          <button class="tablinks separatebtn"><a href="logout.php">Log-out</a></button>
        </div>
      </div>
    </div>
    </div>
  </header>
  <div class="tab" style="width: 170px; background-color:#618a3d">
    <button class="tablinks" onclick="openPage('Home', this)" id="defaultOpen">Dashboard</button>
    <button class="tablinks" onclick="openPage('Products', this)">Products</button>
    <button class="tablinks" onclick="openPage('Sellers', this)">Sellers</button>
    <button class="tablinks" onclick="openPage('Sellerss', this)">Customers</button>
    <button class="tablinks" onclick="openPage('orderplaced', this)">Order details</button>
    <button class="tablinks" onclick="openPage('customerissue', this)">Customer Query</button>
    <button class="tablinks" onclick="openPage('sellerissue', this)">Seller Query</button>
  </div>

  <div id="Home" class="tabcontent">
    <div class="box-container">
      <div class="box box1" style="background-color:#618a3d">
        <div class="text">
          <h2 class="topic-heading"><?php echo $total_sellers; ?></h2>
          <h2 class="topic">Total No of Sellers</h2>
        </div>
        <i class="fa-solid fa-users fa-2x"></i>
      </div>

      <div class="box box2" style="background-color:#618a3d">
        <div class="text">
          <h2 class="topic-heading"><?php echo $total_customers; ?></h2>
          <h2 class="topic">Total No of Customers</h2>
        </div>
        <i class="fa-solid fa-users fa-2x"></i>
      </div>

      <div class="box box3" style="background-color:#618a3d">
        <div class="text">
          <h2 class="topic-heading"><?php echo $total_quantity; ?></h2>
          <h2 class="topic">Products Currently Available</h2>
        </div>

        <i class="fa-solid fa-boxes-stacked fa-2x"></i>
      </div>

      <div class="box box4" style="background-color:#618a3d">
        <div class="text">
          <h2 class="topic-heading"><?php echo $total_new_orders; ?></h2>
          <h2 class="topic">New Order</h2>
        </div>
        <i class="fa-solid fa-boxes-stacked fa-2x"></i>
      </div>
    </div>
  </div>
  <div id="Products" class="tabcontent">
    <h2 class="formregister">Available products from all sellers</h2>
    <table>
      <thead>
        <tr>
          <th>Seller Name</th>
          <th>Seller id</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody id="productsTableBody"></tbody>
    </table>
  </div>
  <div id="Sellers" class="tabcontent">
    <h1 class="recent-Articles">Registered Sellers</h1>
    <div id="sellerContent"></div>
  </div>
  <div id="Sellerss" class="tabcontent">
    <h1 class="recent-Articles">Registered Customers</h1>
    <div id="customerContent"></div>
  </div>

  <div id="customerissue" class="tabcontent">
    <h1 class="recent-Articles">Customer queries</h1>
    <table>
      <thead>
        <tr>
          <th>CustomerName</th>
          <th>Issue</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody id="customerissuetable"></tbody>
    </table>
  </div>

  <div id="sellerissue" class="tabcontent">
    <h1 class="recent-Articles">Seller queries</h1>
    <table>
      <thead>
        <tr>
          <th>Seller Name</th>
          <th>Issue</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody id="sellerissuetable"></tbody>
    </table>
  </div>

  <div id="orderplaced" class="tabcontent">
    <h2 class="formregister">Order placed by Customers</h2>
    <table>
      <thead>
        <tr>
          <th>User Name</th>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Date of Purchase</th>
        </tr>
      </thead>
      <tbody id="ordersTableBody"></tbody>
    </table>
  </div>

  <script>
    window.addEventListener('load', function() {
      fetch('fetchallproducts.php').then(response => response.json()).then(data => {
        const tableBody = document.getElementById('productsTableBody');
        data.forEach(product => {
          const row = document.createElement('tr');
          row.innerHTML = `
                        <td>${product.seller_name}</td>
                        <td id='sellerId'>${product.seller_id}</td>
                        <td id='productName'>${product.product_name}</td>
                        <td>${product.quantity}</td>
                        <td><button class='removequantity' >Remove</button></td>
                    `;
          tableBody.appendChild(row);
        });
      }).catch(error => console.error('Error fetching data:', error));

      fetch('fetchorderproducts.php').then(response => response.json()).then(data => {
        const tableBody = document.getElementById('ordersTableBody');
        data.forEach(product => {
          const row = document.createElement('tr');
          row.innerHTML = `
                        <td>${product.customer_name}</td>
                        <td>${product.product}</td>
                        <td>${product.price}</td>
                        <td>${product.quantity}</td>
                        <td>${product.dateofpurchase}</td>
                    `;
          tableBody.appendChild(row);
        });
      }).catch(error => console.error('Error fetching data:', error));
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

      if (pageName === 'customerissue') {
        fetchCustomerQueries();
      } else if (pageName === 'sellerissue') {
        fetchSellerQueries();
      }

      if (pageName == 'Sellers') {
        var removeButtons = document.querySelectorAll('.removeseller');
        removeButtons.forEach(function(button) {
          button.addEventListener('click', function() {
            var name = document.getElementById('sellername').textContent
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'removeuser.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  button.parentElement.parentElement.remove()
                } else {
                  console.error('Failed to remove users', xhr.responseText);
                }
              }
            };
            xhr.send('userName=' + encodeURIComponent(name) + '&pageName=' + encodeURIComponent(pageName));

          });
        });
      } else if (pageName == 'Sellerss') {
        var removeButtons = document.querySelectorAll('.removeuser');
        removeButtons.forEach(function(button) {
          button.addEventListener('click', function() {
            var name = document.getElementById('username').textContent
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'removeuser.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  button.parentElement.parentElement.remove()
                } else {
                  console.error('Failed to remove users', xhr.responseText);
                }
              }
            };
            xhr.send('userName=' + encodeURIComponent(name) + '&pageName=' + encodeURIComponent(pageName));
          });
        });
      } else if (pageName == 'Products') {

        var removeButtons = document.querySelectorAll('.removequantity');
        removeButtons.forEach(function(button) {
          button.addEventListener('click', function() {
            var sellerId = button.parentElement.parentElement.querySelector('#sellerId').textContent;
            var productName = button.parentElement.parentElement.querySelector('#productName').textContent;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'removequantity.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  button.parentElement.parentElement.remove()
                } else {
                  console.error('Failed to remove users', xhr.responseText);
                }
              }
            };
            xhr.send('seller_id=' + encodeURIComponent(sellerId) + '&product_name=' + encodeURIComponent(productName));
          });
        });
      }
    }

    function fetchCustomerQueries() {
      fetch('fetchcustomerqueries.php')
        .then(response => response.json())
        .then(data => {
          const tableBody = document.getElementById('customerissuetable');
          tableBody.innerHTML = ''; // Clear previous data
          data.forEach(query => {
            const row = document.createElement('tr');
            row.innerHTML = `
                        <td>${query.customerName}</td>
                        <td>${query.issue}</td>
                        <td>${query.description}</td>
                    `;
            tableBody.appendChild(row);
          });
        })
        .catch(error => console.error('Error fetching customer queries:', error));
    }

    function fetchSellerQueries() {
      fetch('fetchsellerqueries.php')
        .then(response => response.json())
        .then(data => {
          const tableBody = document.getElementById('sellerissuetable');
          tableBody.innerHTML = ''; // Clear previous data
          data.forEach(query => {
            const row = document.createElement('tr');
            row.innerHTML = `
                        <td>${query.sellerName}</td>
                        <td>${query.issue}</td>
                        <td>${query.description}</td>
                    `;
            tableBody.appendChild(row);
          });
        })
        .catch(error => console.error('Error fetching seller queries:', error));
    }

    document.getElementById("defaultOpen").click();

    function fetchData(tab) {
      fetch('fetchdata.php?tab=' + tab)
        .then(response => response.text())
        .then(data => {
          if (tab === 'sellers') {
            document.getElementById('sellerContent').innerHTML = data;
          } else if (tab === 'customers') {
            document.getElementById('customerContent').innerHTML = data;
          }
        })
        .catch(error => console.error('Error fetching data:', error));
    }

    window.addEventListener('load', function() {
      fetchData('sellers');
      fetchData('customers');
    });

    function redirectToOrderDetails() {
      var badge = document.getElementById('badgeCount');
      badge.textContent = '0';
      openPage('orderplaced', document.getElementById('orderplaced'));
    }

    let menuicn = document.querySelector("#menuicn");
    let nav = document.querySelector(".tab");

    menuicn.addEventListener("click", () => {
      nav.classList.toggle("navclose");
    })
  </script>
</body>

</html>