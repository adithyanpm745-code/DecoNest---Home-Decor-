<?php
include("../Assets/Connection/Connection.php");
session_start();	
	$SelQry="select * from tbl_user where user_id='".$_SESSION["uid"]."'";
	
		$row=$con->query($SelQry);
		$data=$row->fetch_assoc();
		$dbpassword=$data["user_password"];
		
if(isset($_POST["btn_submit"]))
	{
			$old=$_POST["txt_oldpassword"];
			$new=$_POST["txt_newpassword"];
			$conform=$_POST["txt_repassword"];
		
		if($dbpassword==$old)
		 	{
			
			if($new==$conform)
				{
					$upQry="update tbl_user set user_password='".$new."'where user_id='".$_SESSION['uid']."'";
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

<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Change Password - DecoNest</title>
    <link rel="icon" href="../Assets/Templates/Main/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/style.css">
    <style>
        .change-password-section {
            background: linear-gradient(rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.92)), 
                       url('../Assets/Templates/Main/img/password-bg.jpg') no-repeat center center;
            background-size: cover;
            padding: 60px 0;
            min-height: calc(100vh - 180px);
        }
        
        .password-form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .password-form-header {
            background-color: #f8f5f0;
            padding: 25px 30px;
            text-align: center;
            border-bottom: 3px solid #c8a97e;
        }
        
        .password-form-title {
            color: #333;
            font-weight: 700;
            margin-bottom: 0;
            font-size: 1.8rem;
        }
        
        .password-icon {
            font-size: 2.5rem;
            color: #c8a97e;
            margin-bottom: 15px;
        }
        
        .password-form-body {
            padding: 30px;
        }
        
        .form-group-custom {
            margin-bottom: 25px;
            position: relative;
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
            padding-right: 45px;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
        }
        
        .form-control-custom:focus {
            border-color: #c8a97e;
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 42px;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .password-toggle:hover {
            color: #c8a97e;
        }
        
        .password-strength {
            height: 5px;
            margin-top: 8px;
            border-radius: 5px;
            background: #f0f0f0;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s, background 0.3s;
            border-radius: 5px;
        }
        
        .password-requirements {
            margin-top: 5px;
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 3px;
        }
        
        .requirement i {
            margin-right: 5px;
            font-size: 0.7rem;
        }
        
        .requirement.met {
            color: #28a745;
        }
        
        .form-actions {
            padding: 20px 30px;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .btn-submit {
            background-color: #c8a97e;
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            min-width: 140px;
        }
        
        .btn-submit:hover {
            background-color: #b8976a;
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

    <!-- Change Password section -->
    <section class="change-password-section">
        <div class="container">
            <div class="password-form-card">
                <div class="password-form-header">
                    <div class="password-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h2 class="password-form-title">Change Your Password</h2>
                    <p class="mb-0">Secure your account with a new password</p>
                </div>
                
                <form id="form1" name="form1" method="post" action="">
                    <div class="password-form-body">
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="txt_oldpassword">Current Password</label>
                            <input type="password" class="form-control-custom" name="txt_oldpassword" id="txt_oldpassword" required="required" 
							placeholder="Enter your current password"/>
                            <span class="password-toggle" onclick="togglePassword('txt_oldpassword')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="txt_newpassword">New Password</label>
                            <input type="password" class="form-control-custom" name="txt_newpassword" id="txt_newpassword" 
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                   title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters" 
                                   required onkeyup="checkPasswordStrength(this.value)" placeholder="Create a new password"/>
                            <span class="password-toggle" onclick="togglePassword('txt_newpassword')">
                                <i class="fas fa-eye"></i>
                            </span>
                            <div class="password-strength">
                                <div class="password-strength-bar" id="passwordStrengthBar"></div>
                            </div>
                            <div class="password-requirements" id="passwordRequirements">
                                <div class="requirement" id="reqLength"><i class="fas fa-circle"></i> At least 8 characters</div>
                                <div class="requirement" id="reqLowercase"><i class="fas fa-circle"></i> One lowercase letter</div>
                                <div class="requirement" id="reqUppercase"><i class="fas fa-circle"></i> One uppercase letter</div>
                                <div class="requirement" id="reqNumber"><i class="fas fa-circle"></i> One number</div>
                            </div>
                        </div>
                        
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="txt_repassword">Confirm New Password</label>
                            <input type="password" class="form-control-custom" name="txt_repassword" id="txt_repassword" 
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                   title="Must match the password above" 
                                   required onkeyup="checkPasswordMatch()"  placeholder="Re-enter your new password"/>
                            <span class="password-toggle" onclick="togglePassword('txt_repassword')">
                                <i class="fas fa-eye"></i>
                            </span>
                            <div id="passwordMatch" style="font-size: 0.85rem; margin-top: 5px;"></div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <input type="submit" class="btn btn-submit" name="btn_submit" id="btn_submit" value="Update Password" />
                        <input type="reset" class="btn btn-reset" name="btn_reset" id="btn_reset" value="Clear Form" onclick="resetPasswordValidation()" />
                        <div class="mt-2">
                            <a href="../Guest/ForgetPassword.php" class="btn btn-submit">
                                 Forget Password?
                            </a>
                        </div>
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
    
    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = passwordInput.nextElementSibling.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
        
        function checkPasswordStrength(password) {
            let strength = 0;
            const requirements = {
                length: false,
                lowercase: false,
                uppercase: false,
                number: false
            };
            
            // Check length
            if (password.length >= 8) {
                strength += 25;
                requirements.length = true;
                document.getElementById('reqLength').classList.add('met');
            } else {
                document.getElementById('reqLength').classList.remove('met');
            }
            
            // Check lowercase
            if (/[a-z]/.test(password)) {
                strength += 25;
                requirements.lowercase = true;
                document.getElementById('reqLowercase').classList.add('met');
            } else {
                document.getElementById('reqLowercase').classList.remove('met');
            }
            
            // Check uppercase
            if (/[A-Z]/.test(password)) {
                strength += 25;
                requirements.uppercase = true;
                document.getElementById('reqUppercase').classList.add('met');
            } else {
                document.getElementById('reqUppercase').classList.remove('met');
            }
            
            // Check number
            if (/[0-9]/.test(password)) {
                strength += 25;
                requirements.number = true;
                document.getElementById('reqNumber').classList.add('met');
            } else {
                document.getElementById('reqNumber').classList.remove('met');
            }
            
            // Update strength bar
            const strengthBar = document.getElementById('passwordStrengthBar');
            strengthBar.style.width = strength + '%';
            
            // Update color based on strength
            if (strength < 50) {
                strengthBar.style.background = '#dc3545'; // Red
            } else if (strength < 100) {
                strengthBar.style.background = '#ffc107'; // Yellow
            } else {
                strengthBar.style.background = '#28a745'; // Green
            }
        }
        
        function checkPasswordMatch() {
            const newPassword = document.getElementById('txt_newpassword').value;
            const confirmPassword = document.getElementById('txt_repassword').value;
            const matchElement = document.getElementById('passwordMatch');
            
            if (confirmPassword.length === 0) {
                matchElement.innerHTML = '';
                return;
            }
            
            if (newPassword === confirmPassword) {
                matchElement.innerHTML = '<i class="fas fa-check-circle" style="color:#28a745"></i> Passwords match';
            } else {
                matchElement.innerHTML = '<i class="fas fa-times-circle" style="color:#dc3545"></i> Passwords do not match';
            }
        }
        
        function resetPasswordValidation() {
            document.getElementById('passwordStrengthBar').style.width = '0%';
            document.getElementById('passwordMatch').innerHTML = '';
            
            // Reset requirement indicators
            const requirements = document.querySelectorAll('.requirement');
            requirements.forEach(req => {
                req.classList.remove('met');
            });
        }
    </script>
</body>
</html>

 <!--::footer_part:-->
    <?php include("Footer.php"); ?>
