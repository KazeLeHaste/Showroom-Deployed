<?php
session_start();
require_once 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['username']) ||!isset($_SESSION['role'])) {
    // User is not logged in, redirect to login page
    header("Location: home.php");
    exit;
}

// Get the posted data from the checkout form
$receiver_name = $_POST['contact'];
$contact_number = $_POST['address'];
$shipping_address = $_POST['message'];
$mode = $_POST['mode'];
$delivery = $_POST['delivery'];

// Validate the input data
if (empty($receiver_name) || empty($contact_number) || empty($shipping_address) || empty($mode) || empty($delivery)) {
    header("Location: ../website/checkout_page.php?show_popup=1");

    exit;
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Get the cart items for the current user
$stmt = $conn->prepare("SELECT * FROM cart_table WHERE user_id =?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Calculate the total cost of the order
$total = 0;
while ($row = $result->fetch_assoc()) {
    $total += $row['total_price'];
}

// Create an order and update the cart items
function createOrder($conn, $user_id, $receiver_name, $contact_number, $shipping_address, $mode, $total, $delivery) {
    $order_date = date("Y-m-d H:i:s"); // Get the current date and time
    $stmt = $conn->prepare("INSERT INTO orders_table (user_id, receiver_name, contact_number, order_date, total, payment_method, shipping_address, delivery_method) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isssssss", $user_id, $receiver_name, $contact_number, $order_date, $total, $mode, $shipping_address, $delivery);
    $stmt->execute();
    return $conn->insert_id;
}

$order_id = createOrder($conn, $user_id, $receiver_name, $contact_number, $shipping_address, $mode, $total, $delivery);
$_SESSION['order_id'] = $order_id; // Set the order_id session variable

// Redirect to the order confirmation page
header("Location:../website/order_confirmation.php");
exit;
?>