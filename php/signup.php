<?php
// Include the connect.php file
require_once 'connect.php';
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $account = "Customer";

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Use PDO prepared statement to insert the user
    $sql = "INSERT INTO user_info (user_name, user_email, user_password, account_type) VALUES (:username, :email, :password, :account)";
    $stmt = $conn->prepare($sql);
    try {
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':account' => $account
        ]);
        $_SESSION['success_message'] = "Account Created.";
        header("Location: ../website/home.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>