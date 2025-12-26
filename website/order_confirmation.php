<?php
session_start();
require_once '../php/connect.php';

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    // User is not logged in, redirect to login page
    header("Location: home.php");
    exit;
}

$role = $_SESSION['role'];
if (!in_array($role, array('Admin', 'Customer'))) {
    header("Location: product_page.php");
    exit;
}

// Get the order ID from the session
if (!isset($_SESSION['order_id'])) {
    die("Order ID is not set in the session.");
}
$order_id = $_SESSION['order_id'];
$user_id = $_SESSION['user_id'];

// Retrieve the order details from the database
$query = "SELECT * FROM orders_table WHERE order_id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Error executing query: " . $stmt->error);
}
$order_data = $result->fetch_assoc();
if (!$order_data) {
    die("No order data found for order_id: " . $order_id);
}

// Retrieve the cart items from the database
$query = "SELECT product_name, quantity, product_price, total_price FROM cart_table WHERE user_id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Error executing query: " . $stmt->error);
}

$cart_items = array();
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
}
if (empty($cart_items)) {
    die("No cart items found for user_id: " . $user_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="main.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        }

        th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        }

        th {
        background-color: transparent;
        }

    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>
    
    <div class="container">
        <div class="content-individual">
            <div class="about-us">
                <div class="full-description">
                    <h2>Order Confirmation</h2>

                    <h2>Order Details</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Product Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart_items as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                    <td><?php echo '₱' . htmlspecialchars($item['product_price']); ?></td>
                                    <td><?php echo '₱' . htmlspecialchars($item['total_price']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <h2>Checkout Information</h2>
                    <p>
                        <strong>Order ID:</strong> <?php echo htmlspecialchars($order_data['order_id']); ?><br>
                        <strong>Receiver Name:</strong> <?php echo htmlspecialchars($order_data['receiver_name']); ?><br>
                        <strong>Contact Number:</strong> <?php echo htmlspecialchars($order_data['contact_number']); ?><br>
                        <strong>Order Date:</strong> <?php echo htmlspecialchars($order_data['order_date']); ?><br>
                        <strong>Total:</strong> <?php echo '₱' . htmlspecialchars($order_data['total']); ?><br>
                        <strong>Payment Method:</strong> <?php echo htmlspecialchars($order_data['payment_method']); ?><br>
                        <strong>Shipping Address:</strong> <?php echo htmlspecialchars($order_data['shipping_address']); ?><br>
                        <strong>Delivery Method:</strong> <?php echo htmlspecialchars($order_data['delivery_method']); ?>
                    </p>
                    
                    <div style="display: flex;">
                        <button class="nav-item" onclick="window.location.href='product_page.php'" style="padding: 5px 10px; background-color:#9f2651; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; font-size: 18px; height: 50px; margin-right: 12px;">Continue Shopping</button>
                        <button class="nav-item" onclick="window.location.href='../php/cart_clear.php'" style="padding: 5px 10px; background-color:#9f2651; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; font-size: 18px; height: 50px;">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
        <footer class="footer_section" style="margin-top: 40px; font-weight: 500; background-color: #bfc0c0">
            <div class="container-3">
                <p style="padding: 20px 0; margin: 0 auto; text-align: center; border-top: 1.5px solid #eeeeee; width: 80%;">
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="#" style="text-decoration: none; color: BLACK; font-weight: 600;">SHOWROOM</a>.&nbsp;&nbsp;&nbsp;
                <a href="https://www.facebook.com/" target="_blank" class="icon">
                        <img src="../images/facebook.png" alt="Facebook">
                    </a>
                    <a href="https://github.com/" target="_blank">
                        <img src="../images/github.png" alt="GitHub" class="icon">
                    </a>
                    <a href="https://www.youtube.com/" target="_blank">
                        <img src="../images/youtube.png" alt="YouTube" class="icon">
                    </a>
                </p>
            </div>
        </footer>
</body>
</html>
