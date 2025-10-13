<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");
if(isset($_POST["btn_submit"]))
{
	$content=$_POST["txt_content"];
		
	$InsQry="insert into tbl_feedback(feedback_content,seller_id,feedback_date) values('".$content."','".$_SESSION["sid"]."',now())";
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

	$SelQry="select * from tbl_feedback f inner join tbl_seller u on f.seller_id=u.seller_id where f.seller_id='".$_SESSION['sid']."'";
	$row=$con->query($SelQry);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Feedback - DecoNest</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="none" stroke="rgba(200, 169, 126, 0.15)" stroke-width="0.5" x="0" y="0" width="100" height="100" /></svg>');
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .feedback-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .feedback-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .feedback-header {
            background: linear-gradient(135deg, #f8f5f0 0%, #ffffff 100%);
            padding: 25px;
            border-bottom: 1px solid #eae7e1;
        }
        
        .feedback-title {
            color: #5a5a5a;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .feedback-body {
            padding: 25px;
        }
        
        .form-control {
            border: 1px solid #e0d9cc;
            border-radius: 6px;
            padding: 12px 15px;
            transition: all 0.3s;
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
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #b89768;
            border-color: #b89768;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
            padding: 5px 10px;
            font-size: 0.875rem;
        }
        
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
        
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        
        .table th {
            background-color: #f8f5f0;
            color: #5a5a5a;
            font-weight: 600;
            border-top: 1px solid #eae7e1;
            padding: 12px 15px;
        }
        
        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-top: 1px solid #f1ede5;
        }
        
        .table tr:hover td {
            background-color: #fcfaf7;
        }
        
        .no-feedback {
            text-align: center;
            padding: 40px;
            color: #9e9e9e;
        }
        
        .no-feedback i {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
            color: #e0d9cc;
        }
        
        .card-title {
            color: #5a5a5a;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1ede5;
        }
        
        .text-accent {
            color: #c8a97e;
        }
    </style>
</head>
<body>
    <!--::header part start::-->
    <!-- Include your header here -->
    <!-- Header part end-->

    <div class="feedback-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="feedback-card">
                    <div class="feedback-header">
                        <h2 class="feedback-title"><i class="far fa-comment-dots text-accent mr-2"></i>Share Your Feedback</h2>
                    </div>
                    <div class="feedback-body">
                        <form id="form1" name="form1" method="post" action="">
                            <div class="form-group">
                                <label for="txt_content" class="font-weight-bold">Your Feedback</label>
                                <textarea name="txt_content" id="txt_content" class="form-control" cols="30" rows="5" required="required" placeholder="We'd love to hear your thoughts..."></textarea>
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" name="btn_submit" id="btn_submit" value="Submit Feedback" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="feedback-card">
                    <div class="feedback-header">
                        <h2 class="feedback-title"><i class="far fa-list-alt text-accent mr-2"></i>Your Previous Feedback</h2>
                    </div>
                    <div class="feedback-body">
                        <?php
                        
                        
                        if($row->num_rows > 0) {
                        ?>
                        <div class="table-responsive">
                            <table class="table">
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
                                    $i=0;
                                    while($data=$row->fetch_assoc())
                                    {
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $data['feedback_content']?></td>
                                        <td><?php echo date('M j, Y', strtotime($data['feedback_date']))?></td>
                                        <td>
                                            <a href="Feedback.php?delId=<?php echo $data['feedback_id']?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this feedback?')">
                                                <i class="far fa-trash-alt mr-1"></i> Delete
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
                            <i class="far fa-comment-slash"></i>
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
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Assets/Templates/Main/js/jquery-1.12.1.min.js"></script>
    <script src="../Assets/Templates/Main/js/popper.min.js"></script>
    <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
</body>
</html>