<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
	    $content=$_POST["txt_content"];
		$colour=$_POST["sel_colour"];
		$material=$_POST["sel_material"];
	
		$photo=$_FILES["customization_file"]['name'];
		$path=$_FILES["customization_file"]['tmp_name'];
		move_uploaded_file($path,'../Assets/Files/CustomizationDocs/'.$photo);
		
	$InsQry="insert into tbl_customization(customization_content,user_id,customization_date,customization_file,seller_id,colour_id,material_id) 
	values('".$content."','".$_SESSION["uid"]."',curdate(),'".$photo."','".$_GET["sid"]."','".$colour."','".$material."')";
	if($con->query($InsQry))
	{
		?>
		<script>
		alert("Customization Request is successfully send")
		window.location="MyCustomization.php";
		</script>
			<?php
	}
	else
	{
		?>
        <script>
		alert("Something has wrong")
		window.location="Customization.php";
		</script>
        <?php
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customization Request</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        background: url('https://images.unsplash.com/photo-1493663284031-b7e3aaa4c4b1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    
    .container-custom {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 30px;
        margin-bottom: 30px;
        flex: 1;
    }
    
    .page-title {
        color: #5a5a5a;
        font-weight: 600;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #c8a97e;
        position: relative;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background-color: #c8a97e;
    }
    
    .custom-form {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .form-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .form-header {
        color: #5a5a5a;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9e1d2;
        display: flex;
        align-items: center;
    }
    
    .form-header i {
        color: #c8a97e;
        margin-right: 10px;
        font-size: 1.2rem;
    }
    
    .form-control, .custom-file-label {
        border-radius: 6px;
        border: 1px solid #e9e1d2;
        padding: 12px 15px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #c8a97e;
        box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
    }
    
    .custom-file-input:focus ~ .custom-file-label {
        border-color: #c8a97e;
        box-shadow: 0 0 0 0.2rem rgba(200, 169, 126, 0.25);
    }
    
    .btn-custom {
        background-color: #c8a97e;
        border: none;
        color: white;
        padding: 12px 30px;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-custom:hover {
        background-color: #b8976a;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(200, 169, 126, 0.3);
    }
    
    .btn-custom i {
        margin-right: 8px;
    }
    
    .upload-container {
        border: 2px dashed #e9e1d2;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s;
        background-color: rgba(200, 169, 126, 0.05);
    }
    
    .upload-container:hover {
        border-color: #c8a97e;
        background-color: rgba(200, 169, 126, 0.1);
    }
    
    .upload-icon {
        font-size: 3rem;
        color: #c8a97e;
        margin-bottom: 15px;
    }
    
    .instruction-text {
        color: #6c757d;
        font-size: 0.9rem;
        margin-top: 10px;
    }
    
    .preview-container {
        display: none;
        margin-top: 20px;
        text-align: center;
    }
    
    .preview-image {
        max-width: 100%;
        max-height: 300px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .container-custom {
            padding: 20px;
        }
        
        .form-section {
            padding: 20px;
        }
    }
</style>
</head>

<body>
<?php include("Header.php"); ?>

<div class="container container-custom">
    <h2 class="page-title">Request Customization</h2>
    
    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" class="custom-form">

                                <div class="row">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="upload-container">
                                    <div class="mb-3">
                                        <label for="sel_colour" class="form-label">Color</label>
                                        <select class="form-select" name="sel_colour" id="sel_colour" required>
                                            <option value="">Select Color</option>
                                            <?php
                                            $sel = "select * from tbl_colour";
                                            $res = $con->query($sel);
                                            while($data = $res->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $data["colour_id"]?>">
                                                <?php echo $data["colour_name"]?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="upload-container">
                                    <div class="mb-3">
                                        <label for="sel_material" class="form-label">Material</label>
                                        <select class="form-select" name="sel_material" id="sel_material" required>
                                            <option value="">Select Material</option>
                                            <?php
                                            $sel = "select * from tbl_material";
                                            $res = $con->query($sel);
                                            while($data = $res->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $data["material_id"]?>">
                                                <?php echo $data["material_name"]?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

        <div class="form-section">
            <h4 class="form-header"><i class="fas fa-edit"></i>Customization Details</h4>
            
            <div class="form-group">
                <label for="txt_content" class="font-weight-bold">Describe your customization request ,Inducing Colour,Material,etc...</label>
                <textarea name="txt_content" id="txt_content" class="form-control" cols="30" rows="6" 
                          placeholder="Please provide detailed information about your customization needs..." required></textarea>
                <small class="form-text instruction-text">Be as specific as possible to help us understand your requirements</small>
            </div>
        </div>
        
        <div class="form-section">
            <h4 class="form-header"><i class="fas fa-image"></i>Reference Image</h4>
            
            <div class="upload-container">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h5>Upload a reference image</h5>
                <p class="instruction-text">JPEG, PNG or JPG files (Max 5MB)</p>
                
                <div class="custom-file">
                    <input type="file" name="customization_file" id="customization_file" 
                           class="custom-file-input" accept="image/*" required>
                    <label class="custom-file-label" for="customization_file">Choose file</label>
                </div>
            </div>
            
            <div class="preview-container" id="previewContainer">
                <h5>Image Preview</h5>
                <img src="#" class="preview-image" id="previewImage" alt="Preview">
            </div>
        </div>
        
        <div class="text-center mt-4">
            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-custom btn-lg">
                <i class="fas fa-paper-plane"></i>Submit Request
            </button>
        </div>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<script>
    // Update custom file input label with selected file name
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("customization_file").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
        
        // Show image preview
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImage').src = event.target.result;
                document.getElementById('previewContainer').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>

 <!--::footer_part:-->
    <?php include("Footer.php"); ?>