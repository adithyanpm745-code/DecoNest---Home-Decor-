<?php
include("../Assets/Connection/Connection.php");
$pname="";
$did="";
$dpid="";
if(isset($_POST["btn_submit"]))
{
    $name=$_POST["txt_place"];
    $did=$_POST["txt_id"];
    $district_id=$_POST["sel_district"];
    
    if($did=="")
    {
        $InsQry="insert into tbl_place(place_name,district_id) values('".$name."','".$district_id."')";
        if($con->query($InsQry))
        {
            ?>
            <script>
            alert("Place Added successfully")
            window.location="Place.php";
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
            alert("Something has wrong")
            window.location="Place.php";
            </script>
            <?php
        }
    }
    else
    {
        $upQry="update tbl_place set place_name='".$name."',district_id='".$district_id."' where place_id='".$did."'";
        if($con->query($upQry))
        {
            ?>
            <script>
            alert("Place has been Updated successfully!")
            window.location="Place.php";
            </script>
            <?php 
        }
    }
}
if(isset($_GET['delId']))
{
    $DelQry="delete from tbl_place where place_id='".$_GET['delId']."'";
    if($con->query($DelQry))
    {
        ?>
        <script>
        alert("Place has been removed")
        window.location="Place.php"
        </script>
        <?php
    }
}
if(isset($_GET['editId']))
{
    $SelQry="select * from tbl_place where place_id='".$_GET['editId']."'";
    {
        $row=$con->query($SelQry);
        $data=$row->fetch_assoc();
        $pname=$data['place_name'];
        $did=$data["place_id"];
        $dpid=$data['district_id'];
    }
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>DecoNest - Place Management</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../Assets/Templates/Admin/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/kaiadmin.min.css" />
    
    <style>
        body {
            background: url('../Assets/Templates/Admin/assets/img/blogpost.jpg') fixed;
            background-size: cover;
        }
        .main-content {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px 0 rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .card-header {
            background-color: #177dff;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px 15px;
            border: 1px solid #e1e5eb;
        }
        .btn {
            border-radius: 5px;
            padding: 8px 20px;
            font-weight: 500;
        }
        .btn-primary {
            background-color: #177dff;
            border-color: #177dff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #3d5170;
        }
        .action-btns a {
            margin-right: 5px;
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include("SideBar.php"); ?>

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="main-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0"><?php echo ($did == "") ? "Add New Place" : "Edit Place"; ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="form1" name="form1" method="post" action="">
                                            <div class="form-group">
                                                <label for="sel_district">District</label>
                                                <select name="sel_district" id="sel_district" class="form-control" required>
                                                    <option value="">Select District</option>
                                                    <?php
                                                    $sel="select * from tbl_district";
                                                    $res=$con->query($sel);
                                                    while($data=$res->fetch_assoc())
                                                    {
                                                    ?>
                                                    <option <?php if($dpid == $data['district_id']) echo "selected"; ?> 
                                                        value="<?php echo $data["district_id"]?>">
                                                        <?php echo $data["district_name"]?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_place">Place Name</label>
                                                <input type="text" class="form-control" name="txt_place" id="txt_place" 
                                                    value="<?php echo $pname ?>" 
                                                    pattern="^[A-Z][a-zA-Z ]{2,}$"
                                                    title="Please enter a valid place name starting with a capital letter. Only letters and spaces are allowed (minimum 3 characters)."  
                                                    required />
                                                <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $did ?>" />
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="reset" class="btn btn-secondary">Cancel</button>
                                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                                                    <?php echo ($did == "") ? "Submit" : "Update"; ?>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Place List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>District</th>
                                                        <th>Place</th>
                                                        <th class="text-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i=0;
                                                    $SelQry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
                                                    $row=$con->query($SelQry);
                                                    while($data=$row->fetch_assoc())
                                                    {
                                                        $i++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $data["district_name"] ?></td>
                                                        <td><?php echo $data['place_name']?></td>
                                                        <td class="text-right action-btns">
                                                            <a href="Place.php?editId=<?php echo $data['place_id'] ?>" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a href="Place.php?delId=<?php echo $data['place_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this place?')">
                                                                <i class="fas fa-trash-alt"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="../Assets/Templates/Admin/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/core/popper.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/core/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/kaiadmin.min.js"></script>
</body>
</html>