<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	$content=$_POST["txt_content"];
		
	$InsQry="insert into tbl_complaint(complaint_content,user_id,complaint_date) 
	values('".$content."','".$_SESSION["uid"]."',now())";
	if($con->query($InsQry))
	{
		?>
		<script>
		alert("Complaint sent successfully!")
		window.location="MyComplaints.php";
		</script>
			<?php
	}
	else
	{
		?>
        <script>
		alert("Something has wrong")
		window.location="Complaint.php";
		</script>
        <?php
	}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Complaint | DecoNest</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
<!-- font awesome CSS -->
<link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
<style>
    body {
        background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                    url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1758&q=80');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .complaint-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .complaint-header {
        text-align: center;
        margin-bottom: 30px;
        color: #5a5a5a;
    }
    
    .complaint-header h2 {
        font-weight: 600;
        margin-bottom: 10px;
        color: #c8a97e;
    }
    
    .complaint-header p {
        color: #777;
        font-size: 16px;
    }
    
    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px 15px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #c8a97e;
        box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
    }
    
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }
    
    .btn-submit {
        background-color: #c8a97e;
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        background-color: #b89768;
        transform: translateY(-2px);
    }
    
    .complaint-icon {
        font-size: 5rem;
        color: #c8a97e;
        margin-bottom: 20px;
    }
    
    .back-link {
        color: #5a5a5a;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        transition: all 0.3s;
    }
    
    .back-link:hover {
        color: #c8a97e;
        text-decoration: none;
    }
</style>
</head>

<body>
    <?php include("Header.php"); ?>
    
    <div class="container">
        <div class="complaint-container">
            <div class="text-center">
                <div class="complaint-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
            </div>
            
            <div class="complaint-header">
                <h2>Submit a Complaint in Admin</h2>
                <p>We're here to help. Please describe your issue in detail below.</p>
            </div>
            
            <form id="form1" name="form1" method="post" action="">
                <div class="form-group">
                    <label for="txt_content" class="font-weight-bold">Complaint Details</label>
                    <textarea name="txt_content" id="txt_content" class="form-control" required 
                              placeholder="Please describe your complaint in detail. Our team will review it and get back to you as soon as possible."></textarea>
                </div>
                
                <div class="text-center mt-4">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit Complaint" class="btn btn-submit" />
                    <br>
                    <a href="MyComplaints.php" class="back-link">
                        <i class="fas fa-arrow-left mr-2"></i>View My Previous Complaints
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Assets/Templates/Main/js/jquery-1.12.1.min.js"></script>
    <script src="../Assets/Templates/Main/js/popper.min.js"></script>
    <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
</body>
</html>

<!--::footer_part:-->
    <?php include("Footer.php"); ?>