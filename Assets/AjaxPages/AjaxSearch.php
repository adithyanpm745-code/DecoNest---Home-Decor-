<?php
include("../Connection/Connection.php");

if($_GET["Morepid"] == 0)
{
	?>
	<div class="row">
    <?php
	if($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."'and c.colour_id='".$_GET['colId']."'
	and m.material_id='".$_GET['matId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."'and c.colour_id='".$_GET['colId']."'
	and m.material_id='".$_GET['matId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] !="" && $_GET['matId'] =="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id 
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."'
	and c.colour_id='".$_GET['colId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] =="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."'
	and  m.material_id='".$_GET['matId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where  ca.category_id='".$_GET['catId']."' and c.colour_id='".$_GET['colId']."' and m.material_id='".$_GET['matId']."' 
	and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] !="" && $_GET['matId'] =="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."' and c.colour_id='".$_GET['colId']."'
	 and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] =="" && $_GET['matId'] =="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."' and se.seller_status=1 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] =="" && $_GET['matId'] !="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."' and m.material_id='".$_GET['matId']."'
	 and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and c.colour_id='".$_GET['colId']."'and m.material_id='".$_GET['matId']."' 
	and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] =="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."'and c.colour_id='".$_GET['colId']."'and se.seller_status=1 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and m.material_id='".$_GET['matId']."' and se.seller_status=1 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where c.colour_id='".$_GET['colId']."'and m.material_id='".$_GET['matId']."' and se.seller_status=1 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] =="" && $_GET['matId'] =="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."' and se.seller_status=1 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] ==""  && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id  inner join tbl_seller se on p.seller_id=se.seller_id where
	ca.category_id='".$_GET['catId']."' and c.colour_id='".$_GET['colId']."' and se.seller_status=1 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] !=""  && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id  inner join tbl_seller se on p.seller_id=se.seller_id where
	ca.category_id='".$_GET['catId']."' and m.material_id='".$_GET['matId']."' and se.seller_status=1 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] ==""  && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id  inner join tbl_seller se on p.seller_id=se.seller_id where
	ca.category_id='".$_GET['catId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] !=""  && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	 inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	 inner join tbl_material m on p.material_id=m.material_id   inner join tbl_seller se on p.seller_id=se.seller_id where
	 c.colour_id='".$_GET['colId']."'and m.material_id='".$_GET['matId']."' and se.seller_status=1 
	 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] ==""  && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	 inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	 inner join tbl_material m on p.material_id=m.material_id   inner join tbl_seller se on p.seller_id=se.seller_id where
	 c.colour_id='".$_GET['colId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] !=""  && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	 inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	 inner join tbl_material m on p.material_id=m.material_id  inner join tbl_seller se on p.seller_id=se.seller_id
	 where m.material_id='".$_GET['matId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] ==""  && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	 inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	 inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id 
	 where ca.category_id='".$_GET['catId']."'and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] =="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where  c.colour_id='".$_GET['colId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] !="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where  m.material_id='".$_GET['matId']."' and se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] ==""  && $_GET['matId'] =="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where se.seller_status=1 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] ==""  && $_GET['matId'] =="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id inner join tbl_seller se on p.seller_id=se.seller_id
	where se.seller_status=1 ";
	}
	$rows=$con->query($SelQry);
	$i=0;
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
            </div>
        </div>
    </div>
    <br><br><br><br>
    <?php
	}
	?>
    </div>
	<?php
}
else
{
	?>
	<div class="row">
    <?php
	if($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."'and c.colour_id='".$_GET['colId']."'
	and m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."'and c.colour_id='".$_GET['colId']."'
	and m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] !="" && $_GET['matId'] =="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id  
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."'
	and c.colour_id='".$_GET['colId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] =="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."'
	and  m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where  ca.category_id='".$_GET['catId']."' and c.colour_id='".$_GET['colId']."' and m.material_id='".$_GET['matId']."' 
	and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] !="" && $_GET['matId'] =="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."' and c.colour_id='".$_GET['colId']."'
	 and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] =="" && $_GET['matId'] =="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."' and seller_id='".$_GET['Morepid']."' 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] =="" && $_GET['matId'] !="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."' and m.material_id='".$_GET['matId']."'
	 and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and c.colour_id='".$_GET['colId']."'and m.material_id='".$_GET['matId']."' 
	and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] =="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."'and c.colour_id='".$_GET['colId']."' and seller_id='".$_GET['Morepid']."' 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] !="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where c.colour_id='".$_GET['colId']."'and m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] !="" && $_GET['colId'] =="" && $_GET['matId'] =="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where ca.category_id='".$_GET['catId']."' and s.subcategory_id='".$_GET['subId']."' and seller_id='".$_GET['Morepid']."' 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] ==""  && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id   where
	ca.category_id='".$_GET['catId']."' and c.colour_id='".$_GET['colId']."' and seller_id='".$_GET['Morepid']."' 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] !=""  && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id  where
	ca.category_id='".$_GET['catId']."' and m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' 
	and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] ==""  && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id   where
	ca.category_id='".$_GET['catId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] !=""  && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	 inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	 inner join tbl_material m on p.material_id=m.material_id    where
	 c.colour_id='".$_GET['colId']."'and m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' 
	 and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] ==""  && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	 inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	 inner join tbl_material m on p.material_id=m.material_id   where
	 c.colour_id='".$_GET['colId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] !=""  && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	 inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	 inner join tbl_material m on p.material_id=m.material_id  
	 where m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] !="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] ==""  && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	 inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	 inner join tbl_material m on p.material_id=m.material_id  
	 where ca.category_id='".$_GET['catId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] !="" && $_GET['matId'] =="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where  c.colour_id='".$_GET['colId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] =="" && $_GET['matId'] !="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where  m.material_id='".$_GET['matId']."' and seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] ==""  && $_GET['matId'] =="" && $_GET['name'] !="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id 
	where  seller_id='".$_GET['Morepid']."' and product_name LIKE '".$_GET['name']."%'";
	}
	elseif($_GET['catId'] =="" && $_GET['subId'] =="" && $_GET['colId'] ==""  && $_GET['matId'] =="" && $_GET['name'] =="")
	{
		$SelQry="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
	inner join tbl_category ca on s.category_id=ca.category_id inner join tbl_colour c on p.colour_id=c.colour_id 
	inner join tbl_material m on p.material_id=m.material_id where  seller_id='".$_GET['Morepid']."'";
	}
	$rows=$con->query($SelQry);
	$i=0;
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
            </div>
        </div>
    </div>
    <br><br><br><br>
    <?php
	}
	?>
    </div>
	<?php
}
	
?>
