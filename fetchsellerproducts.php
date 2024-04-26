<?php
session_start(); // Start the session

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

    // Fetch products from fruits table
    $fruits_query = "SELECT sellerName, productname AS productName, quantity FROM fruits WHERE sellerName = '$username'";
    $fruits_result = $conn->query($fruits_query);

    // Fetch products from vegetables table
    $vegetables_query = "SELECT sellerName, productname AS productName, quantity FROM vegetables WHERE sellerName = '$username'";
    $vegetables_result = $conn->query($vegetables_query);

    $dairy_query = "SELECT sellerName, productname AS productName, quantity FROM dairy WHERE sellerName = '$username'";
    $dairy_result = $conn->query($dairy_query);

    $meatandegg_query = "SELECT sellerName, productname AS productName, quantity FROM meatandegg WHERE sellerName = '$username'";
    $meatandegg_result = $conn->query($meatandegg_query);

    $honey_query = "SELECT sellerName, productname AS productName, quantity FROM honey WHERE sellerName = '$username'";
    $honey_result = $conn->query($honey_query);

    $oil_query = "SELECT sellerName, productname AS productName, quantity FROM oil WHERE sellerName = '$username'";
    $oil_result = $conn->query($oil_query);

    $saltandsugar_query = "SELECT sellerName, productname AS productName, quantity FROM saltandsugar WHERE sellerName = '$username'";
    $saltandsugar_result = $conn->query($saltandsugar_query);

    $products = array();

    // Store fetched products in an array
    if ($fruits_result && $fruits_result->num_rows > 0) {
        while ($row = $fruits_result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    if ($vegetables_result && $vegetables_result->num_rows > 0) {
        while ($row = $vegetables_result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    if ($dairy_result && $dairy_result->num_rows > 0) {
        while ($row = $dairy_result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    if ($meatandegg_result && $meatandegg_result->num_rows > 0) {
        while ($row = $meatandegg_result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    if ($honey_result && $honey_result->num_rows > 0) {
        while ($row = $honey_result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    if ($oil_result && $oil_result->num_rows > 0) {
        while ($row = $oil_result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    if ($saltandsugar_result && $saltandsugar_result->num_rows > 0) {
        while ($row = $saltandsugar_result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    // Return the products as JSON
    echo json_encode($products);
}

$conn->close();
?>