
<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Products - DecoNest</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
* {
    font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.products-hero {
    background: linear-gradient(rgba(127, 143, 219, 0.9), rgba(118, 75, 162, 0.9)),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
    background-size: cover;
    background-position: center;
    color: white;
    text-align: center;
    padding: 80px 0 60px 0;
    margin-bottom: 40px;
    border-radius: 0 0 50px 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.products-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.products-hero p {
    font-size: 1.3rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

.filter-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.filter-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 25px;
    text-align: center;
    font-size: 1.5rem;
}

.form-select, .form-control {
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    padding: 9px 14px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
}

.form-select:focus, .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    background: white;
}

.filter-label {
    font-weight: 500;
    color: #555;
    margin-bottom: 8px;
}

.products-grid {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.product-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: none;
    margin-bottom: 30px;
    height: 95%;
}

.product-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
}

.product-image {
    position: relative;
    overflow: hidden;
    height: 250px;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

.product-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-body {
    padding: 25px;
}

.product-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    line-height: 1.3;
}

.product-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
    margin-bottom: 15px;
}

.product-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 20px;
}

.detail-item {
    display: flex;
    align-items: center;
    font-size: 13px;
    color: #666;
}

.detail-item i {
    margin-right: 8px;
    color: #667eea;
    width: 16px;
}

.rating-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 10px;
}

.rating-stars {
    margin-right: 10px;
}

.rating-stars i {
    font-size: 16px;
    margin-right: 2px;
}

.action-buttons {
    display: flex;
    gap: 10px;
}

.btn-custom {
    flex: 1;
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-primary-custom {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, #5a6fd8, #6a4190);
    transform: translateY(-2px);
    color: white;
}

.btn-outline-custom {
    background: transparent;
    border: 2px solid #667eea;
    color: #667eea;
}

.btn-outline-custom:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

.out-of-stock {
    background: #dc3545;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    width: 100%;
}

.search-container {
    position: relative;
}

.search-container i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
}

.search-container input {
    padding-left: 45px;
}

@media (max-width: 768px) {
    .products-hero h1 {
        font-size: 2.5rem;
    }
    
    .products-hero p {
        font-size: 1.1rem;
    }
    
    .filter-container {
        padding: 20px;
    }
    
    .product-details {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>
</head>

<body>
    <!-- Hero Section -->
    <div class="products-hero">
        <div class="container">
            <h1><i class="fas fa-store"></i> Our Products</h1>
            <p>Discover beautiful home decor items to transform your space</p>
        </div>
    </div>

    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <!-- Filter Section -->
            <div class="filter-container">
                <h3 class="filter-title"><i class="fas fa-filter"></i> Find Your Perfect Decor</h3>
                <div class="row g-3">
                    <div class="col-md-6 col-lg-2">
                        <label class="filter-label">Category</label>
                        <select name="sel_category" id="sel_category" class="form-select" onChange="getSubcategory(this.value),AjaxSearch()">
                            <option value="">All Categories</option>
                            <?php
                            $sel="select * from tbl_category";
                            $res=$con->query($sel);
                            while($data=$res->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $data["category_id"]?>">
                            <?php echo $data["category_name"]?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="col-md-6 col-lg-2">
                        <label class="filter-label">SubCategory</label>
                        <select name="sel_subcategory" id="sel_subcategory" class="form-select" onChange="AjaxSearch()">
                            <option value="">All SubCategories</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 col-lg-2">
                        <label class="filter-label">Colour</label>
                        <select name="sel_colour" id="sel_colour" class="form-select" onChange="AjaxSearch()">
                            <option value="">All Colours</option>
                            <?php
                            $sel="select * from tbl_colour";
                            $res=$con->query($sel);
                            while($data=$res->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $data["colour_id"]?> ">
                            <?php echo $data["colour_name"]?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="col-md-6 col-lg-2">
                        <label class="filter-label">Material</label>
                        <select name="sel_material" id="sel_material" class="form-select" onChange="AjaxSearch()">
                            <option value="">All Materials</option>
                            <?php
                            $sel="select * from tbl_material";
                            $res=$con->query($sel);
                            while($data=$res->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $data["material_id"]?> ">
                            <?php echo $data["material_name"]?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="col-md-12 col-lg-4">
                        <label class="filter-label">Search Products</label>
                        <div class="search-container">
                            <i class="fas fa-search"></i>
                            <input type="text" name="txt_name" id="txt_name" class="form-control" placeholder="Search by product name..." onkeyup="AjaxSearch()">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                <div id="search">
                    <div class="row">
                        <?php
                        $i=0;
                        $SelQry="select * from tbl_product p 
                        inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
                        inner join tbl_category ca on s.category_id=ca.category_id
                        inner join tbl_colour c on p.colour_id=c.colour_id 
                        inner join tbl_material m on p.material_id=m.material_id 
                        inner join tbl_seller se on p.seller_id=se.seller_id where seller_status=1 and seller_status=1 order by p.product_id desc";

                        $rows=$con->query($SelQry);
                        while($data=$rows->fetch_assoc())
                        {
                            $i++;

                            $selstock = "SELECT sum(stock_count) as stock FROM tbl_stock WHERE product_id='" . $data["product_id"] . "'";
                            $selstock1 = "SELECT sum(cart_quantity) as cart_qty FROM tbl_cart WHERE product_id='" . $data["product_id"] . "' AND cart_status > 0";
                            $stockRes = $con->query($selstock)->fetch_assoc();
                            $cartRes = $con->query($selstock1)->fetch_assoc();

                            $totalStock = $stockRes['stock'] ? $stockRes['stock'] : 0;
                            $totalCart = $cartRes['cart_qty'] ? $cartRes['cart_qty'] : 0;
                            $remaining = $totalStock - $totalCart;

                            // Rating calculation (unchanged PHP logic)
                            $average_rating = 0;
                            $total_review = 0;
                            $five_star_review = 0;
                            $four_star_review = 0;
                            $three_star_review = 0;
                            $two_star_review = 0;
                            $one_star_review = 0;
                            $total_user_rating = 0;
                            $review_content = array();

                            $query = "SELECT * FROM tbl_review where product_id = '".$data["product_id"]."' ORDER BY review_id DESC";
                            $result = $con->query($query);

                            while($row = $result->fetch_assoc())
                            {
                                if($row["user_rating"] == '5') $five_star_review++;
                                if($row["user_rating"] == '4') $four_star_review++;
                                if($row["user_rating"] == '3') $three_star_review++;
                                if($row["user_rating"] == '2') $two_star_review++;
                                if($row["user_rating"] == '1') $one_star_review++;
                                $total_review++;
                                $total_user_rating = $total_user_rating + $row["user_rating"];
                            }

                            if($total_review==0 || $total_user_rating==0 )
                            {
                                $average_rating = 0;       
                            }
                            else
                            {
                                $average_rating = $total_user_rating / $total_review;
                            }
                        ?>
                        
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="product-card">
                                <div class="product-image">
                                    <?php if ($remaining <= 0) { ?>
                                        <div class="product-badge" style="background: #dc3545;">Out of Stock</div>
                                    <?php } else { ?>
                                        <div class="product-badge">In Stock</div>
                                    <?php } ?>
                                    <img src="../Assets/Files/ProductDocs/<?php echo $data['product_photo']?>" alt="<?php echo $data['product_name']?>" />
                                </div>
                                
                                <div class="card-body">
                                    <h5 class="product-title"><?php echo $data['product_name']?></h5>
                                    <div class="product-price">₹<?php echo number_format($data['product_price'])?></div>
                                    
                                    <div class="product-details">
                                        <div class="detail-item">
                                            <i class="fas fa-tag"></i>
                                            <span><?php echo $data['category_name']?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-layer-group"></i>
                                            <span><?php echo $data['subcategory_name']?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-palette"></i>
                                            <span><?php echo $data['colour_name']?></span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-cube"></i>
                                            <span><?php echo $data['material_name']?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="rating-container">
                                        <div class="rating-stars">
                                            <?php
                                            for($j=1; $j<=5; $j++) {
                                                if($j <= $average_rating) {
                                                    echo '<i class="fas fa-star" style="color:#FFD700"></i>';
                                                } else {
                                                    echo '<i class="fas fa-star" style="color:#ddd"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <small class="text-muted">(<?php echo $total_review?> reviews)</small> &nbsp;&nbsp;&nbsp;

										<?php 
										if($total_review > 0) { ?>
                                        <a href='ViewReview.php?pid=<?php echo $data['product_id']; ?>'>
                                           View Reviews
                                        </a>
										<?php } ?>
                                    
                                    </div>
                                    
                                    <div class="action-buttons">
                                        <?php if ($remaining > 0) { ?>
                                            <a href="#" onclick="AddtoCart(<?php echo $data['product_id']?>)" class="btn-custom btn-primary-custom">
                                                <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                            </a>
                                        <?php } else { ?>
                                            <div class="out-of-stock">
                                                <i class="fas fa-exclamation-triangle me-2"></i><br>Out of Stock
                                            </div>
                                        <?php } ?>
                                        
                                        <a href="ViewOneProduct.php?product=<?php echo $data['product_id']?>" class="btn-custom btn-outline-custom">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </a>
                                    </div>
                                    
                                    <!-- <div class="mt-3 text-center">
                                        <a href='ViewReview.php?pid=<?php echo $data['product_id']; ?>' class="text-decoration-none text-muted">
                                            <i class="fas fa-comments me-1"></i>View Reviews
                                        </a>
                                    </div> -->
                                </div>
                            </div>
							
                        </div>
						<br><br><br><br>
                        
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
	

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/JQ/jQuery.js"></script>

    <script>
    function getSubcategory(catId) 
    {
        $.ajax({
        url:"../Assets/AjaxPages/AjaxSubcategory.php?catId="+catId,
        success: function(html){
            $("#sel_subcategory").html(html);
        }
        });
    }
    
    function AjaxSearch()
    {
        var catId=document.getElementById("sel_category").value;
        var subId=document.getElementById("sel_subcategory").value;
        var colId=document.getElementById("sel_colour").value;
        var matId=document.getElementById("sel_material").value;
        var name = document.getElementById('txt_name').value
        
        $.ajax({
        url:"../Assets/AjaxPages/AjaxSearch.php?catId="+catId+"&subId="+subId+"&colId="+colId+"&matId="+matId+"&Morepid=0"+"&name="+name,
        success: function(html){
            $("#search").html(html);
        }
        });
    }
    
    function AddtoCart(pid)
    {
        $.ajax({url:"../Assets/AjaxPages/AjaxAddCart.php?id="+ pid,
        success:function(result)
        {
            alert(result);
            window.location="ViewProduct.php"
        }});
    }
    </script>
</body>
</html>
<div>
    
</div>
 <!--::footer_part:-->
    <?php include("Footer.php"); ?>
 


