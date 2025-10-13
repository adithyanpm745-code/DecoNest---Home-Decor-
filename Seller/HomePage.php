<?php
include("../Assets/Connection/Connection.php");
session_start();
include('Header1.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seller Dashboard - Home Decor Hub</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    min-height: 100vh;
    background-attachment: fixed;
    position: relative;
    overflow-x: hidden;
}

/* Animated background elements */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
    animation: float-bg 20s ease-in-out infinite alternate;
    pointer-events: none;
    z-index: -2;
}

@keyframes float-bg {
    0% { transform: translateY(0px) rotate(0deg); }
    100% { transform: translateY(-20px) rotate(1deg); }
}

/* Particle background */
.particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: -1;
}

.particle {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: particle-float 15s infinite ease-in-out;
}

.particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; }
.particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 2s; }
.particle:nth-child(3) { width: 8px; height: 8px; left: 30%; animation-delay: 4s; }
.particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: 6s; }
.particle:nth-child(5) { width: 7px; height: 7px; left: 50%; animation-delay: 8s; }
.particle:nth-child(6) { width: 4px; height: 4px; left: 60%; animation-delay: 10s; }
.particle:nth-child(7) { width: 6px; height: 6px; left: 70%; animation-delay: 12s; }
.particle:nth-child(8) { width: 8px; height: 8px; left: 80%; animation-delay: 14s; }
.particle:nth-child(9) { width: 5px; height: 5px; left: 90%; animation-delay: 16s; }

@keyframes particle-float {
    0%, 100% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
    }
    10%, 90% {
        opacity: 1;
    }
    50% {
        transform: translateY(-100px) rotate(180deg);
    }
}

.enhanced-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
}

/* Enhanced Header */
.enhanced-header {
    text-align: center;
    margin-bottom: 50px;
    padding: 40px 30px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
    animation: header-entrance 1s ease-out;
}

@keyframes header-entrance {
    from { 
        opacity: 0; 
        transform: translateY(-50px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.enhanced-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.05), transparent);
    transform: rotate(45deg);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.enhanced-welcome-text {
    font-size: 3rem;
    color: #ffffff;
    margin-bottom: 15px;
    text-shadow: 
        2px 2px 4px rgba(0, 0, 0, 0.3),
        0 0 20px rgba(255, 255, 255, 0.2);
    font-weight: 300;
    letter-spacing: 2px;
    animation: glow-pulse 2s ease-in-out infinite alternate;
}

@keyframes glow-pulse {
    from { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3), 0 0 20px rgba(255, 255, 255, 0.2); }
    to { text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3), 0 0 30px rgba(255, 255, 255, 0.4); }
}

.enhanced-seller-name {
    font-size: 2.2rem;
    color: #f8f9fa;
    font-weight: bold;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
    margin-bottom: 20px;
    background: linear-gradient(45deg, #ffffff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.enhanced-subtitle {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 20px 0;
    font-style: italic;
    font-weight: 300;
}

.enhanced-quick-link {
    display: inline-block;
    margin: 15px 20px;
    padding: 12px 25px;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    text-decoration: none;
    border-radius: 30px;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.enhanced-quick-link:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-3px);
    text-decoration: none;
    color: white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Enhanced Reports Section */
.enhanced-reports-section {
    text-align: center;
    margin-bottom: 40px;
}

.enhanced-report-link {
    display: inline-block;
    padding: 15px 35px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 
        0 8px 25px rgba(238, 90, 82, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.enhanced-report-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s;
}

.enhanced-report-link:hover::before {
    left: 100%;
}

.enhanced-report-link:hover {
    background: linear-gradient(135deg, #ee5a52, #ff6b6b);
    transform: translateY(-3px);
    box-shadow: 
        0 12px 30px rgba(238, 90, 82, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    color: white;
    text-decoration: none;
}

/* Enhanced Dashboard Grid */
.enhanced-dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.enhanced-dashboard-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 35px;
    box-shadow: 
        0 15px 35px rgba(0, 0, 0, 0.1),
        0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(255, 255, 255, 0.3);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.enhanced-dashboard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #fce38a);
    background-size: 300% 100%;
    animation: gradient-move 4s ease infinite;
}

@keyframes gradient-move {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.enhanced-dashboard-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.enhanced-dashboard-card:hover::after {
    opacity: 1;
}

.enhanced-dashboard-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.15),
        0 10px 25px rgba(0, 0, 0, 0.1);
}

.enhanced-card-icon {
    font-size: 3.5rem;
    margin-bottom: 25px;
    text-align: center;
    opacity: 0.8;
    background: linear-gradient(45deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: icon-pulse 3s ease-in-out infinite alternate;
}

@keyframes icon-pulse {
    from { transform: scale(1); opacity: 0.8; }
    to { transform: scale(1.05); opacity: 1; }
}

.enhanced-card-title {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 20px;
    text-align: center;
    font-weight: 700;
    position: relative;
}

.enhanced-card-description {
    color: #666;
    text-align: center;
    margin-bottom: 25px;
    line-height: 1.7;
    font-size: 1rem;
    font-weight: 400;
}

.enhanced-card-link {
    display: block;
    text-align: center;
    padding: 15px 30px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    text-decoration: none;
    border-radius: 30px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 
        0 8px 20px rgba(102, 126, 234, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.enhanced-card-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s;
}

.enhanced-card-link:hover::before {
    left: 100%;
}

.enhanced-card-link:hover {
    background: linear-gradient(135deg, #5a67d8, #6b46c1);
    transform: translateY(-3px);
    box-shadow: 
        0 12px 25px rgba(102, 126, 234, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    text-decoration: none;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .enhanced-dashboard-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .enhanced-welcome-text {
        font-size: 2.5rem;
    }
    
    .enhanced-seller-name {
        font-size: 1.8rem;
    }
    
    .enhanced-container {
        padding: 15px;
    }
    
    .enhanced-dashboard-card {
        padding: 25px;
    }
}

@media (max-width: 480px) {
    .enhanced-welcome-text {
        font-size: 2rem;
    }
    
    .enhanced-seller-name {
        font-size: 1.5rem;
    }
    
    .enhanced-subtitle {
        font-size: 1.1rem;
    }
    
    .enhanced-quick-link {
        margin: 10px 15px;
        padding: 10px 20px;
        font-size: 0.9rem;
    }
}

/* Loading animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.enhanced-dashboard-card {
    animation: fadeInUp 0.6s ease-out forwards;
}

.enhanced-dashboard-card:nth-child(1) { animation-delay: 0.1s; }
.enhanced-dashboard-card:nth-child(2) { animation-delay: 0.2s; }
.enhanced-dashboard-card:nth-child(3) { animation-delay: 0.3s; }
.enhanced-dashboard-card:nth-child(4) { animation-delay: 0.4s; }
.enhanced-dashboard-card:nth-child(5) { animation-delay: 0.5s; }
.enhanced-dashboard-card:nth-child(6) { animation-delay: 0.6s; }
.enhanced-dashboard-card:nth-child(7) { animation-delay: 0.7s; }
.enhanced-dashboard-card:nth-child(8) { animation-delay: 0.8s; }
</style>
</head>
<body>
<!-- Animated background particles -->
<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<div class="enhanced-container">
    <div class="enhanced-header">
        <div class="enhanced-welcome-text">Welcome Back</div>
        <div class="enhanced-seller-name"><?php echo $_SESSION["sname"]?></div>
        <div class="enhanced-subtitle">Transform spaces, inspire lives - Your home decor journey continues</div>
        <!-- <div>
            <a href="MyProfile.php" class="enhanced-quick-link">
                <i class="fas fa-user-circle me-2"></i>Quick Profile Access
            </a>
        </div> -->
    </div>
    
    <div class="enhanced-reports-section">
        <a href="Report1.php" class="enhanced-report-link">
            <i class="fas fa-chart-line me-2"></i>View Analytics & Reports
        </a>
    </div>
    
    <form id="form1" name="form1" method="post" action="">
        <div class="enhanced-dashboard-grid">
            <div class="enhanced-dashboard-card">
                <div class="enhanced-card-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="enhanced-card-title">My Profile</div>
                <div class="enhanced-card-description">View and manage your seller profile information, contact details, and account settings.</div>
                <a href="MyProfile.php" class="enhanced-card-link">
                    <i class="fas fa-eye me-2"></i>View Profile
                </a>
            </div>

            <!-- <div class="enhanced-dashboard-card">
                <div class="enhanced-card-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="enhanced-card-title">Edit Profile</div>
                <div class="enhanced-card-description">Update your profile information, business details, and personal preferences.</div>
                <a href="EditProfile.php" class="enhanced-card-link">
                    <i class="fas fa-edit me-2"></i>Edit Profile
                </a>
            </div> -->

            <!-- <div class="enhanced-dashboard-card">
                <div class="enhanced-card-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="enhanced-card-title">Change Password</div>
                <div class="enhanced-card-description">Secure your account by updating your password regularly for better protection.</div>
                <a href="ChangePassword.php" class="enhanced-card-link">
                    <i class="fas fa-key me-2"></i>Change Password
                </a>
            </div> -->

            <div class="enhanced-dashboard-card">
                <div class="enhanced-card-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="enhanced-card-title">Add Product</div>
                <div class="enhanced-card-description">List new home decor items, furniture, and accessories to expand your catalog.</div>
                <a href="Product.php" class="enhanced-card-link">
                    <i class="fas fa-plus me-2"></i>Add New Product
                </a>
            </div>

            <div class="enhanced-dashboard-card">
                <div class="enhanced-card-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="enhanced-card-title">View Products</div>
                <div class="enhanced-card-description">Manage your existing product inventory and update product information.</div>
                <a href="ViewProduct.php" class="enhanced-card-link">
                    <i class="fas fa-list me-2"></i>View Products
                </a>
            </div>
            <?php
                $SelQry = "select * from tbl_seller c 
                where c.seller_id='".$_SESSION['sid']."'";
            $row=$con->query($SelQry);
		    $data=$row->fetch_assoc();
            ?>
            <?php if($data['seller_customization']==1): ?>
            <div class="enhanced-dashboard-card">
                <div class="enhanced-card-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="enhanced-card-title">Customization Orders</div>
                <div class="enhanced-card-description">Review custom orders and personalization requests from your customers.</div>
                <a href="ViewCustomization.php" class="enhanced-card-link">
                    <i class="fas fa-magic me-2"></i>View Customizations
                </a>
            </div>
                    <?php endif; ?>

            <div class="enhanced-dashboard-card">
                <div class="enhanced-card-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="enhanced-card-title">Order Management</div>
                <div class="enhanced-card-description">Manage customer orders, track deliveries and update order statuses.</div>
                <a href="ViewBooking.php" class="enhanced-card-link">
                    <i class="fas fa-shopping-cart me-2"></i>View Orders
                </a>
            </div>

            <div class="enhanced-dashboard-card">
                <div class="enhanced-card-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="enhanced-card-title">Customer Support</div>
                <div class="enhanced-card-description">Address customer concerns and feedback to maintain service quality.</div>
                <a href="ViewComplaint.php" class="enhanced-card-link">
                    <i class="fas fa-headset me-2"></i>View Complaints
                </a>
            </div>
        </div>
    </form>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>