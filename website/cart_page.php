<?php
    session_start();
    require_once '../php/connect.php';

    // Check if the user is logged in
    if (!isset($_SESSION['username']) ||!isset($_SESSION['role'])) {
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
    <title>Cart Page</title>
    <link href="main.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

    </style>
</head>
<body>
    
    <?php include 'sidebar.php';?>
    <div class="container-2">
    <?php
            $user_id = $_SESSION['user_id'];

            $stmt = $conn->prepare("SELECT c.cart_id, p.product_id, p.product_name, p.product_description, p.product_price, c.quantity FROM cart_table c JOIN product_table p ON c.product_id = p.product_id WHERE c.user_id =?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($cart_data = mysqli_fetch_assoc($result)) {
                   ?>
                        
                            <div class="content-cart">
                                <div class="product-cart">
                                    <?php                 
                                        echo "<img src='../images/". $cart_data['product_id']. ".jpg' alt='Product Image'>"; 
                                   ?>
                                    <div class="product-info-cart">
                                        <div class="item-name-cart">
                                            <?php echo $cart_data['product_name'];?>
                                        </div>
                                        <div class="item-desc-cart">
                                            <?php echo $cart_data['product_description'];?>
                                        </div>
                                    </div>
                                    <div class="cart-payable">
                                        <div class="price">Price: ₱<?php echo $cart_data['product_price'];?></div>

                                        <div class="amount-2">
                                            <label>Quantity:</label>
                                        </div>
                                        
                                        <div class="amount-2">
                                            <form action="update_cart.php" method="POST">
                                                <input type="hidden" name="cart_id" value="<?php echo $cart_data['cart_id'];?>">
                                                <input type="hidden" name="action" value="minus">
                                                <button type="submit" class="minus">-</button>
                                            </form>
                                            <label style="margin: 0 2px;"><?php echo $cart_data['quantity'];?></label>
                                            <form action="update_cart.php" method="POST">
                                                <input type="hidden" name="cart_id" value="<?php echo $cart_data['cart_id'];?>">
                                                <input type="hidden" name="action" value="plus">
                                                <button type="submit" class="plus">+</button>
                                            </form>
                                        </div>
                                        <form action="update_cart.php" method="POST">
                                            <input type="hidden" name="cart_id" value="<?php echo $cart_data['cart_id'];?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button class="delete">Remove</button>
                                        </form>
                                    </div>
                                </div>                
                            </div>
                        

                <?php
                }
            } else {
                echo "<div style='text-align: center; font-size: 24px; margin-top: 20px; display: flex; align-items: center; justify-content: center; width: 100%; margin-bottom: 12px;'>Your cart is empty.</div>";
            }
            $stmt->close();
            $conn->close();
         ?>
         <form action="checkout_page.php" method="post" class="checkout-1">
            <?php
            if ($result->num_rows > 0) {
                ?>
                <button type="submit" class="checkout" name="checkout">Checkout</button>
            <?php
            } else {
                ?>
                <button type="button" class="checkout" disabled>Checkout</button>
            <?php
            }
            ?>
        </form>
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
                alert("Insufficient Stock");
            </script>
        <?php endif; ?>
</body>
</html>