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
$stmt = $conn->prepare("SELECT * FROM cart_table WHERE user_id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total cost of the order
$total = 0;
foreach ($rows as $row) {
    $total += $row['total_price'];
}

// Create an order and update the cart items
function createOrder($conn, $user_id, $receiver_name, $contact_number, $shipping_address, $mode, $total, $delivery) {
    // Use RETURNING to get inserted order_id in PostgreSQL
    $sql = "INSERT INTO orders_table (user_id, receiver_name, contact_number, order_date, total, payment_method, shipping_address, delivery_method) VALUES (:user_id, :receiver_name, :contact_number, :order_date, :total, :payment_method, :shipping_address, :delivery_method) RETURNING order_id";
    $order_date = date("Y-m-d H:i:s");
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':receiver_name' => $receiver_name,
        ':contact_number' => $contact_number,
        ':order_date' => $order_date,
        ':total' => $total,
        ':payment_method' => $mode,
        ':shipping_address' => $shipping_address,
        ':delivery_method' => $delivery
    ]);
    return $stmt->fetchColumn();
}

$order_id = createOrder($conn, $user_id, $receiver_name, $contact_number, $shipping_address, $mode, $total, $delivery);
$_SESSION['order_id'] = $order_id; // Set the order_id session variable

// Redirect to the order confirmation page
header("Location:../website/order_confirmation.php");
exit;
?>