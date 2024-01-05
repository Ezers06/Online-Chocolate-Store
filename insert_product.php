<?php

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'online_store';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}

session_start(); // Start the session if not already started

if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or display an error message
    echo "Error: User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];

$productName = $_POST['product_name'];
$productPrice = $_POST['product_price'];
$quantity = $_POST['quantity'];
$totalPrice = $_POST['total_price'];

try {
  $stmt = $conn->prepare("INSERT INTO tbl_product (user_id, product_name, product_price, quantity, total_price) VALUES (:user_id, :product_name, :product_price, :quantity, :total_price)");
  $stmt->bindParam(':user_id', $user_id);
  $stmt->bindParam(':product_name', $productName);
  $stmt->bindParam(':product_price', $productPrice);
  $stmt->bindParam(':quantity', $quantity);
  $stmt->bindParam(':total_price', $totalPrice);
  $stmt->execute();

  echo "Product inserted successfully.";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>
