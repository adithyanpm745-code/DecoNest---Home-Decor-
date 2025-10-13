<?php
include("../Assets/Connection/Connection.php");
session_start();	

ob_start();
include("Header.php");

	$SelQry="select * from tbl_seller where seller_id='".$_SESSION["sid"]."'";
	
		$row=$con->query($SelQry);
		$data=$row->fetch_assoc();
		$dbpassword=$data["seller_password"];
		
if(isset($_POST["btn_submit"]))
	{
			$old=$_POST["txt_oldpassword"];
			$new=$_POST["txt_newpassword"];
			$conform=$_POST["txt_repassword"];
		
		if($dbpassword==$old)
		 	{
			
			if($new==$conform)
				{
					$upQry="update tbl_seller set seller_password='".$new."'where seller_id='".$_SESSION['sid']."'";
					if($con->query($upQry))
					{	
					?>
					<script>
					alert("Password has been Updated successfully!")
					window.location="MyProfile.php";
					</script>
					<?php 
					}
				}
				else
				{
				?>
				<script>
				alert("Password Mismatch")
				//window.location="ChangePassword.php";
				</script>
				<?php
				}
				
		 }
		 else
		 {
			 ?>
		<script>
		alert("Invalid Password")
		window.location="ChangePassword.php";
		</script>
			<?php
		 }
		 
		}
		

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | HomeDecor Seller</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .seller-password-container {
            background: url('https://images.unsplash.com/photo-1513519245088-0e12902e5a38?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80') no-repeat center center;
            background-size: cover;
            padding: 40px 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .seller-password-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border: none;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .seller-password-header {
            background: linear-gradient(135deg, #6a994e 0%, #a7c957 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        
        .seller-password-title {
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .seller-password-body {
            padding: 40px;
        }
        
        .seller-form-label {
            font-weight: 600;
            color: #386641;
            margin-bottom: 8px;
        }
        
        .seller-password-input-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .seller-password-input {
            border: 2px solid #e5e1d8;
            border-radius: 10px;
            padding: 12px 45px 12px 20px;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .seller-password-input:focus {
            border-color: #a7c957;
            box-shadow: 0 0 0 0.25rem rgba(167, 201, 87, 0.25);
            outline: none;
        }
        
        .seller-password-icon {
            position: absolute;
            right: 20px;
            top: 12px;
            color: #a7c957;
        }
        
        .seller-password-toggle {
            position: absolute;
            right: 45px;
            top: 12px;
            color: #6c757d;
            cursor: pointer;
            z-index: 10;
        }
        
        .seller-password-toggle:hover {
            color: #386641;
        }
        
        .seller-password-help {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
            padding: 0 5px;
        }
        
        .seller-btn-submit {
            background: #bc4749;
            border: 2px solid #bc4749;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 15px;
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
            width: 100%;
        }
        
        .seller-btn-reset:hover {
            background: #6a994e;
            color: white;
            transform: translateY(-3px);
        }
        
        .seller-password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 8px;
            background: #e9ecef;
            overflow: hidden;
        }
        
        .seller-strength-meter {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 5px;
        }
        
        .seller-password-criteria {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .seller-criteria-item {
            margin-bottom: 3px;
        }
        
        .seller-criteria-valid {
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="seller-password-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="seller-password-card">
                    <div class="seller-password-header">
                        <h2 class="seller-password-title"><i class="fas fa-lock me-2"></i>Change Password</h2>
                        <p class="mb-0">Secure your account with a new password</p>
                    </div>

                    <div class="seller-password-body">
                        <form id="form1" name="form1" method="post" action="">
                            <!-- Old Password Field -->
                            <div class="mb-4">
                                <label for="txt_oldpassword" class="seller-form-label"><i class="fas fa-key me-2"></i>Old Password</label>
                                <div class="seller-password-input-group">
                                    <input type="password" class="seller-password-input" name="txt_oldpassword" id="txt_oldpassword" required="required"/>
                                    <span class="seller-password-toggle" id="toggleOldPassword">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="seller-password-icon"><i class="fas fa-lock"></i></span>
                                </div>
                            </div>
                            
                            <!-- New Password Field -->
                            <div class="mb-4">
                                <label for="txt_newpassword" class="seller-form-label"><i class="fas fa-key me-2"></i>New Password</label>
                                <div class="seller-password-input-group">
                                    <input type="password" class="seller-password-input" name="txt_newpassword" id="txt_newpassword" 
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                           title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters" 
                                           required/>
                                    <span class="seller-password-toggle" id="toggleNewPassword">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="seller-password-icon"><i class="fas fa-lock"></i></span>
                                </div>
                                <div class="seller-password-strength">
                                    <div class="seller-strength-meter" id="passwordStrengthMeter"></div>
                                </div>
                                <div class="seller-password-criteria" id="passwordCriteria">
                                    <div class="seller-criteria-item" id="lengthCriteria">At least 8 characters</div>
                                    <div class="seller-criteria-item" id="uppercaseCriteria">One uppercase letter</div>
                                    <div class="seller-criteria-item" id="lowercaseCriteria">One lowercase letter</div>
                                    <div class="seller-criteria-item" id="numberCriteria">One number</div>
                                </div>
                            </div>
                            
                            <!-- Confirm Password Field -->
                            <div class="mb-5">
                                <label for="txt_repassword" class="seller-form-label"><i class="fas fa-key me-2"></i>Confirm Password</label>
                                <div class="seller-password-input-group">
                                    <input type="password" class="seller-password-input" name="txt_repassword" id="txt_repassword" 
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                           title="Must match the password above" 
                                           required/>
                                    <span class="seller-password-toggle" id="toggleConfirmPassword">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="seller-password-icon"><i class="fas fa-lock"></i></span>
                                </div>
                                <div class="seller-password-help" id="passwordMatchText">Passwords must match</div>
                            </div>
                            
                            <!-- Buttons -->
                            <div class="d-grid gap-2">
                                <input type="submit" class="btn seller-btn-submit" name="btn_submit" id="btn_submit" value="Change Password" />
                                <input type="reset" class="btn seller-btn-reset" name="btn_reset" id="btn_reset" value="Reset Form" />
                                <div class="mt-2">
                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="../Guest/ForgetPassword.php" >
                                 Forget Password
                            </a>
                        </div>
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
<script>
    // Toggle password visibility
    document.querySelectorAll('.seller-password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
    
    // Password strength indicator
    const passwordInput = document.getElementById('txt_newpassword');
    const strengthMeter = document.getElementById('passwordStrengthMeter');
    const criteria = {
        length: document.getElementById('lengthCriteria'),
        uppercase: document.getElementById('uppercaseCriteria'),
        lowercase: document.getElementById('lowercaseCriteria'),
        number: document.getElementById('numberCriteria')
    };
    
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        // Check criteria
        const hasLength = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        
        // Update criteria indicators
        criteria.length.classList.toggle('seller-criteria-valid', hasLength);
        criteria.uppercase.classList.toggle('seller-criteria-valid', hasUppercase);
        criteria.lowercase.classList.toggle('seller-criteria-valid', hasLowercase);
        criteria.number.classList.toggle('seller-criteria-valid', hasNumber);
        
        // Calculate strength
        if (hasLength) strength += 25;
        if (hasUppercase) strength += 25;
        if (hasLowercase) strength += 25;
        if (hasNumber) strength += 25;
        
        // Update strength meter
        strengthMeter.style.width = strength + '%';
        
        if (strength < 50) {
            strengthMeter.style.background = '#dc3545';
        } else if (strength < 100) {
            strengthMeter.style.background = '#ffc107';
        } else {
            strengthMeter.style.background = '#28a745';
        }
    });
    
    // Confirm password validation
    const confirmPassword = document.getElementById('txt_repassword');
    const matchText = document.getElementById('passwordMatchText');
    
    confirmPassword.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirm = this.value;
        
        if (confirm === '') {
            matchText.textContent = 'Passwords must match';
            matchText.style.color = '#6c757d';
        } else if (password === confirm) {
            matchText.textContent = 'Passwords match!';
            matchText.style.color = '#28a745';
        } else {
            matchText.textContent = 'Passwords do not match';
            matchText.style.color = '#dc3545';
        }
    });
</script>
</body>
</html>
