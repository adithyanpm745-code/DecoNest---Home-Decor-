<?php
include("../Assets/Connection/Connection.php");
$mname="";
$mid="";

if(isset($_POST["btn_submit"]))
{
    $name=$_POST["txt_material"];
    $mid=$_POST["txt_id"];
    
    $MatQry="select * from tbl_material where material_name='".$name."'";
    $row=$con->query($MatQry);
    if($data=$row->fetch_assoc())
      {
        ?>
           <script>
            alert("This Material is Already Exists !")        
            </script>
           <?php	
      }
    else
    {
    
        if($mid=="")
        {
        $InsQry="insert into tbl_material(material_name)values('".$name."')";
            if($con->query($InsQry))
                {
            
?>
        <script>
        alert("Material has been Inserted successfully!")
        window.location="Material.php";
        </script>
<?php   
                }
            else
                {
        ?>
        <script>
        alert("Something has wrong")
        window.location="Material.php";
        </script>
        <?php
                }
    }
    else
    {
        $upQry="update tbl_material set material_name='".$name."' where material_id='".$mid."'";
        if($con->query($upQry))
        {
            ?>
        <script>
        alert("Material has been Updated successfully")
        window.location="Material.php";
        </script>
            <?php 
        }
    }
    }
    }
    if(isset($_GET['delId']))
    {
        $DelQry="delete from tbl_material where material_id='".$_GET['delId']."'";
        if($con->query($DelQry))
        {
        ?>
        <script>
        alert("Item has been removed")
        window.location="Material.php";
        </script>
        <?php	
        }
    }
if(isset($_GET['editId']))
{
    $SelQry="select * from tbl_material where material_id='".$_GET['editId']."'";
    {
        $row=$con->query($SelQry);
        $data=$row->fetch_assoc();
        $mname=$data['material_name'];
        $mid=$data["material_id"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .form-container {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }
        .table-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
        }
        .action-btns a {
            margin: 0 5px;
        }
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 15px 0;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        .material-icon {
            font-size: 1.2rem;
            margin-right: 8px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include("SideBar.php"); ?>
            
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="header text-center">
                    <h2><i class="fas fa-layer-group me-2"></i>Material Management</h2>
                </div>
                
                <!-- Form Card -->
                <div class="card form-container mb-4">
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="txt_material" class="form-label">Material Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                        <input type="text" class="form-control" name="txt_material" id="txt_material" 
                                               value="<?php echo $mname ?>" 
                                               pattern="^[A-Z][a-zA-Z- ]{2,}$"
                                               title="Please enter a valid Material name starting with a capital letter. Only letters and spaces are allowed (minimum 3 characters)."  
                                               required />
                                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $mid ?>" />
                                    </div>
                                    <small class="text-muted">Example: Wood, Metal, Plastic, etc.</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i><?php echo ($mid == "") ? "Add Material" : "Update Material"; ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Table Card -->
                <div class="card table-container">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>SL.NO</th>
                                        <th>Material</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0;
                                    $SelQry="select * from tbl_material";
                                    $row=$con->query($SelQry);
                                    while($data=$row->fetch_assoc())
                                    {
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td>
                                            <i class="fas fa-cube material-icon"></i>
                                            <?php echo $data['material_name']?>
                                        </td>
                                        <td class="action-btns">
                                            <a href="Material.php?editId=<?php echo $data['material_id'] ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="Material.php?delId=<?php echo $data['material_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this material?')">
                                                <i class="fas fa-trash-alt"></i> Delete
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>