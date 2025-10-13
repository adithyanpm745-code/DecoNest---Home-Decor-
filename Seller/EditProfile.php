<?php
include("../Assets/Connection/Connection.php");
session_start();	

ob_start();
include("Header.php");

	$SelQry="select * from tbl_seller where seller_id='".$_SESSION["sid"]."'";
	
		$row=$con->query($SelQry);
		$data=$row->fetch_assoc();
		
		if(isset($_POST["btn_submit"]))
		{
		$name=$_POST["txt_name"];
		$email=$_POST["txt_email"];
		$contact=$_POST["txt_contact"];
		$address=$_POST["txt_address"];
		
		$Email="select * from tbl_seller where seller_email='".$email."' and seller_id !='".$_SESSION['sid']."'";
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

		$upQry="update tbl_seller set seller_name='".$name."',seller_email='".$email."',seller_contact='".$contact."',seller_address='".$address."' 
		where seller_id='".$_SESSION['sid']."'";
		if($con->query($upQry))
		{
			
			?>
		<script>
		alert("Profile has been Updated successfully!")
		window.location="MyProfile.php";
		</script>
			<?php 
		}
		}}
		
		
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | HomeDecor Seller</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .seller-edit-container {
            background: url('https://images.unsplash.com/photo-1513519245088-0e12902e5a38?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80') no-repeat center center;
            background-size: cover;
            padding: 40px 0;
            min-height: 100vh;
        }
        
        .seller-edit-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border: none;
        }
        
        .seller-edit-header {
            background: linear-gradient(135deg, #6a994e 0%, #a7c957 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        
        .seller-edit-title {
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .seller-edit-body {
            padding: 40px;
        }
        
        .seller-form-label {
            font-weight: 600;
            color: #386641;
            margin-bottom: 8px;
        }
        
        .seller-form-control {
            border: 2px solid #e5e1d8;
            border-radius: 10px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        
        .seller-form-control:focus {
            border-color: #a7c957;
            box-shadow: 0 0 0 0.25rem rgba(167, 201, 87, 0.25);
        }
        
        .seller-form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .seller-btn-submit {
            background: #bc4749;
            border: 2px solid #bc4749;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .seller-btn-submit:hover {
            background: transparent;
            color: #bc4749;
            transform: translateY(-3px);
        }
        
        .seller-btn-reset {
            background: transparent;
            border: 2px solid #6a994e;
            color: #6a994e;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .seller-btn-reset:hover {
            background: #6a994e;
            color: white;
            transform: translateY(-3px);
        }
        
        .seller-form-icon {
            position: absolute;
            right: 20px;
            top: 42px;
            color: #a7c957;
        }
        
        .seller-input-group {
            position: relative;
        }
        
        .seller-form-help {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="seller-edit-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="seller-edit-card">
                    <div class="seller-edit-header">
                        <h2 class="seller-edit-title"><i class="fas fa-user-edit me-2"></i>Edit Your Profile</h2>
                        <p class="mb-0">Update your information to keep your account current</p>
                    </div>

                    <div class="seller-edit-body">
                        <form id="form1" name="form1" method="post" action="">
                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="txt_name" class="seller-form-label"><i class="fas fa-user me-2"></i>Full Name</label>
                                <div class="seller-input-group">
                                    <input type="text" class="form-control seller-form-control" name="txt_name" id="txt_name" 
                                           value="<?php echo $data['seller_name']?>" 
                                           minlength="3" 
                                           title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" 
                                           pattern="^[A-Z]+[a-zA-Z ]*$" 
                                           required />
                                    <span class="seller-form-icon"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <div class="seller-form-help">Enter your full name starting with a capital letter</div>
                            </div>
                            
                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="txt_email" class="seller-form-label"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                <div class="seller-input-group">
                                    <input type="email" class="form-control seller-form-control" name="txt_email" id="txt_email" 
                                           value="<?php echo $data['seller_email']?>" 
                                           required="required" />
                                    <span class="seller-form-icon"><i class="fas fa-envelope"></i></span>
                                </div>
                                <div class="seller-form-help">We'll never share your email with anyone else</div>
                            </div>
                            
                            <!-- Contact Field -->
                            <div class="mb-4">
                                <label for="txt_contact" class="seller-form-label"><i class="fas fa-phone me-2"></i>Contact Number</label>
                                <div class="seller-input-group">
                                    <input type="text" class="form-control seller-form-control" name="txt_contact" id="txt_contact" 
                                           value="<?php echo $data['seller_contact']?>" 
                                           pattern="[6-9]{1}[0-9]{9}" 
                                           title="Phone number with 6-9 and remaing 9 digit with 0-9"  
                                           required="required" />
                                    <span class="seller-form-icon"><i class="fas fa-phone"></i></span>
                                </div>
                                <div class="seller-form-help">Enter your 10-digit mobile number</div>
                            </div>
                            
                            <!-- Address Field -->
                            <div class="mb-5">
                                <label for="txt_address" class="seller-form-label"><i class="fas fa-home me-2"></i>Address</label>
                                <textarea class="form-control seller-form-control seller-form-textarea" 
                                          name="txt_address" 
                                          id="txt_address" 
                                          required><?php echo $data['seller_address']?></textarea>
                                <div class="seller-form-help">Enter your complete address for delivery purposes</div>
                            </div>
                            
                            <!-- Buttons -->
                            <div class="d-flex justify-content-center gap-3">
                                <input type="submit" class="btn seller-btn-submit" name="btn_submit" id="btn_submit" value="Update Profile" />
                                <input type="reset" class="btn seller-btn-reset" name="btn_reset" id="btn_reset" value="Reset Form" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

