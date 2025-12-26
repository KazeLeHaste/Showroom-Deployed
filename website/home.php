<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="home.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="message">
            <?php
                if (isset($_SESSION['error_message'])) {
                    echo "<div class='error'>" . $_SESSION['error_message'] . "</div>";
                    unset($_SESSION['error_message']);
                }

                if (isset($_SESSION['success_message'])) {
                    echo "<div class='success'>" . $_SESSION['success_message'] . "</div>";
                    unset($_SESSION['success_message']);
                }
            ?>
    </div>
    <!-- Login Form-->
    <div class="container">
        <div class="curved-shape"></div>
        <div class="curved-shape2"></div>
        <div class="form-box Login">
            <h2 class="animation" style="--D:0; --S:21">Login</h2>
            <form action="../php/login.php" method="POST" autocomplete="off">
                <div class="input-box animation" style="--D:1; --S:22">
                    <input type="text" name="username" required>
                    <label for="">Username</label>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box animation" style="--D:2; --S:23">
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <div class="input-box animation" style="--D:3; --S:24">
                    <button class="btn" type="submit">Login</button>
                </div>
                <div class="regi-link animation" style="--D:4; --S:25">
                    <p>Don't have an account? <a href="#" class="SignUpLink">Sign Up</a></p>
                </div>
            </form>
        </div>
        <div class="info-content Login">
            <h2 class="animation" style="--D:0; --S:20">Welcome Back</h2>
            <p class="animation" style="--D:1; --S:21">
            Log in here to enter on our Show Room Online Shop
            </p>
        </div>
        <div class="form-box Register">
            <h2 class="animation" style="--li:17; --S:0;">Register</h2>
            <form action="../php/signup.php" method="POST" autocomplete="off">
                <div class="input-box animation" style="--li:18; --S:1;">
                    <input type="text" name="username" required>
                    <label for="">Username</label>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box animation" style="--li:18; --S:1;">
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                    <i class="bx bxs-envelope"></i>
                </div>
                <div class="input-box animation" style="--li:19; --S:2;">
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <div class="input-box animation" style="--li:20; --S:3;">
                    <button class="btn" type="submit">Register</button>
                </div>
                <div class="regi-link animation" style="--li:21; --S:4;">
                    <p>Don't have an account? <a href="#" class="SignInLink">Sign In</a></p>
                </div>
            </form>
        </div>
        <div class="info-content Register">
            <h2 class="animation" style="--li:17; --S:0;">Welcome Back</h2>
            <p class="animation" style="--li:18; --S:1;">
            Register here to create your account on our Show Room Online Shop
            </p>
        </div>
    </div>
<script src="home.js"></script>

</body>
</html>