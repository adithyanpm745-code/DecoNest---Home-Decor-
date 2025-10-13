<?php
include("../Assets/Connection/Connection.php");
session_start();

	if(isset($_GET['delId']))
	{
		$DelQry="delete from tbl_complaint where complaint_id='".$_GET['delId']."'";
		if($con->query($DelQry))
		{
			?>
            <script>
			alert("Complaint deleted successfully")
			window.location="MyComplaints.php"
			</script>
			<?php
		}
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Complaints | DecoNest</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
<!-- font awesome CSS -->
<link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
<style>
    body {
        background: linear-gradient(rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.92)), 
                    url('https://images.unsplash.com/photo-1493663284031-b7e3aaa4c4b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .complaints-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 30px;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 40px;
        color: #5a5a5a;
    }
    
    .section-header h2 {
        font-weight: 600;
        margin-bottom: 15px;
        color: #c8a97e;
        position: relative;
        display: inline-block;
    }
    
    .section-header h2:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #c8a97e;
    }
    
    .complaint-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .complaint-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .card-header {
        background-color: #f8f5f0;
        padding: 15px 20px;
        border-bottom: 1px solid #eae2d6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .complaint-number {
        font-weight: 600;
        color: #5a5a5a;
        font-size: 16px;
    }
    
    .complaint-date {
        color: #888;
        font-size: 14px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .complaint-content {
        color: #5a5a5a;
        margin-bottom: 15px;
        line-height: 1.6;
    }
    
    .complaint-reply {
        background-color: #f9f9f9;
        border-left: 4px solid #c8a97e;
        padding: 15px;
        border-radius: 4px;
        margin-top: 15px;
    }
    
    .reply-label {
        font-weight: 600;
        color: #c8a97e;
        margin-bottom: 8px;
        display: block;
    }
    
    .card-footer {
        padding: 15px 20px;
        background-color: #fafafa;
        display: flex;
        justify-content: flex-end;
        border-top: 1px solid #eee;
    }
    
    .delete-btn {
        color: #e74c3c;
        background: none;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .delete-btn:hover {
        background-color: #ffece8;
        text-decoration: none;
    }
    
    .no-complaints {
        text-align: center;
        padding: 40px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }
    
    .no-complaints i {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .no-complaints p {
        color: #888;
        font-size: 18px;
        margin-bottom: 25px;
    }
    
    .new-complaint-btn {
        background-color: #c8a97e;
        color: white;
        padding: 10px 25px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .new-complaint-btn:hover {
        background-color: #b89768;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }
    
    .complaint-type-badge {
        background-color: #c8a97e;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        margin-left: 10px;
    }
</style>
</head>

<body>
    <?php include("Header.php"); ?>
    
    <div class="complaints-container">
        <div class="section-header">
            <h2>My Complaints</h2>
            <p>View and manage your submitted complaints</p>
        </div>
        
        <div class="text-center mb-4">
            <a href="Complaint.php" class="new-complaint-btn">
                <i class="fas fa-plus-circle mr-2"></i>Submit New Complaint 
            </a>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <h4 class="mb-4">Product Complaints <span class="complaint-type-badge">Products</span></h4>
                
                <?php
                $i = 0;
                $SelQry = "select * from tbl_complaint c
                inner join tbl_booking b on c.booking_id=b.booking_id 
                inner join tbl_user u on b.user_id=u.user_id
                where c.user_id='".$_SESSION['uid']."'";
                
                $row = $con->query($SelQry);
                if($row->num_rows > 0) {
                    while($data = $row->fetch_assoc()) {
                        $i++;
                ?>
                <div class="complaint-card">
                    <div class="card-header">
                        <span class="complaint-number">Complaint #<?php echo $i; ?></span>
                        <span class="complaint-date"><?php echo date('M j, Y', strtotime($data['complaint_date'])); ?></span>
                    </div>
                    <div class="card-body">
                        <p class="reply-label">Booking Date : <?php echo $data['booking_date']; ?></p>
                        <p class="reply-label">Booking ID   : <?php echo $data['booking_id']; ?></p>
                        <p class="complaint-content"><?php echo $data['complaint_content']; ?></p>
                        
                        <?php if(!empty($data['complaint_reply'])) { ?>
                        <div class="complaint-reply">
                            <span class="reply-label">Seller Response:</span>
                            <?php echo $data['complaint_reply']; ?>
                        </div>
                        <?php } else { ?>
                        <div class="text-muted">
                            <i class="fas fa-clock mr-2"></i>Waiting for seller response
                        </div>
                        <?php } ?>
                    </div>
                    <div class="card-footer">
                        <a href="MyComplaints.php?delId=<?php echo $data['complaint_id']; ?>" 
                           class="delete-btn" 
                           onclick="return confirm('Are you sure you want to delete this complaint?')">
                            <i class="fas fa-trash-alt mr-2"></i>Delete
                        </a>
                    </div>
                </div>
                <?php
                    }
                } else {
                ?>
                <div class="no-complaints">
                    <i class="fas fa-comment-slash"></i>
                    <p>You haven't submitted any product complaints yet.</p>
                </div>
                <?php } ?>
            </div>
            
            <div class="col-md-6">
                <h4 class="mb-4">Complaints in Admin <span class="complaint-type-badge">Website</span></h4>
                
                <?php
                $i = 0;
                $SelQry = "select * from tbl_complaint where user_id='".$_SESSION['uid']."' and booking_id=0";
                
                $row = $con->query($SelQry);
                if($row->num_rows > 0) {
                    while($data = $row->fetch_assoc()) {
                        $i++;
                ?>
                <div class="complaint-card">
                    <div class="card-header">
                        <span class="complaint-number">Complaint #<?php echo $i; ?></span>
                        <span class="complaint-date"><?php echo date('M j, Y', strtotime($data['complaint_date'])); ?></span>
                    </div>
                    <div class="card-body">
                        <p class="complaint-content"><?php echo $data['complaint_content']; ?></p>
                        
                        <?php if(!empty($data['complaint_reply'])) { ?>
                        <div class="complaint-reply">
                            <span class="reply-label">Admin Response:</span>
                            <?php echo $data['complaint_reply']; ?>
                        </div>
                        <?php } else { ?>
                        <div class="text-muted">
                            <i class="fas fa-clock mr-2"></i>Waiting for admin response
                        </div>
                        <?php } ?>
                    </div>
                    <div class="card-footer">
                        <a href="MyComplaints.php?delId=<?php echo $data['complaint_id']; ?>" 
                           class="delete-btn" 
                           onclick="return confirm('Are you sure you want to delete this complaint?')">
                            <i class="fas fa-trash-alt mr-2"></i>Delete
                        </a>
                    </div>
                </div>
                <?php
                    }
                } else {
                ?>
                <div class="no-complaints">
                    <i class="fas fa-comment-slash"></i>
                    <p>You haven't submitted any site complaints yet.</p>
                </div>
                <?php } ?>
            </div>
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