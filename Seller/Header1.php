
<!doctype html>
<html lang="zxx">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DecoNest - Seller Dashboard</title>
    <link rel="icon" href="../Assets/Templates/Main/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #d2d5e3ff 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Top Header */
        .seller-top-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            transition: all 0.3s ease;
        }

        .seller-header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .seller-logo {
            display: flex;
            align-items: center;
        }

        .seller-logo img {
            height: 50px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .seller-logo img:hover {
            transform: scale(1.05);
        }

        .seller-brand-text {
            margin-left: 15px;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sidebar Toggle Button */
        .sidebar-toggle {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .sidebar-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .sidebar-toggle i {
            font-size: 1.2rem;
        }

        /* User Info in Header */
        .seller-user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .seller-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .seller-user-details {
            display: flex;
            flex-direction: column;
        }

        .seller-user-name {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
            font-size: 0.9rem;
        }

        .seller-user-role {
            color: #7f8c8d;
            font-size: 0.8rem;
            margin: 0;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1060;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Sidebar */
        .seller-sidebar {
            position: fixed;
            top: 0;
            left: -320px;
            width: 320px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            z-index: 1070;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .seller-sidebar.active {
            left: 0;
        }

        /* Sidebar Header */
        .seller-sidebar-header {
            padding: 25px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .seller-sidebar-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer-sidebar 3s ease-in-out infinite;
        }

        @keyframes shimmer-sidebar {
            0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .seller-sidebar-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .seller-sidebar-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .seller-sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }

        .seller-sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0 5px 0;
        }

        .seller-sidebar-tagline {
            font-size: 0.9rem;
            opacity: 0.9;
            text-align: center;
        }

        /* Sidebar Navigation */
        .seller-sidebar-nav {
            padding: 20px 0;
        }

        .seller-nav-section {
            margin-bottom: 25px;
        }

        .seller-nav-section-title {
            padding: 0 20px 10px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid #ecf0f1;
            margin-bottom: 15px;
        }

        .seller-nav-item {
            list-style: none;
            margin: 0;
        }

        .seller-nav-link {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            font-weight: 500;
        }

        .seller-nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .seller-nav-link:hover,
        .seller-nav-link.active {
            background: rgba(102, 126, 234, 0.05);
            color: #667eea;
            text-decoration: none;
            transform: translateX(10px);
        }

        .seller-nav-link:hover::before,
        .seller-nav-link.active::before {
            transform: scaleY(1);
        }

        .seller-nav-icon {
            width: 20px;
            margin-right: 15px;
            text-align: center;
            font-size: 1.1rem;
        }

        .seller-nav-text {
            flex: 1;
        }

        .seller-nav-badge {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        /* Dropdown Menu */
        .seller-nav-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .seller-nav-dropdown.active {
            max-height: 300px;
        }

        .seller-nav-dropdown .seller-nav-link {
            padding: 12px 20px 12px 55px;
            font-size: 0.9rem;
            background: transparent;
        }

        .seller-nav-dropdown .seller-nav-link:hover {
            background: rgba(102, 126, 234, 0.08);
            transform: translateX(5px);
        }

        .seller-nav-arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .seller-nav-item.dropdown-open .seller-nav-arrow {
            transform: rotate(180deg);
        }

        /* Sidebar Footer */
        .seller-sidebar-footer {
            padding: 20px;
            border-top: 1px solid #ecf0f1;
            margin-top: auto;
        }

        .seller-logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(238, 90, 82, 0.3);
        }

        .seller-logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(238, 90, 82, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Main Content Area */
        .seller-main-content {
            margin-top: 80px;
            transition: all 0.3s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .seller-user-details {
                display: none;
            }
            
            .seller-sidebar {
                width: 280px;
                left: -280px;
            }
            
            .seller-brand-text {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .seller-sidebar {
                width: 100%;
                left: -100%;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-in {
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>

<body>
    <!-- Top Header -->
    <header class="seller-top-header">
        <div class="seller-header-content">
            <div class="seller-logo">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="seller-brand-text">DecoNest</div>
            </div>
            
            <div class="seller-user-info">
            <div class="seller-user-details">
                <div class="seller-user-name"><?php echo $_SESSION["sname"]?></div>
                <div class="seller-user-role">Home Decor Specialist</div>
            </div>
            <a href="MyProfile.php" class="seller-user-avatar">
                <i class="fas fa-user"></i>
            </a>
            </div>
        </div>
    </header>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="closeSidebar()"></div>

    <!-- Sidebar -->
    <nav class="seller-sidebar" id="sellerSidebar">
        <!-- Sidebar Header -->
        <div class="seller-sidebar-header">
            <button class="seller-sidebar-close" onclick="closeSidebar()">
                <i class="fas fa-times"></i>
            </button>
            <div class="seller-sidebar-logo">
                <img src="../Assets/Templates/Main/img/Logo.png" width="100" height="60" alt="logo">
                <div class="seller-sidebar-brand">DecoNest</div>
                <div class="seller-sidebar-tagline">Transform Spaces, Inspire Lives</div>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <div class="seller-sidebar-nav">
            <!-- Dashboard Section -->
            <div class="seller-nav-section">
                <div class="seller-nav-section-title">Dashboard</div>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li class="seller-nav-item">
                        <a href="HomePage.php" class="seller-nav-link active">
                            <i class="fas fa-home seller-nav-icon"></i>
                            <span class="seller-nav-text">Home</span>
                        </a>
                    </li>
                    <li class="seller-nav-item">
                        <a href="Report1.php" class="seller-nav-link">
                            <i class="fas fa-chart-line seller-nav-icon"></i>
                            <span class="seller-nav-text">Analytics & Reports</span>
                            <span class="seller-nav-badge">New</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Products Section -->
            <div class="seller-nav-section">
                <div class="seller-nav-section-title">Products</div>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li class="seller-nav-item">
                        <a href="Product.php" class="seller-nav-link">
                            <i class="fas fa-plus-circle seller-nav-icon"></i>
                            <span class="seller-nav-text">Add Products</span>
                        </a>
                    </li>
                    <li class="seller-nav-item">
                        <a href="ViewProduct.php" class="seller-nav-link">
                            <i class="fas fa-boxes seller-nav-icon"></i>
                            <span class="seller-nav-text">View Products</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Orders Section -->
            <div class="seller-nav-section">
                <div class="seller-nav-section-title">Orders & Services</div>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li class="seller-nav-item dropdown-item">
                        <a href="#" class="seller-nav-link" onclick="toggleDropdown(this)">
                            <i class="fas fa-shopping-cart seller-nav-icon"></i>
                            <span class="seller-nav-text">View Orders</span>
                            <i class="fas fa-chevron-down seller-nav-arrow"></i>
                        </a>
                        <ul class="seller-nav-dropdown">
                            <li class="seller-nav-item">
                                <a href="ViewBooking.php" class="seller-nav-link">
                                    <span class="seller-nav-text">Customer Orders</span>
                                </a>
                            </li>
                            <?php
                $SelQry = "select * from tbl_seller c 
                where c.seller_id='".$_SESSION['sid']."'";
            $row=$con->query($SelQry);
		    $data=$row->fetch_assoc();
            ?>
                <?php if($data['seller_customization']==1): ?>
                            <li class="seller-nav-item">
                                <a href="ViewCustomization.php" class="seller-nav-link">
                                    <span class="seller-nav-text">Customization Orders</span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="seller-nav-item">
                        <a href="ViewComplaint.php" class="seller-nav-link">
                            <i class="fas fa-comments seller-nav-icon"></i>
                            <span class="seller-nav-text">Product Complaints</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Account Section -->
            <div class="seller-nav-section">
                <div class="seller-nav-section-title">Account</div>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li class="seller-nav-item dropdown-item">
                        <a href="#" class="seller-nav-link" onclick="toggleDropdown(this)">
                            <i class="fas fa-user-cog seller-nav-icon"></i>
                            <span class="seller-nav-text">Settings</span>
                            <i class="fas fa-chevron-down seller-nav-arrow"></i>
                        </a>
                        <ul class="seller-nav-dropdown">
                            <li class="seller-nav-item">
                                <a href="MyProfile.php" class="seller-nav-link">
                                    <span class="seller-nav-text">My Profile</span>
                                </a>
                            </li>
                            <li class="seller-nav-item">
                                <a href="EditProfile.php" class="seller-nav-link">
                                    <span class="seller-nav-text">Edit Profile</span>
                                </a>
                            </li>
                            <li class="seller-nav-item">
                                <a href="ChangePassword.php" class="seller-nav-link">
                                    <span class="seller-nav-text">Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="seller-nav-item">
                        <a href="Feedback.php" class="seller-nav-link">
                            <i class="fas fa-star seller-nav-icon"></i>
                            <span class="seller-nav-text">Feedback</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="seller-sidebar-footer">
            <a href="LogOut.php" class="seller-logout-btn">
                <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i>
                Logout
            </a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="seller-main-content">
        <!-- Your main content will go here -->
    </div>

    <!-- JavaScript -->
    <script>
        // Sidebar Toggle Functions
        function toggleSidebar() {
            const sidebar = document.getElementById('sellerSidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            
            // Add animation class
            if (sidebar.classList.contains('active')) {
                sidebar.classList.add('slide-in');
                setTimeout(() => sidebar.classList.remove('slide-in'), 400);
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sellerSidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }

        // Dropdown Toggle Function
        function toggleDropdown(element) {
            event.preventDefault();
            const dropdownItem = element.closest('.dropdown-item');
            const dropdown = dropdownItem.querySelector('.seller-nav-dropdown');
            
            dropdownItem.classList.toggle('dropdown-open');
            dropdown.classList.toggle('active');
        }

        // Close sidebar when clicking on a regular nav link
        document.querySelectorAll('.seller-nav-link:not([onclick])').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });

        // Add fade-in animation to nav items
        document.addEventListener('DOMContentLoaded', () => {
            const navItems = document.querySelectorAll('.seller-nav-item');
            navItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(-20px)';
                    item.style.transition = 'all 0.3s ease';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateX(0)';
                    }, 50);
                }, index * 50);
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>