<?php
// Connect to the database
require_once 'connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the product ID from the form
    $product_id = $_POST['select_product'];

    // Get the updated values from the form
    $product_description = $_POST['product_description'];
    $product_classification = $_POST['product_classification'];
    $product_price = $_POST['product_price'];
    $product_stock = $_POST['product_stock'];

    // Initialize an empty array to store the update queries
    $update_queries = array();

    // Check if each field is not empty, and add the update query to the array
    if (!empty($product_description)) {
        $update_queries[] = "product_description = '$product_description'";
    }
    if (!empty($product_classification)) {
        $update_queries[] = "product_classification = '$product_classification'";
    }
    if (!empty($product_price)) {
        $update_queries[] = "product_price = '$product_price'";
    }
    if (!empty($product_stock)) {
        $update_queries[] = "product_stock = '$product_stock'";
    }

    // If there are update queries, construct the UPDATE statement
    if (!empty($update_queries)) {
        $update_query = "UPDATE product_table SET ". implode(', ', $update_queries). " WHERE product_id = '$product_id'";
        mysqli_query($conn, $update_query);

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