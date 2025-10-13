<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	$amount=$_POST["txt_amount"];
		
    $UpQry="update tbl_customization set customization_amount='".$amount."',customization_status=1 
    where customization_id='".$_GET['accept']."'";
	if($con->query($UpQry))
	{
		?>
		<script>
		alert("Amount added successfully!")
		window.location="ViewCustomization.php";
		</script>
			<?php
	}
	else
	{
		?>
        <script>
		alert("Something has wrong")
		window.location="ViewCustomization.php";
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
    <title>Customization Amount</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- Custom Styles -->
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1550&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .overlay {
            background-color: rgba(255, 255, 255, 0.95);
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }
        
        .amount-container {
            max-width: 500px;
            width: 100%;
            padding: 0 15px;
        }
        
        .amount-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .card-header-custom {
            background: linear-gradient(to right, #f8f5f0, #e9e1d3);
            padding: 25px 30px;
            text-align: center;
            border-bottom: 1px solid #e0d9c7;
        }
        
        .card-header-custom h3 {
            color: #5a5a5a;
            margin: 0;
            font-weight: 600;
        }
        
        .card-header-custom p {
            color: #7a7a7a;
            margin: 10px 0 0;
        }
        
        .card-body-custom {
            padding: 30px;
        }
        
        .form-label {
            color: #5a5a5a;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .form-control-custom {
            border: 2px solid #e9e1d3;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control-custom:focus {
            border-color: #c8a97e;
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
        }
        
        .input-group-text {
            background-color: #f8f5f0;
            border: 2px solid #e9e1d3;
            border-right: none;
            color: #5a5a5a;
            font-weight: 500;
        }
        
        .btn-submit {
            background-color: #c8a97e;
            color: white;
            border: none;
            padding: 12px 25px;
            font-weight: 500;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            background-color: #b4986e;
            transform: translateY(-2px);
        }
        
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #c8a97e;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        
        .info-box p {
            margin: 0;
            color: #5a5a5a;
            font-size: 0.9rem;
        }
        
        .info-box i {
            color: #c8a97e;
            margin-right: 8px;
        }
        
        .currency-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #c8a97e;
            font-size: 18px;
        }
        
        .input-wrapper {
            position: relative;
        }
    </style>
</head>
<body>
    <!-- Header inclusion -->
    <?php include('Header.php'); ?>
    
    <div class="overlay">
        <div class="amount-container">
            <div class="amount-card">
                <div class="card-header-custom">
                    <h3>Set Customization Amount</h3>
                    <p>Please enter the amount for this customization request</p>
                </div>
                
                <div class="card-body-custom">
                    <form id="form1" name="form1" method="post" action="">
                        <div class="mb-4">
                            <label for="txt_amount" class="form-label">Amount (₹)</label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       class="form-control form-control-custom" 
                                       name="txt_amount" 
                                       id="txt_amount" 
                                       pattern="^\d+(\.\d{1,2})?$"
                                       title="Amount must be a positive number. Decimals allowed up to 2 places (e.g., 199 or 199.99)."
                                       placeholder="Enter amount"
                                       required />
                                <span class="currency-icon">₹</span>
                            </div>
                        </div>
                        
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-submit">
                            <i class="fas fa-check-circle mr-2"></i> Submit Amount
                        </button>
                        
                        <div class="info-box">
                            <p><i class="fas fa-info-circle"></i> Enter the amount as a positive number. You can include up to 2 decimal places (e.g., 199 or 199.99).</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="../Assets/Templates/Main/js/jquery-3.4.1.min.js"></script>
    <script src="../Assets/Templates/Main/js/popper.min.js"></script>
    <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
    
    <!-- Optional JavaScript for enhanced UX -->
    <script>
        $(document).ready(function() {
            // Add focus effect to input
            $('#txt_amount').on('focus', function() {
                $(this).css('background-color', '#fffdf9');
            }).on('blur', function() {
                $(this).css('background-color', '');
            });
            
            // Validate input on keypress to allow only numbers and decimal
            $('#txt_amount').on('keypress', function(e) {
                var charCode = (e.which) ? e.which : e.keyCode;
                var value = $(this).val();
                
                // Allow numbers (0-9), backspace, delete, tab, arrow keys
                if (charCode == 8 || charCode == 9 || charCode == 46 || (charCode >= 37 && charCode <= 40)) {
                    return true;
                }
                
                // Allow decimal point only if not already present
                if (charCode == 46) {
                    return value.indexOf('.') === -1;
                }
                
                // Allow only numbers
                if (charCode < 48 || charCode > 57) {
                    return false;
                }
                
                // If there's a decimal, restrict to 2 digits after it
                if (value.indexOf('.') !== -1) {
                    var parts = value.split('.');
                    if (parts[1].length >= 2) {
                        return false;
                    }
                }
                
                return true;
            });
        });
    </script>
</body>
</html>