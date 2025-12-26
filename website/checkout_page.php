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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="main.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="container">
        <div class="content-individual">
            <form class="form" action="../php/checkout.php" method="POST" style="border: 2px solid black; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px rgba(0, 0, 0, 0.3); border: 2px solid white; border-radius: 12px; margin-top: 40px; padding-bottom: 20px; background-color: white">
                <h1>Checkout Form</h1>
                <label><b>Reciever Name:</b></label><br>
                <input type="text" id="name" name="contact" required><br>
                <label><b>Contact Number:</b></label><br>
                <input type="tel" id="text" name="address" required><br>
                <label><b>Shipping Address:</b></label><br>
                <textarea id="message" name="message" style="color: black; height: 100px;" required></textarea><br>
                <label><b>Mode of Payment:</b></label><br>
                <select name="mode" id="mode" required>
                    <option value="" disabled selected>- Payment Method -</option>
                    <option value="COD">Cash on Delivery</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Gcash">Gcash</option>
                    <option value="Paymaya">Paymaya</option>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                </select><br>
                <label><b>Mode of Delivery:</b></label><br>
                <select name="delivery" id="delivery" required>
                    <option value="" disabled selected>- Delivery Method -</option>
                    <option value="J&T Express">J&T Express</option>
                    <option value="Lalamove">Lalamove</option>
                    <option value="Grab Move">Grab Move</option>
                    <option value="Angkas Padala">Angkas Padala</option>
                </select>
                <input type="submit" value="Purchase">
            </form>
        </div>
        
    </div>
    <footer class=" footer_section" style = " margin-top: 40px;  font-weight: 500; background-color: #bfc0c0">
            <div class="container-3">
                <p style="padding: 20px 0; margin: 0 auto; text-align: center; border-top: 1.5px solid #eeeeee; width: 80%;">
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="#" style = "text-decoration: none; color: BLACK; font-weight: 600;">SHOWROOM</a>.&nbsp;&nbsp;&nbsp;
                <a href="https://www.facebook.com/" target="_blank" class="icon">
                        <img src="../images/facebook.png"  alt="Facebook">
                    </a>
                    <a href="https://github.com/" target="_blank">
                        <img src="../images/github.png"  alt="GitHub" class="icon">
                    </a>
                    <a href="https://www.youtube.com/" target="_blank">
                        <img src="../images/youtube.png"  alt="YouTube" class="icon">
                    </a>
                </p>
            </div>
        </footer>
        <?php if (isset($_GET['show_popup']) && $_GET['show_popup'] == 1): ?>
            <script>
                // Display the popup using JavaScript
                alert("Fill out all fields.");
            </script>
        <?php endif; ?>
</body>
</html>