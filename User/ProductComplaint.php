<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");
if(isset($_POST["btn_submit"]))
{
	$content=$_POST["txt_content"];
		
	$InsQry="insert into tbl_complaint(complaint_content,user_id,complaint_date,booking_id) 
	values('".$content."','".$_SESSION["uid"]."',now(),'".$_GET["Bid"]."')";
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
		window.location="ProductComplaint.php";
		</script>
        <?php
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Complaint</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .complaint-container {
        background-image: url('https://images.unsplash.com/photo-1516387938699-a93567ec168e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        padding: 40px 0;
    }
    .complaint-card {
        background-color: rgba(255, 255, 255, 0.92);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        padding: 30px;
        margin-top: 20px;
    }
    .complaint-header {
        text-align: center;
        margin-bottom: 25px;
        color: #2c3e50;
    }
    .complaint-icon {
        font-size: 2.5rem;
        color: #e74c3c;
        margin-bottom: 15px;
    }
    .complaint-btn {
        background-color: #3498db;
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .complaint-btn:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }
</style>
</head>

<body>
<div class="complaint-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="complaint-card">
                    <div class="complaint-header">
                        <div class="complaint-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h2>Submit Your Complaint</h2>
                        <p class="text-muted">We're here to help resolve any issues you've encountered</p>
                    </div>
                    
                    <form id="complaintForm" name="form1" method="post" action="">
                        <div class="mb-4">
                            <label for="complaintContent" class="form-label fw-semibold">Complaint Details</label>
                            <textarea 
                                class="form-control" 
                                id="complaintContent" 
                                name="txt_content" 
                                rows="5" 
                                placeholder="Please describe your issue in detail..." 
                                required
                            ></textarea>
                            <div class="form-text">Please provide as much detail as possible to help us resolve your issue quickly.</div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="MyComplaints.php" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-chevron-left me-1"></i> View My Complaints
                            </a>
                            <button type="submit" name="btn_submit" class="btn complaint-btn">
                                <i class="fas fa-paper-plane me-1"></i> Submit Complaint
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<!--::footer_part:-->
    <?php include("Footer.php"); ?>