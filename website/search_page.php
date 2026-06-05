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
    <title>Search Query</title>
    <link href="main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

    </style>
</head>
<body>
    
    <?php include 'sidebar.php'; ?>

    <div class="container">

    <div class="content">
            
                <?php
                // Check if the search form has been submitted
                if (isset($_POST['search'])) {
                    // Get the search query from the form
                    $searchQuery = $_POST['search'];

                    // Query the database for search results using parameterized LIKE
                    $sql = "SELECT * FROM product_table WHERE product_name ILIKE :q OR product_description ILIKE :q OR product_classification ILIKE :q";
                    $stmt = $conn->prepare($sql);
                    $like = '%' . $searchQuery . '%';
                    $stmt->execute([':q' => $like]);
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Check if there are any rows in the result
                    if (count($rows) > 0) {
                        // Loop through each row and display the product information
                        foreach ($rows as $row) {
                            echo "<a href='indi-product_page.php?product_id=" . $row['product_id'] . "'>";
                            echo "<div class='product'>";
                            echo "<img src='../images/" . $row['product_id'] . ".jpg' alt='Product Image'>";
                            echo "<div class='product-description'>";
                            echo "<label>" . htmlspecialchars($row['product_name']) . "</label>";
                            echo "<label>₱" . htmlspecialchars($row['product_price']) . "</label>";
                            echo "</div>";
                            echo "</div>";
                            echo "</a>";
                        }
                    } else {
                        echo "No products found.";
                    }
                }
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