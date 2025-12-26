
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="main.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../images/showroom.png" alt="Logo">
        </div>
        <div class="header-action">
            <div class="header-action-top">
                <div class="search">
                    <form action="search_page.php" method="post">
                        <input type="text" name="search" placeholder="" class="search-bar">
                        <button class="search_btn">Search</button>
                    </form>
                </div>
                <div style="display: flex; flex-direction: row-reverse; border: none; justify-content: space-between; width: max-content    ;">
                    <button class="logout" onclick="window.location.href='../php/logout.php'">Logout</button>
                    <label class="profile" style ="color: black;">Welcome, <strong>&nbsp;<?php echo "<label style='color: black;'>".$_SESSION['username']."</label>";?></strong></label>

                </div>
            </div>



            
            <div class="header-action-bot">
                <div class="nav">
                    <button class="nav-item" onclick="window.location.href=''">Home</button>
                    <button class="nav-item" onclick="window.location.href='product_page.php'">Products</button>
                    <button class="nav-item" onclick="window.location.href='contact_page.php'">Contacts</button>
                    <button class="nav-item" onclick="window.location.href='about_page.php'">About</button>
                    <?php
                        $role = $_SESSION['role'];
                        if ($role === 'Admin') {
                            echo "<button class='nav-item' onclick=\"window.location.href='add_product_page.php'\">Add" . "&nbsp;" . "Product</button>";
                        }
                    ?>
                </div>
                <button class="cart" onclick="window.location.href='cart_page.php'">
                    Cart
                </button>
                
            </div>
        </div>
    </header>
   
</body>
</html>