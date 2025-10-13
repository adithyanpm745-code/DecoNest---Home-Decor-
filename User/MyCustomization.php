<?php
include("../Assets/Connection/Connection.php");
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Customization</title>
<!-- Add Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        background: url('https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .container-custom {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    
    .page-title {
        color: #5a5a5a;
        font-weight: 600;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #c8a97e;
        position: relative;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background-color: #c8a97e;
    }
    
    .custom-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .card-header-custom {
        background: linear-gradient(to right, #f8f5f0, #e9e1d2);
        border-bottom: 1px solid #e9e1d2;
        padding: 15px 20px;
        font-weight: 600;
        color: #5a5a5a;
    }
    
    .seller-info {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    
    .status-badge {
        padding: 8px 15px;
        border-radius: 30px;
        font-weight: 500;
        font-size: 0.85rem;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-accepted {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .status-completed {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    
    .btn-custom {
        background-color: #c8a97e;
        border: none;
        color: white;
        padding: 8px 20px;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .btn-custom:hover {
        background-color: #b8976a;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(200, 169, 126, 0.3);
    }
    
    .custom-img {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .custom-img:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
    
    .content-box {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #c8a97e;
    }
    
    .amount-display {
        font-size: 1.5rem;
        font-weight: 600;
        color: #c8a97e;
    }
    
    @media (max-width: 768px) {
        .container-custom {
            padding: 15px;
        }
    }
</style>
</head>

<body>
<?php include("Header.php"); ?>

<div class="container container-custom">
    <h2 class="page-title">My Customization Requests</h2>
    
    <div class="row">
        <?php
        $i = 0;
        $SelQry = "select * from tbl_customization c inner join tbl_seller s on c.seller_id=s.seller_id 
        inner join tbl_colour col on c.colour_id=col.colour_id inner join tbl_material m on c.material_id=m.material_id 
        where c.user_id='".$_SESSION['uid']."' group by c.customization_id ORDER BY c.customization_id DESC";
        $row = $con->query($SelQry);
        
        if($row->num_rows > 0) {
            while($data = $row->fetch_assoc()) {
                $i++;
                
                // Determine status class
                $statusClass = "";
                $statusText = "";
                
                if($data['customization_status'] == 1) {
                    $statusClass = "status-accepted";
                    $statusText = "Accepted";
                } else if($data['customization_status'] == 2) {
                    $statusClass = "status-rejected";
                    $statusText = "Rejected";
                } else if($data['customization_status'] == 3) {
                    $statusClass = "status-completed";
                    $statusText = "Payment Completed";
                } else if($data['customization_status'] == 4) {
                    $statusClass = "status-completed";
                    $statusText = "Product Packed";
                } else if($data['customization_status'] == 5) {
                    $statusClass = "status-completed";
                    $statusText = "Product Shipped";
                } else if($data['customization_status'] == 6) {
                    $statusClass = "status-completed";
                    $statusText = "Order Completed";
                } else {
                    $statusClass = "status-pending";
                    $statusText = "Pending";
                }
        ?>
        
        <div class="col-md-12 mb-4">
            <div class="card custom-card">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <span>Customization #<?php echo $i; ?></span>
                    <span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="seller-info">
                                <h6 class="mb-3"><i class="fas fa-store mr-2"></i>Seller Details</h6>
                                <p class="mb-1"><strong>Name:</strong> <?php echo $data['seller_name']; ?></p>
                                <p class="mb-1"><strong>Email:</strong> <?php echo $data['seller_email']; ?></p>
                                <p class="mb-1"><strong>Address:</strong> <?php echo $data['seller_address']; ?></p>
                                <p class="mb-0"><strong>Contact:</strong> <?php echo $data['seller_contact']; ?></p>
                            </div>
                            
                            <div class="mt-3">
                                <p class="mb-1"><strong>Date:</strong> <?php echo $data['customization_date']; ?></p>
                                <p class="amount-display mb-0">₹<?php echo $data['customization_amount']; ?></p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="content-box mb-3">
                                <h6><i class="fas fa-file-alt mr-2"></i>Customization Details</h6>
                                <p class="mb-0">Colour : <?php echo $data['colour_name']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                 Material : <?php echo $data['material_name']; ?></p>
                                <p class="mb-0">Details : <?php echo $data['customization_content']; ?></p>
                            </div>
                            
                            <div class="text-center">
                                <img src="../Assets/Files/CustomizationDocs/<?php echo $data['customization_file']; ?>" 
                                     class="custom-img img-fluid" width="150" height="150" alt="Customization Image" />
                            </div>
                        </div>
                        
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <?php
                                if($data['customization_status'] == 1) {
                                ?>
                                <a href="CustomPayment.php?cid=<?php echo $data['customization_id']; ?>" 
                                   class="btn btn-custom btn-lg">
                                    <i class="fas fa-credit-card mr-2"></i>Make Payment
                                </a>
								<?php
                                } else if($data['customization_status'] >= 6) {
                                ?>
                                <div class="alert alert-info mt-3">
                                    <i class=""></i>
                                    Your Order Completed
                                </div>
                                <a href='CustomBill.php?Cid=<?php echo $data['customization_id']; ?>' class='btn btn-outline-success action-btn'>
                                 <i class="fas fa-file-invoice me-2"></i>Download Invoice </a>
                                <?php
                                } else if($data['customization_status'] >= 3) {
                                ?>
                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Your order is being processed
                                </div>
                                <a href='CustomBill.php?Cid=<?php echo $data['customization_id']; ?>' class='btn btn-outline-success action-btn'>
                                 <i class="fas fa-file-invoice me-2"></i>Download Invoice </a>
                                <?php
                                } else if($data['customization_status'] == 2) {
                                ?>
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    This request has been rejected
                                </div>
                                <?php
                                } else {
                                ?>
                                <div class="alert alert-secondary mt-3">
                                    <i class="fas fa-clock mr-2"></i>
                                    Waiting for seller response
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            }
        } else {
        ?>
        <div class="col-12 text-center py-5">
            <i class="fas fa-clipboard-list fa-4x mb-3 text-muted"></i>
            <h4 class="text-muted">No Customization Requests Found</h4>
            <p>You haven't made any customization requests yet.</p>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>
</html>

 <!--::footer_part:-->
    <?php include("Footer.php"); ?>