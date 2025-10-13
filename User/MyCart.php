<?php

session_start();
include("../Assets/connection/connection.php");		
include("Header.php");
?>
            
            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Your Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4a6cf7;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                        url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            line-height: 1.6;
            padding: 0;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-header {
            text-align: center;
            margin: 30px 0;
            color: var(--dark-color);
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }
        
        .page-header h1:after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            margin: 10px auto;
            border-radius: 2px;
        }
        
        .cart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .cart-items {
            flex: 1 1 65%;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
        }
        
        .cart-summary {
            flex: 1 1 30%;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            align-self: flex-start;
        }
        
        .cart-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 0.5fr 0.1fr;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .cart-item {
            display: grid;
            grid-template-columns:  100px 2fr 2fr 1.1fr 1fr;
            gap: 15px;
            padding: 20px 0;
            border-bottom: 1px solid #f1f1f1;
            align-items: center;
        }
        
        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .item-details h3 {
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: var(--dark-color);
        }
        
        .item-details p {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }
        
        .item-price {
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .item-quantity select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 80px;
        }
        
        .item-remove {
            background: var(--danger-color);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .item-remove:hover {
            background: #bd2130;
        }
        
        .item-total {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .summary-title {
            font-size: 1.3rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            color: var(--dark-color);
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.2rem;
            font-weight: 700;
            padding-top: 15px;
            margin-top: 15px;
            border-top: 2px solid #eee;
            color: var(--primary-color);
        }
        
        .checkout-btn {
            background: var(--success-color);
            color: white;
            border: none;
            padding: 15px;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 20px;
        }
        
        .checkout-btn:hover {
            background: #218838;
        }
        
        .address-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: var(--dark-color);
        }
        
        .address-form textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }
        
        .empty-cart {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .empty-cart i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-cart p {
            font-size: 1.2rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }
        
        .continue-shopping {
            display: inline-block;
            padding: 10px 20px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: background 0.3s;
        }
        
        .continue-shopping:hover {
            background: #3452ce;
        }
        
        @media (max-width: 992px) {
            .cart-container {
                flex-direction: column;
            }
            
            .cart-header {
                grid-template-columns: 2fr 1fr 1fr 0.5fr;
            }
            
            .cart-header .header-price,
            .cart-item .item-price {
                display: none;
            }
            
            .cart-item {
                grid-template-columns: 80px 2fr 1fr 0.5fr;
            }
        }
        
        @media (max-width: 576px) {
            .cart-header {
                display: none;
            }
            
            .cart-item {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 10px;
            }
            
            .item-details {
                order: 2;
            }
            
            .item-image {
                order: 1;
                margin: 0 auto;
            }
            
            .item-price {
                display: block !important;
                order: 3;
            }
            
            .item-quantity {
                order: 4;
            }
            
            .item-total {
                order: 5;
            }
            
            .item-remove {
                order: 6;
                margin: 0 auto;
            }
        }

        .buy-now {
    background: #ff9800;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s;
    margin-left: 5px;
}
.buy-now:hover {
    background: #e68900;
}

    </style>
</head>
<body>
     <?php
       
        if (isset($_POST["btn_checkout"])) {
                 
                 $amt = $_POST["carttotalamt"];
                 $address = $_POST["txt_address"];
                
	
                $selC = "select * from tbl_booking where user_id='" .$_SESSION["uid"]. "'and booking_status='0'";
                $rs = $con->query($selC);
                $row=$rs->fetch_assoc();
                 $_SESSION["bid"] = $row["booking_id"];
                
                $upQry1 = "update tbl_booking set booking_date=now(),booking_amount='".$amt."',booking_status='1',booking_address='".$address."' where user_id='" .$_SESSION["uid"]. "' and booking_status = 0";
				$con->query($upQry1);
				
				 $upQry1 = "update tbl_cart set cart_status='1' where booking_id='" .$row["booking_id"]. "'";
                if($con->query($upQry1))
                {
					
					
					
						?>
                    <script>
					window.location="Payment.php";
					</script>
                    <?php
					}
					else
					{
						?>
							<script>
                            window.location="MyBooking.php";
                            </script>
                            <?php
					}
					
                   
         		  	
					
                
                 
                
                
   
        }


    ?>
    <body onload="recalculateCart()" style="padding:0px">
    
    <div class="container">
        <div class="page-header">
            <h1>Your Shopping Cart</h1>
            <p>Review your items and proceed to checkout</p>
        </div>
        
        <?php                
        $sel = "select * from tbl_booking b inner join tbl_cart c on c.booking_id=b.booking_id where b.user_id='" .$_SESSION["uid"]. "' and booking_status='0' and cart_status=0";
        $res = $con->query($sel);
        $cart_count = $res->num_rows;
        
        if ($cart_count > 0) { 
        ?>
        <form method="post">
            <div class="cart-container">
                <div class="cart-items">
                    <div class="cart-header">
                        <div class="header-product">Product Details</div>
                        <div class="header-price">Price</div>
                        <div class="header-quantity">Quantity</div>
                        <div class="header-total">Total</div>
                        <!-- <div class="header-action">Action</div> -->
                    </div>
                    
                    <?php
                    while ($row = $res->fetch_assoc()) {
                        $selPr = "select * from tbl_product where product_id='" .$row["product_id"]. "'";
                        $respr = $con->query($selPr);
                        if ($rowpr = $respr->fetch_assoc()) {
                            $selstock = "select sum(stock_count) as stock from tbl_stock where product_id='".$rowpr["product_id"]."'";
                            $selstock1 = "select sum(cart_quantity) as quantity from tbl_cart where product_id='".$rowpr["product_id"]."' and cart_status >'0'";
                            $chk = $con->query($selstock1)->fetch_assoc();
                            $resst = $con->query($selstock);
                            if ($rowst = $resst->fetch_assoc()) {
                    ?>
                    <div class="cart-item">
                        <img src="../Assets/Files/ProductDocs/<?php echo $rowpr['product_photo']?>" 
                             alt="<?php echo $rowpr["product_name"] ?>" class="item-image">
                        <div class="item-details">
                            <h3><?php echo $rowpr["product_name"] ?></h3>
                            <p><?php echo substr($rowpr["product_details"], 0, 100) . '...' ?></p>
                        </div>
                        <div class="item-price">₹<?php echo $rowpr["product_price"] ?></div>
                        <div class="item-quantity">
                            <select id="<?php echo $row["cart_id"]?>" class="quantity-select">
                                <?php
                                for ($k = 1; $k <= ($rowst["stock"] - $chk["quantity"]); $k++) {
                                    echo '<option ' . ($row["cart_quantity"] == $k ? 'selected' : '') . ' value="' . $k . '">' . $k . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="item-total">
                            ₹<?php
                                $pr = $rowpr["product_price"];
                                $qty = $row["cart_quantity"];
                                $tot = (int)$pr * (int)$qty;
                                echo $tot;
                            ?>
                        </div>
                        <button type="button" class="item-remove" value="<?php echo $row["cart_id"] ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                                
                        <!-- one item buy to cart -->
                        <button type="button" class="buy-now" value="<?php echo $row["cart_id"] ?>">
                       <i class="fas fa-bolt"></i> Buy Now
                        </button>

                    </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
                </div>
                
                
            
            
            <div class="address-section">
                <h2 class="section-title">Shipping Address</h2>
                <?php 
                $SelQry = "select * from tbl_user where user_id='".$_SESSION["uid"]."'";
                $row = $con->query($SelQry);
                $data = $row->fetch_assoc(); 
                ?>
                <div class="address-form">
                    <textarea name="txt_address" id="txt_address" placeholder="Enter your complete shipping address" required><?php echo $data['user_address']?></textarea>
                </div>
            </div>

            <div class="cart-summary">
                    <h2 class="summary-title">Order Summary</h2>
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span id="cart-subtotal">₹0.00</span>
                    </div>
                    <div class="summary-item">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="summary-item">
                        <span>Tax</span>
                        <span>₹0.00</span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span id="cart-total">₹0.00</span>
                        <input type="hidden" id="cart-totalamt" name="carttotalamt" value=""/>
                    </div>
                    
                    <button type="submit" class="checkout-btn" name="btn_checkout">
                        <i class="fas fa-lock"></i> Proceed to Checkout
                    </button>
                </div>

        </form>
        <?php } else { ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <p>Your cart is empty</p>
            <a href="ViewProduct.php" class="continue-shopping">Continue Shopping</a>
        </div>
        <?php } ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    /* Set rates + misc */
    var fadeTime = 300;

    /* Assign actions */
    $(".quantity-select").change(function() {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxCart.php?action=Update&id=" + this.id + "&qty=" + this.value
        });
        updateQuantity(this);
    });

    $(".item-remove").click(function() {
        if(confirm("Are you sure you want to remove this item from your cart?")) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxCart.php?action=Delete&id=" + this.value
            });
            removeItem(this);
        }
    });

    /* Recalculate cart */
    function recalculateCart() {
        var subtotal = 0;

        /* Sum up row totals */
        $(".cart-item").each(function() {
            var itemTotal = parseFloat($(this).find(".item-total").text().replace('₹', ''));
            subtotal += itemTotal;
        });

        /* Calculate totals */
        var total = subtotal;

        /* Update totals display */
        $("#cart-subtotal").text('₹' + subtotal.toFixed(2));
        $("#cart-total").text('₹' + total.toFixed(2));
        $("#cart-totalamt").val(total.toFixed(2));
        
        if (total == 0) {
            $(".checkout-btn").fadeOut(fadeTime);
        } else {
            $(".checkout-btn").fadeIn(fadeTime);
        }
    }

    /* Update quantity */
    function updateQuantity(quantityInput) {
        /* Calculate line price */
        var productRow = $(quantityInput).closest(".cart-item");
        var price = parseFloat(productRow.find(".item-price").text().replace('₹', ''));
        var quantity = $(quantityInput).val();
        var linePrice = price * quantity;
        
        /* Update line price display and recalc cart totals */
        productRow.find(".item-total").fadeOut(fadeTime, function() {
            $(this).text('₹' + linePrice.toFixed(2));
            recalculateCart();
            $(this).fadeIn(fadeTime);
        });
    }

    /* Remove item from cart */
    function removeItem(removeButton) {
        /* Remove row from DOM and recalc cart total */
        var productRow = $(removeButton).closest(".cart-item");
        productRow.slideUp(fadeTime, function() {
            productRow.remove();
            recalculateCart();
            
            // If no items left, show empty cart message
            if($(".cart-item").length === 0) {
                window.location.reload();
            }
        });
    }

    // Initialize cart calculation on page load
    $(document).ready(function() {
        recalculateCart();
    });

    
    //one iten but in cart
        $(".buy-now").click(function() {
    var cartId = $(this).val();
    var address = $("#txt_address").val().trim();

    if (address === "") {
        alert("Please enter your shipping address first!");
        $("#txt_address").focus();
        return;
    }

    if (confirm("Do you want to buy this item only?")) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxBuyNow.php",
            method: "POST",
            data: { cid: cartId, address: address },
            success: function(response) {
                response = response.trim();
                if (response === "success") {
                    alert("Redirecting to Payment...");
                    window.location = "Payment.php";
                } else {
                    alert("Something went wrong: " + response);
                }
            },
            error: function(err) {
                console.log(err);
                alert("Error connecting to server.");
            }
        });
    }
});





    </script>
</body>
</html>