<?php
session_start();
require_once '../php/connect.php';

$cart_id = $_POST['cart_id'];
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

// Execute the update query
mysqli_query($conn, $sql);

$sql_check = "SELECT quantity FROM cart_table WHERE cart_id = $cart_id";
$result = mysqli_query($conn, $sql_check);
$row = mysqli_fetch_assoc($result);

if ($row['quantity'] <= 0) {
    // Delete the item from the cart table if quantity reaches 0
    $sql_delete = "DELETE FROM cart_table WHERE cart_id = $cart_id";
    mysqli_query($conn, $sql_delete);
} else {
    // Update the total price
    updateTotalPrice($cart_id, $conn);
}

// Redirect back to the cart page
header("Location: cart_page.php");
exit;

// Function to update the total price
function updateTotalPrice($cart_id, $conn) {
  // Retrieve the product price from the product_table
  $query = "SELECT product_price FROM product_table WHERE product_id = (SELECT product_id FROM cart_table WHERE cart_id = '$cart_id')";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $price = $row['product_price'];

  // Retrieve the quantity from the cart_table
  $query = "SELECT quantity FROM cart_table WHERE cart_id = '$cart_id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $quantity = $row['quantity'];

  // Calculate the total price
  $total_price = $price * $quantity;

  // Update the total_price column in the cart_table
  $query = "UPDATE cart_table SET total_price = '$total_price' WHERE cart_id = '$cart_id'";
  mysqli_query($conn, $query);
}
?>