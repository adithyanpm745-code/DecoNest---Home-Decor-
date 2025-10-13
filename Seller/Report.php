<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header1.php");

$seller_id = $_SESSION["sid"]; // seller login session

// --- DATE FILTER ---
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to   = isset($_GET['to']) ? $_GET['to'] : '';
$dateCondition = ($from && $to) ? " AND b.booking_date BETWEEN '$from' AND '$to' " : "";

// ---------- 1. SALES SUMMARY ----------
$summaryQry = "
    SELECT SUM(b.booking_amount) as total_revenue,
           COUNT(DISTINCT b.booking_id) as total_orders,
           SUM(c.cart_quantity) as total_items
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    WHERE p.seller_id = '$seller_id' AND b.booking_status='5' $dateCondition
";
$summary = $con->query($summaryQry)->fetch_assoc();

// ---------- 2. MONTHLY SALES ----------
$monthlyQry = "
    SELECT DATE_FORMAT(b.booking_date, '%Y-%m') as month,
           SUM(b.booking_amount) as revenue
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    WHERE p.seller_id = '$seller_id' AND b.booking_status='5' $dateCondition
    GROUP BY DATE_FORMAT(b.booking_date, '%Y-%m')
    ORDER BY month ASC
";
$monthlyRes = $con->query($monthlyQry);

// ---------- 3. TOP PRODUCTS ----------
$topProductQry = "
    SELECT p.product_name, SUM(c.cart_quantity) as qty_sold, SUM(b.booking_amount) as revenue
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    WHERE p.seller_id='$seller_id' AND b.booking_status='5' $dateCondition
    GROUP BY p.product_id
    ORDER BY qty_sold DESC
    LIMIT 5
";
$topProductRes = $con->query($topProductQry);

// ---------- 4. TOP CUSTOMERS ----------
$customerQry = "
    SELECT u.user_name, COUNT(b.booking_id) as orders, SUM(b.booking_amount) as spent
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    INNER JOIN tbl_user u ON b.user_id = u.user_id
    WHERE p.seller_id='$seller_id' AND b.booking_status='5' $dateCondition
    GROUP BY u.user_id
    ORDER BY spent DESC
    LIMIT 5
";
$customerRes = $con->query($customerQry);

// ---------- 5. CUSTOMIZATION SUMMARY ----------
$customQry = "
    SELECT SUM(customization_amount) as custom_revenue, COUNT(customization_id) as custom_orders
    FROM tbl_customization
    WHERE seller_id='$seller_id' AND customization_status='1'
";
if($from && $to){
    $customQry .= " AND customization_date BETWEEN '$from' AND '$to' ";
}
$custom = $con->query($customQry)->fetch_assoc();

// ---------- 6. STOCK REPORT ----------
$stockQry = "
    SELECT p.product_name, 
           IFNULL(SUM(s.stock_count),0) as total_stock,
           IFNULL(SUM(c.cart_quantity),0) as sold_stock,
           (IFNULL(SUM(s.stock_count),0) - IFNULL(SUM(c.cart_quantity),0)) as available_stock
    FROM tbl_product p
    LEFT JOIN tbl_stock s ON p.product_id = s.product_id
    LEFT JOIN tbl_cart c ON p.product_id = c.product_id
    LEFT JOIN tbl_booking b ON c.booking_id = b.booking_id
    WHERE p.seller_id='$seller_id'
    GROUP BY p.product_id
";
$stockRes = $con->query($stockQry);

// ---------- 7. BOOKING STATUS REPORT ----------
$bookingQry = "
    SELECT b.booking_status, COUNT(b.booking_id) as total
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    WHERE p.seller_id='$seller_id' $dateCondition
    GROUP BY b.booking_status
";
$bookingRes = $con->query($bookingQry);

// ---------- 8. CUSTOMIZATION MONTHLY ----------
$customMonthlyQry = "
    SELECT DATE_FORMAT(customization_date, '%Y-%m') as month,
           SUM(customization_amount) as revenue,
           COUNT(customization_id) as orders
    FROM tbl_customization
    WHERE seller_id='$seller_id'
";
if($from && $to){
    $customMonthlyQry .= " AND customization_date BETWEEN '$from' AND '$to' ";
}
$customMonthlyQry .= " GROUP BY DATE_FORMAT(customization_date, '%Y-%m') ORDER BY month ASC";
$customMonthlyRes = $con->query($customMonthlyQry);

// ---------- 9. CUSTOMIZATION STATUS ----------
$customStatusQry = "
    SELECT customization_status, COUNT(customization_id) as total
    FROM tbl_customization
    WHERE seller_id='$seller_id'
";
if($from && $to){
    $customStatusQry .= " AND customization_date BETWEEN '$from' AND '$to' ";
}
$customStatusQry .= " GROUP BY customization_status";
$customStatusRes = $con->query($customStatusQry);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seller Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="p-4 bg-light">

<div class="container">
    <h2 class="mb-4">📊 Seller Reports Dashboard</h2>

    <!-- Date Filter -->
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>From Date</label>
            <input type="date" name="from" class="form-control" value="<?php echo $from; ?>">
        </div>
        <div class="col-md-4">
            <label>To Date</label>
            <input type="date" name="to" class="form-control" value="<?php echo $to; ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <!-- 1. Sales Summary -->
    <div class="row mb-4">
        <div class="col-md-3"><div class="card shadow text-center p-3"><h6>Total Revenue</h6><h4 class="text-success">₹<?php echo $summary['total_revenue'] ?? 0; ?></h4></div></div>
        <div class="col-md-3"><div class="card shadow text-center p-3"><h6>Total Orders</h6><h4><?php echo $summary['total_orders'] ?? 0; ?></h4></div></div>
        <!-- <div class="col-md-3"><div class="card shadow text-center p-3"><h6>Items Sold</h6><h4><?php echo $summary['total_items'] ?? 0; ?></h4></div></div> -->
        <!-- <div class="col-md-3"><div class="card shadow text-center p-3"><h6>Customization Revenue</h6><h4 class="text-primary">₹<?php echo $custom['custom_revenue'] ?? 0; ?></h4></div></div> -->
    </div>

    <!-- 2. Monthly Sales -->
    <div class="card shadow mb-4"><div class="card-body"><h5>📅 Monthly Sales</h5><canvas id="monthlyChart"></canvas></div></div>

    <!-- 3. Top Products & Customers -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4"><div class="card-body">
                <h5>🏆 Top Products</h5>
                <table class="table table-bordered"><tr><th>Product</th><th>Qty Sold</th><th>Revenue</th></tr>
                <?php 
                $prodNames=[];$prodQty=[];
                while($row=$topProductRes->fetch_assoc()){ 
                    echo "<tr><td>{$row['product_name']}</td><td>{$row['qty_sold']}</td><td>₹{$row['revenue']}</td></tr>";
                    $prodNames[]=$row['product_name'];
                    $prodQty[]=$row['qty_sold'];
                } ?>
                </table>
                <canvas id="topProductsChart"></canvas>
            </div></div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4"><div class="card-body">
                <h5>👥 Top Customers</h5>
                <table class="table table-bordered"><tr><th>Customer</th><th>Orders</th><th>Spent</th></tr>
                <?php while($row=$customerRes->fetch_assoc()){ echo "<tr><td>{$row['user_name']}</td><td>{$row['orders']}</td><td>₹{$row['spent']}</td></tr>"; } ?>
                </table>
            </div></div>
        </div>
    </div>

    <!-- 4. Stock Report -->
    <div class="card shadow mb-4"><div class="card-body">
        <h5>📦 Stock Report</h5>
        <table class="table table-bordered">
            <tr><th>Product</th><th>Total Stock</th><th>Sold</th><th>Available</th></tr>
            <?php while($row=$stockRes->fetch_assoc()){ echo "<tr><td>{$row['product_name']}</td><td>{$row['total_stock']}</td><td>{$row['sold_stock']}</td><td>{$row['available_stock']}</td></tr>"; } ?>
        </table>
    </div></div>

    <!-- 5. Booking Status -->
    <div class="card shadow mb-4"><div class="card-body">
        <h5>📑 Booking Status Report</h5>
        <canvas id="bookingChart"></canvas>
    </div></div>

    <!-- 6. Customization Reports -->
    <div class="card shadow mb-4"><div class="card-body">
        <h5>🎨 Customization Orders Report</h5>
        <div class="row">
            <div class="col-md-6"><canvas id="customMonthlyChart"></canvas></div>
            <div class="col-md-6"><canvas id="customStatusChart"></canvas></div>
        </div>
    </div></div>
</div>

<script>
// Monthly Sales Chart with gradient
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
const gradient = monthlyCtx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(54, 162, 235, 0.6)');
gradient.addColorStop(1, 'rgba(54, 162, 235, 0.1)');
new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: [<?php $monthlyRes->data_seek(0); while($m=$monthlyRes->fetch_assoc()){ echo "'".$m['month']."',"; } ?>],
        datasets: [{
            label: 'Revenue (₹)',
            data: [<?php $monthlyRes->data_seek(0); while($m=$monthlyRes->fetch_assoc()){ echo $m['revenue'].","; } ?>],
            borderColor: '#007bff',
            backgroundColor: gradient,
            borderWidth: 3,
            pointBackgroundColor: '#007bff',
            fill: true,
            tension: 0.4
        }]
    }
});

// Top Products Pie Chart colorful
const productCtx = document.getElementById('topProductsChart').getContext('2d');
new Chart(productCtx, {
    type: 'pie',
    data: { labels: <?php echo json_encode($prodNames); ?>,
        datasets: [{ data: <?php echo json_encode($prodQty); ?>,
            backgroundColor: [
                '#ff6384','#36a2eb','#ffce56','#4bc0c0','#9966ff',
                '#ff9f40','#8dd17e','#e07b91','#50c878','#ff6f61'
            ],
            borderColor: '#fff',
            borderWidth: 2 }] }
});

// Booking Status Bar Chart colorful
const bookingCtx = document.getElementById('bookingChart').getContext('2d');
new Chart(bookingCtx, {
    type: 'bar',
    data: {
        labels: [<?php while($b=$bookingRes->fetch_assoc()){ echo "'Status ".$b['booking_status']."',"; } ?>],
        datasets: [{
            label: 'Bookings',
            data: [<?php $bookingRes->data_seek(0); while($b=$bookingRes->fetch_assoc()){ echo $b['total'].","; } ?>],
            backgroundColor: [
                'rgba(75, 192, 192, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(255, 205, 86, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(153, 102, 255, 0.7)'
            ],
            borderColor: '#333',
            borderWidth: 1
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});

// Customization Monthly Revenue Chart with gradient
const customMonthlyCtx = document.getElementById('customMonthlyChart').getContext('2d');
const customGradient = customMonthlyCtx.createLinearGradient(0, 0, 0, 400);
customGradient.addColorStop(0, 'rgba(255, 87, 51, 0.6)');
customGradient.addColorStop(1, 'rgba(255, 87, 51, 0.1)');
new Chart(customMonthlyCtx, {
    type: 'line',
    data: {
        labels: [<?php $customMonthlyRes->data_seek(0); while($m=$customMonthlyRes->fetch_assoc()){ echo "'".$m['month']."',"; } ?>],
        datasets: [{
            label: 'Customization Revenue (₹)',
            data: [<?php $customMonthlyRes->data_seek(0); while($m=$customMonthlyRes->fetch_assoc()){ echo $m['revenue'].","; } ?>],
            borderColor: '#ff5733',
            backgroundColor: customGradient,
            borderWidth: 3,
            pointBackgroundColor: '#ff5733',
            fill: true,
            tension: 0.4
        }]
    }
});

// Customization Status Doughnut colorful
const customStatusCtx = document.getElementById('customStatusChart').getContext('2d');
new Chart(customStatusCtx, {
    type: 'doughnut',
    data: {
        labels: [<?php while($cs=$customStatusRes->fetch_assoc()){ echo "'Status ".$cs['customization_status']."',"; } ?>],
        datasets: [{
            data: [<?php $customStatusRes->data_seek(0); while($cs=$customStatusRes->fetch_assoc()){ echo $cs['total'].","; } ?>],
            backgroundColor: ['#00c49f','#ff8042','#0088fe','#ffbb28','#d35400','#8e44ad'],
            borderColor: '#fff',
            borderWidth: 2
        }]
    }
});
</script>

</body>
</html>


