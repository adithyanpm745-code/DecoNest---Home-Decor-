<?php
include("../Assets/Connection/Connection.php");
session_start();
include('SideBar.php');

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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #c8a97e;
            --primary-dark: #b89768;
            --secondary-color: #5a5a5a;
            --light-bg: #f8f9fa;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            background-color: var(--light-bg);
            background-image: url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1750&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-blend-mode: overlay;
            background-color: rgba(248, 249, 250, 0.92);
            font-family: 'Poppins', sans-serif;
            color: #333;
            min-height: 100vh;
        }
        
        .deconest-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .deconest-card {
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            border: none;
            margin-bottom: 25px;
            transition: var(--transition);
            overflow: hidden;
        }
        
        .deconest-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .deconest-card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-bottom: none;
            padding: 15px 25px;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .deconest-form-control, .deconest-form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: var(--transition);
            font-size: 0.95rem;
        }
        
        .deconest-form-control:focus, .deconest-form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
        }
        
        .deconest-btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(200, 169, 126, 0.3);
        }
        
        .deconest-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(200, 169, 126, 0.4);
        }
        
        .deconest-btn-outline {
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            padding: 8px 15px;
            transition: var(--transition);
        }
        
        .deconest-btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        .deconest-product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }
        
        .deconest-product-img:hover {
            transform: scale(1.05);
        }
        
        .deconest-table th {
            border-top: none;
            font-weight: 600;
            color: var(--secondary-color);
            background-color: #f8f9fa;
            padding: 15px 12px;
            border-bottom: 2px solid var(--primary-color);
        }
        
        .deconest-table td {
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .deconest-table tr:hover {
            background-color: rgba(200, 169, 126, 0.05);
        }
        
        .deconest-page-title {
            color: var(--secondary-color);
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
            font-size: 1.8rem;
        }
        
        .deconest-page-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
            border-radius: 2px;
        }
        
        .deconest-section-title {
            font-size: 1.3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
            font-weight: 600;
        }
        
        .deconest-back-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
        }
        
        .deconest-back-link:hover {
            color: var(--primary-dark);
            transform: translateX(-5px);
        }
        
        .deconest-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .deconest-badge-success {
            background-color: #28a745;
            color: white;
        }
        
        .deconest-badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        
        .deconest-badge-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .deconest-custom-file-upload {
            border: 1px dashed #ddd;
            border-radius: 8px;
            display: inline-block;
            padding: 15px;
            cursor: pointer;
            background-color: #f8f9fa;
            width: 100%;
            text-align: center;
            transition: var(--transition);
        }
        
        .deconest-custom-file-upload:hover {
            background-color: #e9ecef;
            border-color: var(--primary-color);
        }
        
        input[type="file"] {
            display: none;
        }
        
        .deconest-action-buttons a {
            margin-right: 8px;
            transition: var(--transition);
        }
        
        .deconest-action-buttons a:hover {
            transform: scale(1.1);
        }
        
        .deconest-stock-info {
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .deconest-out-of-stock {
            color: #dc3545;
            font-weight: 600;
        }
        
        /* Animation for table rows */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .deconest-table tbody tr {
            animation: fadeIn 0.5s ease forwards;
        }
        
        .deconest-table tbody tr:nth-child(even) {
            animation-delay: 0.1s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .deconest-container {
                padding: 20px 15px;
                margin-top: 15px;
                margin-bottom: 15px;
            }
            
            .deconest-page-title {
                font-size: 1.5rem;
            }
            
            .deconest-table-responsive {
                font-size: 0.85rem;
            }
            
            .deconest-product-img {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <!-- Header inclusion -->

    <div class="container deconest-container">
        <
        
        <h2 class="deconest-page-title">Shop Products</h2>
        
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="deconest-section-title">Product List</h5>
                
                <div class="table-responsive deconest-table-responsive">
                    <table class="table table-hover deconest-table">
                        <thead>
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
                                      where seller_id = '".$_SESSION['sid']."'";
                            
                            $row = $con->query($SelQry);
                            while($data = $row->fetch_assoc()) {
                                $i++;

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
                                <td>
                                    <img src="../Assets/Files/ProductDocs/<?php echo $data['product_photo'] ?>" 
                                         class="deconest-product-img" alt="Product Image">
                                </td>
                                <td><strong><?php echo $data['product_name'] ?></strong></td>
                                <td><?php echo substr($data['product_details'], 0, 50) . '...' ?></td>
                                <td><span class="badge deconest-badge" style="background-color: var(--primary-color);">₹<?php echo $data['product_price'] ?></span></td>
                                <td><?php echo $data['category_name'] ?></td>
                                <td><?php echo $data['subcategory_name'] ?></td>
                                <td><?php echo $data['colour_name'] ?></td>
                                <td><?php echo $data['material_name'] ?></td>
                                <td><?php echo date('d M Y', strtotime($data['product_date'])) ?></td>
                                
                                <td class="deconest-stock-info">
                                    <?php if ($remaining > 0) { ?>
                                        <span class="badge deconest-badge-success">In Stock: <?php echo $remaining; ?></span>
                                        <br><br>
                                        
                                    <?php } else { ?>
                                        <span class="deconest-out-of-stock">Out of Stock</span>
                                        <br><br>
                                    <?php } ?>          
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
        
        // Add animation to table rows on page load
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.deconest-table tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
            });
        });
    </script>
</body>
</html>