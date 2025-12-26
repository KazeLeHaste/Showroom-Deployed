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
    <title>Change Product</title>
    <link href="main.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="container">
        <div class="content-individual">
            <form class="form" action="../php/update_item.php" method="post" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 6px 20px rgba(0, 0, 0, 0.3); border-radius: 12px; margin-top: 40px; padding-bottom: 20px;">
            <h2>Change Product Details</h2>
            <label>Select Product:</label><br>
            <select name="select_product" id="select_product" required>
                <option value="" disabled selected> - Select Product -</option>
                <?php
                // Retrieve products from product_table
                $sql = "SELECT product_id, product_name FROM product_table";
                $result = mysqli_query($conn, $sql);

                // Generate options
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='". $row['product_id']. "'>". $row['product_name']. "</option>";
                }

                // Close connection
                mysqli_close($conn);
            ?>
            </select> 
                <br>

                <label>Product Description:</label><br>
                <input type="text" id="product_description" name="product_description"><br>

               <label>Product Classification:</label><br>
                <input type="text" id="product_classification" name="product_classification"><br>

                <label>Product Price:</label><br>
                <input type="number" id="product_price" name="product_price"><br>

                <label>Product Stock:</label><br>
                <input type="text" id="product_stock" name="product_stock"><br>

                <input type="submit" value="Submit">

                <div class="message">
                    <?php
                        if (isset($_SESSION['error_message'])) {
                            echo "<div class='error'>" . $_SESSION['error_message'] . "</div>";
                            unset($_SESSION['error_message']);
                        }

                        if (isset($_SESSION['success_message'])) {
                            echo "<div class='success'>" . $_SESSION['success_message'] . "</div>";
                            unset($_SESSION['success_message']);
                        }
                    ?>
                </div>
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
                alert("Changed Successful!");
            </script>
        <?php endif; ?>
</body>
</html>