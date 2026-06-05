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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="main.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        table {
        border-collapse: collapse;
        width: 90%;
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
        <div class="about-us-2">
        <?php
        // Query to retrieve data from orders_table
        $sql = "SELECT order_id, user_id, receiver_name, order_date, total FROM orders_table";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Print table header
        echo "<table border='1'>";
        echo "<tr><th>Order ID</th><th>User ID</th><th>Receiver Name</th><th>Order Date</th><th>Total</th></tr>";

        // Print table data
        $total = 0;
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>". htmlspecialchars($row["order_id"]). "</td>";
            echo "<td>". htmlspecialchars($row["user_id"]). "</td>";
            echo "<td>". htmlspecialchars($row["receiver_name"]). "</td>";
            echo "<td>". htmlspecialchars($row["order_date"]). "</td>";
            echo "<td>". "₱" . htmlspecialchars($row["total"]). "</td>";
            echo "</tr>";
            $total += $row["total"];
        }

        // Print table footer
        echo "</table>";

        // Print total
        echo "<p>Gross Sales: ₱". number_format($total, 2). "</p>";
        ?>

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

</main>
</body>
</html>
