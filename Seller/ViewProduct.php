<?php
include("../Assets/Connection/Connection.php");
session_start();
include('Header.php');
if(isset($_POST["btn_submit"]))
	{
		$name=$_POST["txt_name"];
		$details=$_POST["txt_details"];
		$price=$_POST["txt_price"];
		$subcategory=$_POST["sel_subcategory"];
		$colour=$_POST["sel_colour"];
		$material=$_POST["sel_material"];
	
		
		
		$photo=$_FILES["file_photo"]['name'];
		$path=$_FILES["file_photo"]['tmp_name'];
		move_uploaded_file($path,'../Assets/Files/ProductDocs/'.$photo);
		
		$InsQry="insert into tbl_product(product_name,product_details,product_price,product_photo,subcategory_id,colour_id,material_id,product_date,seller_id) 
		values('".$name."','".$details."','".$price."','".$photo."','".$subcategory."','".$colour."','".$material."',curdate(),'".$_SESSION["sid"]."')";
		if($con->query($InsQry))
		{
			?>
        <script>
		alert("Product added successfully");
		window.location="ViewProduct.php";
		</script>
        <?php	
		}
		else
		{
			?>
        <script>
		alert("Something has wrong")
		window.location="ViewProduct.php";
		</script>
        <?php
		}
	}
	if(isset($_GET['delId']))
	{
		$DelQry="delete from tbl_product where product_id='".$_GET['delId']."'";
		if($con->query($DelQry))
		{
			?>
            <script>
			alert("The Product was removed from the list")
			window.location="ViewProduct.php"
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
    <title>Manage Products - DecoNest</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-blend-mode: overlay;
            background-color: rgba(248, 249, 250, 0.9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .form-control, .form-select {
            border-radius: 5px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
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
        
        .btn-outline-primary {
            color: #c8a97e;
            border-color: #c8a97e;
            border-radius: 5px;
        }
        
        .btn-outline-primary:hover {
            background-color: #c8a97e;
            color: #fff;
        }
        
        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #5a5a5a;
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
        
        .action-buttons a {
            margin-right: 8px;
        }
        
        .badge-success {
            background-color: #28a745;
        }
        
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        
        /* Custom file upload button */
        .custom-file-upload {
            border: 1px solid #ddd;
            border-radius: 5px;
            display: inline-block;
            padding: 10px 15px;
            cursor: pointer;
            background-color: #f8f9fa;
            width: 100%;
            text-align: center;
            transition: all 0.3s;
        }
        
        .custom-file-upload:hover {
            background-color: #e9ecef;
        }
        
        input[type="file"] {
            display: none;
        }
        
        .section-title {
            font-size: 1.2rem;
            color: #5a5a5a;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
        }
    </style>
</head>
<body>
    <!-- Header inclusion -->
    <?php include('Header.php'); ?>

    <div class="container main-container">
        <a href="Product.php" class="back-link"><i class="fas fa-arrow-left me-2"></i>Back to Add Products</a><br><br>
        <h2 class="page-title"> Your Products</h2>
        
        
        <div class="row mt-4">
            <div class="col-lg-12">
                <h5 class="section-title"> Product List</h5>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>SL.NO</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Colour</th>
                                <th>Materials</th>
                                <th>Date Added</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $SelQry = "select * from tbl_product p 
                                      inner join tbl_subcategory s on p.subcategory_id = s.subcategory_id 
                                      inner join tbl_category ca on s.category_id = ca.category_id
                                      inner join tbl_colour c on p.colour_id = c.colour_id 
                                      inner join tbl_material m on p.material_id = m.material_id 
                                      where seller_id = '".$_SESSION['sid']."' order by p.product_id desc";
                            
                            $row = $con->query($SelQry);
                            while($data = $row->fetch_assoc()) {
                                $i++;

    //                             $rows=$con->query($SelQry);
	// while($data=$rows->fetch_assoc())
	// {
	// 	$i++;

		 $selstock = "SELECT sum(stock_count) as stock FROM tbl_stock WHERE product_id='" . $data["product_id"] . "'";
        $selstock1 = "SELECT sum(cart_quantity) as cart_qty FROM tbl_cart WHERE product_id='" . $data["product_id"] . "' AND cart_status > 0";
        $stockRes = $con->query($selstock)->fetch_assoc();
        $cartRes = $con->query($selstock1)->fetch_assoc();

        $totalStock = $stockRes['stock'] ? $stockRes['stock'] : 0;
        $totalCart = $cartRes['cart_qty'] ? $cartRes['cart_qty'] : 0;
        $remaining = $totalStock - $totalCart;

	?>
                        
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><img src="../Assets/Files/ProductDocs/<?php echo $data['product_photo'] ?>" class="product-img" alt="Product Image"></td>
                                <td><?php echo $data['product_name'] ?></td>
                                <td><?php echo $data['product_details'] ?></td>
                                <td>₹<?php echo $data['product_price'] ?></td>
                                <td><?php echo $data['category_name'] ?></td>
                                <td><?php echo $data['subcategory_name'] ?></td>
                                <td><?php echo $data['colour_name'] ?></td>
                                <td><?php echo $data['material_name'] ?></td>
                                <td><?php echo date('d M Y', strtotime($data['product_date'])) ?></td>
                                
                                <td class="action-buttons">
                                    

                                    
	   <?php if ($remaining > 0) { ?>
        Remining Stock: <?php echo $remaining; ?><br><br>
           <a href="Stock.php?pid=<?php echo $data['product_id'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-boxes"></i> Add Stock
                                    </a><br><br>
        <?php } else { ?>
          <span style="color:red;">Out of Stock</span><br><br>
           <a href="Stock.php?pid=<?php echo $data['product_id'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-boxes"></i> Add Stock
                                    </a>
        <?php } ?>          
                                </td>
                                    <td><br><br>&nbsp;&nbsp;&nbsp;
                                    <a href="Product.php?delId=<?php echo $data['product_id'] ?>" class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a><br><br>
                                    <a href="Gallery.php?pid=<?php echo $data['product_id'] ?>" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-images"></i> Add Gallery
                                    </a>
                                </td>
                            </tr>
                             <?php } ?> 
                        </tbody>
                        <?php
	
	?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../Assets/Templates/Main/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="../Assets/JQ/jQuery.js"></script>
    
    <script>
        function AjaxPlace(catId) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxSubCategory.php?catId=" + catId,
                success: function(html) {
                    $("#sel_subcategory").html(html);
                }
            });
        }
        
        // Show selected file name
        document.getElementById('file_photo').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            document.getElementById('selectedFileName').textContent = 'Selected file: ' + fileName;
        });
    </script>
</body>
</html>