<?php
include("../Assets/Connection/Connection.php");

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>DecoNest - Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="../Assets/Templates/Admin/assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

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
  </head>
  <body>
    <div class="">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="HomePage.php" class="logo">
              <img
                src="../Assets/Templates/Admin/assets/img/kaiadmin/Logo.png" height="150" weight="250"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="HomePage.php">
                        <span class="sub-item">Dashboard 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Pages</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-map-marker-alt"></i> 
                  <p>Location</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="District.php">
                        <span class="sub-item">District</span>
                      </a>
                    </li>
                    <li>
                      <a href="Place.php">
                        <span class="sub-item">Place</span>
                      </a>
                    </li>
                  
                    <!-- <li>
                      <a href="components/gridsystem.html">
                        <span class="sub-item">Grid System</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/panels.html">
                        <span class="sub-item">Panels</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/notifications.html">
                        <span class="sub-item">Notifications</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/sweetalert.html">
                        <span class="sub-item">Sweet Alert</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/font-awesome-icons.html">
                        <span class="sub-item">Font Awesome Icons</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/simple-line-icons.html">
                        <span class="sub-item">Simple Line Icons</span>
                      </a>
                    </li>
                    <li>
                      <a href="components/typography.html">
                        <span class="sub-item">Typography</span>
                      </a>
                    </li>-->
                    
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-layer-group"></i>
                  <p>Category</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="Category.php">
                        <span class="sub-item">Category</span>
                      </a>
                    </li>
                    <li>
                      <a href="SubCategory.php">
                        <span class="sub-item">Sub Category</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square"></i>
                  <p>Forms</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="forms/forms.html">
                        <span class="sub-item">Basic Form</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->

              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#tables">
                  <i class="fas fa-palette"></i>
                  <p>Colour & Material</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="tables">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="Colour.php">
                        <span class="sub-item">Colour</span>
                      </a>
                    </li>
                    <li>
                      <a href="Material.php">
                        <span class="sub-item">Material</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fas fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">User & Seller List</h4>
              </li>

              <li class="nav-item">
                <a href="SellerList.php">
                  <i class="fas fa-user-tie"></i>
                  <p>Seller List</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="UserList.php">
                  <i class="fas fa-users"></i>
                  <p>User List</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#maps">
                  <i class="fas fa-map-marker-alt"></i>
                  <p>Maps</p>
                   <span class="caret"></span> 
                </a>
                <div class="collapse" id="maps">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="SellerList.php">
                        <span class="sub-item">Seller List</span>
                      </a>
                    </li>
                    <li>
                      <a href="UserList.php">
                        <span class="sub-item">User List</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->

              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Complaints & FeedBacks</h4>
              </li>

              <li class="nav-item">
                <a href="ViewComplaint.php">
                  <i class="fas fa-comment-dots"></i>
                  <p>Complaints</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="ViewFeedBack.php">
                  <i class="fas fa-comments"></i>
                  <p>FeedBacks</p>
                </a>
              </li>

              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Reports</h4>
              </li>

              <li class="nav-item">
                <a href="Report.php">
                  <i class="fas fa-comment-dots"></i>
                  <p>Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Report1.php">
                  <i class="fas fa-comment-dots"></i>
                  <p>Seller Wise Reports</p>
                </a>
              </li>

              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-arrow-right-from-bracket"></i>
                </span>
                <h4 class="text-section">Sign Out</h4>
              </li>

              <li class="nav-item">
                <a href="LogOut.php">
                  <i class="fas fa-right-from-bracket"></i>
                  <p>Sign Out</p>
                </a>
              </li>
              
              <!-- <li class="nav-item">
                <a href="widgets.html">
                  <i class="fas fa-desktop"></i>
                  <p>Widgets</p>
                   <span class="badge badge-success">4</span> 
                </a>
              </li> -->

              <!-- <li class="nav-item">
                <a href="../../documentation/index.html">
                  <i class="fas fa-file"></i>
                  <p>Documentation</p>
                  <span class="badge badge-secondary">1</span>
                </a>
              </li> -->

              <!-- <li class="nav-item">
                <a data-bs-toggle="collapse" href="#submenu">
                  <i class="fas fa-bars"></i>
                  <p>Menu Levels</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="submenu">
                  <ul class="nav nav-collapse">
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav1">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="subnav1">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav2">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="subnav2">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a href="#">
                        <span class="sub-item">Level 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> -->

            </ul>
          </div>
        </div>
      </div>


      <!-- End Sidebar -->

      

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

    <!-- Bootstrap Notify -->
    <!-- <script src="../Assets/Templates/Admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->

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
     <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script> 
  </body>
</html>
