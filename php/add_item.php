<?php
// Include the connect.php file
session_start();
require_once 'connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_classification = $_POST['product_classification'];
    $product_price = $_POST['product_price'];
    $product_stock = $_POST['product_stock'];

    // Attempt insert query execution
    $sql = "INSERT INTO product_table (product_name, product_description, product_classification, product_price, product_stock) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssiii", $product_name, $product_description, $product_classification, $product_price, $product_stock);
    mysqli_stmt_execute($stmt);

    // Check for errors
    if (mysqli_stmt_errno($stmt)) {
        echo "Error: " . mysqli_stmt_error($stmt);
    } else {
        $_SESSION['success_message'] = "Item Saved.";
        header("Location: ../website/add_product_page.php");
    }
}
?>