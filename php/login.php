<?php
// Include the connect.php file
session_start();
require_once 'connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists in database (use PDO prepared statement)
    $sql = "SELECT * FROM user_info WHERE user_name = :username LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // User exists, check password (consider hashing in future)
        if ($password == $user['user_password']) {
            $_SESSION['username'] = $user['user_name'];
            $_SESSION['role'] = $user['account_type'];
            $_SESSION['user_id'] = $user['user_id'];

            header("Location: ../website/yourhome.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Invalid Password";
            header("Location: ../website/home.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Invalid Username.";
        header("Location: ../website/home.php");
        exit;
    }
}


?>