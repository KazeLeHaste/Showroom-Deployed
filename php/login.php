<?php
// Include the connect.php file
session_start();
require_once 'connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists in database
    $sql = "SELECT * FROM user_info WHERE user_name = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: ". $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User exists, check password
        $user = $result->fetch_assoc();
        if ($password == $user['user_password']) {
            $_SESSION['username'] = $user['user_name'];
            $_SESSION['role'] = $user['account_type'];
            $_SESSION['user_id'] = $user['user_id'];

            header("Location: ../website/yourhome.php");
        } else {
            $_SESSION['error_message'] = "Invalid Password";
            header("Location: ../website/home.php");
        }
    } else {
        $_SESSION['error_message'] = "Invalid Username.";
        header("Location: ../website/home.php");
    }
}


?>