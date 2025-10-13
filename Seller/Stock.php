<?php

include("../Assets/Connection/Connection.php");
session_start();

if(isset($_POST["btn_submit"]))
	{
	$name=$_POST["txt_stock"];
	
	$InsQry="insert into tbl_stock (stock_count,stock_date,product_id) values('".$name."',curdate(),'".$_GET["pid"]."')";
	if($con->query($InsQry))
	{
		?>
		 <script>
		 alert("New Stock has been added")
		 //window.location="Stock.php?pid=<?php echo $_GET['pid'] ?>";
         window.location="ViewProduct.php";
		</script>
        
        <?php
		}
        else
        {
        ?>
        <script>
		alert("Something has wrong")
		window.location="Stock.php";
		</script>
        <?php
        }
     } 
	 	if(isset($_GET['delId']))
	{
		$DelQry="delete from tbl_stock where stock_id='".$_GET['delId']."'";
		if($con->query($DelQry))
		{
			?>
            <script>
			alert("Stock has been removed ")
			window.location="Stock.php?pid=<?php echo $_GET['pid'] ?>"
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
    <title>Manage Stock - DecoNest</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-blend-mode: overlay;
            background-color: rgba(248, 249, 250, 0.92);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
            background-color: rgba(255, 255, 255, 0.95);
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0 !important;
            font-weight: 600;
            color: #5a5a5a;
        }
        
        .form-control {
            border-radius: 5px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #c8a97e;
            box-shadow: 0 0 0 0.25rem rgba(200, 169, 126, 0.25);
        }
        
        .btn-primary {
            background-color: #c8a97e;
            border-color: #c8a97e;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #b89768;
            border-color: #b89768;
        }
        
        .btn-outline-danger {
            border-radius: 5px;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #5a5a5a;
            background-color: #f8f5f0;
        }
        
        .page-title {
            color: #5a5a5a;
            font-weight: 600;
            margin-bottom: 25px;
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
        
        .main-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        
        .stock-badge {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 4px;
        }
        
        .action-buttons a {
            margin-right: 8px;
        }
        
        .section-title {
            font-size: 1.2rem;
            color: #5a5a5a;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .back-link {
            color: #c8a97e;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            display: inline-block;
        }
        
        .back-link:hover {
            color: #b89768;
            text-decoration: underline;
        }
        
        .stock-table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(200, 169, 126, 0.05);
        }
    </style>
</head>
<body>
    <!-- Header inclusion -->
    <?php include('Header.php'); ?>

    <div class="container main-container">
        <a href="ViewProduct.php" class="back-link"><i class="fas fa-arrow-left me-2"></i>Back to Products</a>
        <h2 class="page-title">Manage Product Stock</h2>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add New Stock</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" name="form1" id="form1">
                            <div class="mb-3">
                                <label for="txt_stock" class="form-label">Stock Quantity</label>
                                <input type="text" class="form-control" name="txt_stock" id="txt_stock" 
                                       pattern="^[0-9]+$"
                                       title="Stock must be a whole number e.g., 199 or 199 (no decimals)."
                                       placeholder="Enter quantity to add" required>
                                <div class="form-text">Enter the number of items you're adding to inventory.</div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Add Stock
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Stock Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light p-3 rounded-circle me-3">
                                <i class="fas fa-boxes text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Current Stock Status</h6>
                                <p class="text-muted mb-0">Manage your inventory levels</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light p-3 rounded-circle me-3">
                                <i class="fas fa-history text-info" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Stock History</h6>
                                <p class="text-muted mb-0">Track all stock additions</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="bg-light p-3 rounded-circle me-3">
                                <i class="fas fa-exclamation-triangle text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Important Note</h6>
                                <p class="text-muted mb-0">Deleting stock records is permanent</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-12">
                <h5 class="section-title">Stock History</h5>
                
                <div class="table-responsive stock-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL.NO</th>
                                <th>Stock Added</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $SelQry = "select * from tbl_stock s inner join tbl_product p on s.product_id = p.product_id where s.product_id = '".$_GET['pid']."'";
                            $row = $con->query($SelQry);
                            while($data = $row->fetch_assoc()) {
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td>
                                    <span class="stock-badge bg-success text-white">
                                        +<?php echo $data["stock_count"] ?> units
                                    </span>
                                </td>
                                <td><?php echo date('M j, Y', strtotime($data['stock_date'])) ?></td>
                                <td>
                                    <a href="Stock.php?delId=<?php echo $data['stock_id']?>&pid=<?php echo $_GET["pid"];?>" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Are you sure you want to remove this stock entry?')">
                                        <i class="fas fa-trash-alt me-1"></i> Remove
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            
                            <?php if($i == 0) { ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                                    No stock records found. Add your first stock entry above.
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../Assets/Templates/Main/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="../Assets/Templates/Main/js/all.js"></script>
</body>
</html>