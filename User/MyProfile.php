<?php
include("../Assets/Connection/Connection.php");
session_start();
	$SelQry="select * from tbl_user u 
 	inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where
	user_id='".$_SESSION["uid"]."'";
	
		$row=$con->query($SelQry);
		$data=$row->fetch_assoc();
?>










<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Profile - DecoNest</title>
    <link rel="icon" href="../Assets/Templates/Main/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/style.css">
    <style>
        .profile-section {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                       url('../1.jpg') no-repeat center center;
            background-size: cover;
            padding: 50px 0;
            min-height: calc(100vh - 180px);
        }
        
        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .profile-header {
            background-color: #f8f5f0;
            padding: 30px;
            text-align: center;
            border-bottom: 3px solid #c8a97e;
        }
        
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            object-fit: cover;
            margin-bottom: 20px;
        }
        
        .profile-name {
            color: #333;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .profile-body {
            padding: 30px;
        }
        
        .profile-detail {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .detail-label {
            font-weight: 600;
            color: #5a5a5a;
            margin-bottom: 5px;
        }
        
        .detail-value {
            color: #777;
            font-size: 1.1rem;
        }
        
        .profile-actions {
            padding: 20px 30px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .btn-edit {
            background-color: #c8a97e;
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-edit:hover {
            background-color: #b8976a;
            transform: translateY(-2px);
            color: white;
        }
        
        .btn-password {
            background-color: white;
            border: 2px solid #c8a97e;
            color: #c8a97e;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-password:hover {
            background-color: #72592dff;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .profile-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Header part -->
    <?php include('Header.php'); ?>

    <!-- Profile section -->
    <section class="profile-section">
        <div class="container">
            <div class="profile-card">
                <div class="profile-header">
                    <img src="../Assets/Files/UserDocs/<?php echo $data['user_photo']?>" class="profile-avatar" alt="Profile Photo">
                    <h2 class="profile-name"><?php echo $data['user_name']?></h2>
                </div>
                
                <div class="profile-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-detail">
                                <p class="detail-label">Email Address</p>
                                <p class="detail-value"><?php echo $data['user_email']?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-detail">
                                <p class="detail-label">Contact Number</p>
                                <p class="detail-value"><?php echo $data['user_contact']?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="profile-detail">
                        <p class="detail-label">Address</p>
                        <p class="detail-value"><?php echo $data['user_address']?></p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-detail">
                                <p class="detail-label">District</p>
                                <p class="detail-value"><?php echo $data['district_name']?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-detail">
                                <p class="detail-label">Place</p>
                                <p class="detail-value"><?php echo $data['place_name']?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="profile-actions">
                    <a href="EditProfile.php" class="btn btn-edit">Edit Profile</a>
                    <a href="ChangePassword.php" class="btn btn-password">Change Password</a>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="../Assets/Templates/Main/js/jquery-1.12.1.min.js"></script>
    <script src="../Assets/Templates/Main/js/popper.min.js"></script>
    <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
</body>
</html>

 <!--::footer_part:-->
    <?php include("Footer.php"); ?>

