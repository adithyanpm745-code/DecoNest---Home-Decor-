<?php
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_GET['reject']))
{
	$UpQry="update tbl_customization set customization_status=2 where customization_id='".$_GET['reject']."'";
		if($con->query($UpQry))
		{
 		 ?>
  			<script>
  			alert("Reject");
 			 window.location="ViewCustomization.php";
			 </script>	
 		<?php
		}
}
if(isset($_GET['ProductPacked']))
{
	$UpQry="update tbl_customization set customization_status=4 where customization_id='".$_GET['ProductPacked']."'";
		if($con->query($UpQry))
		{
 		 ?>
  			<script>
  			alert("Product Packed");
 			 window.location="ViewCustomization.php";
			 </script>	
 		<?php
		}
}
if(isset($_GET['ProductShipped']))
{
	$UpQry="update tbl_customization set customization_status=5 where customization_id='".$_GET['ProductShipped']."'";
		if($con->query($UpQry))
		{
 		 ?>
  			<script>
  			alert("Product Shipped");
 			 window.location="ViewCustomization.php";
			 </script>	
 		<?php
		}
}
if(isset($_GET['OrderCompleted']))
{
	$UpQry="update tbl_customization set customization_status=6 where customization_id='".$_GET['OrderCompleted']."'";
		if($con->query($UpQry))
		{
 		 ?>
  			<script>
  			alert("Order Completed");
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
    <title>User Customization List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- Custom Styles -->
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .overlay {
            background-color: rgba(255, 255, 255, 0.16);
            min-height: 100vh;
        }
        
        .page-title {
            color: #5a5a5a;
            font-weight: 600;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #c8a97e;
            display: inline-block;
        }
        
        .customization-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .customization-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .card-header-custom {
            background: linear-gradient(to right, #f8f5f0, #e9e1d3);
            padding: 15px 20px;
            border-bottom: 1px solid #e0d9c7;
        }
        
        .user-details {
            color: #5a5a5a;
        }
        
        .user-details strong {
            color: #c8a97e;
        }
        
        .customization-content {
            padding: 20px;
            color: #5a5a5a;
            line-height: 1.6;
        }
        
        .customization-image {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 5px;
            background: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .action-btn {
            padding: 6px 15px;
            border-radius: 4px;
            font-weight: 500;
            margin: 0 5px 5px 0;
            transition: all 0.2s ease;
        }
        
        .btn-accept {
            background-color: #28a745;
            color: white;
            border: none;
        }
        
        .btn-accept:hover {
            background-color: #218838;
            color: white;
        }
        
        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        
        .btn-reject:hover {
            background-color: #c82333;
            color: white;
        }
        
        .btn-action {
            background-color: #c8a97e;
            color: white;
            border: none;
        }
        
        .btn-action:hover {
            background-color: #b4986e;
            color: white;
        }
        
        .amount-display {
            font-size: 1.2rem;
            font-weight: 600;
            color: #c8a97e;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 0;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 5rem;
            margin-bottom: 20px;
            color: #dee2e6;
        }
    </style>
</head>
<body>
    <!-- Header inclusion -->
    <?php include('Header.php'); ?>
    
    <div class="overlay">
        <div class="container py-5">
            <h2 class="page-title">Customization Requests</h2>
            
            <?php
            $i = 0;
            $SelQry = "select * from tbl_customization c inner join tbl_user u on c.user_id=u.user_id 
            inner join tbl_colour col on c.colour_id=col.colour_id inner join tbl_material m on c.material_id=m.material_id 
            where c.seller_id='".$_SESSION['sid']."' ORDER BY c.customization_id DESC";
            $row = $con->query($SelQry);
            
            if($row->num_rows > 0) {
                while($data = $row->fetch_assoc()) {
                    $i++;
            ?>
            <div class="customization-card">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Customization #<?php echo $i; ?></h5>
                        <class="text-muted">Requested on: <?php echo date('M j, Y', strtotime($data['customization_date'])); ?>
                    </div>
                    <div>
                        <?php
                        $status_class = "";
                        if($data['customization_status'] == 1) {
                            $status_text = "Accepted";
                            $status_class = "bg-success";
                        } else if($data['customization_status'] == 2) {
                            $status_text = "Rejected";
                            $status_class = "bg-danger";
                        } else if($data['customization_status'] == 3) {
                            $status_text = "Payment Completed";
                            $status_class = "bg-info";
                        } else if($data['customization_status'] == 4) {
                            $status_text = "Product Packed";
                            $status_class = "bg-warning";
                        } else if($data['customization_status'] == 5) {
                            $status_text = "Product Shipped";
                            $status_class = "bg-primary";
                        } else if($data['customization_status'] == 6) {
                            $status_text = "Order Completed";
                            $status_class = "bg-success";
                        } else {
                            $status_text = "Pending";
                            $status_class = "bg-secondary";
                        }
                        ?>
                        <span class="status-badge <?php echo $status_class; ?> text-white"><?php echo $status_text; ?></span>
                    </div>
                </div>
                
                <div class="customization-content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h6 class="text-muted">USER DETAILS</h6>
                                <div class="user-details pl-3">
                                    <div><strong>Name:</strong> <?php echo $data['user_name']; ?></div>
                                    <div><strong>Email:</strong> <?php echo $data['user_email']; ?></div>
                                    <div><strong>Address:</strong> <?php echo $data['user_address']; ?></div>
                                    <div><strong>Contact:</strong> <?php echo $data['user_contact']; ?></div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h6 class="text-muted">CUSTOMIZATION REQUEST</h6>
                                <p class="pl-3">Colour : <?php echo $data['colour_name']; ?></p>
                                <p class="pl-3">Material : <?php echo $data['material_name']; ?></p>
                                <p class="pl-3">Details : <?php echo $data['customization_content']; ?></p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-4 text-center">
                                <h6 class="text-muted">REFERENCE IMAGE</h6>
                                <img src="../Assets/Files/CustomizationDocs/<?php echo $data['customization_file']; ?>" 
                                     class="customization-image img-fluid" 
                                     alt="Customization Reference" 
                                     style="max-height: 200px;">
                            </div>
                            
                            <div class="text-center">
                                <h6 class="text-muted">AMOUNT</h6>
                                <div class="amount-display">₹<?php echo $data['customization_amount']; ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="text-muted mb-3">ACTIONS</h6>
                        <div class="d-flex flex-wrap">
                            <?php
                            if($data['customization_status'] == 0) {
                            ?>
                                <a href="Amount.php?accept=<?php echo $data['customization_id']; ?>" class="btn btn-accept action-btn">
                                    <i class="fas fa-check-circle mr-1"></i> Accept
                                </a>
                                <a href="ViewCustomization.php?reject=<?php echo $data['customization_id']; ?>" class="btn btn-reject action-btn">
                                    <i class="fas fa-times-circle mr-1"></i> Reject
                                </a>
                            <?php
                            } else if($data['customization_status'] == 3) {
                            ?>
                                <a href="ViewCustomization.php?ProductPacked=<?php echo $data['customization_id']; ?>" class="btn btn-action action-btn">
                                    <i class="fas fa-box mr-1"></i> Product Packed
                                </a>
                            <?php
                            } else if($data['customization_status'] == 4) {
                            ?>
                                <a href="ViewCustomization.php?ProductShipped=<?php echo $data['customization_id']; ?>" class="btn btn-action action-btn">
                                    <i class="fas fa-shipping-fast mr-1"></i> Product Shipped
                                </a>
                            <?php
                            } else if($data['customization_status'] == 5) {
                            ?>
                                <a href="ViewCustomization.php?OrderCompleted=<?php echo $data['customization_id']; ?>" class="btn btn-action action-btn">
                                    <i class="fas fa-check-double mr-1"></i> Order Completed
                                </a>
                            <?php
                            } else {
                                echo '<span class="text-muted">No actions available at this stage</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
            ?>
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>No Customization Requests</h3>
                <p>You don't have any customization requests at this time.</p>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="../Assets/Templates/Main/js/jquery-3.4.1.min.js"></script>
    <script src="../Assets/Templates/Main/js/popper.min.js"></script>
    <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
</body>
</html>