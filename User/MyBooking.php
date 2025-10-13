<?php  
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_POST['Cbid']))
{
    $bookingId = $_POST['Cbid']; // value from button

    $updateQry = "UPDATE tbl_booking SET booking_status = 6 WHERE booking_id = '$bookingId'";

    if($con->query($updateQry))
    {
        ?>
        <script>
            alert('You have successfully Cancelled the Product');
            window.location = 'MyBooking.php';
        </script>
        <?php
    }
    else
    {
        echo "Error updating booking status!";
    }
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Bookings</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #4e73df;
      --secondary-color: #f8f9fc;
      --accent-color: #2df306ff;
      --text-color: #5a5c69;
      --light-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      --medium-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(to bottom, #f8f9fc 0%, #e6e9f5 100%);
      color: var(--text-color);
      min-height: 100vh;
    }
    
    .page-container {
      background: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80') no-repeat center center;
      background-size: cover;
      padding: 20px 0;
    }
    
    .content-wrapper {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      box-shadow: var(--medium-shadow);
      backdrop-filter: blur(5px);
      margin: 20px auto;
      padding: 30px;
      max-width: 95%;
    }
    
    .page-header {
      text-align: center;
      margin-bottom: 40px;
      position: relative;
    }
    
    .page-title {
      font-weight: 800;
      color: var(--primary-color);
      margin-bottom: 10px;
      position: relative;
      display: inline-block;
    }
    
    .page-title:after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(to right, var(--primary-color), var(--accent-color));
      border-radius: 2px;
    }
    
    .page-subtitle {
      color: var(--text-color);
      font-size: 1.1rem;
      margin-top: 20px;
    }
    
    .booking-card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: var(--light-shadow);
      margin-bottom: 25px;
      background: linear-gradient(to bottom, #ffffff 0%, #f8f9fc 100%);
    }
    
    .booking-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--medium-shadow);
    }
    
    .card-header-custom {
      background: linear-gradient(to right, var(--primary-color), #6f86d6);
      color: white;
      padding: 15px 20px;
      border-bottom: 0;
    }
    
    .order-badge {
      font-size: 0.85rem;
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 600;
    }
    
    .status-badge {
      padding: 7px 14px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    
    .product-item {
      border-left: 3px solid var(--primary-color);
      transition: all 0.2s ease;
      background: white;
    }
    
    .product-item:hover {
      border-left: 3px solid var(--accent-color);
      background-color: #f8f9fc;
    }
    
    .product-img {
      width: 70px;
      height: 70px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: var(--light-shadow);
    }
    
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      background: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80') no-repeat center center;
      background-size: cover;
      border-radius: 12px;
      color: white;
      position: relative;
    }
    
    .empty-state:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.6);
      border-radius: 12px;
      z-index: 1;
    }
    
    .empty-state-content {
      position: relative;
      z-index: 2;
    }
    
    .empty-icon {
      font-size: 4rem;
      margin-bottom: 20px;
      color: white;
    }
    
    .timeline {
      position: relative;
      padding-left: 30px;
      margin: 20px 0;
    }
    
    .timeline:before {
      content: '';
      position: absolute;
      left: 0;
      top: 8px;
      height: calc(100% - 16px);
      width: 3px;
      background: var(--primary-color);
      border-radius: 3px;
    }
    
    .timeline-item {
      position: relative;
      margin-bottom: 15px;
    }
    
    .timeline-item:before {
      content: '';
      position: absolute;
      left: -30px;
      top: 5px;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: var(--primary-color);
      border: 3px solid white;
      box-shadow: 0 0 0 2px var(--primary-color);
    }
    
    .timeline-item.active:before {
      background: var(--accent-color);
      box-shadow: 0 0 0 2px var(--accent-color);
    }
    
    .action-btn {
      border-radius: 20px;
      padding: 8px 20px;
      font-weight: 600;
      transition: all 0.2s ease;
    }
    
    .items-container {
      max-height: 300px;
      overflow-y: auto;
      padding-right: 5px;
    }
    
    .items-container::-webkit-scrollbar {
      width: 6px;
    }
    
    .items-container::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    
    .items-container::-webkit-scrollbar-thumb {
      background: var(--primary-color);
      border-radius: 10px;
    }
    
    @media (max-width: 768px) {
      .content-wrapper {
        padding: 20px 15px;
      }
      
      .page-title {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header inclusion -->
  <?php include('Header.php'); ?>
  
  <div class="page-container">
    <div class="content-wrapper">
      <div class="page-header">
        <h1 class="page-title display-4">Your Bookings</h1>
        <p class="page-subtitle">Track and manage all your orders in one place</p>
      </div>

      <div class="row">
        <?php
        $i = 0;
        $selqry = "SELECT * FROM tbl_booking b 
                  INNER JOIN tbl_user u ON b.user_id = u.user_id 
                  INNER JOIN tbl_cart c ON b.booking_id = c.booking_id 
                  WHERE booking_status > 0 AND b.user_id = '" . $_SESSION['uid'] . "' group by b.booking_id ORDER BY b.booking_id DESC ";
        $row = $con->query($selqry);

        if ($row->num_rows == 0) {
          echo "
          <div class='col-12'>
            <div class='empty-state'>
              <div class='empty-state-content'>
                <div class='empty-icon'><i class='fas fa-shopping-bag'></i></div>
                <h3 class='text-white'>No bookings yet</h3>
                <p class='text-white'>You haven't made any bookings yet. Start shopping to see your orders here.</p>
                <a href='ViewProduct.php' class='btn btn-light action-btn mt-3'><i class='fas fa-shopping-cart me-2'></i>Start Shopping</a>
              </div>
            </div>
          </div>";
        }

        while ($data = $row->fetch_assoc()) {
            $i++;
        ?>
        <div class="col-12 col-lg-6">
          <div class="booking-card card">
            <div class="card-header-custom">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="mb-0">Order #<?php echo $data['booking_id']; ?></h5>
                  <i class="far fa-calendar me-1"></i> <?php echo $data['booking_date']; ?>
                </div>
                <span class="order-badge bg-light text-dark">#<?php echo $i; ?></span>
              </div>
            </div>
            
            <div class="card-body">
              <div class="row mb-4">
                <div class="col-6">
                  <div class="border-end">
                    <class="text-muted d-block"><?php echo $data['user_name']; ?><br>
                    <class="text-muted d-block"><?php echo $data['user_contact']; ?><br>
                    <class="text-muted d-block"><?php echo $data['user_address']; ?><br><br>
                    <class="text-muted d-block"><h5>Delivery Address</h5><?php echo $data['booking_address']; ?><br><br>
                    <small class="text-muted d-block"><h4>Total Amount<h4></small>
                    <h4 class="text-success fw-bold">₹<?php echo $data['booking_amount']; ?></h4>
                    
                  </div>
                </div>

                

                  <div class="col-6">
                  <small class="text-muted d-block">Status</small>
                  <div>
                    <br>
                    <?php 
                    $statusText = "";
                    $badgeClass = "bg-secondary";

                    if ($data["booking_status"] == 1 && $data["cart_status"] == 1) {
                        $statusText = "Payment Pending";
                        $badgeClass = "bg-warning";

                        ?>
                        <a href='Payment.php?bid=<?php echo $data['booking_id']; ?>' class='btn btn-outline-primary action-btn'>
                        Make Payment</a><br><br>
                        <form method="post">
                       <button type="submit" name="Cbid" value="<?php echo $data['booking_id']; ?>" 
                       class="text-muted d-block"
                                       onclick="return confirm('Are you sure you want to Cancelled the Product?')"><b>Cancel</b>
                      </button>
                      </form><br>
                        <?php
                    } 
                    else if ($data["booking_status"] == 2) {
                      
                        $statusText = "Payment Completed";
                        $badgeClass = "bg-success";
                        ?>
                        <form method="post">
                       <button type="submit" name="Cbid" value="<?php echo $data['booking_id']; ?>" 
                       class="text-muted d-block"
                                       onclick="return confirm('Are you sure you want to Cancelled the Product?')"> <b>Cancel</b>
                      </button>
                      </form><br>
                        <?php 
                    }
                    else if ($data["booking_status"] == 3) {
                        $statusText = "Product Packed";
                        $badgeClass = "bg-info";
                        ?>
                        <form method="post">
                       <button type="submit" name="Cbid" value="<?php echo $data['booking_id']; ?>" 
                       class="text-muted d-block"
                                       onclick="return confirm('Are you sure you want to Cancelled the Product?')"> <b>Cancel</b>
                      </button>
                      </form><br>
                        <?php 
                    }
                    else if ($data["booking_status"] == 4) {
                        $statusText = "Product Shipped";
                        $badgeClass = "bg-primary";
                    }
                    else if ($data["booking_status"] == 5) {
                        $statusText = "Order Completed";
                        $badgeClass = "bg-success";
                    }
                    else if ($data["booking_status"] == 6) {
                        $statusText = "<b><h4>Cancelled</b><h4>";
                        $badgeClass = "text-muted d-block";
                    }
                    else{
                        $statusText = "Unknown Status";
                    }

                    echo "<span class='status-badge $badgeClass text-white'>$statusText</span>";
                    
                    if ($data["booking_status"] == 5) {
                      echo "<a class='status-badge bg-danger text-white ms-1 text-decoration-none' 
                      href='ProductComplaint.php?Bid=".$data['booking_id']."'><i class='fas fa-exclamation-circle me-1'></i>Complaint</a>";
                    }
                    ?>
                  </div>
                </div>
              </div>
              
              <!-- Order Progress -->
              <div class="mb-4">
                <h6 class="mb-3"><i class="fas fa-truck me-2"></i>Order Progress</h6>
                <div class="timeline">
                  <div class="timeline-item <?php echo $data['booking_status'] >= 1 ? 'active' : ''; ?>">
                    <small>Order Placed</small>
                  </div>
                  <div class="timeline-item <?php echo $data['booking_status'] >= 2 ? 'active' : ''; ?>">
                    <small>Payment <?php echo $data['booking_status'] >= 2 ? 'Completed' : 'Pending'; ?></small>
                  </div>
                  <div class="timeline-item <?php echo $data['booking_status'] >= 3 ? 'active' : ''; ?>">
                    <small>Order Packed</small>
                  </div>
                  <div class="timeline-item <?php echo $data['booking_status'] >= 4 ? 'active' : ''; ?>">
                    <small>Shipped</small>
                  </div>
                  <div class="timeline-item <?php echo $data['booking_status'] >= 5 ? 'active' : ''; ?>">
                    <small>Delivered</small>
                  </div>
                </div>
              </div>

              <h6 class="mb-3"><i class="fas fa-boxes me-2"></i>Order Items (<?php
                $cart_count = "SELECT COUNT(*) as count FROM tbl_cart WHERE booking_id = " . $data["booking_id"];
                $count_result = $con->query($cart_count);
                $count_data = $count_result->fetch_assoc();
                echo $count_data['count'];
              ?>)</h6>
              
              <div class="items-container">
              <?php
                $j = 0;
                $cart = "SELECT * FROM tbl_cart c 
                         INNER JOIN tbl_product p ON c.product_id = p.product_id 
                         INNER JOIN tbl_seller s on p.seller_id=  s.seller_id
                         WHERE c.booking_id = " . $data["booking_id"];
                $roW = $con->query($cart);

                while ($data1 = $roW->fetch_assoc()) {
                    $j++;
              ?>
                <div class="product-item p-3 mb-3 rounded">
                  <div class="d-flex align-items-center">
                    <img src="../Assets/Files/ProductDocs/<?php echo $data1['product_photo']; ?>" class="product-img me-3" alt="Product">
                    <div class="flex-grow-1">
                      <h6 class="mb-1 fw-bold"><?php echo $data1['product_name']; ?></h6>
                      <small class="text-muted d-block"><b>Seller:</b> <?php echo $data1['seller_name']; ?> <br>
                      <?php echo $data1['seller_address']; ?> <br>
                    <?php echo $data1['seller_contact']; ?></small>
                      <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="text-primary fw-bold">₹<?php echo number_format($data1['product_price'], 2); ?></span>
                        <span class="text-muted">Qty: <?php echo $data1['cart_quantity']; ?></span>
                        <span class="text-success fw-semibold">₹<?php echo number_format($data1['cart_quantity'] * $data1['product_price'], 2); ?></span>
                        <?php if ($data["booking_status"] ==5) {
                         ?>
                        <a href='Review.php?pid=<?php echo $data1['product_id']; ?>' class='btn btn-outline-primary action-btn'>
                  <i class="fas fa-star me-2"></i>Rate & Review Products
                    </a>
                          <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
              <!-- <div class="card-footer bg-transparent border-top">
              <div class="d-grid gap-2">
                <a href='Review.php?pid=<?php echo $data['product_id']; ?>' class='btn btn-outline-primary action-btn'>
                  <i class="fas fa-star me-2"></i>Rate & Review Products
                </a>
              </div>
            </div> -->
            <div class="card-footer bg-transparent border-top">
              <div class="d-grid gap-2">
                <a href='DownloadBill.php?Bid=<?php echo $data['booking_id']; ?>' class='btn btn-outline-success action-btn'>
                  <i class="fas fa-file-invoice me-2"></i>Download Invoice
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

 <!--::footer_part:-->
    <?php include("Footer.php"); ?>

