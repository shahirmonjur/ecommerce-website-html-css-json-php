<?php
session_start();
include("connection.php");

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $totalAmount = 1;

  $sql = "INSERT INTO orders (Username, OrderTime, TotalAmount) VALUES (?, CURRENT_TIMESTAMP, ?)";
  $stmt = $mysqli->prepare($sql);

  if ($stmt) {
    $stmt->bind_param("si", $username, $totalAmount);
    $stmt->execute();
    $stmt->close();

    echo json_encode(array('status' => 'success', 'message' => 'Your order has been confirmed. You shall receive your order delivered at your billing address (Cash-on-delivery service active).'));
  } else {
    echo json_encode(array('status' => 'error', 'message' => 'An error occurred while processing your order. Please try again later.'));
  }
} else {
  echo json_encode(array('status' => 'error', 'message' => 'Please login to confirm the order.'));
}

$mysqli->close();
?>