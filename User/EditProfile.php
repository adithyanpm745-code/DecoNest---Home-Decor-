<?php
include("../Assets/Connection/Connection.php");
session_start();	
	$SelQry="select * from tbl_user where user_id='".$_SESSION["uid"]."'";
	
		$row=$con->query($SelQry);
		$data=$row->fetch_assoc();
		
		if(isset($_POST["btn_submit"]))
		{
		$name=$_POST["txt_name"];
		$email=$_POST["txt_email"];
		$contact=$_POST["txt_contact"];
		$address=$_POST["txt_address"];
		
		$Email="select * from tbl_user where user_email='".$email."' and user_id !='".$_SESSION['uid']."' ";
		$row=$con->query($Email);
		if($data=$row->fetch_assoc())
		  {
			?>
       		 <script>
			alert("This Email is Already Registered !")		
			</script>
     	   <?php	
		  }
		else
		{  

		$upQry="update tbl_user set user_name='".$name."',user_email='".$email."',user_contact='".$contact."',user_address='".$address."' 
		where user_id='".$_SESSION['uid']."'";
		if($con->query($upQry))
		{
			
			?>
		<script>
		alert("Profile has been Updated successfully!")
		window.location="MyProfile.php";
		</script>
			<?php 
		}
		}
		}
		
?>
<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Profile - DecoNest</title>
    <link rel="icon" href="../Assets/Templates/Main/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/style.css">
    <style>
        .edit-profile-section {
            background: linear-gradient(rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.92)), 
                       url('../Assets/Templates/Main/img/decor-bg.jpg') no-repeat center center;
            background-size: cover;
            padding: 60px 0;
            min-height: calc(100vh - 180px);
        }
        
        .profile-form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .profile-form-header {
            background-color: #f8f5f0;
            padding: 25px 30px;
            text-align: center;
            border-bottom: 3px solid #c8a97e;
        }
        
        .profile-form-title {
            color: #333;
            font-weight: 700;
            margin-bottom: 0;
            font-size: 1.8rem;
        }
        
        .profile-form-body {
            padding: 30px;
        }
        
        .form-group-custom {
            margin-bottom: 25px;
        }
        
        .form-label-custom {
            font-weight: 600;
            color: #5a5a5a;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
        }
        
        .form-control-custom:focus {
            border-color: #c8a97e;
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
        }
        
        textarea.form-control-custom {
            min-height: 120px;
            resize: vertical;
        }
        
        .form-actions {
            padding: 20px 30px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .btn-submit {
            background-color: #9d7d50ff;
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            min-width: 140px;
        }
        
        .btn-submit:hover {
            background-color: #a38150ff;
            transform: translateY(-2px);
            color: white;
        }
        
        .btn-reset {
            background-color: white;
            border: 2px solid #6c757d;
            color: #6c757d;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            min-width: 140px;
        }
        
        .btn-reset:hover {
            background-color: #f8f5f0;
            transform: translateY(-2px);
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #c8a97e;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .back-link a:hover {
            color: #b8976a;
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
            }
            
            .btn-submit, .btn-reset {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header part -->
    <?php include('Header.php'); ?>

    <!-- Edit Profile section -->
    <section class="edit-profile-section">
        <div class="container">
            <div class="profile-form-card">
                <div class="profile-form-header">
                    <h2 class="profile-form-title">Edit Your Profile</h2>
                </div>
                
                <form id="form1" name="form1" method="post" action="">
                    <div class="profile-form-body">
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="txt_name">Full Name</label>
                            <input type="text" class="form-control-custom" name="txt_name" id="txt_name" 
                                   value="<?php echo $data['user_name']?>" 
                                   minlength="3" 
                                   title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
                                   pattern="^[A-Z]+[a-zA-Z ]*$" 
                                   required />
                        </div>
                        
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="txt_email">Email Address</label>
                            <input type="email" class="form-control-custom" name="txt_email" id="txt_email" 
                                   value="<?php echo $data['user_email']?>" 
                                   required="required" />
                        </div>
                        
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="txt_contact">Contact Number</label>
                            <input type="text" class="form-control-custom" name="txt_contact" id="txt_contact" 
                                   value="<?php echo $data['user_contact']?>" 
                                   pattern="[6-9]{1}[0-9]{9}" 
                                   title="Phone number with 6-9 and remaining 9 digit with 0-9"  
                                   required="required" />
                        </div>
                        
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="txt_address">Address</label>
                            <textarea class="form-control-custom" name="txt_address" id="txt_address" 
                                      required><?php echo $data['user_address']?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <input type="submit" class="btn btn-submit" name="btn_submit" id="btn_submit" value="Save Changes" />
                        <input type="reset" class="btn btn-reset" name="btn_reset" id="btn_reset" value="Reset" />
                    </div>
                </form>
                
                <div class="back-link">
                    <a href="MyProfile.php">&larr; Back to My Profile</a>
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
