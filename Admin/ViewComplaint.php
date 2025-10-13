<?php
include("../Assets/Connection/Connection.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>DecoNest - View Complaints</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="icon" href="../Assets/Templates/Admin/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../Assets/Templates/Admin/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/demo.css" />
    
    <style>
      body {
        background-image: url('../Assets/Templates/Admin/assets/img/kaiadmin/Home.web');
        background-repeat: repeat;
        background-color: #f5f7fb;
      }
      .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        border: none;
      }
      .card-header {
        background-color: #fff;
        border-bottom: 1px solid #eaeaea;
        padding: 15px 20px;
        border-radius: 10px 10px 0 0 !important;
      }
      .table th {
        border-top: none;
        font-weight: 600;
        color: #495057;
      }
      .badge-new {
        background-color: #fd3995;
      }
      .badge-replied {
        background-color: #1bc943;
      }
      .user-details {
        font-size: 1.00rem;
        line-height: 1.4;
      }
      .complaint-content {
        max-width: 300px;
        word-wrap: break-word;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- Include Sidebar -->
      <?php include("SideBar.php"); ?>

      <!-- Content Wrapper -->
      <div class="main-panel">
        <div class="container mt-4">
          
         <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Complaint Management</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- New Complaints Section -->
                    <div class="mb-5">
                      <h4 class="text-primary mb-3">New Complaints <span class="badge badge-new"><?php 
                        $countQuery = "SELECT COUNT(*) as count FROM tbl_complaint c WHERE booking_id=0 and complaint_status=0";
                        $countResult = $con->query($countQuery);
                        $countData = $countResult->fetch_assoc();
                        echo $countData['count'];
                      ?></span></h4>
                      
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead class="bg-light">
                            <tr>
                              <th>SL.NO</th>    
                              <th>User Details</th>
                              <th>Content</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=0;
                            $SelQry="select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id where booking_id=0 and complaint_status=0";
                            $row=$con->query($SelQry);
                            while($data=$row->fetch_assoc())
                            {
                              $i++;
                            ?>
                            <tr>
                              <td><?php echo $i?></td>
                              <td>
                                <div class="user-details">
                                  <strong><?php echo $data['user_name']?></strong><br>
                                  <?php echo $data['user_email']?><br>
                                  <?php echo $data['user_contact']?><br>
                                  <?php echo substr($data['user_address'], 0, 30).'...'?>
                                </div>
                              </td>
                              <td class="complaint-content"><?php echo $data['complaint_content']?></td>
                              <td><?php echo date('d M Y', strtotime($data['complaint_date']))?></td>
                              <td>
                                <a href="Reply.php?cid=<?php echo $data['complaint_id']?>" class="btn btn-primary btn-sm">
                                  <i class="fas fa-reply"></i> Reply
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
                    
                    <!-- Replied Complaints Section -->
                    <div>
                      <h4 class="text-success mb-3">Replied Complaints <span class="badge badge-replied"><?php 
                        $countQuery = "SELECT COUNT(*) as count FROM tbl_complaint c WHERE booking_id=0 and complaint_status=1";
                        $countResult = $con->query($countQuery);
                        $countData = $countResult->fetch_assoc();
                        echo $countData['count'];
                      ?></span></h4>
                      
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead class="bg-light">
                            <tr>
                              <th>SL.NO</th>    
                              <th>User Details</th>
                              <th>Content</th>
                              <th>Reply</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=0;
                            $SelQry="select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id where booking_id=0 and complaint_status=1";
                            $row=$con->query($SelQry);
                            while($data=$row->fetch_assoc())
                            {
                              $i++;
                            ?>
                            <tr>
                              <td><?php echo $i?></td>
                              <td>
                                <div class="user-details">
                                  <strong><?php echo $data['user_name']?></strong><br>
                                  <?php echo $data['user_email']?><br>
                                  <?php echo $data['user_contact']?><br>
                                  <?php echo substr($data['user_address'], 0, 30).'...'?>
                                </div>
                              </td>
                              <td class="complaint-content"><?php echo $data['complaint_content']?></td>
                              <td class="complaint-content"><?php echo $data['complaint_reply']?></td>
                              <td><?php echo date('d M Y', strtotime($data['complaint_date']))?></td>
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

            <H1>Products Complaints</H1>

            <!-- Content Wrapper -->
      <div class="main-panel">
        <div class="container mt-4">
        
         <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">View Products Complaints</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- New Complaints Section -->
                    <div class="mb-5">
                      <h4 class="text-primary mb-3"> Complaints <span class="badge badge-new"><?php 
                        $countQuery = "SELECT COUNT(*) as count FROM tbl_complaint c WHERE booking_id=0 and complaint_status=0";
                        $countResult = $con->query($countQuery);
                        $countData = $countResult->fetch_assoc();
                        echo $countData['count'];
                      ?></span></h4>
                      
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead class="bg-light">
                            <tr>
                              <th>SL.NO</th>    
                              <th>Products Details</th>  
                              <th>User Details</th>
                              <th>User Content</th>
                              <th>Date</th>
                              <th>Seller Details</th>
                              <th>Seller Reply</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=0;
                            $SelQry="select * from tbl_complaint c 
                        inner join tbl_booking b on c.booking_id=b.booking_id 
                        inner join tbl_cart ca on ca.booking_id=b.booking_id
                        inner join tbl_product p on ca.product_id=p.product_id
                        inner join tbl_user u on c.user_id=u.user_id 
                        inner join tbl_seller s on p.seller_id=s.seller_id 
                             ";
                            $row=$con->query($SelQry);
                            while($data=$row->fetch_assoc())
                            {
                              $i++;
                            ?>
                            <tr>
                              <td><?php echo $i?></td>
                              <td>
                                <strong><?php echo $data['product_name']?></strong><br><br>
                                <strong>Booking ID:</strong> <?php echo $data['booking_id']?><br>
                              </td>
                              <td>
                                <div class="user-details">
                                  <strong><?php echo $data['user_name']?></strong><br>
                                  <?php echo $data['user_email']?><br>
                                  <?php echo $data['user_contact']?><br>
                                  <?php echo substr($data['user_address'], 0, 30).'...'?>
                                </div>
                              </td>
                              <td class="complaint-content"><?php echo $data['complaint_content']?></td>
                              <td><?php echo date('d M Y', strtotime($data['complaint_date']))?></td>
                              <td>
                                <div class="user-details">
                                  <strong><?php echo $data['seller_name']?></strong><br>
                                  <?php echo $data['seller_email']?><br>
                                  <?php echo $data['seller_contact']?><br>
                                  <?php echo substr($data['seller_address'], 0, 30).'...'?>
                                </div>
                              </td>
                              <td class="complaint-content"><?php echo $data['complaint_reply']?></td>
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
        </div>
      </div>
      
    </div>

    <!--   Core JS Files   -->
    <script src="../Assets/Templates/Admin/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/core/popper.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../Assets/Templates/Admin/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../Assets/Templates/Admin/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../Assets/Templates/Admin/assets/js/setting-demo.js"></script>
    <script src="../Assets/Templates/Admin/assets/js/demo.js"></script>
  </body>
</html>