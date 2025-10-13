<?php
include("../Assets/Connection/Connection.php");

$sname="";
$cid="";
$subcid="";
if(isset($_POST["btn_submit"]))
{
    $name=$_POST["txt_subcategory"];
    $cid=$_POST["txt_id"];
    $category_id=$_POST["sel_category"];
    
    $SCatQry="select * from tbl_subcategory where subcategory_name='".$name."' AND category_id='".$category_id."'";
        $row=$con->query($SCatQry);
        if($data=$row->fetch_assoc())
          {
?>
               <script>
            alert("This SubCategory is Already Exists !")      
            </script>
           <?php   
          }
        else
        { 
    
    if($cid=="")
            {
$InsQry="insert into tbl_subcategory(subcategory_name,category_id) values('".$name."','".$category_id."')";
if($con->query($InsQry))
    {
        ;
?>
        <script>
        alert("Data Inserted successfully !")
        window.location="SubCategory.php";
        </script>
            <?php
    }
    else
    {
?>
        <script>
        alert("Something has wrong")
        window.location="SubCategory.php";
        </script>
        <?php
    }
    }
            
 else
    {
    $upQry="update tbl_subcategory set subcategory_name='".$name."',category_id='".$category_id."' where subcategory_id='".$cid."'";
        if($con->query($upQry))
        {
?>
        <script>
        alert("Data Updated Successfully !")
        window.location="SubCategory.php";
        </script>
            <?php 
        }
    }
    
        }
}
if(isset($_GET['delId']))
    {
        $DelQry="delete from tbl_subcategory where subcategory_id='".$_GET['delId']."'";
        if($con->query($DelQry))
        {
?>
            <script>
            alert("Item has been removed")
            window.location="SubCategory.php"
            </script>
            <?php
        }
    }
    if(isset($_GET['editId']))
{
    $SelQry="select * from tbl_subcategory where subcategory_id='".$_GET['editId']."'";
    {
        $row=$con->query($SelQry);
        $data=$row->fetch_assoc();
        $sname=$data['subcategory_name'];
        $cid=$data["subcategory_id"];
        $subcid=$data['category_id'];
    }
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SubCategory Management</title>
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
        .form-control:focus {
            border-color: #177dff;
            box-shadow: 0 0 0 0.25rem rgba(23, 125, 255, 0.25);
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
                            <h1><i class="fas fa-layer-group me-2"></i> SubCategory Management</h1>
                            <p class="mb-0">Add, edit, and manage product subcategories for your store</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <img src="https://cdn-icons-png.flaticon.com/512/1570/1570887.png" alt="SubCategories" style="height: 80px;">
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i><?php echo ($cid == "" ? "Add New SubCategory" : "Edit SubCategory") ?></h5>
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <div class="row mb-3">
                                <label for="sel_category" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="sel_category" id="sel_category" class="form-select" required>
                                        <option value="">Select Category</option>
                                        <?php
                                        $sel="select * from tbl_category";
                                        $res=$con->query($sel);
                                        while($data=$res->fetch_assoc())
                                        {
                                        ?>
                                        <option 
                                        <?php
                                        if($subcid == $data['category_id'])
                                        {
                                            echo "selected";
                                        }
                                        ?>
                                        value="<?php echo $data["category_id"]?>">
                                        <?php echo $data["category_name"]?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="txt_subcategory" class="col-sm-3 col-form-label">SubCategory Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="txt_subcategory" id="txt_subcategory" 
                                           value="<?php echo $sname ?>" 
                                           pattern="^[A-Z][a-zA-Z &+-,().]{2,}$"
                                           title="Please enter a valid SubCategory name starting with a capital letter. Only letters, spaces, & and + are allowed (minimum 3 characters)."
                                           required>
                                    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $cid ?>">
                                    <div class="form-text">Example: Sofa, Dining Table, Bed Frame</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i><?php echo ($cid == "" ? "Add SubCategory" : "Save Changes") ?>
                                    </button>
                                    <button type="reset" name="btn_reset" id="btn_reset" class="btn btn-secondary">
                                        <i class="fas fa-undo me-2"></i>Reset
                                    </button>
                                    <?php if($cid != "") { ?>
                                    <a href="SubCategory.php" class="btn btn-outline-danger">
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
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Existing SubCategories</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th width="10%">SL.NO</th>
                                        <th width="35%">Category</th>
                                        <th width="35%">SubCategory</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0;
                                    $SelQry="select * from tbl_subcategory s inner join tbl_category c on s.category_id=c.category_id";
                                    $row=$con->query($SelQry);
                                    while($data=$row->fetch_assoc())
                                    {
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $data["category_name"] ?></td>
                                        <td><?php echo $data['subcategory_name']?></td>
                                        <td>
                                            <a href="SubCategory.php?editId=<?php echo $data['subcategory_id'] ?>" class="btn btn-sm btn-warning action-btn">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <a href="SubCategory.php?delId=<?php echo $data['subcategory_id']?>" class="btn btn-sm btn-danger action-btn" onclick="return confirm('Are you sure you want to delete this subcategory?')">
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