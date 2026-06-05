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

    // Insert product using PDO prepared statement
    $sql = "INSERT INTO product_table (product_name, product_description, product_classification, product_price, product_stock) VALUES (:name, :description, :classification, :price, :stock)";
    $stmt = $conn->prepare($sql);
    try {
        $stmt->execute([
            ':name' => $product_name,
            ':description' => $product_description,
            ':classification' => $product_classification,
            ':price' => $product_price,
            ':stock' => $product_stock
        ]);
        $_SESSION['success_message'] = "Item Saved.";
        header("Location: ../website/add_product_page.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>