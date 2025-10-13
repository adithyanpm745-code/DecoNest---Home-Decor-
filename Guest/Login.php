<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	$email=$_POST["txt_email"];
	$password=$_POST["txt_password"];
		
	$SelQryAdmin="select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";	
	$rowAdmin=$con->query($SelQryAdmin);
	
	$SelQryUser="select * from tbl_user where user_email='".$email."' and user_password='".$password."'";	
	$rowUser=$con->query($SelQryUser);
	
	$SelQrySeller="select * from tbl_seller where seller_email='".$email."' and seller_password='".$password."' and seller_status=1" ;	
	$rowSeller=$con->query($SelQrySeller);
	
	if($admin=$rowAdmin->fetch_assoc())
	{
		$_SESSION["aid"]=$admin["admin_id"];
		$_SESSION["aname"]=$admin["admin_name"];
		
		header("location:../Admin/HomePage.php");
	}
	
	else if($user=$rowUser->fetch_assoc())
	{
		$_SESSION["uid"]=$user["user_id"];
		$_SESSION["uname"]=$user["user_name"];
		
		header("location:../User/HomePage.php");
	}
	else if($seller=$rowSeller->fetch_assoc())
	{
		$_SESSION["sid"]=$seller["seller_id"];
		$_SESSION["sname"]=$seller["seller_name"];
		
		header("location:../Seller/HomePage.php");
	}
	else
	{
		?>
		<script>
		alert("Invailed Email or Password")
		
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
    <title>Login | DecoNest Home Decor</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Montserrat:wght@300;400;500&display=swap');
        
        :root {
            --primary: #8B7257;
            --fprimary: #050771ff;
            --secondary: #F5EFE6;
            --accent: #A78A6E;
            --text: #333333;
            --light: #FFFFFF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--secondary);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }
        
        .decor-image {
            flex: 1;
            background-image: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .decor-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(139, 114, 87, 0.2);
        }
        
        .login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        
        .login-form {
            max-width: 400px;
            width: 100%;
            background-color: var(--light);
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo h1 {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 2rem;
            font-weight: 600;
        }
        
        .logo p {
            font-size: 0.9rem;
            color: var(--accent);
            margin-top: 0.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(139, 114, 87, 0.2);
        }
        
        .btn {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 4px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn:hover {
            background-color: var(--accent);
        }
        
        .links {
            margin-top: 1.5rem;
            text-align: center;
        }
        
        .links a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }
        
        .links a:hover {
            color: var(--accent);
            text-decoration: underline;
        }

        .flinks {
            margin-top: 1.5rem;
            text-align: center;
        }
        
        .flinks a {
            color: var(--fprimary);
            text-decoration: none;
            font-size: 0.9rem;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }
        
        .flinks a:hover {
            color: var(--accent);
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #999;
            font-size: 0.8rem;
        }
        
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        
        .divider::before {
            margin-right: 1rem;
        }
        
        .divider::after {
            margin-left: 1rem;
        }
        
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .decor-image {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="decor-image"></div>
    
    <div class="login-container">
        <form id="form1" name="form1" method="post" action="" class="login-form">
            <div class="logo">
                <h1>Login</h1>
                <p>Where every room tells a story</p>
            </div>
            
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input type="email" name="txt_email" id="txt_email" required placeholder="Enter your email"/>
            </div>
            
            <div class="form-group">
                <label for="txt_password">Password</label>
                <input type="password" name="txt_password" id="txt_password" required placeholder="Enter your password"/>
            </div>
            
            <button type="submit" name="btn_submit" id="btn_submit" class="btn">Login</button>
            
            <div class="divider">OR</div>
            
            <div class="links">
                <a href="Seller.php">Become a Seller</a>
                <a href="UserRegistration.php">Create Account</a>
            </div>
            <div class="flinks">
                <a href="ForgetPassword.php">Forget Password</a>
            </div>
            <div class="links">
                <a href="../">View Home Page</a>
            </div>
        </form>
    </div>
</body>
</html>