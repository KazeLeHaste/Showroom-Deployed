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
        // Determine if stored password is hashed or plaintext
        $stored = $user['user_password'];
        $pwInfo = password_get_info($stored);

        if ($pwInfo['algo'] === 0) {
            // Legacy plaintext password stored. Compare directly.
            if ($password === $stored) {
                // Re-hash the plaintext password and update the DB
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE user_info SET user_password = :pw WHERE user_id = :id");
                $update->execute([':pw' => $newHash, ':id' => $user['user_id']]);

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
            // Stored password is hashed. Verify using password_verify.
            if (password_verify($password, $stored)) {
                // Optionally rehash if algorithm parameters changed
                if (password_needs_rehash($stored, PASSWORD_DEFAULT)) {
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $update = $conn->prepare("UPDATE user_info SET user_password = :pw WHERE user_id = :id");
                    $update->execute([':pw' => $newHash, ':id' => $user['user_id']]);
                }

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
        }
    } else {
        $_SESSION['error_message'] = "Invalid Username.";
        header("Location: ../website/home.php");
        exit;
    }
}


?>