<?php
// Include the connect.php file
require_once 'connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $account = "Customer";

    // Attempt insert query execution
    $sql = "INSERT INTO user_info (user_name, user_email, user_password, account_type) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password, $account);
    mysqli_stmt_execute($stmt);

    // Check for errors
    if (mysqli_stmt_errno($stmt)) {
        echo "Error: " . mysqli_stmt_error($stmt);
    } else {
        $_SESSION['success_message'] = "Account Created.";
        header("Location: ../website/home.php");

    }
}
?>