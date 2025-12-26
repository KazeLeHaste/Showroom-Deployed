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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Query</title>
    <link href="main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <?php include 'sidebar.php'; ?>
    
    <div class="container" style = "background-color: white;">
        

            <div class="about-us">
                <img src="../images/logos.png" alt="about-us" style = "width: 350px; height: 200px; margin-right: 80px; border: 1px solid black;">
                <div class="full-description">
                    <div class="p-header">About Showroom</div>
                    <div class="description">Showroom is your ultimate online destination for high-quality computer peripherals. Our online shop is dedicated to providing a wide range of products that cater to both casual users and tech enthusiasts. Whether you're looking to upgrade your home office, enhance your gaming setup, or find the perfect accessories for your computer, Showroom has got you covered.

                    <br><br><b>Our Product Range</b><br>
                    At Showroom, we offer an extensive selection of computer peripherals, including:<br>
                    <b>Keyboards:</b> From ergonomic designs to mechanical keyboards, we have options that suit every typing preference. <br>
                    <b>Mouse:</b> Explore our collection of wired and wireless mouse, designed for precision and comfort.<br>
                    <b>Monitors:</b> Find the perfect display with our range of high-resolution monitors, ideal for gaming, work, and entertainment.<br>
                    <b>Headsets:</b> Experience superior sound quality with our selection of gaming and office headsets.<br>
                    <b>Webcams:</b> Stay connected with high-definition webcams, perfect for video conferencing and streaming.<br>
                    <b>Storage Devices:</b> Keep your data safe with our reliable external hard drives, SSDs, and USB flash drives.<br>
                    <b>Printers and Scanners:</b> Enhance your productivity with our range of multifunctional printers and scanners.<br>
                    <b>Networking Equipment:</b> Ensure fast and reliable internet with our routers, modems, and network accessories.<br>
                    <b>Accessories: </b>From mouse pads to cable organizers, we have all the extras to complete your setup.<br>
                </div>
                <div class="p-header" style = "margin-top: 20px;">Showroom Developers</div>
                <div class="description">
                <br>
                    <b>Name:</b> Odvina, Marienella Reggiette M.<br>
                    <b>Age:</b> 20 years old <br>
                    <b>Gender:</b> Female <br>
                    <b>email:</b> marienellareggiette.odvina@perpetual.edu.ph<br>
                    <br>
                    <b>Name:</b> Deganos, Lloyd Alvin <br>
                    <b>Age:</b> 20 years old<br>
                    <b>Gender:</b> Male <br>
                    <b>email:</b> llyodalvin.deganos@perpetual.edu.ph<br>

                    <br>
                    <b>Name:</b> Gaqui, Kim Christian <br>
                    <b>Age:</b> 20 years old <br>
                    <b>Gender:</b> Male <br>
                    <b>email:</b> kimchristian.gaqui@perpetual.edu.ph<br>

                    <br>
                    <b>Name:</b> Gutierrez, Patrick Kyle E. <br>
                    <b>Age:</b> 20 years old<br>
                    <b>Gender:</b> Male <br>
                    <b>email:</b> patrickkyle.gutierrez@perpetual.edu.ph<br>

                    <br>
                    <b>Name:</b> Quintero, Sheila Lorraine <br>
                    <b>Age:</b> 20 years old <br>
                    <b>Gender:</b> Female <br>
                    <b>email:</b> sheilalorraine.quintero@perpetual.edu.ph<br>

                    <br>

                    
                    

                </div>
            
        </div>
        
    </div>
</div>

        <footer class=" footer_section" style = " margin-top: 40px;  font-weight: 500; background-color: #bfc0c0">
            <div class="container-3">
                <p style="padding: 20px 0; margin: 0 auto; text-align: center; border-top: 1.5px solid #eeeeee; width: 80%;">
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="#" style = "text-decoration: none; color: BLACK; font-weight: 600;">SHOWROOM</a>.&nbsp;&nbsp;&nbsp;
                <a href="https://www.facebook.com/" target="_blank" class="icon">
                        <img src="../images/facebook.png"  alt="Facebook">
                    </a>
                    <a href="https://github.com/" target="_blank">
                        <img src="../images/github.png"  alt="GitHub" class="icon">
                    </a>
                    <a href="https://www.youtube.com/" target="_blank">
                        <img src="../images/youtube.png"  alt="YouTube" class="icon">
                    </a>
                </p>
            </div>
        </footer>
    
   
</body>
</html>