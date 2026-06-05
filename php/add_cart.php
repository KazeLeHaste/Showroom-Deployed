<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
    } else {
        echo "Error: Quantity is not set.";
        exit;
    }

    if (isset($_SESSION['user_id']) && isset($_SESSION['product_id'])) {
        $user_id = $_SESSION['user_id'];
        $product_id = $_SESSION['product_id'];
    } else {
        echo "Error: User ID or Product ID is not set.";
        exit;
    }

    // Check if the product stock is sufficient
    if (!checkStock($product_id, $quantity)) {
        header("Location: ../website/cart_page.php?show_popup=1");
        exit;
    }

    // Check if the product is already in the cart
    $checkSql = "SELECT cart_id, quantity FROM cart_table WHERE user_id = :user_id AND product_id = :product_id";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->execute([':user_id' => $user_id, ':product_id' => $product_id]);
    $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        // Update quantity if product is already in the cart
        $updateSql = "UPDATE cart_table SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $conn->prepare($updateSql);
        $stmt->execute([':quantity' => $quantity, ':user_id' => $user_id, ':product_id' => $product_id]);
        $cart_id = $existing['cart_id'];
    } else {
        // Insert new cart item (returning cart_id)
        $insertSql = "INSERT INTO cart_table (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity) RETURNING cart_id";
        $stmt = $conn->prepare($insertSql);
        $stmt->execute([':user_id' => $user_id, ':product_id' => $product_id, ':quantity' => $quantity]);
        $cart_id = $stmt->fetchColumn();
    }

    if ($cart_id) {
        // Update the total price
        updateTotalPrice($cart_id, $conn);
        header("Location:../website/cart_page.php");
        exit;
    }
}

// Function to update the total price
function updateTotalPrice($cart_id, $conn) {
    // Get product info and quantity
    $sql = "SELECT p.product_name, p.product_price, c.quantity
            FROM cart_table c
            JOIN product_table p ON c.product_id = p.product_id
            WHERE c.cart_id = :cart_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':cart_id' => $cart_id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        return;
    }

    $name = $data['product_name'];
    $price = $data['product_price'];
    $quantity = $data['quantity'];

    $total_price = $price * $quantity;

    $updateSql = "UPDATE cart_table SET total_price = :total_price, product_name = :name, product_price = :price WHERE cart_id = :cart_id";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->execute([':total_price' => $total_price, ':name' => $name, ':price' => $price, ':cart_id' => $cart_id]);
}

// Function to check if the product stock is sufficient
function checkStock($product_id, $quantity)
{
    global $conn;

    $stmt = $conn->prepare("SELECT product_stock FROM product_table WHERE product_id = :product_id");
    $stmt->execute([':product_id' => $product_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && isset($row['product_stock'])) {
        $stock = $row['product_stock'];
        return ($stock >= $quantity);
    }

    return false;
}

?>