<?php
include("../Assets/Connection/Connection.php");
include("SideBar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List - DecoNest Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/fonts.min.css">
    <!-- Custom CSS -->
    <style>
        .card-stat {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card-stat:hover {
            transform: translateY(-5px);
        }
        .user-card {
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }
        .user-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .user-avatar {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .page-title {
            position: relative;
            padding-bottom: 10px;
        }
        .page-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #177dff, #f3545d);
        }
    </style>
</head>
<body>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">User Management</h4>
                </div>
                
                <!-- Stats Cards Row -->
                <div class="row">
                    <?php
                    // Get total user count
                    $countQry = "SELECT COUNT(*) as total FROM tbl_user";
                    $countRes = $con->query($countQry);
                    $totalUsers = $countRes->fetch_assoc()['total'];
                    
                    // Get active users (example - you might need to adjust this based on your criteria)
                    // If 'user_status' column does not exist, count all users as active or adjust as needed
                    $activeQry = "SELECT COUNT(*) as active FROM tbl_user";
                    
                    $activeRes = $con->query($activeQry);
                    $activeUsers = $activeRes->fetch_assoc()['active'];
                    ?>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-stat bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-users fa-3x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">Total Users</h5>
                                        <h2 class="mb-0"><?php echo $totalUsers; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-stat bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-user-check fa-3x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">Active Users</h5>
                                        <h2 class="mb-0"><?php echo $activeUsers; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="col-md-6 col-lg-3">
                        <div class="card card-stat bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-user-clock fa-3x"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">New This Month</h5>
                                        <h2 class="mb-0">3</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-stat bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-chart-line fa-3x"></i>
                                    </div>
                                    <!-- <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">Growth Rate</h5>
                                        <h2 class="mb-0">+12%</h2>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- User List Section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">User List</h4>
                                    <div class="ms-auto">
                                        <!-- <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search users...">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Contact</th>
                                                <th>Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=0;
                                            $SelQry="select * from tbl_user s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id";
                                            
                                            $row=$con->query($SelQry);
                                            while($data=$row->fetch_assoc())
                                            {
                                                $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i?></td>
                                                <td>
                                                    <img src="../Assets/Files/UserDocs/<?php echo $data['user_photo']?>" 
                                                         class="user-avatar" 
                                                         alt="<?php echo $data['user_name']?>">
                                                </td>
                                                 <td>
                                                    <h5 class="mb-1"><?php echo $data['user_name']?></h5>
                                                </td>
                                                <td><?php echo $data['user_email']?></td>
                                                <td><?php echo $data['user_address']?></td>
                                                <td><?php echo $data['user_contact']?></td>
                                                <td>
                                                    District : <?php echo $data['district_name'] ?><br><br>
                                                    Place : <?php echo $data['place_name']?>
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
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="../Assets/Templates/Admin/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/core/popper.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/core/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/webfont/webfont.min.js"></script>
    
    
</body>
</html>