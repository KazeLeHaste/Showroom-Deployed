<?php
// Connect to the database
require_once 'connect.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the product ID from the form
    $product_id = $_POST['select_product'];

    // Get the updated values from the form
    $product_description = $_POST['product_description'];
    $product_classification = $_POST['product_classification'];
    $product_price = $_POST['product_price'];
    $product_stock = $_POST['product_stock'];

    // Prepare fields and parameters for an update query
    $fields = [];
    $params = [':product_id' => $product_id];

    if (!empty($product_description)) {
        $fields[] = 'product_description = :product_description';
        $params[':product_description'] = $product_description;
    }
    if (!empty($product_classification)) {
        $fields[] = 'product_classification = :product_classification';
        $params[':product_classification'] = $product_classification;
    }
    if (!empty($product_price)) {
        $fields[] = 'product_price = :product_price';
        $params[':product_price'] = $product_price;
    }
    if (!empty($product_stock)) {
        $fields[] = 'product_stock = :product_stock';
        $params[':product_stock'] = $product_stock;
    }

    // If there are update fields, construct and execute the UPDATE statement
    if (!empty($fields)) {
        $update_query = 'UPDATE product_table SET ' . implode(', ', $fields) . ' WHERE product_id = :product_id';
        $stmt = $conn->prepare($update_query);
        $stmt->execute($params);

        // Set a success message
        $_SESSION['success_message'] = 'Product updated successfully!';
    } else {
        // Set an error message if no fields were updated
        $_SESSION['error_message'] = 'No fields were updated!';
    }

    // Redirect back to the change product page
    header("Location: ../website/update_product_page.php?show_popup=1");
    exit;
}
?>