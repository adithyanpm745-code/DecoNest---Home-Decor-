<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))
	{
		
		$photo=$_FILES["file_photo"]['name'];
		$path=$_FILES["file_photo"]['tmp_name'];
		move_uploaded_file($path,'../Assets/Files/GalleryDocs/'.$photo);

		$InsQry="insert into tbl_gallery(gallery_file,product_id) 
		values('".$photo."','".$_GET['pid']."')";
		if($con->query($InsQry))
		{
			?>
        <script>
		alert("New Photos has been added");
		window.location="Gallery.php?pid=<?php echo $_GET['pid'] ?>";
		</script>
        <?php	
		}
		else
		{
			?>
        <script>
		alert("Something has wrong")
		window.location="Gallery.php";
		</script>
        <?php
		}
	}
	
	if(isset($_GET['delId']))
	{
		$DelQry="delete from tbl_gallery where gallery_id='".$_GET['delId']."'";
		if($con->query($DelQry))
		{
			?>
            <script>
			alert("Photo has been removed")
			window.location="Gallery.php?pid=<?php echo $_GET['pid'] ?>"
			</script>
			<?php
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery - DecoNest</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-blend-mode: overlay;
            background-color: rgba(248, 249, 250, 0.92);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
            background-color: rgba(255, 255, 255, 0.95);
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0 !important;
            font-weight: 600;
            color: #5a5a5a;
        }
        
        .form-control {
            border-radius: 5px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #c8a97e;
            box-shadow: 0 0 0 0.25rem rgba(200, 169, 126, 0.25);
        }
        
        .btn-primary {
            background-color: #c8a97e;
            border-color: #c8a97e;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #b89768;
            border-color: #b89768;
        }
        
        .btn-outline-danger {
            border-radius: 5px;
        }
        
        .btn-outline-secondary {
            border-radius: 5px;
        }
        
        .page-title {
            color: #5a5a5a;
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: #c8a97e;
        }
        
        .main-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        
        .action-buttons a {
            margin-right: 8px;
        }
        
        .section-title {
            font-size: 1.2rem;
            color: #5a5a5a;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .back-link {
            color: #c8a97e;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            display: inline-block;
        }
        
        .back-link:hover {
            color: #b89768;
            text-decoration: underline;
        }
        
        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-img {
            transform: scale(1.03);
        }
        
        .gallery-item {
            margin-bottom: 25px;
            position: relative;
        }
        
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 8px;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .custom-file-upload {
            border: 2px dashed #ddd;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            cursor: pointer;
            background-color: #f8f9fa;
            text-align: center;
            transition: all 0.3s;
            height: 150px;
        }
        
        .custom-file-upload:hover {
            border-color: #c8a97e;
            background-color: #f8f5f0;
        }
        
        input[type="file"] {
            display: none;
        }
        
        .upload-icon {
            font-size: 2rem;
            color: #c8a97e;
            margin-bottom: 10px;
        }
        
        #selectedFileName {
            font-size: 0.9rem;
            margin-top: 10px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Header inclusion -->
    <?php include('Header.php'); ?>

    <div class="container main-container">
        <a href="ViewProduct.php" class="back-link"><i class="fas fa-arrow-left me-2"></i>Back to Products</a>
        <h2 class="page-title">Manage Product Gallery</h2>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add New Gallery Image</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                            <div class="mb-3">
                                <label for="file_photo" class="form-label d-block">Product Image</label>
                                <label for="file_photo" class="custom-file-upload">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <span>Click to upload or drag and drop</span>
                                    <small class="text-muted">PNG, JPG, GIF up to 5MB</small>
                                </label>
                                <input type="file" name="file_photo" id="file_photo" accept="image/*" required>
                                <div id="selectedFileName" class="mt-2 text-center"></div>
                            </div>
                            
                            <div class="d-flex justify-content-end gap-2">
                                <input type="reset" name="btn_reset" id="btn_reset" value="Reset" class="btn btn-outline-secondary">
                                <input type="submit" name="btn_submit" id="btn_submit" value="Add to Gallery" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-12">
                <h5 class="section-title">Gallery Images</h5>
                
                <?php
                $i = 0;
                $SelQry = "select * from tbl_gallery g inner join tbl_product p on g.product_id = p.product_id where g.product_id = '".$_GET['pid']."'";
                $row = $con->query($SelQry);
                
                if($row->num_rows > 0) {
                ?>
                <div class="row">
                    <?php
                    while($data = $row->fetch_assoc()) {
                        $i++;
                    ?>
                    <div class="col-md-4 col-lg-3 gallery-item">
                        <div class="card h-100">
                            <img src="../Assets/Files/GalleryDocs/<?php echo $data['gallery_file']?>" class="gallery-img card-img-top" alt="Gallery Image">
                            <div class="gallery-overlay">
                                <a href="Gallery.php?delId=<?php echo $data['gallery_id']?>&pid=<?php echo $_GET["pid"];?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this image?')">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </a>
                            </div>
                            <div class="card-body text-center py-2">
                                <small class="text-muted">Image <?php echo $i ?></small>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } else { ?>
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No gallery images yet</h5>
                    <p class="text-muted">Upload your first product image using the form above.</p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../Assets/Templates/Main/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="../Assets/Templates/Main/js/all.js"></script>
    
    <script>
        // Show selected file name
        document.getElementById('file_photo').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            document.getElementById('selectedFileName').textContent = 'Selected file: ' + fileName;
            
            // Optional: Show preview of selected image
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.custom-file-upload').style.backgroundImage = 'url(' + e.target.result + ')';
                    document.querySelector('.custom-file-upload').style.backgroundSize = 'cover';
                    document.querySelector('.custom-file-upload').style.backgroundPosition = 'center';
                    document.querySelector('.custom-file-upload').innerHTML = '';
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        
        // Reset the custom file upload area when form is reset
        document.getElementById('btn_reset').addEventListener('click', function() {
            document.querySelector('.custom-file-upload').style.backgroundImage = '';
            document.querySelector('.custom-file-upload').innerHTML = `
                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                <span>Click to upload or drag and drop</span>
                <small class="text-muted">PNG, JPG, GIF up to 5MB</small>
            `;
            document.getElementById('selectedFileName').textContent = '';
        });
    </script>
</body>
</html>