<?php

require_once 'connect.php';
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare the SQL statement
    $sql = "INSERT INTO inquiry_table (`name`, `email`, `message`) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

    // Execute the SQL statement
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Message Saved.";
        header("Location: ../website/yourhome.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Error.";
        header("Location: ../website/contact_page.php");
        exit;
    }
}

?>