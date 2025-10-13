<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	$content=$_POST["txt_content"];
		
	$InsQry="insert into tbl_feedback(feedback_content,user_id,feedback_date) values('".$content."','".$_SESSION["uid"]."',now())";
	if($con->query($InsQry))
	{
		?>
		<script>
		alert("Thank you for your feedback")
		window.location="Feedback.php";
		</script>
			<?php
	}
	else
	{
		?>
        <script>
		alert("Something has wrong")
		window.location="Feedback.php";
		</script>
        <?php
	}
}
	if(isset($_GET['delId']))
	{
		$DelQry="delete from tbl_feedback where feedback_id='".$_GET['delId']."'";
		if($con->query($DelQry))
		{
			?>
            <script>
			alert("Feedback deleted successfully")
			window.location="Feedback.php"
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
    <title>Feedback - DecoNest</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                        url('../Assets/Templates/Main/img/feedback-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .feedback-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 40px;
        }
        
        .page-title {
            color: #5a5a5a;
            font-weight: 600;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: #c8a97e;
        }
        
        .form-control:focus {
            border-color: #c8a97e;
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
        }
        
        .btn-primary {
            background-color: #c8a97e;
            border-color: #c8a97e;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #b89768;
            border-color: #b89768;
            transform: translateY(-2px);
        }
        
        .feedback-table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .feedback-table th {
            background-color: #f8f5f0;
            color: #5a5a5a;
            font-weight: 600;
            border: none;
        }
        
        .feedback-table td {
            vertical-align: middle;
            border-color: #f1f1f1;
        }
        
        .delete-btn {
            color: #dc3545;
            transition: all 0.3s;
        }
        
        .delete-btn:hover {
            color: #bd2130;
            transform: scale(1.1);
        }
        
        .no-feedback {
            text-align: center;
            padding: 30px;
            color: #6c757d;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .card-header {
            background-color: #f8f5f0;
            border-bottom: 1px solid #eae5dd;
            font-weight: 600;
            color: #5a5a5a;
        }
    </style>
</head>
<body>
    <!-- Header included from Header.php -->
    <?php include('Header.php'); ?>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="page-title">Share Your Feedback</h2>
                
                <div class="feedback-container">
                    <div class="card">
                        <div class="card-header">
                            We Value Your Opinion
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="txt_content" class="font-weight-bold">Your Feedback</label>
                                    <textarea name="txt_content" id="txt_content" class="form-control" rows="5" 
                                              placeholder="Please share your thoughts about our products and services..." 
                                              required></textarea>
                                    <small class="form-text text-muted">Your feedback helps us improve our services.</small>
                                </div>
                                <div class="text-center mt-4">
                                    <input type="submit" name="btn_submit" id="btn_submit" 
                                           class="btn btn-primary btn-lg" value="Submit Feedback">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="feedback-container">
                    <h3 class="page-title">Your Previous Feedback</h3>
                    
                    <?php
                    $SelQry = "select * from tbl_feedback f inner join tbl_user u on f.user_id=u.user_id where f.user_id='".$_SESSION['uid']."'";
                    $row = $con->query($SelQry);
                    
                    if($row->num_rows > 0) {
                    ?>
                    <div class="table-responsive feedback-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>Content</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                while($data = $row->fetch_assoc()) {
                                    $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['feedback_content']; ?></td>
                                    <td><?php echo date('M j, Y', strtotime($data['feedback_date'])); ?></td>
                                    <td>
                                        <a href="Feedback.php?delId=<?php echo $data['feedback_id']; ?>" 
                                           class="delete-btn" 
                                           onclick="return confirm('Are you sure you want to delete this feedback?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="no-feedback">
                        <i class="far fa-comment-dots fa-3x mb-3"></i>
                        <h4>No Feedback Yet</h4>
                        <p>You haven't submitted any feedback yet. Share your thoughts with us!</p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript Libraries -->
    <script src="../Assets/Templates/Main/js/jquery-1.12.1.min.js"></script>
    <script src="../Assets/Templates/Main/js/popper.min.js"></script>
    <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.magnific-popup.js"></script>
    <script src="../Assets/Templates/Main/js/swiper.min.js"></script>
    <script src="../Assets/Templates/Main/js/mixitup.min.js"></script>
    <script src="../Assets/Templates/Main/js/owl.carousel.min.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.nice-select.min.js"></script>
    <script src="../Assets/Templates/Main/js/slick.min.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.counterup.min.js"></script>
    <script src="../Assets/Templates/Main/js/waypoints.min.js"></script>
    <script src="../Assets/Templates/Main/js/contact.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.ajaxchimp.min.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.form.js"></script>
    <script src="../Assets/Templates/Main/js/jquery.validate.min.js"></script>
    <script src="../Assets/Templates/Main/js/mail-script.js"></script>
    <script src="../Assets/Templates/Main/js/custom.js"></script>
</body>
</html>

 <!--::footer_part:-->
    <?php include("Footer.php"); ?>