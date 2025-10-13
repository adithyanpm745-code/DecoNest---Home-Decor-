<?php
include("../Assets/Connection/Connection.php");
$dname="";
$did="";
if(isset($_POST["btn_submit"]))
{
    $name=$_POST["txt_dis"];
    $did=$_POST["txt_id"];
    
    $DisQry="select * from tbl_district where district_name='".$name."'";
    $row=$con->query($DisQry);
    if($data=$row->fetch_assoc())
    {
        ?>
        <script>
        alert("This District is Already Exists !")      
        </script>
        <?php 
    }
    else
    {  
        if($did=="")
        {
            $dis=$_POST["txt_dis"];
            $InsQry="insert into tbl_district(district_name) values('$dis')";
            if($con->query($InsQry))
            {
                ?>
                <script>
                alert("District Added successfully")
                window.location="District.php";
                </script>
                <?php
            }
            else
            {
                ?>
                <script>
                alert("Something has wrong")
                window.location="District.php";
                </script>
                <?php
            }
        }
        else
        {
            $upQry="update tbl_district set district_name='".$name."' where district_id='".$did."'";
            if($con->query($upQry))
            {
                ?>
                <script>
                alert("District has been Updated successfully!")
                window.location="District.php";
                </script>
                <?php 
            }
        }
    }
}
if(isset($_GET['delId']))
{
    $DelQry="delete from tbl_district where district_id='".$_GET['delId']."'";
    if($con->query($DelQry))
    {
        ?>
        <script>
        alert("District has been removed")
        window.location="District.php"
        </script>
        <?php
    }
}
if(isset($_GET['editId']))
{
    $SelQry="select * from tbl_district where district_id='".$_GET['editId']."'";
    {
        $row=$con->query($SelQry);
        $data=$row->fetch_assoc();
        $dname=$data['district_name'];
        $did=$data["district_id"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>District Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Public Sans', sans-serif;
        }
        .location-header {
            background-image: url('https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxleHBsb3JlLWZlZWR8MXx8fGVufDB8fHx8fA%3D%3D&w=1000&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .location-header h2 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: none;
        }
        .card-header {
            background-color: #343a40;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            font-weight: 600;
        }
        .btn-primary {
            background-color: #177dff;
            border-color: #177dff;
        }
        .btn-primary:hover {
            background-color: #1269d3;
            border-color: #1269d3;
        }
        .btn-danger {
            background-color: #f3545d;
            border-color: #f3545d;
        }
        .btn-danger:hover {
            background-color: #e03e47;
            border-color: #e03e47;
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .action-btns a {
            margin-right: 5px;
        }
        .form-control:focus {
            border-color: #177dff;
            box-shadow: 0 0 0 0.25rem rgba(23, 125, 255, 0.25);
        }
    </style>
</head>
<body>
	<?php include("SideBar.php"); ?>
	<div class="main-panel">
		
    <div class="container py-4">
        <div class="location-header">
            <h2><i class="fas fa-map-marker-alt"></i> District Management</h2>
            <p class="lead">Manage all districts in your system</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><?php echo ($did == "") ? "Add New District" : "Edit District"; ?></h5>
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <div class="mb-3">
                                <label for="txt_dis" class="form-label">District Name</label>
                                <input type="text" class="form-control" name="txt_dis" id="txt_dis" 
                                    value="<?php echo $dname ?>" 
                                    pattern="^[A-Z][a-zA-Z ]{2,}$"
                                    title="Please enter a valid district name starting with a capital letter. Only letters and spaces are allowed (minimum 3 characters)."  
                                    required>
                                <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $did ?>"/>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary me-md-2">
                                    <i class="fas fa-save"></i> <?php echo ($did == "") ? "Submit" : "Update"; ?>
                                </button>
                                <button type="reset" name="btn_reset" id="btn_reset" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">District List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SL.NO</th>
                                <th>District Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $SelQry="select * from tbl_district";
                            $row=$con->query($SelQry);
                            while($data=$row->fetch_assoc())
                            {
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $data['district_name']?></td>
                                <td class="action-btns">
                                    <a href="District.php?delId=<?php echo $data['district_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this District?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                    <a href="District.php?editId=<?php echo $data['district_id'] ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
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
    </div>
						</div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>