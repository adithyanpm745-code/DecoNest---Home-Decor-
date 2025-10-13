<!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Top Products</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Managed Website</a></li>
                            <li><a href="">Manage Reputation</a></li>
                            <li><a href="">Power Tools</a></li>
                            <li><a href="">Marketing Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Brand Assets</a></li>
                            <li><a href="">Investor Relations</a></li>
                            <li><a href="">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Features</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Brand Assets</a></li>
                            <li><a href="">Investor Relations</a></li>
                            <li><a href="">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Resources</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Guides</a></li>
                            <li><a href="">Research</a></li>
                            <li><a href="">Experts</a></li>
                            <li><a href="">Agencies</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="single_footer_part">
                        <h4>Newsletter</h4>
                        <p>Heaven fruitful doesn't over lesser in days. Appear creeping
                        </p>
                        <div id="mc_embed_signup">
                            <form target="_blank"
                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="subscribe_form relative mail_part">
                                <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                    class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = ' Email Address '">
                                <button type="submit" name="submit" id="newsletter-submit"
                                    class="email_icon newsletter-submit button-contactForm">subscribe</button>
                                <div class="mt-10 info"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="index.html" target="_blank">DecoNest</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    
    <!--::footer_part:-->
    <?php include("Footer.php"); ?>






    <?php
include("../Assets/Connection/Connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Product List - DecoNest</title>
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
    background: linear-gradient(rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9)),
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

.products-grid {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    overflow-x: auto;
}

.product-table {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    width: 100%;
    min-width: 1200px;
}

.product-table th {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-weight: 600;
    padding: 20px 15px;
    text-align: center;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
}

.product-table td {
    padding: 20px 15px;
    vertical-align: middle;
    text-align: center;
    border-bottom: 1px solid #f0f0f0;
    font-size: 14px;
}

.product-table tr:hover {
    background: rgba(102, 126, 234, 0.05);
    transform: scale(1.01);
    transition: all 0.3s ease;
}

.product-image-cell {
    position: relative;
}

.product-image-cell img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.product-image-cell img:hover {
    transform: scale(1.1);
}

.product-name {
    font-weight: 600;
    color: #333;
    max-width: 150px;
    word-wrap: break-word;
}

.product-price {
    font-weight: 700;
    color: #667eea;
    font-size: 16px;
}

.category-tag {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
}

.subcategory-tag {
    background: linear-gradient(135deg, #764ba2, #667eea);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
}

.color-tag {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    background: #f8f9fa;
    color: #555;
    border: 2px solid #e9ecef;
}

.material-tag {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    background: #f8f9fa;
    color: #555;
    border: 2px solid #e9ecef;
}

.rating-display {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 5px;
}

.rating-stars {
    font-size: 16px;
}

.rating-stars i {
    margin-right: 2px;
}

.rating-link {
    color: #667eea;
    text-decoration: none;
    font-size: 12px;
    font-weight: 500;
    transition: color 0.3s ease;
}

.rating-link:hover {
    color: #764ba2;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: center;
}

.btn-custom {
    padding: 8px 16px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 12px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 120px;
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
    min-width: 120px;
}

.serial-number {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin: 0 auto;
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
    
    .product-table {
        font-size: 12px;
        min-width: 800px;
    }
    
    .product-table th,
    .product-table td {
        padding: 15px 10px;
    }
    
    .product-image-cell img {
        width: 60px;
        height: 60px;
    }
}
</style>
</head>

<body>
    <!-- Hero Section -->
    <div class="products-hero">
        <div class="container">
            <h1><i class="fas fa-list"></i> Product List</h1>
            <p>Browse and explore our complete product collection</p>
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
                        <select name="sel_category" id="sel_category" class="form-select" onChange="AjaxPlace(this.value),AjaxSearch()">
                            <option value="">Select</option>
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
                            <option value="">Select</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 col-lg-2">
                        <label class="filter-label">Colour</label>
                        <select name="sel_colour" id="sel_colour" class="form-select" onChange="AjaxSearch()">
                            <option value="">Select</option>
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
                            <option value="">Select</option>
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
                    <table class="product-table table">
                        <thead>
                            <tr>
                                <th>SL.NO</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Photo</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Colour</th>
                                <th>Material</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $SelQry="select * from tbl_product p 
                            inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
                            inner join tbl_category ca on s.category_id=ca.category_id
                            inner join tbl_colour c on p.colour_id=c.colour_id 
                            inner join tbl_material m on p.material_id=m.material_id where seller_id='".$_GET['Morepid']."' order by p.product_id desc";

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

                                // Rating calculation
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

                            <tr>
                                <td>
                                    <div class="serial-number"><?php echo $i?></div>
                                </td>
                                <td>
                                    <div class="product-name"><?php echo $data['product_name']?></div>
                                </td>
                                <td>
                                    <div class="product-price">₹<?php echo number_format($data['product_price'])?></div>
                                </td>
                                <td>
                                    <div class="product-image-cell">
                                        <img src="../Assets/Files/ProductDocs/<?php echo $data['product_photo']?>" alt="<?php echo $data['product_name']?>" />
                                    </div>
                                </td>
                                <td>
                                    <div class="category-tag"><?php echo $data['category_name']?></div>
                                </td>
                                <td>
                                    <div class="subcategory-tag"><?php echo $data['subcategory_name']?></div>
                                </td>
                                <td>
                                    <div class="color-tag"><?php echo $data['colour_name']?></div>
                                </td>
                                <td>
                                    <div class="material-tag"><?php echo $data['material_name']?></div>
                                </td>
                                <td>
                                    <div class="rating-display">
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
                                        <a href='ViewReview.php?pid=<?php echo $data['product_id']; ?>' class="rating-link">
                                            View Review
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <?php if ($remaining > 0) { ?>
                                            <a href="#" onclick="AddtoCart(<?php echo $data['product_id']?>)" class="btn-custom btn-primary-custom">
                                                <i class="fas fa-cart-plus me-1"></i>Add to Cart
                                            </a>
                                        <?php } else { ?>
                                            <div class="out-of-stock">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Out of Stock
                                            </div>
                                        <?php } ?>
                                        
                                        <a href="ViewOneProduct.php?product=<?php echo $data['product_id']?>" class="btn-custom btn-outline-custom">
                                            <i class="fas fa-eye me-1"></i>View More
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets/JQ/jQuery.js"></script>

    <script>
    function AjaxPlace(catId) 
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
        url:"../Assets/AjaxPages/AjaxSearch.php?catId="+catId+"&subId="+subId+"&colId="+colId+"&matId="+matId+"&Morepid="+<?php echo $_GET["Morepid"]?>+"&name="+name,
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
            window.location="ViewProductList.php?Morepid=<?php echo $_GET['Morepid']?>"
        }});
    }
    </script>
</body>
</html>