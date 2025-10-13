<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DecoNest</title>
    <link rel="icon" href="../Assets/Templates/Main/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/flaticon.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/style.css">
    <style>
        /* Light color scheme for home decor theme */
        .main_menu {
            background-color: #EFFFFF;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .navbar-light .navbar-nav .nav-link {
            color: #5a5a5a;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link:focus {
            color: #c8a97e; /* Warm accent color common in home decor */
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            background-color: #ffffff;
        }
        
        .dropdown-item {
            color: #5a5a5a;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: #f8f5f0;
            color: #c8a97e;
        }
        
        .hearer_icon a {
            color: #5a5a5a !important;
            transition: all 0.3s ease;
        }
        
        .hearer_icon a:hover {
            color: #c8a97e !important;
        }
        
        .navbar-toggler {
            border-color: rgba(200, 169, 126, 0.3);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(200, 169, 126, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.html"> <img src="../Assets/Templates/Main/img/Logo.png" width="250" height="160" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                       <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="HomePage.php">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Shop
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <a class="dropdown-item" href="ViewSeller.php"> shop details</a>
                                        <a class="dropdown-item" href="ViewProduct.php">product details</a>
                                        
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Orders
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                        <a class="dropdown-item" href="MyCart.php"> My Cart</a>
                                        <a class="dropdown-item" href="MyBooking.php">My Booking</a>
                                        <a class="dropdown-item" href="MYCustomization.php">MY Customization</a>
                                        <a class="dropdown-item" href="MyWishList.php">My WishList</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                        <a class="dropdown-item" href="MyComplaints.php">My Complaint</a>
                                        <a class="dropdown-item" href="Complaint.php">Complaint</a>
                                        <a class="dropdown-item" href="FeedBack.php">FeedBack</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_2"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Settings
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                        <a class="dropdown-item" href="MyProfile.php">My Profile</a>
                                        <a class="dropdown-item" href="EditProfile.php">Edit Profile</a>
                                        <a class="dropdown-item" href="ChangePassword.php">Change Password</a>
                                    </div>
                                </li>
                                
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="#">Contact</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="LogOut.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                        <!-- <div class="hearer_icon d-flex"> -->
                            <!-- <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <a href="MyCart.php"><i class="ti-heart"></i></a> -->
                            <!-- <div class="dropdown cart"> -->
                                <a class="" href="MyCart.php" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <a href="MyCart.php"><Strong>Cart</Strong><i class="fas fa-cart-plus"></i>
                                </a>
                                 <a href="MyWishlist.php"><i class="ti-heart"></i></a> 
                                <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <div class="single_product">
    
                                    </div>
                                </div> -->
                                
                            <!-- </div> -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div> -->
    </header>
    <!-- Header part end-->
     <br><br><br><br><br><br>
    </html>



     
     