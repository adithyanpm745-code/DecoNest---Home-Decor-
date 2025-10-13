<?php
include("../Assets/Connection/Connection.php");

$cname="";
$cid="";

if(isset($_POST["btn_submit"]))
{
    $name=$_POST["txt_cat"];
    $cid=$_POST["txt_id"];
    
    $CatQry="select * from tbl_category where category_name='".$name."'";
    $row=$con->query($CatQry);
    if($data=$row->fetch_assoc())
    {
?>
        <script>
        alert("This Category is Already Exists !")      
        </script>
<?php   
    }
    else
    { 
        if($cid=="")
        {
            $InsQry="insert into tbl_category(category_name)values('$name')";
            if($con->query($InsQry))
            {
?>
                <script>
                alert("Category added Successfully")
                window.location="Category.php";
                </script>
<?php   
            }
            else
            {
?>
                <script>
                alert("Something has wrong")
                window.location="Category.php";
                </script>
<?php
            }
        }
        else
        {
            $upQry="update tbl_category set category_name='".$name."' where category_id='".$cid."'";
            if($con->query($upQry))
            {
?>
                <script>
                alert("Changes saved Successfully")
                window.location="Category.php";
                </script>
<?php 
            }
        }
    }
}
if(isset($_GET['delId']))
{
    $DelQry="delete from tbl_category where category_id='".$_GET['delId']."'";
    if($con->query($DelQry))
    {
?>
        <script>
        alert("Item has been removed")
        window.location="Category.php";
        </script>
<?php   
    }
}
if(isset($_GET['editId']))
{
    $SelQry="select * from tbl_category where category_id='".$_GET['editId']."'";
    {
        $row=$con->query($SelQry);
        $data=$row->fetch_assoc();
        $cname=$data['category_name'];
        $cid=$data["category_id"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .form-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .action-btn {
            margin: 0 5px;
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead {
            background-color: #177dff;
            color: white;
        }
        .hero-section {
            background: linear-gradient(135deg, #177dff 0%, #80b0ff 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar">
                <?php include("SideBar.php"); ?>
            </div>
            
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="hero-section">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1><i class="fas fa-layer-group me-2"></i> Category Management</h1>
                            <p class="mb-0">Add, edit, and manage product categories for your store</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <img src="https://cdn-icons-png.flaticon.com/512/1570/1570887.png" alt="Categories" style="height: 80px;">
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i><?php echo ($cid == "" ? "Add New Category" : "Edit Category") ?></h5>
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <div class="row mb-3">
                                <label for="txt_cat" class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="txt_cat" id="txt_cat" 
                                           value="<?php echo $cname ?>" 
                                           pattern="^[A-Z][a-zA-Z &+-,]{2,}$"
                                           title="Please enter a valid Category name starting with a capital letter. Only letters, spaces, & and + are allowed (minimum 3 characters)."
                                           required>
                                    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $cid ?>">
                                    <div class="form-text">Example: Living Room, Bedroom, Kitchen</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i><?php echo ($cid == "" ? "Add Category" : "Save Changes") ?>
                                    </button>
                                    <?php if($cid != "") { ?>
                                    <a href="Category.php" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Existing Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th width="10%">SL. NO</th>
                                        <th width="60%">Category Name</th>
                                        <th width="30%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0;
                                    $SelQry="select * from tbl_category";
                                    $row=$con->query($SelQry);
                                    while($data=$row->fetch_assoc())
                                    {
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $data['category_name']?></td>
                                        <td>
                                            <a href="Category.php?editId=<?php echo $data['category_id'] ?>" class="btn btn-sm btn-warning action-btn">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <a href="Category.php?delId=<?php echo $data['category_id'] ?>" class="btn btn-sm btn-danger action-btn" onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="fas fa-trash-alt me-1"></i>Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert for better alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>