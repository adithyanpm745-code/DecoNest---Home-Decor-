<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product - DecoNest</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #c8a97e 0%, #d4b896 50%, #c8a97e 100%);
            --secondary-gradient: linear-gradient(135deg, #8b7355 0%, #a08668 100%);
            --accent-color: #f4f1eb;
            --text-primary: #2c2c2c;
            --text-secondary: #6c757d;
            --white: #ffffff;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --shadow-soft: 0 8px 25px rgba(0,0,0,0.1);
            --shadow-hover: 0 15px 35px rgba(0,0,0,0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #65699cff 0%, #6d7793ff 50%, #7371b3ff 100%);
            min-height: 100vh;
            color: var(--text-primary);
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Elements
        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .floating-shape {
            position: absolute;
            opacity: 0.6;
            animation: float 8s ease-in-out infinite;
        }

        .shape-1 {
            top: 10%;
            right: 10%;
            width: 120px;
            height: 120px;
            background: var(--primary-gradient);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation-delay: 0s;
        }

        .shape-2 {
            bottom: 20%;
            left: 5%;
            width: 80px;
            height: 80px;
            background: var(--secondary-gradient);
            border-radius: 50%;
            animation-delay: 2s;
        }

        .shape-3 {
            top: 50%;
            left: 15%;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, rgba(200, 169, 126, 0.3), rgba(139, 115, 85, 0.3));
            border-radius: 50%;
            animation-delay: 4s;
        }

        .shape-4 {
            top: 30%;
            right: 30%;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(244, 241, 235, 0.8), rgba(248, 245, 240, 0.8));
            border-radius: 20px;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg) scale(1);
            }
            25% { 
                transform: translateY(-20px) rotate(90deg) scale(1.1);
            }
            50% { 
                transform: translateY(-10px) rotate(180deg) scale(0.9);
            }
            75% { 
                transform: translateY(-30px) rotate(270deg) scale(1.05);
            }
        } */

        /* Main Container */
        .product-view-container {
            min-height: 100vh;
            padding: 2rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            align-items: center;
        }

        .container-fluid {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

        .product-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            position: relative;
            margin: 2rem;
            transition: var(--transition);
        }

        .product-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-5px);
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--primary-gradient);
            z-index: 1;
        }

        .product-header {
            background: linear-gradient(135deg, #fdfbf7, #f8f5f0);
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .product-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .product-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .product-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            font-weight: 400;
        }

        .product-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        .product-image-section {
            background: linear-gradient(135deg, #f8f5f0, #fdfbf7);
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .image-container {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
        }

        .image-container:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-hover);
        }

        .product-image {
            width: 280px;
            height: 280px;
            object-fit: cover;
            border-radius: 15px;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(200, 169, 126, 0.1), transparent);
            opacity: 0;
            transition: var(--transition);
        }

        .image-container:hover .image-overlay {
            opacity: 1;
        }

        .product-details-section {
            padding: 2rem;
            background: var(--white);
        }

        .detail-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(200, 169, 126, 0.1);
            transition: var(--transition);
        }

        .detail-item:hover {
            background: rgba(248, 245, 240, 0.5);
            margin: 0 -1rem;
            padding-left: 1rem;
            padding-right: 1rem;
            border-radius: 10px;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-primary);
            min-width: 120px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .detail-value {
            color: var(--text-secondary);
            flex: 1;
            font-size: 0.95rem;
        }

        .price-display {
            font-size: 1.8rem;
            font-weight: 700;
            background: var(--primary-gradient);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .rating-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .star-rating {
            display: flex;
            gap: 2px;
        }

        .star-icon {
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .star-icon:hover {
            transform: scale(1.2);
        }

        .rating-text {
            margin-left: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .gallery-link, .review-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, rgba(200, 169, 126, 0.1), rgba(139, 115, 85, 0.1));
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
            border: 1px solid rgba(200, 169, 126, 0.2);
        }

        .gallery-link:hover, .review-link:hover {
            background: var(--primary-gradient);
            color: var(--white);
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(200, 169, 126, 0.3);
        }

        .action-section {
            background: linear-gradient(135deg, #f8f5f0, #fdfbf7);
            padding: 2rem;
            text-align: center;
            border-top: 1px solid rgba(200, 169, 126, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .btn-modern {
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 150px;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-cart {
            background: var(--primary-gradient);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(68, 49, 161, 0.93);
        }

        .btn-cart:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(54, 74, 153, 0.8);
            color: var(--white);
            text-decoration: none;
        }

        .btn-buy {
            background: linear-gradient(135deg, var(--success-color), #34ce57);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-buy:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
            color: var(--white);
            text-decoration: none;
        }

        .out-of-stock {
            background: linear-gradient(135deg, var(--danger-color), #e85370);
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 15px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .in-stock {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .out-stock {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(220, 53, 69, 0.2);
        }
        
        .wishlist-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, rgba(117, 86, 87, 0.93), rgba(116, 74, 74, 0.68));
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition);
            border: 1px solid rgba(153, 56, 34, 0.56);
        }

        .wishlist-link:hover {
            background: var(--primary-gradient);
            color: var(--white);
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(196, 36, 36, 0.76);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .product-content {
                grid-template-columns: 1fr;
            }

            .product-title {
                font-size: 2rem;
            }

            .product-image {
                width: 250px;
                height: 250px;
            }

            .detail-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .detail-label {
                min-width: auto;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-modern {
                width: 100%;
                max-width: 300px;
            }
        }

        /* Loading Animation */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-decoration">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
        <div class="floating-shape shape-4"></div>
    </div>

    <div class="product-view-container">
        <div class="container-fluid">
            <?php
            $i=0;
            $SelQry="select * from tbl_product p 
            inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
            inner join tbl_category ca on s.category_id=ca.category_id
            inner join tbl_colour c on p.colour_id=c.colour_id 
            inner join tbl_material m on p.material_id=m.material_id 
            inner join tbl_seller se on p.seller_id=se.seller_id 
            where seller_status=1 and product_id='".$_GET['product']."'";

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
            ?>
            
            <div class="product-card">
                <!-- Product Header -->
                <div class="product-header">
                    <h1 class="product-title"><?php echo $data['product_name']?></h1>
                    <p class="product-subtitle">Premium Home Decor Collection</p>
                </div>

                <!-- Product Content -->
                <div class="product-content">
                    <!-- Image Section -->
                    <div class="product-image-section">
                        <div class="image-container">
                            <img src="../Assets/Files/ProductDocs/<?php echo $data['product_photo']?>" 
                                 alt="<?php echo $data['product_name']?>" 
                                 class="product-image">
                            <div class="image-overlay"></div>
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="product-details-section">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-tag"></i>
                                Price
                            </div>
                            <div class="detail-value price-display">₹<?php echo number_format($data['product_price'], 2)?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-info-circle"></i>
                                Details
                            </div>
                            <div class="detail-value"><?php echo $data['product_details']?></div>
                        </div>

                        <!-- <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-calendar-alt"></i>
                                Added Date
                            </div>
                            <div class="detail-value"><?php echo date('M d, Y', strtotime($data['product_date']))?></div>
                        </div> -->

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-layer-group"></i>
                                Category
                            </div>
                            <div class="detail-value"><?php echo $data['category_name']?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-list"></i>
                                Subcategory&nbsp;&nbsp;
                            </div>
                            <div class="detail-value"><?php echo $data['subcategory_name']?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-palette"></i>
                                Colour
                            </div>
                            <div class="detail-value"><?php echo $data['colour_name']?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-cube"></i>
                                Material
                            </div>
                            <div class="detail-value"><?php echo $data['material_name']?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-warehouse"></i>
                                Stock Status&nbsp;&nbsp;   
                            </div>
                            <div class="detail-value">
                                <?php if ($remaining > 0) { ?>
                                    <span class="stock-status in-stock">
                                        <i class="fas fa-check-circle"></i>
                                        In Stock (<?php echo $remaining; ?> available)
                                    </span>
                                <?php } else { ?>
                                    <span class="stock-status out-stock">
                                        <i class="fas fa-times-circle"></i>
                                        Out of Stock
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-star"></i>
                                Rating
                            </div>
                            <div class="detail-value">
                                <div class="rating-container">
                                    <?php
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
                                        if($row["user_rating"] == '5')
                                        {
                                            $five_star_review++;
                                        }

                                        if($row["user_rating"] == '4')
                                        {
                                            $four_star_review++;
                                        }

                                        if($row["user_rating"] == '3')
                                        {
                                            $three_star_review++;
                                        }

                                        if($row["user_rating"] == '2')
                                        {
                                            $two_star_review++;
                                        }

                                        if($row["user_rating"] == '1')
                                        {
                                            $one_star_review++;
                                        }

                                        $total_review++;
                                        $total_user_rating = $total_user_rating + $row["user_rating"];
                                    }
                                    
                                    if($total_review==0 || $total_user_rating==0 )
                                    {
                                        $average_rating = 0 ; 			
                                    }
                                    else
                                    {
                                        $average_rating = $total_user_rating / $total_review;
                                    }
                                    ?>
                                    
                                    <div class="star-rating">
                                        <?php
                                        for($star = 1; $star <= 5; $star++) {
                                            if($star <= $average_rating) {
                                                echo '<i class="fas fa-star star-icon" style="color:#FC3"></i>';
                                            } else {
                                                echo '<i class="fas fa-star star-icon" style="color:#999"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <span class="rating-text">
                                        <?php echo number_format($average_rating, 1); ?> (<?php echo $total_review; ?> reviews)
                                    </span>
                                </div>
                                
                                <?php if($total_review > 0) { ?>
                                <div style="margin-top: 0.5rem;">
                                    <a href='ViewReview.php?pid=<?php echo $data['product_id']; ?>' class="review-link">
                                        <i class="fas fa-comment-alt"></i> View Reviews
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-images"></i>
                                Gallery
                            </div>
                            <div class="detail-value">
                                <a href="ViewGallery.php?pid=<?php echo $data['product_id'] ?>" class="gallery-link">
                                    <i class="fas fa-external-link-alt"></i> View More Images
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a href="WishlistAction.php?pid=<?php echo $data['product_id']; ?>" 
   class="btn btn-danger">❤️ Wishlist</a> -->
                                        
                <!-- Action Section -->
                <div class="action-section">
                    <h3 style="margin-bottom: 1rem; color: var(--text-primary); font-family: 'Playfair Display', serif;">
                        Ready to Purchase?
                    </h3>
                    
                    <div class="action-buttons">
            <?php 
            // check if already exists
            $uid = $_SESSION['uid'];
            $pid = $_GET['product'];
            $check = "SELECT * FROM tbl_wishlist WHERE user_id='$uid' AND product_id='$pid'";
            $res = $con->query($check);
            if ($remaining > 0) { ?>
                <a href="#" onclick="AddtoCart(<?php echo $data['product_id']?>)" class="btn-modern btn-cart">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </a>
                <a href="#" onclick="BuyNow(<?php echo $data['product_id']?>)" class="btn-modern btn-buy">
                    <i class="fas fa-bolt"></i> Buy Now
                </a>
                <?php
                if($res->num_rows > 0){
                    // REMOVE from wishlist
                    ?>
                    <a href="#" onclick="AddtoWishlist(<?php echo $data['product_id']?>)" class="wishlist-link ">
                        <i class="fas fa-heart"></i> Remove from Wishlist
                    </a>
                    <?php
                } else {
                    // ADD to wishlist
                    ?>
                    <a href="#" onclick="AddtoWishlist(<?php echo $data['product_id']?>)" class="wishlist-link ">
                        <i class="bi bi-heart-fill"></i> ❤️ Add to Wishlist
                    </a>
                    <?php
                }
                ?>
            <?php } else { ?>
                <div class="out-of-stock">
                    <i class="fas fa-exclamation-triangle"></i>
                    Currently Out of Stock
                </div>
                <?php
                if($res->num_rows > 0){
                    // REMOVE from wishlist
                    ?>
                    <a href="#" onclick="AddtoWishlist(<?php echo $data['product_id']?>)" class="wishlist-link ">
                        <i class="fas fa-heart"></i> Remove from Wishlist
                    </a>
                    <?php
                } else {
                    // ADD to wishlist
                    ?>
                    <a href="#" onclick="AddtoWishlist(<?php echo $data['product_id']?>)" class="wishlist-link ">
                        <i class="bi bi-heart-fill"></i> ❤️ Add to Wishlist
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

            <?php
            }
            ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../Assets/JQ/jQuery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <script>
        function AddtoCart(pid)
        {
            $.ajax({url:"../Assets/AjaxPages/AjaxAddCart.php?id="+ pid,
            success:function(result)
            {
                alert(result);
                window.location="ViewOneProduct.php?product=<?php echo $_GET['product'] ?>"
            }});
        }
        
        function BuyNow(pid)
        {
            $.ajax({url:"../Assets/AjaxPages/AjaxAddCart.php?id="+ pid,
            success:function(result)
            {
                alert(result);
                window.location="MyCart.php"
            }});
        }

        function AddtoWishlist(pid)
        {
             $.ajax({
                 url:"../Assets/AjaxPages/WishlistAction.php?pid="+ pid,
                 success:function(result)
                 {
                    alert(result);
                     window.location="ViewOneProduct.php?product=<?php echo $_GET['product'] ?>"
                }
             });
        }

        // Add smooth loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const productCard = document.querySelector('.product-card');
            productCard.style.opacity = '0';
            productCard.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                productCard.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                productCard.style.opacity = '1';
                productCard.style.transform = 'translateY(0)';
            }, 100);

            // Add subtle parallax effect on scroll
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const shapes = document.querySelectorAll('.floating-shape');
                shapes.forEach((shape, index) => {
                    const rate = scrolled * -0.5 * (index + 1);
                    shape.style.transform = `translateY(${rate}px)`;
                });
            });
        });
    </script>
</body>
</html>

    <!-- Footer inclusion -->
    <?php include('Footer.php'); ?>