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
$stmt = $conn->prepare("SELECT product_id, quantity FROM cart_table WHERE user_id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];

    $update_stmt = $conn->prepare("UPDATE product_table SET product_stock = product_stock - :quantity WHERE product_id = :product_id");
    $update_stmt->execute([':quantity' => $quantity, ':product_id' => $product_id]);
}

// Delete cart items
$delStmt = $conn->prepare("DELETE FROM cart_table WHERE user_id = :user_id");
$delStmt->execute([':user_id' => $user_id]);

// Add a query string parameter to indicate a popup should be displayed
header("Location: ../website/yourhome.php?show_popup=1");

?>