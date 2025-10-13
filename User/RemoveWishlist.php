<?php
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_GET['rid'])){
    $wid = $_GET['rid'];
    $con->query("DELETE FROM tbl_wishlist WHERE wishlist_id='$wid'");
}
header("Location: MyWishlist.php");
?>
