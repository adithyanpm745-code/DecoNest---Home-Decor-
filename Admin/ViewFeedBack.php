<?php
include("../Assets/Connection/Connection.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>DecoNest - View Feedback</title>
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
        background-image: url('../Assets/Templates/Admin/assets/img/kaiadmin/bg-pattern.png');
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
        background-color: #f8f9fa;
      }
      .user-details {
        font-size: 0.85rem;
        line-height: 1.4;
      }
      .feedback-content {
        max-width: 300px;
        word-wrap: break-word;
      }
      .feedback-card {
        background-color: #fff;
        border-left: 4px solid #1bc943;
        margin-bottom: 15px;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      }
      .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #177dff;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 15px;
      }
      .feedback-date {
        font-size: 0.8rem;
        color: #6c757d;
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
                      <h4 class="card-title">User Feedback</h4>
                      <span class="badge badge-primary ml-2">
                        <?php 
                          $countQuery = "SELECT COUNT(*) as count FROM tbl_feedback f inner join tbl_user u on f.user_id=u.user_id";
                          $countResult = $con->query($countQuery);
                          $countData = $countResult->fetch_assoc();
                          echo $countData['count'] . ' Feedback entries';
                        ?>
                      </span>
                    </div>
                  </div>
                  <div class="card-body">
                    <?php
                    $i=0;
                    $SelQry="select * from tbl_feedback f inner join tbl_user u on f.user_id=u.user_id ORDER BY f.feedback_date DESC";
                    $row=$con->query($SelQry);
                    
                    if($row->num_rows > 0) {
                      while($data=$row->fetch_assoc())
                      {
                        $i++;
                        $initial = strtoupper(substr($data['user_name'], 0, 1));
                    ?>
                    <div class="feedback-card">
                      <div class="d-flex align-items-start">
                        <div class="user-avatar">
                          <?php echo $initial; ?>
                        </div>
                        <div class="flex-grow-1">
                          <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-1"><?php echo $data['user_name']; ?></h6>
                            <small class="feedback-date"><?php echo date('M j, Y \a\t g:i A', strtotime($data['feedback_date'])); ?></small>
                          </div>
                          <p class="mb-2 text-muted small"><?php echo $data['user_email']; ?> • <?php echo $data['user_contact']; ?><br>
                        <?php echo $data['user_address']; ?></p><br>
                          <p class="mb-0"><?php echo $data['feedback_content']; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php
                      }
                    } else {
                    ?>
                    <div class="text-center py-5">
                      <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                      <h5 class="text-muted">No feedback yet</h5>
                      <p class="text-muted">Users haven't submitted any feedback.</p>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Seller Feedback</h4>
                      <span class="badge badge-primary ml-2">
                        <?php 
                          $countQuery = "SELECT COUNT(*) as count FROM tbl_feedback f inner join tbl_seller u on f.seller_id=u.seller_id";
                          $countResult = $con->query($countQuery);
                          $countData = $countResult->fetch_assoc();
                          echo $countData['count'] . ' Feedback entries';
                        ?>
                      </span>
                    </div>
                  </div>
                  <div class="card-body">
                    <?php
                    $i=0;
                    $SelQry="select * from tbl_feedback f inner join tbl_seller u on f.seller_id=u.seller_id ORDER BY f.feedback_date DESC";
                    $row=$con->query($SelQry);
                    
                    if($row->num_rows > 0) {
                      while($data=$row->fetch_assoc())
                      {
                        $i++;
                        $initial = strtoupper(substr($data['seller_name'], 0, 1));
                    ?>
                    <div class="feedback-card">
                      <div class="d-flex align-items-start">
                        <div class="user-avatar">
                          <?php echo $initial; ?>
                        </div>
                        <div class="flex-grow-1">
                          <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-1"><?php echo $data['seller_name']; ?></h6>
                            <small class="feedback-date"><?php echo date('M j, Y \a\t g:i A', strtotime($data['feedback_date'])); ?></small>
                          </div>
                          <p class="mb-2 text-muted small"><?php echo $data['seller_email']; ?> • <?php echo $data['seller_contact']; ?><br>
                        <?php echo $data['seller_address']; ?></p><br>
                          <p class="mb-0"><?php echo $data['feedback_content']; ?></p>
                        </div>
                      </div>
                    </div>
                    <?php
                      }
                    } else {
                    ?>
                    <div class="text-center py-5">
                      <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                      <h5 class="text-muted">No feedback yet</h5>
                      <p class="text-muted">Sellers haven't submitted any feedback.</p>
                    </div>
                    <?php
                    }
                    ?>
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