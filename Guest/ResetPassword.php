<?php
session_start();
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit'])){
    $pass=$_POST['txt_pass'];
    $cpass=$_POST['txt_cpass'];
    if($pass==$cpass){
        if(isset($_SESSION['ruid'])){ //User
            $updQry="update tbl_user set user_password='".$pass."' where user_id=".$_SESSION['ruid'];
            if($con->query($updQry)){
                session_destroy();
                ?>
                <script>
                    alert("Password Updated")
                    window.location="Login.php"
                    </script>
                <?php
            }
        }
        else if(isset($_SESSION['rsid'])){ //Seller
            $updQry="update tbl_seller set seller_password='".$pass."' where seller_id=".$_SESSION['rsid'];
            if($con->query($updQry)){
                session_destroy();
                ?>
                <script>
                    alert("New Password Updated")
                    window.location="Login.php"
                    </script>
                <?php
            }
        }
        else{
            ?>
            <script>
                alert('Something went wrong')
                    window.location="Login.php"
                </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - DecoNest</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: url('https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1080&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .form-container {
            padding: 30px;
        }
        
        .input-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        
        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 0 2px rgba(106, 17, 203, 0.2);
        }
        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 42px;
            color: #6a11cb;
            font-size: 18px;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 42px;
            color: #777;
            cursor: pointer;
            font-size: 18px;
        }
        
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(106, 17, 203, 0.3);
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(106, 17, 203, 0.4);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #6a11cb;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: color 0.3s ease;
        }
        
        .back-link a:hover {
            color: #2575fc;
            text-decoration: underline;
        }
        
        .back-link i {
            margin-right: 8px;
        }
        
        .notification {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
        }
        
        .error {
            background-color: #ffebee;
            color: #d32f2f;
            border: 1px solid #f5c6cb;
        }
        
        .success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c3e6cb;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        
        .password-strength {
            height: 5px;
            margin-top: 8px;
            border-radius: 5px;
            background: #eee;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s, background 0.3s;
        }
        
        @media (max-width: 500px) {
            .container {
                max-width: 100%;
            }
            
            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">DecoNest</div>
            <h1>Create New Password</h1>
            <p>Enter your new password below</p>
        </div>
        
        <div class="form-container">
            <div id="error-notification" class="notification error">
                Passwords do not match
            </div>
            
            <form action="" method="post" id="resetForm">
                <div class="input-group">
                    <label for="password">New Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" name="txt_pass" id="password" placeholder="Enter your new password" 
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters" 
                    required/>
                    <span class="password-toggle" id="togglePassword">
                        <i class="far fa-eye"></i>
                    </span>
                    <div class="password-strength">
                        <div class="strength-meter" id="passwordStrength"></div>
                    </div>
                </div>
                
                <div class="input-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" name="txt_cpass" id="confirmPassword" placeholder="Confirm your new password" 
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Must match the password above" 
                    required/>
                    <span class="password-toggle" id="toggleConfirmPassword">
                        <i class="far fa-eye"></i>
                    </span>
                </div>
                
                <button type="submit" name="btn_submit" class="btn-submit">
                    Change Password
                </button>
            </form>
            
            <div class="back-link">
                <a href="login.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
            </div>
        </div>
    </div>

    <script>
        // Password visibility toggle
        const togglePassword = document.querySelector('#togglePassword');
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const password = document.querySelector('#password');
        const confirmPassword = document.querySelector('#confirmPassword');
        const strengthMeter = document.querySelector('#passwordStrength');
        
        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
        
        toggleConfirmPassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            
            // Toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
        
        // Password strength meter
        password.addEventListener('input', function() {
            const val = password.value;
            const result = zxcvbn(val);
            
            // Update the strength meter
            let strength = 0;
            let color = '#d32f2f'; // Red for weak
            
            if (val.length > 0) {
                switch(result.score) {
                    case 0:
                    case 1:
                        strength = 25;
                        color = '#d32f2f'; // Red
                        break;
                    case 2:
                        strength = 50;
                        color = '#f57c00'; // Orange
                        break;
                    case 3:
                        strength = 75;
                        color = '#689f38'; // Light green
                        break;
                    case 4:
                        strength = 100;
                        color = '#2e7d32'; // Dark green
                        break;
                }
            }
            
            strengthMeter.style.width = strength + '%';
            strengthMeter.style.background = color;
        });
        
        // Form validation
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                document.getElementById('error-notification').style.display = 'block';
                document.getElementById('error-notification').textContent = 'Passwords do not match';
                
                // Hide after 5 seconds
                setTimeout(() => {
                    document.getElementById('error-notification').style.display = 'none';
                }, 5000);
            }
        });
        
        // Check if there was an error in PHP
        <?php if(isset($_POST['btn_submit']) && ($_POST['txt_pass'] != $_POST['txt_cpass'])): ?>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('error-notification').style.display = 'block';
                document.getElementById('error-notification').textContent = 'Passwords do not match';
            });
        <?php endif; ?>
    </script>
</body>
</html>