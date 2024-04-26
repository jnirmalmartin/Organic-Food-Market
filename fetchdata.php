<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindatabase";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['tab']) && $_GET['tab'] == 'sellers') {
  $sql = "SELECT * FROM seller";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo '<table id="sellersTable">
            <tr>
              <th>Seller Name</th>
              <th>Address</th>
              <th>Mail id</th>
              <th>Phone number</th>
              <th>Edit</th>

            </tr>';
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td id=sellername>" . $row["Name"] . "</td>
              <td >" . $row["Address"] . "</td>
              <td>" . $row["Email"] . "</td>
              <td>" . $row["Phone"] . "</td>
              <td><button class='removeseller' >Remove</button></td>
            </tr>";
    }
    echo '</table>';
  } else {
    echo "0 results";
  }
}

if (isset($_GET['tab']) && $_GET['tab'] == 'customers') {
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo '<table id="customersTable">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone number</th>
              <th>Address</th>
              <th>Edit</th>
            </tr>';
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td id=username>" . $row["Name"] . "</td>
              <td>" . $row["Email"] . "</td>
              <td>" . $row["Phone"] . "</td>
              <td>" . $row["Address"] . "</td>
              <td><button class='removeuser'>Remove</button></td>
            </tr>";
    }
    echo '</table>';
  } else {
    echo "0 results";
  }
}

$conn->close();
?>