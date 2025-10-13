<?php
include("../Assets/Connection/Connection.php");
$cname="";
$cid="";

if(isset($_POST["btn_submit"]))
{
    $name=$_POST["txt_colour"];
    $cid=$_POST["txt_id"];
    
    $ColQry="select * from tbl_colour where colour_name='".$name."'";
    $row=$con->query($ColQry);
    if($data=$row->fetch_assoc())
      {
        ?>
           <script>
            alert("This Colour is Already Exists !")        
            </script>
           <?php	
      }
    else
    {
    
        if($cid=="")
        {
        $InsQry="insert into tbl_colour(colour_name)values('$name')";
            if($con->query($InsQry))
                {
?>
        <script>
        alert("Colour has been Inserted successfully!")
        window.location="Colour.php";
        </script>
<?php   
                }
            else
                {
        ?>
        <script>
        alert("Something has wrong")
        window.location="Colour.php";
        </script>
        <?php
                }
    }
    else
    {
        $upQry="update tbl_colour set colour_name='".$name."' where colour_id='".$cid."'";
        if($con->query($upQry))
        {
            ?>
        <script>
        alert("Colour has been Updated successfully")
        window.location="Colour.php";
        </script>
            <?php 
        }
    }
    }
    }
    if(isset($_GET['delId']))
    {
        $DelQry="delete from tbl_colour where colour_id='".$_GET['delId']."'";
        if($con->query($DelQry))
        {
        ?>
        <script>
        alert("Item has been removed")
        window.location="Colour.php";
        </script>
        <?php	
        }
    }
if(isset($_GET['editId']))
{
    $SelQry="select * from tbl_colour where colour_id='".$_GET['editId']."'";
    {
        $row=$con->query($SelQry);
        $data=$row->fetch_assoc();
        $cname=$data['colour_name'];
        $cid=$data["colour_id"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colour Management</title>
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
                    <h2><i class="fas fa-palette me-2"></i>Colour Management</h2>
                </div>
                
                <!-- Form Card -->
                <div class="card form-container mb-4">
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="txt_colour" class="form-label">Colour Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        <input type="text" class="form-control" name="txt_colour" id="txt_colour" 
                                               value="<?php echo $cname ?>" 
                                               pattern="^[A-Z][a-zA-Z ]{2,}$"
                                               title="Please enter a valid Colour name starting with a capital letter. Only letters and spaces are allowed (minimum 3 characters)."  
                                               required />
                                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $cid ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                                        <i class="fas fa-check me-2"></i><?php echo ($cid == "") ? "Add Colour" : "Update Colour"; ?>
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
                                        <th>Colour</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=0;
                                    $SelQry="select * from tbl_colour";
                                    $row=$con->query($SelQry);
                                    while($data=$row->fetch_assoc())
                                    {
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $data['colour_name']?></td>
                                        <td class="action-btns">
                                            <a href="Colour.php?editId=<?php echo $data['colour_id'] ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="Colour.php?delId=<?php echo $data['colour_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this colour?')">
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