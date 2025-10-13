<?php
session_start();
include("../connection/connection.php");

if(isset($_POST["cid"])) {
    $cid = $_POST["cid"];
    $uid = $_SESSION["uid"];
    $address = mysqli_real_escape_string($con, $_POST["address"]);

    // Fetch the cart item
    $sel = "SELECT * FROM tbl_cart WHERE cart_id='$cid' AND cart_status='0'";
    $res = $con->query($sel);
    
    if($row = $res->fetch_assoc()) {
        $product_id = $row["product_id"];
        $qty = $row["cart_quantity"];

        // Get product price
        $selp = "SELECT product_price FROM tbl_product WHERE product_id='$product_id'";
        $resp = $con->query($selp);
        if($rowp = $resp->fetch_assoc()) {
            $amount = $qty * $rowp["product_price"];

            // Create a new booking with the entered address
            $ins = "INSERT INTO tbl_booking (user_id, booking_date, booking_amount, booking_status, booking_address)
                    VALUES ('$uid', NOW(), '$amount', '1', '$address')";
            if($con->query($ins)) {
                $bid = $con->insert_id;

                // Update this specific cart item to link to that booking
                $up = "UPDATE tbl_cart SET booking_id='$bid', cart_status='1' WHERE cart_id='$cid'";
                if($con->query($up)) {
                    $_SESSION["bid"] = $bid;
                    echo "success";
                } else {
                    echo "error: cart update failed";
                }
            } else {
                echo "error: booking insert failed";
            }
        } else {
            echo "error: product not found";
        }
    } else {
        echo "error: invalid cart";
    }
} else {
    echo "error: no cart id";
}
?>
