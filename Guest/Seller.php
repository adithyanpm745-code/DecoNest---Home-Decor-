<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"]))
	{
		$name=$_POST["txt_name"];
		$email=$_POST["txt_email"];
		$contact=$_POST["txt_contact"];
		$address=$_POST["txt_address"];
		$place=$_POST["sel_place"];
		$radio=$_POST["radio"];
		
		$password=$_POST["txt_password"];
		$repassword=$_POST["txt_repassword"];
		
		$photo=$_FILES["file_photo"]['name'];
		$path=$_FILES["file_photo"]['tmp_name'];
		move_uploaded_file($path,'../Assets/Files/SellerDocs/'.$photo);
		
		$proof=$_FILES["file_proof"]['name'];
		$path=$_FILES["file_proof"]['tmp_name'];
		move_uploaded_file($path,'../Assets/Files/SellerDocs/'.$proof);
		

		if ($password==$repassword)
		{
		$Email="select * from tbl_seller where seller_email='".$email."'";
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
		
		$InsQry="insert into tbl_seller(seller_name,seller_email,seller_contact,seller_address,place_id,seller_photo,seller_proof,seller_password,seller_customization)
		values('".$name."','".$email."','".$contact."','".$address."','".$place."','".$photo."','".$proof."','".$password."','".$radio."')";
			
			if($con->query($InsQry))
			{
			?>
        <script>
		alert("Your Registration has been Successfully Completed , Please wait for Admin response.");
		window.location="Login.php";
		</script>
        <?php	
			}
			else
			{
			?>
        <script>
		alert("Something has wrong")
		window.location="Seller.php";
		</script>
        <?php
			}
		}
		}
		else
		{
		?>
        	<script>
		alert("Password Mismatch");
		window.location="UserRegistration.php";
		</script>
        <?php
		}
	}
?>




<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"]))
{
    // [Your existing PHP code remains exactly the same]
    // ...
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join DecoNest - Seller Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #8B7257; /* Warm taupe */
            --secondary: #F5EFE6; /* Cream */
            --accent: #A78A6E; /* Muted brown */
            --text: #333333;
            --light: #FFFFFF;
            --dark: #1E1E1E;
            --error: #E74C3C;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: var(--text);
            line-height: 1.6;
            background-image: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .registration-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .registration-form {
            background: white;
            width: 100%;
            max-width: 800px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .form-header {
            background-color: var(--primary);
            color: white;
            padding: 2rem;
            grid-column: 1 / -1;
            text-align: center;
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            opacity: 0.9;
        }

        .form-left {
            padding: 2rem;
            border-right: 1px solid #eee;
        }

        .form-right {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(139, 114, 87, 0.2);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .radio-group {
            display: flex;
            gap: 1rem;
        }

        .radio-option {
            display: flex;
            align-items: center;
        }

        .radio-option input {
            margin-right: 0.5rem;
        }

        .file-input {
            position: relative;
        }

        .file-input input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            cursor: pointer;
        }

        .file-input-label {
            display: block;
            padding: 0.8rem 1rem;
            border: 1px dashed #ddd;
            border-radius: 6px;
            text-align: center;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            border-color: var(--primary);
            background-color: rgba(139, 114, 87, 0.05);
        }

        .file-input-label i {
            display: block;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .form-actions {
            grid-column: 1 / -1;
            padding: 0 2rem 2rem;
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 114, 87, 0.3);
        }

        .btn-secondary {
            background-color: #f1f1f1;
            color: var(--text);
        }

        .btn-secondary:hover {
            background-color: #e1e1e1;
        }

        .login-link {
            text-align: center;
            padding: 1rem;
            grid-column: 1 / -1;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .registration-form {
                grid-template-columns: 1fr;
            }
            
            .form-left {
                border-right: none;
                border-bottom: 1px solid #eee;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }

        /* Decor elements */
        .form-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="registration-form">
            <div class="form-header">
                <h2>Join DecoNest (Shop)</h2>
                <p>Showcase your home decor products to thousands of customers</p>
            </div>
            
            <div class="form-left">
                <div class="form-group">
                    <label for="txt_name">Shop Name</label>
                    <i class="fas fa-store form-icon"></i>
                    <input type="text" name="txt_name" id="txt_name" minlength="3" 
                           title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" 
                           pattern="^[A-Z]+[a-zA-Z ]*$" required placeholder="Enter your shop name">
                </div>
                
                <div class="form-group">
                    <label for="txt_email">Shop Email</label>
                    <i class="fas fa-envelope form-icon"></i>
                    <input type="email" name="txt_email" id="txt_email" required placeholder="your@shop.com" pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$">
                </div>
                
                <div class="form-group">
                    <label for="txt_contact">Shop Contact</label>
                    <i class="fas fa-phone form-icon"></i>
                    <input type="text" name="txt_contact" id="txt_contact" pattern="[6-9]{1}[0-9]{9}" 
                           title="Phone number with 6-9 and remaining 9 digits with 0-9" required placeholder="Enter 10-digit mobile number">
                </div>
                
                <div class="form-group">
                    <label for="txt_address">Shop Address</label>
                    <textarea name="txt_address" id="txt_address" required placeholder="Enter your shop's full address"></textarea>
                </div>

                <div class="form-group">
                    <label for="sel_district">District</label>
                    <select name="sel_district" id="sel_district" onChange="AjaxPlace(this.value)" required>
                        <option value="">Select District</option>
                        <?php
                        $sel="select * from tbl_district";
                        $res=$con->query($sel);
                        while($data=$res->fetch_assoc())
                        {
                        ?>
                        <option value="<?php echo $data["district_id"]?>">
                            <?php echo $data["district_name"]?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel_place">Place</label>
                    <select name="sel_place" id="sel_place" required>
                        <option value="">Select Place</option>
                    </select>
                </div>

            </div>
            
            <div class="form-right">
                
                
                
                
                <div class="form-group">
                    <label>Customization Available?</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" name="radio" id="Yes" value="1" required>
                            <label for="Yes">Yes</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="radio" id="No" value="2">
                            <label for="No">No</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Shop Photo</label>
                    <div class="file-input">
                        <label class="file-input-label" for="file_photo">
                            <i class="fas fa-camera"></i>
                            <span>Click to upload shop photo</span>
                            <small>(JPEG, PNG - Max 2MB)</small>
                        </label>
                        <input type="file" name="file_photo" id="file_photo" accept="image/*" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Proof Document</label>
                    <div class="file-input">
                        <label class="file-input-label" for="file_proof">
                            <i class="fas fa-file-upload"></i>
                            <span>Click to upload proof document</span>
                            <small>(PDF, JPEG, PNG - Max 5MB)</small>
                        </label>
                        <input type="file" name="file_proof" id="file_proof" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_password">Password</label>
                    <!-- <i class="fas fa-lock form-icon"></i> -->
                    <input type="password" name="txt_password" id="txt_password" 
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters" 
                           required placeholder="Create a password">
                    <span class="password-toggle" style="top: 55px;" onclick="togglePassword('txt_password')">
                        <i class="fas fa-eye" ></i>
                    </span>
                </div>
                
                <div class="form-group">
                    <label for="txt_repassword">Confirm Password</label>
                    <i class=""></i>
                    <input type="password" name="txt_repassword" id="txt_repassword" 
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must match the password above" 
                           required placeholder="Re-enter your password">
                    <span class="password-toggle" style="top: 55px;" onclick="togglePassword('txt_repassword')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Register
                </button>
                <button type="reset" name="btn_reset" id="btn_reset" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </button>
            </div>
            
            <div class="login-link">
                Already have an account? <a href="Login.php">Login here</a>
            </div>
        </form>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script> 
    <script>
        function AjaxPlace(disId) {
            $.ajax({
                url:"../Assets/AjaxPages/AjaxPlace.php?disId="+disId,
                success: function(html){
                    $("#sel_place").html(html);
                }
            });
        }

        // File input display
        document.getElementById('file_photo').addEventListener('change', function(e) {
            if(this.files.length > 0) {
                document.querySelector('.file-input-label[for="file_photo"] span').textContent = this.files[0].name;
            }
        });

        document.getElementById('file_proof').addEventListener('change', function(e) {
            if(this.files.length > 0) {
                document.querySelector('.file-input-label[for="file_proof"] span').textContent = this.files[0].name;
            }
        });

        // Password toggle visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.querySelector(`#${inputId} + .password-toggle i`);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>