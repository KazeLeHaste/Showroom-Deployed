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
    <title>Individual Product Page</title>
    <link href="main.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    
    <?php
        // Connect to the database
        include '../php/connect.php';

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the product_id from the URL query string
        $product_id = $_GET['product_id'];

        $_SESSION['product_id'] = $product_id;

        // Validate the product_id
        $product_id = filter_var($product_id, FILTER_VALIDATE_INT);

        if ($product_id) {
            // Prepare the query to prevent SQL injection
            $query = "SELECT * FROM product_table WHERE product_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $product_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $product_data = mysqli_fetch_assoc($result);

            // Check if the product exists
            if ($product_data) {
                // Display the product data
                ?>
                <div class="container">
                    <div class="content-individual">
                        <div class="product-individual">
                            <?php                 
                                echo "<img src='../images/" . $product_data['product_id'] . ".jpg' alt='Product Image'>"; 
                            ?>
                            <div class="full-description">
                                <div class="p-header"><?php echo htmlspecialchars($product_data['product_name']); ?></div>

                                <div class="description"><?php echo htmlspecialchars($product_data['product_description']); ?></div>

                                <div>
                                    <label>Price: ₱<?php echo htmlspecialchars($product_data['product_price']); ?></label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label>Stocks Available: <?php echo htmlspecialchars($product_data['product_stock']); ?></label>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="flex">
                        <form action="../php/add_cart.php" method="POST">
                            <div class="amount">
                            <label>Quantity:</label>
                            <button type="button" id="minus">-</button>
                            <input type="text" name="quantity" id="quantity" value="1" pattern="[0-9]*"></input>
                            <button type="button" id="add">+</button>
                            <button class="add-cart-2" type="submit">Add to Cart</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div> 
                <?php
            } else {
                echo "Product not found";
            }
        } else {
            echo "Invalid product ID";
        }

        // Close the database connection
        mysqli_close($conn);
    ?>

    <script>

    const quantityInput = document.getElementById('quantity');
    const addBtn = document.getElementById('add');
    const minusBtn = document.getElementById('minus');

    addBtn.addEventListener('click', () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    minusBtn.addEventListener('click', () => {
        const currentValue = parseInt(quantityInput.value, 10);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    quantityInput.addEventListener('input', (e) => {
        const value = parseInt(e.target.value, 10);
        if (value < 1) {
            e.preventDefault();
            e.target.value = 1; // or set to 0, depending on your requirement
        }
        });

    </script>
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