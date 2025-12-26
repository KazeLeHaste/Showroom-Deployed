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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="main.css" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
</head>

<body>
    
<?php include 'sidebar.php'; ?>

        <section class="hero">
		    <div class= "img-style2">
            <img src="../images/gadgets.jpg" alt="Sales">
		    </div>

		    <div class="img-style2">
			    <img src="../images/sales.jpg" alt="Sales">
		    </div>
        </section>

        <section class="box-section">
            <a href="indi-product_page.php?product_id=1">
		    <article class="info-box">
					<img src="../images/1.jpg" alt="Save Time">
                    <hr style = "width: 100%; border: 1px solid black;">
                    <div class= "info-text" style = "color: black; font-size: 20px"><strong>MOUSE</strong><br> Showroom </div>
			</article>
            </a>

            <a href="indi-product_page.php?product_id=8">
		    <article class="info-box">
					<img src="../images/8.jpg" alt="Simple to Use">
                    <hr style = "width: 100%; border: 1px solid black;">
                    <div class= "info-text" style = "color: black; font-size: 20px"><strong>CAMERA</strong><br> Showroom </div>
			</article>
            </a>
		
            <a href="indi-product_page.php?product_id=6">
		    <article class="info-box">
				<img src="../images/6.jpg" alt="Cloud Integration">
                <hr style = "width: 100%; border: 1px solid black;">
                    <div class= "info-text" style = "color: black; font-size: 20px"><strong>HEADPHONES</strong><br> Showroom </div>
		    </article>
            </a>

            <a href="indi-product_page.php?product_id=4">
            <article class="info-box">
				<img src="../images/4.jpg" alt="Cloud Integration">
                <hr style = "width: 100%; border: 1px solid black;">
                    <div class= "info-text" style = "color: black; font-size: 20px"><strong>KEYBOARD</strong><br> Showroom </div>
		    </article>
            </a>
	    </section>

        <section class="box-section">
        <a href="indi-product_page.php?product_id=13">
		    <article class="info-box">
            <img src="../images/13.jpg" alt="Cloud Integration">
                <hr style = "width: 100%; border: 1px solid black;">
                    <div class= "info-text" style = "color: black; font-size: 20px"><strong>LAPTOP</strong><br> Showroom </div>
			</article>
            </a>
    
            <a href="indi-product_page.php?product_id=11">
		    <article class="info-box">
            <img src="../images/11.jpg" alt="Cloud Integration">
                <hr style = "width: 100%; border: 1px solid black;">
                    <div class= "info-text" style = "color: black; font-size: 20px"><strong>SPEAKER</strong><br> Showroom </div>
			</article>
            </a>
		
            <a href="indi-product_page.php?product_id=9">
		    <article class="info-box">
            <img src="../images/9.jpg" alt="Cloud Integration">
                <hr style = "width: 100%; border: 1px solid black;">
                    <div class= "info-text" style = "color: black; font-size: 20px"><strong>MONITOR</strong><br> Showroom </div>
		    </article>
            </a>

            <a href="indi-product_page.php?product_id=12">
            <article class="info-box">
            <img src="../images/12.jpg" alt="Cloud Integration">
                <hr style = "width: 100%; border: 1px solid black;">
                    <div class= "info-text" style = "color: black; font-size: 20px"><strong>PRINTER</strong><br> Showroom </div>
		    </article>
            </a>
	    </section>

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
        <?php if (isset($_GET['show_popup']) && $_GET['show_popup'] == 1): ?>
            <script>
                // Display the popup using JavaScript
                alert("Order Successful!");
            </script>
        <?php endif; ?>

</main>
</body>
</html>
