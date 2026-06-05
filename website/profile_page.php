<?php
    session_start();
    require_once '../php/connect.php';

    // Check if the user is logged in
    if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
        // User is not logged in, redirect to login page
        header("Location: home.php");
        exit;
    }

    $role = $_SESSION['role'];
    if (!in_array($role, array('Admin', 'Customer'))) {
        header("Location: product_page.php");
    }

    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM user_info WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([':user_id' => $user_id]);
    $user_infos = $stmt->fetch(PDO::FETCH_ASSOC);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="main.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
</head>

<body>
    
<?php include 'sidebar.php'; ?>

    <div class="container">
        <div class="content-individual">
        <div class="about-us">
                <div class="full-description">
                    <div class="user-info">
                    <div class="user-info-label-1">User Information</div>
                    <div class="user-info-label">Username:</div>
                    <div class="user-info-label-2"><?php echo htmlspecialchars($user_infos['user_name']); ?></div>
                    <div class="user-info-label">Email:</div>
                    <div class="user-info-label-2"><?php echo htmlspecialchars($user_infos['user_email']); ?></div>
                    <div class="user-info-label">Account Type: </div>
                    <div class="user-info-label-2"><?php echo htmlspecialchars($user_infos['account_type']); ?></div>
                    </div>
                </div>
        </div>
        </div>
    </div>
        

    <footer class="footer_section" style="margin-top: 40px; font-weight: 500; background-color: #bfc0c0">
            <div class="container-3">
                <p style="padding: 20px 0; margin: 0 auto; text-align: center; border-top: 1.5px solid #eeeeee; width: 80%;">
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="#" style="text-decoration: none; color: BLACK; font-weight: 600;">SHOWROOM</a>.&nbsp;&nbsp;&nbsp;
                <a href="https://www.facebook.com/" target="_blank" class="icon">
                        <img src="../images/facebook.png" alt="Facebook">
                    </a>
                    <a href="https://github.com/" target="_blank">
                        <img src="../images/github.png" alt="GitHub" class="icon">
                    </a>
                    <a href="https://www.youtube.com/" target="_blank">
                        <img src="../images/youtube.png" alt="YouTube" class="icon">
                    </a>
                </p>
            </div>
        </footer>

</main>
</body>
</html>
