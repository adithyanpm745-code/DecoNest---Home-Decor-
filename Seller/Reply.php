<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	$reply=$_POST["txt_reply"];
	
	
	$upQry="update tbl_complaint set complaint_reply='".$reply."',complaint_status=1 where complaint_id='".$_GET['cid']."'";
		if($con->query($upQry))
		{
			?>
		<script>
		alert("Reply Complaint Successfully Inserted")
		window.location="ViewComplaint.php";
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
    <title>DecoNest - Reply to Complaint</title>
    <link rel="icon" href="../Assets/Templates/Main/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="%23f8f5f0" width="100" height="100"/><path d="M0 50 L100 50 M50 0 L50 100" stroke="%23e9e5de" stroke-width="1"/></svg>');
            background-attachment: fixed;
        }
        
        .reply-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
            padding: 30px;
            margin: 30px auto;
            max-width: 800px;
        }
        
        .reply-header {
            color: #5a5a5a;
            border-bottom: 2px solid #c8a97e;
            padding-bottom: 15px;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .form-label {
            color: #5a5a5a;
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .form-control {
            border: 1px solid #e9e5de;
            border-radius: 4px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #c8a97e;
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
        }
        
        .btn-submit {
            background-color: #c8a97e;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            min-width: 150px;
        }
        
        .btn-submit:hover {
            background-color: #b8986a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        .back-link {
            color: #c8a97e;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-top: 20px;
            transition: all 0.3s;
        }
        
        .back-link:hover {
            color: #b8986a;
            text-decoration: underline;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
    </style>
</head>

<body>
    <!-- Header inclusion -->
    <?php include('Header.php'); ?>
    
 

    <div class="container my-5">
        <div class="reply-container">
            <h2 class="reply-header">Reply to Complaint</h2>
            
            <form id="form1" name="form1" method="post" action="">
                <div class="form-group">
                    <label for="txt_reply" class="form-label">Your Reply</label>
                    <textarea name="txt_reply" id="txt_reply" class="form-control" required placeholder="Type your response to the customer complaint here..."></textarea>
                </div>
                
                <div class="text-center">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit Reply" class="btn btn-submit" />
                </div>
                
                <div class="text-center">
                    <a href="ViewComplaint.php" class="back-link">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Complaints
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