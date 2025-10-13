<?php
include("../Connection/Connection.php");
session_start();

if(!isset($_SESSION['uid'])){
    echo "not_logged_in";
    exit;
}

$uid = $_SESSION['uid'];
$pid = $_GET['pid'];

// check if already exists
$check = "SELECT * FROM tbl_wishlist WHERE user_id='$uid' AND product_id='$pid'";
$res = $con->query($check);

if($res->num_rows > 0){
    // REMOVE from wishlist
    $del = "DELETE FROM tbl_wishlist WHERE user_id='$uid' AND product_id='$pid'";
    if($con->query($del)){
        echo "Removed to Wishlist";  // for AJAX/live update
    } else {
        echo "error";
    }
} else {
    // ADD to wishlist
    $ins = "INSERT INTO tbl_wishlist(user_id, product_id) VALUES('$uid','$pid')";
    if($con->query($ins)){
        echo "Added to Wishlist";  // for AJAX/live update
    } else {
        echo "error";
    }
}
?>
