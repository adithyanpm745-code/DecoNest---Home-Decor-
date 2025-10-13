<?php
include("../Assets/Connection/Connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

if(isset($_GET['accept']))
{
    $SelQry = "select * from tbl_seller where seller_id='" . $_GET['accept'] . "'";
    $row = $con->query($SelQry);
    $data = $row->fetch_assoc();

    $email = $data["seller_email"];
    $name = $data["seller_name"];

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'deconest001@gmail.com';
    $mail->Password = 'eymx okcu htcc yvtd';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('deconest001@gmail.com', 'DecoNest');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Seller Verification Approved - DecoNest";

    $mail->Body = "
    <div style='font-family: Arial, sans-serif; color: #b59c9cff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;'>
        <h2 style='color: #26be3bff;'>Seller Verification Approved</h2>
        <h3>Dear $name,</h3>
        <p>We are pleased to inform you that your seller account has been successfully <strong>verified and approved</strong> by the DecoNest team.</p>
        <p>You can now log in to your seller dashboard and start listing your products.</p>
        <p>Welcome to DecoNest – we're excited to have you on board!</p>
        <br>
        <p>Best regards,<br>Team DecoNest</p>
        <a href='mailto:deconest001@gmail.com' style='color: #337ab7;'>deconest001@gmail.com</a></p>
    </div>
    ";

    if($mail->send())
    {
        echo "<script>alert('Email Sent');</script>";
    }
    else
    {
        echo "<script>alert('Email Failed');</script>";
    }

    $upQry = "update tbl_seller set seller_status=1 where seller_id='" . $_GET['accept'] . "'";
    if($con->query($upQry))
    {
        echo "<script>
            alert('You have successfully approved this shop request.');
            window.location = 'SellerList.php';
        </script>";
    }
}
if(isset($_GET['reject']))
{
    $SelQry = "select * from tbl_seller where seller_id='" . $_GET['reject'] . "'";
    $row = $con->query($SelQry);
    $data = $row->fetch_assoc();

    $email = $data["seller_email"];
    $name = $data["seller_name"];

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'deconest001@gmail.com';
    $mail->Password = 'eymx okcu htcc yvtd';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('deconest001@gmail.com', 'DecoNest');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Seller Verification Rejected - DecoNest";

   $mail->Body = "
    <div style='font-family: Arial, sans-serif; color: #333; padding: 20px; border: 1px solid #ddd; border-radius: 8px;'>
        <h2 style='color: #d9534f;'>Seller Verification Rejected</h2>
        <p>Dear <strong>$name</strong>,</p>

        <p>Thank you for your interest in partnering with <strong>DecoNest</strong>. After reviewing your application, we regret to inform you that your seller account has been <span style='color: red; font-weight: bold;'>rejected</span> by our team.</p>

        <p>We understand that this may be disappointing, and we sincerely apologize for any inconvenience caused. If you believe this decision was made in error or if you would like to provide additional information, please feel free to contact our support team for further clarification.</p>

        <p style='margin-top: 20px;'>We appreciate your effort and hope to work with you in the future.</p>

        <p>Warm regards,<br>
        <strong>Team DecoNest</strong><br>
        <a href='mailto:deconest001@gmail.com' style='color: #337ab7;'>deconest001@gmail.com</a></p>
    </div>
";

    if($mail->send())
    {
        echo "<script>alert('Email Sent');</script>";
    }
    else
    {
        echo "<script>alert('Email Failed');</script>";
    }

    $upQry = "update tbl_seller set seller_status=2 where seller_id='" . $_GET['reject'] . "'";
    if($con->query($upQry))
    {
        echo "<script>
            alert('You have successfully rejected this shop request.');
            window.location = 'SellerList.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>DecoNest - Seller Management</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
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
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/demo.css" />
    <style>
      .seller-card {
        transition: all 0.3s ease;
        border-radius: 10px;
      }
      .seller-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      }
      .status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
      }
      .seller-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      }
      .proof-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      }
      .action-btn {
        margin: 2px;
        min-width: 80px;
      }
      .stats-card {
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        color: white;
      }
      .stats-card i {
        font-size: 30px;
        opacity: 0.8;
      }
      .stats-value {
        font-size: 24px;
        font-weight: 700;
      }
      .stats-label {
        font-size: 14px;
        opacity: 0.9;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- Include your sidebar -->
      <?php include("SideBar.php"); ?>

      <div class="main-panel">
        <div class="content">
          <div class="page-inner">
            <div class="page-header">
              <h4 class="page-title">Seller Management</h4>
              <div class="ml-md-auto">
                <ul class="breadcrumbs">
                  <li class="nav-home">
                    <a href="HomePage.php">
                      <i class="flaticon-home"></i>
                    </a>
                  </li>
                  <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                  </li>
                  <li class="nav-item">
                    <a href="#">Sellers</a>
                  </li>
                </ul>
              </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
              <?php
              // Get counts for each status
              $totalQuery = "SELECT COUNT(*) as total FROM tbl_seller";
              $pendingQuery = "SELECT COUNT(*) as pending FROM tbl_seller WHERE seller_status=0";
              $acceptedQuery = "SELECT COUNT(*) as accepted FROM tbl_seller WHERE seller_status=1";
              $rejectedQuery = "SELECT COUNT(*) as rejected FROM tbl_seller WHERE seller_status=2";
              
              $totalResult = $con->query($totalQuery);
              $pendingResult = $con->query($pendingQuery);
              $acceptedResult = $con->query($acceptedQuery);
              $rejectedResult = $con->query($rejectedQuery);
              
              $total = $totalResult->fetch_assoc()['total'];
              $pending = $pendingResult->fetch_assoc()['pending'];
              $accepted = $acceptedResult->fetch_assoc()['accepted'];
              $rejected = $rejectedResult->fetch_assoc()['rejected'];
              ?>
              
              <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #177dff 0%, #2a93fc 100%);">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h3 class="stats-value"><?php echo $total; ?></h3>
                      <p class="stats-label">Total Sellers</p>
                    </div>
                    <div>
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #ffa534 0%, #fdc830 100%);">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h3 class="stats-value"><?php echo $pending; ?></h3>
                      <p class="stats-label">Pending Approval</p>
                    </div>
                    <div>
                      <i class="fas fa-clock"></i>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #2dce89 0%, #48bb78 100%);">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h3 class="stats-value"><?php echo $accepted; ?></h3>
                      <p class="stats-label">Approved Sellers</p>
                    </div>
                    <div>
                      <i class="fas fa-check-circle"></i>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #f3545d 0%, #f56565 100%);">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h3 class="stats-value"><?php echo $rejected; ?></h3>
                      <p class="stats-label">Rejected Sellers</p>
                    </div>
                    <div>
                      <i class="fas fa-times-circle"></i>
                    </div>
                  </div>
                </div>
              </div>
               <a href="Report1.php" class="btn btn-success btn-sm action-btn"><h3>View Seller Reports</h3></a><br>
            </div>

            <!-- Pending Sellers -->
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">New Seller Applications</h4>
                      <!-- <button class="btn btn-primary btn-round ml-auto" data-toggle="collapse" data-target="#pendingSellers">
                        <i class="fa fa-chevron-down"></i>
                      </button> -->
                    </div>
                  </div>
                  <div class="card-body collapse show" id="pendingSellers">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Shop Details</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Customization</th>
                            <th>Proof</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=0;
                          $SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where seller_status=0";
                          $row=$con->query($SelQry);
                          while($data=$row->fetch_assoc())
                          {
                            $i++;
                          ?>
                          <tr>
                            <td><?php echo $i?></td>
                            <td>
                              <img src="../Assets/Files/SellerDocs/<?php echo $data['seller_photo']?>" class="seller-img" alt="Seller Photo">
                            </td>
                            <td>
                              <h4><?php echo $data['seller_name']?></h4>
                              <p class="text-muted"><?php echo $data['seller_email']?></p>
                              <p><?php echo $data['seller_address']?></p>
                            </td>
                            <td><?php echo $data['seller_contact']?></td>
                            <td>
                              District : <?php echo $data['place_name']?><br>
                              Place : <?php echo $data['district_name']?>
                            </td>
                            <td>
                              <?php if($data['seller_customization']==1): ?>
                                <span class="badge badge-success">Available</span>
                              <?php else: ?>
                                <span class="badge badge-secondary">Not Available</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <img src="../Assets/Files/SellerDocs/<?php echo $data['seller_proof']?>" class="proof-img" data-toggle="modal" data-target="#proofModal" onclick="showProofImage(this.src)" style="cursor: pointer;">
                            </td>
                            <td>
                              <a href="SellerList.php?accept=<?php echo $data['seller_id'] ?>" class="btn btn-success btn-sm action-btn">
                                <i class="fas fa-check"></i> Accept
                              </a>
                              <a href="SellerList.php?reject=<?php echo $data['seller_id']?>" class="btn btn-danger btn-sm action-btn">
                                <i class="fas fa-times"></i> Reject
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

            <!-- Approved Sellers -->
            
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Accept Seller Applications</h4>
                      
                    </div>
                  </div>
                  <div class="card-body collapse show" id="pendingSellers">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Shop Details</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Customization</th>
                            <th>Proof</th>
                            <th>Action</th>
                            <th>View Products</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=0;
                          $SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where seller_status=1";
                          $row=$con->query($SelQry);
                          while($data=$row->fetch_assoc())
                          {
                            $i++;
                          ?>
                          <tr>
                            <td><?php echo $i?></td>
                            <td>
                              <img src="../Assets/Files/SellerDocs/<?php echo $data['seller_photo']?>" class="seller-img" alt="Seller Photo">
                            </td>
                            <td>
                              <h4><?php echo $data['seller_name']?></h4>
                              <p class="text-muted"><?php echo $data['seller_email']?></p>
                              <p><?php echo $data['seller_address']?></p>
                            </td>
                            <td><?php echo $data['seller_contact']?></td>
                            <td>
                              District : <?php echo $data['place_name']?><br>
                              Place : <?php echo $data['district_name']?>
                            </td>
                            <td>
                              <?php if($data['seller_customization']==1): ?>
                                <span class="badge badge-success">Available</span><br><br>
                                 <a href="ViewCustomization.php?sellercustom=<?php echo $data['seller_id'] ?>" class=""> View Customization</a>
                              <?php else: ?>
                                <span class="badge badge-secondary">Not Available</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <img src="../Assets/Files/SellerDocs/<?php echo $data['seller_proof']?>" class="proof-img" data-toggle="modal" data-target="#proofModal" onclick="showProofImage(this.src)" style="cursor: pointer;">
                            </td>
                            <td>
                              
                              <a href="SellerList.php?reject=<?php echo $data['seller_id']?>" class="btn btn-danger btn-sm action-btn">
                                <i class="fas fa-times"></i> Reject
                              </a>
                            </td>
                            <td>
                              <a href="ViewMore.php?sellermore=<?php echo $data['seller_id'] ?>" class="btn btn-success btn-sm action-btn"> View </a>
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

            <!-- Rejected Sellers -->
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Reject Seller Applications</h4>
                      
                    </div>
                  </div>
                  <div class="card-body collapse show" id="pendingSellers">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Shop Details</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Customization</th>
                            <th>Proof</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=0;
                          $SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where seller_status=2";
                          $row=$con->query($SelQry);
                          while($data=$row->fetch_assoc())
                          {
                            $i++;
                          ?>
                          <tr>
                            <td><?php echo $i?></td>
                            <td>
                              <img src="../Assets/Files/SellerDocs/<?php echo $data['seller_photo']?>" class="seller-img" alt="Seller Photo">
                            </td>
                            <td>
                              <h4><?php echo $data['seller_name']?></h4>
                              <p class="text-muted"><?php echo $data['seller_email']?></p>
                              <p><?php echo $data['seller_address']?></p>
                            </td>
                            <td><?php echo $data['seller_contact']?></td>
                            <td>
                              District : <?php echo $data['place_name']?><br>
                              Place : <?php echo $data['district_name']?>
                            </td>
                            <td>
                              <?php if($data['seller_customization']==1): ?>
                                <span class="badge badge-success">Available</span>
                              <?php else: ?>
                                <span class="badge badge-secondary">Not Available</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <img src="../Assets/Files/SellerDocs/<?php echo $data['seller_proof']?>" class="proof-img" data-toggle="modal" data-target="#proofModal" onclick="showProofImage(this.src)" style="cursor: pointer;">
                            </td>
                            <td>
                              <a href="SellerList.php?accept=<?php echo $data['seller_id'] ?>" class="btn btn-success btn-sm action-btn">
                                <i class="fas fa-check"></i> Accept
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

    <!-- Proof Image Modal -->
    <div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Seller Proof Document</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <img id="proofImage" src="" class="img-fluid" style="max-height: 70vh;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    <!-- Kaiadmin JS -->
    <script src="../Assets/Templates/Admin/assets/js/kaiadmin.min.js"></script>

    <script>
      function showProofImage(src) {
        document.getElementById('proofImage').src = src;
      }
      
      // Initialize tooltips
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
  </body>
</html>