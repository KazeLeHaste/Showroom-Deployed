<!DOCTYPE html>
  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    
</head>

<body>
    
    <header>
        <section class= "sidebar">
                <div class="image-text">
                    <span class="image">
                        <img src="../images/showrooms.png" alt="showroomlogo" style = "width: 100px;">
                    </span>

                    <div class="text logo-text">
                        <span class="name" style = "color: #ffffff;">SHOWROOM</span>
                        <span class="profession" style = "color: #ffffff;">Online Shop</span>
                    </div>
                </div>
                <div class="menu-bar">
                <div class="menu">
                    <ul class="menu-links">
                        <li class="nav-link">
                            <a  href="yourhome.php">
                                <i class='bx bx-home-alt icon' ></i>
                                <span class="text nav-text">Your Home</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href= "product_page.php">
                                <i class='bx bx-shopping-bag icon' ></i>
                                <span class="text nav-text">All Products</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="about_page.php">
                                <i class='bx bx-group icon' ></i>
                                <span class="text nav-text">About Us</span>
                            </a>
                        </li>

                         <li class="nav-link">
                            <a href="cart_page.php">
                                <i class='bx bx-cart icon' ></i>
                                <span class="text nav-text">Cart</span>
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="contact_page.php">
                                <i class='bx bx-message icon' ></i>
                                <span class="text nav-text">Contact Us</span>
                             </a>
                        </li>
                        
                        <?php
                            $role = $_SESSION['role'];
                            if ($role === 'Admin') {
                                echo "<li class='nav-link'>
                                <a href='add_product_page.php'>
                                    <i class='bx bx-folder-plus icon' ></i>
                                    <span class='text nav-text'>Add Product</span>
                                </a>
                            </li>";
                            }
                         ?>

                        <?php
                            $role = $_SESSION['role'];
                            if ($role === 'Admin') {
                                echo "<li class='nav-link'>
                                <a href='update_product_page.php'>
                                    <i class='bx bx-edit-alt icon'></i>
                                    <span class='text nav-text'>Change Product</span>
                                </a>
                            </li>";
                            }
                         ?>

                        <?php
                            $role = $_SESSION['role'];
                            if ($role === 'Admin') {
                                echo "<li class='nav-link'>
                                <a href='sales_report_page.php'>
                                    <i class='bx bx-money-withdraw icon'></i>
                                    <span class='text nav-text'>Sales Report</span>
                                </a>
                            </li>";
                            }
                         ?>

                        <?php
                            $role = $_SESSION['role'];
                            if ($role === 'Admin') {
                                echo "<li class='nav-link'>
                                <a href='messages_page.php'>
                                    <i class='bx bx-message-rounded-dots icon'></i>
                                    <span class='text nav-text'>Messages</span>
                                </a>
                            </li>";
                            }
                         ?>
                    </ul>
                </div>
                

                <div class="bottom-content">
                    <li class="">
                        <a href="../php/logout.php">
                            <i class='bx bx-log-out icon' ></i>
                            <span class="text nav-text">Log Out</span>
                        </a>
                    </li>
                </div>
            </div>
           

        </section>
    </header>
    <main>
        <section class = "top">
            
            <div class="text" style="color: white;">WELCOME TO SHOWROOM</div>
            
            
            <div class="search">
            <form action="search_page.php" method="post">
                 <input type="text" name="search" placeholder="Search Now" class="search-bar">
                <button class="search_btn">Search</button>   
</form>          
            </div>
       

            <div class="profile">
            <button class="profile-btn" onclick="window.location.href='profile_page.php'">
                <i class='bx bxs-user-circle icon' style = "color: white;"><span style="font-size: 0.6em; display: flex; align-items: center; justify-content: center; color: white; height: max-content; padding-bottom: 2px; font-family: Arial, Helvetica, sans-serif; margin-left: 6px;">Your Profile</span></i>
                    
            </button>
           
            </div>    
        </section>
</body>
</html>