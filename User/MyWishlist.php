<?php
include("../Assets/Connection/Connection.php");
session_start();

if(!isset($_SESSION['uid'])){
    header("location:../Guest/Login.php");
    exit;
}

$uid = $_SESSION['uid'];
$sel = "SELECT w.wishlist_id, p.product_id, p.product_name, p.product_price, p.product_photo 
        FROM tbl_wishlist w 
        INNER JOIN tbl_product p ON w.product_id = p.product_id 
        WHERE w.user_id='$uid' order by w.wishlist_id desc";

$res = $con->query($sel);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - DecoNest</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="../Assets/JQ/jQuery.js"></script>
    
    <style>
        body {
            background-color: #f8f5f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .wl-page-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 50px 0;
            margin-bottom: 40px;
            border-bottom: 3px solid #e8e3d8;
        }
        
        .wl-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #5a4d41;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        
        .wl-title i {
            color: #c8a97e;
        }
        
        .wl-subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 1.1rem;
        }
        
        .wl-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .wl-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(200, 169, 126, 0.3);
        }
        
        .wl-img-box {
            position: relative;
            height: 280px;
            overflow: hidden;
            background: #f8f5f0;
        }
        
        .wl-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        
        .wl-card:hover .wl-img-box img {
            transform: scale(1.1);
        }
        
        .wl-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #c8a97e;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(200, 169, 126, 0.4);
        }
        
        .wl-card-body {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .wl-product-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #3d3d3d;
            margin-bottom: 15px;
            line-height: 1.4;
            min-height: 65px;
        }
        
        .wl-price {
            font-size: 2rem;
            font-weight: 700;
            color: #c8a97e;
            margin-bottom: 20px;
        }
        
        .wl-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: auto;
        }
        
        .wl-btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .wl-btn-cart {
            background-color: #3135b6ff;
            color: white;
        }
        
        .wl-btn-cart:hover {
            background-color: #776fe1ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(42, 37, 143, 0.4);
            color: white;
        }
        
        .wl-btn-view {
            background-color: #f8f5f0;
            color: #5a4d41;
            border: 2px solid #e5e1d8;
        }
        
        .wl-btn-view:hover {
            background-color: #ffffff;
            border-color: #c8a97e;
            color: #c8a97e;
            transform: translateY(-2px);
        }
        
        .wl-btn-remove {
            background-color: #fff5f5;
            color: #dc3545;
            border: 2px solid #ffe0e0;
        }
        
        .wl-btn-remove:hover {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
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
        
        .wl-empty-state {
            background: white;
            border-radius: 15px;
            padding: 80px 40px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin: 40px 0;
        }
        
        .wl-empty-icon {
            font-size: 5rem;
            color: #e5e1d8;
            margin-bottom: 25px;
        }
        
        .wl-empty-title {
            font-size: 2rem;
            font-weight: 700;
            color: #5a4d41;
            margin-bottom: 15px;
        }
        
        .wl-empty-text {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 30px;
        }
        
        .wl-btn-shop {
            background-color: #c8a97e;
            color: white;
            padding: 15px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        .wl-btn-shop:hover {
            background-color: #b8996e;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(200, 169, 126, 0.4);
            color: white;
        }
        
        .wl-count-badge {
            background-color: #c8a97e;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
            font-weight: 600;
            margin-top: 10px;
        }
        
        @media (max-width: 768px) {
            .wl-title {
                font-size: 2rem;
            }
            
            .wl-page-header {
                padding: 30px 0;
            }
            
            .wl-product-name {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <?php include('Header.php'); ?>
    
    <div class="wl-page-header">
        <div class="container">
            <h1 class="wl-title">
                <i class="fas fa-heart"></i>
                My Wishlist
            </h1>
            <p class="wl-subtitle">Your saved favorites</p>
            <?php if($res->num_rows > 0): ?>
            <div class="text-center">
                <span class="wl-count-badge">
                    <?php echo $res->num_rows; ?> Item<?php echo $res->num_rows > 1 ? 's' : ''; ?>
                </span>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="container" style="padding-bottom: 60px;">
        <?php if($res->num_rows > 0): ?>
        <div class="row" id="wishlistTable">
            <?php 
            $res->data_seek(0);
            while($data = $res->fetch_assoc()){ 
                $selstock = "SELECT sum(stock_count) as stock FROM tbl_stock WHERE product_id='" . $data["product_id"] . "'";
                            $selstock1 = "SELECT sum(cart_quantity) as cart_qty FROM tbl_cart WHERE product_id='" . $data["product_id"] . "' AND cart_status > 0";
                            $stockRes = $con->query($selstock)->fetch_assoc();
                            $cartRes = $con->query($selstock1)->fetch_assoc();

                            $totalStock = $stockRes['stock'] ? $stockRes['stock'] : 0;
                            $totalCart = $cartRes['cart_qty'] ? $cartRes['cart_qty'] : 0;
                            $remaining = $totalStock - $totalCart;
            ?>
            <div class="col-lg-4 col-md-6 mb-4" id="row_<?php echo $data['wishlist_id']; ?>">
                <div class="wl-card">
                    <div class="wl-img-box">
                        <img src="../Assets/Files/ProductDocs/<?php echo $data['product_photo']; ?>" alt="<?php echo htmlspecialchars($data['product_name']); ?>">
                        <div class="wl-badge">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <div class="wl-card-body">
                        <h3 class="wl-product-name"><?php echo htmlspecialchars($data['product_name']); ?></h3>
                        <div class="wl-price">₹<?php echo number_format($data['product_price'], 2); ?></div>
                        <div class="wl-actions">
                             <?php if ($remaining > 0) { ?>
                            <a href="#" onclick="AddtoCart(<?php echo $data['product_id']; ?>); return false;" class="wl-btn wl-btn-cart">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </a>
                            <?php } else { ?>
                                            <div class="out-of-stock">
                                                <i class="fas fa-exclamation-triangle me-2"></i><br>Out of Stock
                                            </div>
                                        <?php } ?>
                            <a href="ViewOneProduct.php?product=<?php echo $data['product_id']; ?>" class="wl-btn wl-btn-view">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                            <button onclick="removeWishlist(<?php echo $data['wishlist_id']; ?>)" class="wl-btn wl-btn-remove">
                                <i class="fas fa-trash-alt"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php else: ?>
        <div class="wl-empty-state">
            <div class="wl-empty-icon">
                <i class="fas fa-heart-broken"></i>
            </div>
            <h2 class="wl-empty-title">Your Wishlist is Empty</h2>
            <p class="wl-empty-text">Discover and save items you love for later</p>
            <a href="ViewProduct.php" class="wl-btn-shop">
                <i class="fas fa-shopping-bag"></i> Start Shopping
            </a>
        </div>
        <?php endif; ?>
    </div>

    <?php include('Footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    function removeWishlist(wid) {
        if(confirm('Are you sure you want to remove this item from your wishlist?')) {
            $.ajax({
                url: "RemoveWishlist.php?rid=" + wid,
                success: function(response) {
                    $("#row_" + wid).fadeOut(400, function() {
                        $(this).remove();
                        if($('#wishlistTable .col-lg-4').length === 0) {
                            location.reload();
                        }
                    });
                }
            });
        }
    }

    function AddtoCart(pid) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxAddCart.php?id=" + pid,
            success: function(result) {
                alert(result);
                window.location = "MyCart.php";
            }
        });
    }
    </script>
</body>
</html>