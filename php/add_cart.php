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
    $stmt = $conn->prepare("SELECT * FROM cart_table WHERE user_id =? AND product_id =?");
    if (!$stmt) {
        echo "Error preparing statement: ". $conn->error;
        exit;
    }
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if product is already in the cart
        $stmt = $conn->prepare("UPDATE cart_table SET quantity = quantity +? WHERE user_id =? AND product_id =?");
        if (!$stmt) {
            echo "Error preparing statement: ". $conn->error;
            exit;
        }
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);
    } else {
        // Insert new cart item
        $stmt = $conn->prepare("INSERT INTO cart_table (user_id, product_id, quantity) VALUES (?,?,?)");
        if (!$stmt) {
            echo "Error preparing statement: ". $conn->error;
            exit;
        }
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    }

    if ($stmt->execute()) {
        // Get the cart ID
        $cart_id = $conn->insert_id;

        // Update the total price
        updateTotalPrice($cart_id, $conn);


        header("Location:../website/cart_page.php");
    } else {

    }

    $stmt->close();
    $conn->close();
}

// Function to update the total price
function updateTotalPrice($cart_id, $conn) {

    $sql = "SELECT product_name, product_price FROM product_table WHERE product_id = (SELECT product_id FROM cart_table WHERE cart_id =?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query returned any results
    if ($result->num_rows > 0) {
        // Store the result in a variable
        $data = $result->fetch_assoc();
        $name = $data['product_name'];
        $price = $data['product_price'];
    }


    // Retrieve the product price from the product_table
    $query = "SELECT product_price FROM product_table WHERE product_id = (SELECT product_id FROM cart_table WHERE cart_id =?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $price = $row['product_price'];

    // Retrieve the quantity from the cart_table
    $query = "SELECT quantity FROM cart_table WHERE cart_id =?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $quantity = $row['quantity'];

    // Calculate the total price
    $total_price = $price * $quantity;

    // Update the total_price, product_name, and product_price columns in the cart_table
    $query = "UPDATE cart_table SET total_price =?, product_name =?, product_price =? WHERE cart_id =?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("dssi", $total_price, $name, $price, $cart_id);
    $stmt->execute();
}

// Function to check if the product stock is sufficient
function checkStock($product_id, $quantity)
{
    global $conn;

    $stmt = $conn->prepare("SELECT product_stock FROM product_table WHERE product_id =?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock = $row['product_stock'];

        if ($stock >= $quantity) {
            return true;
        }
    }

    return false;
}

?>