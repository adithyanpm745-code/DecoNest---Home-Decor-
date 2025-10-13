<?php
include("../Assets/Connection/Connection.php");


if(isset($_POST["btn_submit"]))
{
    $reply=$_POST["txt_reply"];
    
    $upQry="update tbl_complaint set complaint_reply='".$reply."',complaint_status=1 where complaint_id='".$_GET['cid']."'";
        if($con->query($upQry))
        {
            ?>
        <script>
        alert("Reply Complaint Successfully Inserted")
        window.location="ViewComplaint.php";
        </script>
            <?php 
        }
    
}

// Get complaint details for context
$complaintDetails = [];
if(isset($_GET['cid'])) {
    $selQry = "SELECT c.*, u.user_name, u.user_email FROM tbl_complaint c 
               INNER JOIN tbl_user u ON c.user_id = u.user_id 
               WHERE c.complaint_id = '".$_GET['cid']."'";
    $result = $con->query($selQry);
    if($result && $result->num_rows > 0) {
        $complaintDetails = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>DecoNest - Reply to Complaint</title>
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
      .complaint-details {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
      }
      .user-info {
        font-size: 0.9rem;
        color: #6c757d;
      }
      .complaint-content {
        background-color: #fff;
        border-left: 4px solid #177dff;
        padding: 15px;
        border-radius: 4px;
        margin-top: 10px;
      }
      .btn-submit {
        background-color: #177dff;
        border-color: #177dff;
        padding: 8px 20px;
        font-weight: 500;
      }
      .btn-submit:hover {
        background-color: #1269d3;
        border-color: #1269d3;
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
                      <h4 class="card-title">Reply to Complaint</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <?php if(!empty($complaintDetails)): ?>
                    <!-- Complaint Details -->
                    <div class="complaint-details">
                      <h5>Complaint Details</h5>
                      <div class="user-info mb-2">
                        <strong>From:</strong> <?php echo $complaintDetails['user_name']; ?> 
                        (<?php echo $complaintDetails['user_email']; ?>)
                        <br>
                        <strong>Date:</strong> <?php echo date('d M Y, h:i A', strtotime($complaintDetails['complaint_date'])); ?>
                      </div>
                      <div class="complaint-content">
                        <p class="mb-0"><?php echo $complaintDetails['complaint_content']; ?></p>
                      </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Reply Form -->
                    <form id="form1" name="form1" method="post" action="">
                      <div class="form-group">
                        <label for="txt_reply" class="form-label"><strong>Your Reply</strong></label>
                        <textarea 
                          name="txt_reply" 
                          id="txt_reply" 
                          class="form-control" 
                          rows="6" 
                          placeholder="Type your response to this complaint here..."
                          required
                        ></textarea>
                      </div>
                      
                      <div class="form-group mt-4">
                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-submit">
                          <i class="fas fa-paper-plane mr-2"></i> Submit Reply
                        </button>
                        <a href="ViewComplaint.php" class="btn btn-secondary ml-2">
                          <i class="fas fa-arrow-left mr-2"></i> Back to Complaints
                        </a>
                      </div>
                    </form>
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