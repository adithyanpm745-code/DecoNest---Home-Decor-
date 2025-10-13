<?php
include("../Assets/Connection/Connection.php");
session_start();

ob_start();
include("Header.php");

$SelQry = "SELECT * FROM tbl_seller s 
    INNER JOIN tbl_place p ON s.place_id = p.place_id 
    INNER JOIN tbl_district d ON p.district_id = d.district_id 
    WHERE s.seller_id = '" . $_SESSION["sid"] . "'";
    
$row = $con->query($SelQry);
$data = $row->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Seller Profile | HomeDecor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .seller-profile-container {
            background: url('https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80') no-repeat center center;
            background-size: cover;
            padding: 30px 0;
            min-height: 100vh;
        }
        
        .seller-profile-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border: none;
        }
        
        .seller-profile-header {
            background: linear-gradient(135deg, #6a994e 0%, #a7c957 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
            position: relative;
        }
        
        .seller-profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .seller-profile-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #bc4749;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .seller-profile-content {
            padding: 30px;
        }
        
        .seller-info-section {
            margin-bottom: 25px;
        }
        
        .seller-info-title {
            color: #386641;
            border-bottom: 2px solid #a7c957;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .seller-info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 15px;
            border-bottom: 1px solid #f1f1f1;
            transition: all 0.3s ease;
        }
        
        .seller-info-item:hover {
            background-color: #f9f9f9;
            transform: translateX(5px);
        }
        
        .seller-info-item strong {
            color: #386641;
        }
        
        .seller-action-btn {
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .seller-edit-btn {
            background: #bc4749;
            border: 2px solid #bc4749;
            color: white;
        }
        
        .seller-edit-btn:hover {
            background: transparent;
            color: #bc4749;
            transform: translateY(-3px);
        }
        
        .seller-password-btn {
            border: 2px solid #386641;
            color: #386641;
        }
        
        .seller-password-btn:hover {
            background: #386641;
            color: white;
            transform: translateY(-3px);
        }
        
        .seller-decor-icon {
            color: #a7c957;
            margin-right: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="seller-profile-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="seller-profile-card">
                    <div class="seller-profile-header">
                        <span class="seller-profile-badge">HomeDecor Seller</span>
                        <img src="../Assets/Files/SellerDocs/<?php echo $data['seller_photo']?>" 
                             class="seller-profile-pic rounded-circle mb-3" 
                             alt="Profile Picture">
                        <h3 class="fw-bold mt-3"><?php echo $data['seller_name']?></h3>
                        <p class="mb-0">Bringing beauty to your home</p>
                    </div>

                    <div class="seller-profile-content">
                        <!-- Contact Information -->
                        <div class="seller-info-section">
                            <h5 class="seller-info-title">
                                <i class="seller-decor-icon fas fa-address-card"></i>Contact Information
                            </h5>
                            <div class="list-group">
                                <div class="seller-info-item">
                                    <strong><i class="seller-decor-icon fas fa-envelope"></i>Email</strong> 
                                    <span><?php echo $data['seller_email']?></span>
                                </div>
                                <div class="seller-info-item">
                                    <strong><i class="seller-decor-icon fas fa-phone"></i>Contact</strong> 
                                    <span><?php echo $data['seller_contact']?></span>
                                </div>
                                <div class="seller-info-item">
                                    <strong><i class="seller-decor-icon fas fa-map-marker-alt"></i>Address</strong> 
                                    <span><?php echo $data['seller_address']?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Location Details -->
                        <div class="seller-info-section">
                            <h5 class="seller-info-title">
                                <i class="seller-decor-icon fas fa-map-marked-alt"></i>Location Details
                            </h5>
                            <div class="list-group">
                                <div class="seller-info-item">
                                    <strong><i class="seller-decor-icon fas fa-city"></i>District</strong> 
                                    <span><?php echo $data['district_name']?></span>
                                </div>
                                <div class="seller-info-item">
                                    <strong><i class="seller-decor-icon fas fa-building"></i>Place</strong> 
                                    <span><?php echo $data['place_name']?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-center gap-3 mt-5">
                            <a href="EditProfile.php" class="btn seller-action-btn seller-edit-btn">
                                <i class="fas fa-user-edit me-2"></i>Edit Profile
                            </a>
                            <a href="ChangePassword.php" class="btn seller-action-btn seller-password-btn">
                                <i class="fas fa-lock me-2"></i>Change Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

