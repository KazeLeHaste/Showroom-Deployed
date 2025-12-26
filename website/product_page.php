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
    <title>All Products</title>
    <link href="main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
</head>
<body>


   <?php include 'sidebar.php'; ?>

    


    <div class="container">
        <div class="content">
        <?php
            // Include the database connection file
            include '../php/connect.php';

            // Write the SQL query
            $sql = "SELECT product_name, product_price, product_id FROM product_table";

            // Execute the SQL query
            $result = mysqli_query($conn, $sql);

            // Check if there are any rows in the result
            if (mysqli_num_rows($result) > 0) {
            // Loop through each row and display the product information
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<a class='product-link' href='indi-product_page.php?product_id=" . $row['product_id'] . "'>";
                echo "<div class='product'>";
                echo "<img src='../images/" . $row['product_id'] . ".jpg' alt='Product Image'>";
                echo "<div class='product-description'>";
                echo "<label>" . $row['product_name'] . "</label>";
                echo "<label>₱" . $row['product_price'] . "</label>";
                echo "</div>";
                echo "</div>";
                echo "</a>";
            }
            } else {
            echo "No products found.";
            }

            // Close the database connection
            mysqli_close($conn);
        ?>
            
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
       
</body>
</html>


