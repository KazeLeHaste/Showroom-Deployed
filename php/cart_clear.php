<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['user_id'];

// Check if the user is logged in
if (!isset($_SESSION['username']) ||!isset($_SESSION['role'])) {
    // User is not logged in, redirect to login page
    header("Location: home.php");
    exit;
}

// Update product stock in product_table
$stmt = $conn->prepare("SELECT product_id, quantity FROM cart_table WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];

    $update_stmt = $conn->prepare("UPDATE product_table SET product_stock = product_stock - ? WHERE product_id = ?");
    $update_stmt->bind_param("ii", $quantity, $product_id);
    $update_stmt->execute();
}

// Delete cart items
$stmt = $conn->prepare("DELETE FROM cart_table WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Add a query string parameter to indicate a popup should be displayed
header("Location: ../website/yourhome.php?show_popup=1");

?>