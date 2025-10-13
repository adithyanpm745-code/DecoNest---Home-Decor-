<?php
include("../Assets/Connection/Connection.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Gallery | DecoNest</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
<!-- font awesome CSS -->
<link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Roboto', sans-serif;
    }
    
    .gallery-container {
        padding: 40px 0;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="%23f8f9fa"/><path d="M0 50 L100 50 M50 0 L50 100" stroke="%23e9ecef" stroke-width="0.5"/></svg>') repeat;
    }
    
    .gallery-header {
        text-align: center;
        margin-bottom: 40px;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .gallery-header h2 {
        color: #5a5a5a;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .gallery-header p {
        color: #777;
        margin-bottom: 0;
    }
    
    .gallery-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 25px;
        height: 100%;
    }
    
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .gallery-img-container {
        height: 250px;
        overflow: hidden;
        position: relative;
    }
    
    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .gallery-card:hover .gallery-img {
        transform: scale(1.05);
    }
    
    .gallery-card-body {
        padding: 15px;
        text-align: center;
    }
    
    .gallery-card-number {
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        background-color: #f8f5f0;
        color: #c8a97e;
        border-radius: 50%;
        font-weight: 600;
    }
    
    .back-btn {
        background-color: #c8a97e;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-top: 30px;
    }
    
    .back-btn:hover {
        background-color: #b89768;
        color: white;
        text-decoration: none;
    }
    
    .empty-gallery {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .empty-gallery i {
        font-size: 60px;
        color: #e9ecef;
        margin-bottom: 20px;
    }
    
    .empty-gallery h4 {
        color: #6c757d;
        margin-bottom: 15px;
    }
</style>
</head>

<body>
    <!-- Include header -->
    <?php include('Header.php'); ?>
    
    <div class="container gallery-container">
        <div class="gallery-header">
            <h2>Product Gallery</h2>
            <p>Explore all images of this beautiful product</p>
        </div>
        
        <?php
        include("../Assets/Connection/Connection.php");
        
        $i = 0;
        $SelQry = "select * from tbl_gallery g inner join tbl_product p on g.product_id=p.product_id where g.product_id='".$_GET['pid']."'";
        $row = $con->query($SelQry);
        
        if($row->num_rows > 0) {
        ?>
        <div class="row">
            <?php
            while($data = $row->fetch_assoc()) {
                $i++;
            ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="gallery-card">
                    <div class="gallery-img-container">
                        <img src="../Assets/Files/GalleryDocs/<?php echo $data['gallery_file']?>" class="gallery-img" alt="Product Image <?php echo $i ?>" />
                    </div>
                    <div class="gallery-card-body">
                        <span class="gallery-card-number"><?php echo $i ?></span>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <?php
        } else {
        ?>
        <div class="empty-gallery">
            <i class="far fa-image"></i>
            <h4>No Images Available</h4>
            <p>This product doesn't have any gallery images yet.</p>
        </div>
        <?php
        }
        ?>
        
        <div class="text-center">
            <a href="javascript:history.back()" class="back-btn">
                <i class="fas fa-arrow-left mr-2"></i> Back to Product
            </a>
        </div>
    </div>
    
    <!-- jQuery and Bootstrap JS -->
    <script src="../Assets/Templates/Main/js/jquery-3.4.1.min.js"></script>
    <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
</body>
</html>

 <!--::footer_part:-->
    <?php include("Footer.php"); ?>