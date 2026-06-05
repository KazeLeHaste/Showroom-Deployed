<?php
session_start();
require_once '../php/connect.php';

$cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
$action = $_POST['action'];

switch ($action) {
    case 'minus':
        // Update the quantity by subtracting 1
        $sql = "UPDATE cart_table SET quantity = quantity - 1 WHERE cart_id = $cart_id";
        break;
    case 'plus':
        // Update the quantity by adding 1
        $sql = "UPDATE cart_table SET quantity = quantity + 1 WHERE cart_id = $cart_id";
        break;
    case 'delete':
        // Delete the item from the cart table
        $sql = "DELETE FROM cart_table WHERE cart_id = $cart_id";
        break;
    default:
        // Handle invalid action
        echo "Invalid action";
        exit;
}

// Execute the update query using PDO
$stmt = $conn->prepare($sql);
$stmt->execute([':cart_id' => $cart_id]);

$sql_check = "SELECT quantity FROM cart_table WHERE cart_id = :cart_id";
$checkStmt = $conn->prepare($sql_check);
$checkStmt->execute([':cart_id' => $cart_id]);
$row = $checkStmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    // Nothing to do
} else if ($row['quantity'] <= 0) {
    // Delete the item from the cart table if quantity reaches 0
    $sql_delete = "DELETE FROM cart_table WHERE cart_id = :cart_id";
    $delStmt = $conn->prepare($sql_delete);
    $delStmt->execute([':cart_id' => $cart_id]);
} else {
    // Update the total price
    updateTotalPrice($cart_id, $conn);
}

// Redirect back to the cart page
header("Location: cart_page.php");
exit;

// Function to update the total price
function updateTotalPrice($cart_id, $conn) {
    // Retrieve product price and quantity in a single query
    $query = "SELECT p.product_price, c.quantity FROM cart_table c JOIN product_table p ON c.product_id = p.product_id WHERE c.cart_id = :cart_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([':cart_id' => $cart_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) return;

    $price = $row['product_price'];
    $quantity = $row['quantity'];

    // Calculate the total price
    $total_price = $price * $quantity;

    // Update the total_price column in the cart_table
    $update = "UPDATE cart_table SET total_price = :total_price WHERE cart_id = :cart_id";
    $updateStmt = $conn->prepare($update);
    $updateStmt->execute([':total_price' => $total_price, ':cart_id' => $cart_id]);
}
?>