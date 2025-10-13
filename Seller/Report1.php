<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");

$seller_id = $_SESSION["sid"]; // seller login session

// --- DATE FILTER ---
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to   = isset($_GET['to']) ? $_GET['to'] : '';
$dateCondition = ($from && $to) ? " AND DATE(b.booking_date) BETWEEN '$from' AND '$to' " : "";
$customDateCondition = ($from && $to) ? " AND DATE(customization_date) BETWEEN '$from' AND '$to' " : "";

// ---------- 1. SALES SUMMARY ----------
$summaryQry = "
    SELECT 
        SUM(CASE WHEN b.booking_status='5' AND c.cart_status='1' 
            THEN (c.cart_quantity * CAST(p.product_price AS DECIMAL(10,2))) ELSE 0 END) as total_revenue,
        COUNT(DISTINCT CASE WHEN b.booking_status='5' THEN b.booking_id END) as completed_orders,
        COUNT(DISTINCT b.booking_id) as total_orders,
        SUM(CASE WHEN b.booking_status='5' AND c.cart_status='1' THEN c.cart_quantity ELSE 0 END) as total_items_sold,
        AVG(CASE WHEN b.booking_status='5' AND c.cart_status='1' 
            THEN (c.cart_quantity * CAST(p.product_price AS DECIMAL(10,2))) END) as avg_order_value
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    WHERE p.seller_id = '$seller_id' $dateCondition
";
$summary = $con->query($summaryQry)->fetch_assoc();

// ---------- 2. BOOKING STATUS BREAKDOWN ----------
$statusLabels = [
    '0' => 'Pending',
    '1' => 'Confirmed', 
    '2' => 'Processing',
    '3' => 'Shipped',
    '4' => 'Out for Delivery',
    '5' => 'Delivered',
    '6' => 'Cancelled'
];

$bookingStatusQry = "
    SELECT 
        b.booking_status, 
        COUNT(DISTINCT b.booking_id) as order_count,
        SUM(b.booking_amount) as total_amount
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    WHERE p.seller_id='$seller_id' AND c.cart_status='1' $dateCondition
    GROUP BY b.booking_status
    ORDER BY b.booking_status
";
$bookingStatusRes = $con->query($bookingStatusQry);

// ---------- 3. MONTHLY SALES TREND ----------
$monthlyQry = "
    SELECT 
        DATE_FORMAT(b.booking_date, '%Y-%m') as month,
        SUM(CASE WHEN b.booking_status='5' THEN b.booking_amount ELSE 0 END) as revenue,
        COUNT(DISTINCT CASE WHEN b.booking_status='5' THEN b.booking_id END) as orders,
        SUM(CASE WHEN b.booking_status='5' THEN c.cart_quantity ELSE 0 END) as items_sold
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    WHERE p.seller_id = '$seller_id' AND c.cart_status='1' $dateCondition
    GROUP BY DATE_FORMAT(b.booking_date, '%Y-%m')
    ORDER BY month DESC
    LIMIT 12
";
$monthlyRes = $con->query($monthlyQry);

// ---------- 4. TOP PERFORMING PRODUCTS ----------
$topProductQry = "
    SELECT 
        p.product_id,
        p.product_name, 
        p.product_price,
        SUM(c.cart_quantity) as qty_sold, 
        SUM(CASE WHEN b.booking_status='5' THEN c.cart_quantity * p.product_price ELSE 0 END) as revenue,
        COUNT(DISTINCT b.booking_id) as order_count,
        AVG(IFNULL(r.user_rating, 0)) as avg_rating
    FROM tbl_product p
    LEFT JOIN tbl_cart c ON p.product_id = c.product_id AND c.cart_status='1'
    LEFT JOIN tbl_booking b ON c.booking_id = b.booking_id
    LEFT JOIN tbl_review r ON p.product_id = r.product_id
    WHERE p.seller_id='$seller_id' AND b.booking_status='5' $dateCondition
    GROUP BY p.product_id
    ORDER BY qty_sold DESC
    LIMIT 10
";
$topProductRes = $con->query($topProductQry);

// ---------- 5. CUSTOMER INSIGHTS ----------
$customerQry = "
    SELECT 
        u.user_id,
        u.user_name, 
        u.user_email,
        COUNT(DISTINCT b.booking_id) as total_orders,
        SUM(CASE WHEN b.booking_status='5' THEN b.booking_amount ELSE 0 END) as total_spent,
        AVG(CASE WHEN b.booking_status='5' THEN b.booking_amount END) as avg_order_value,
        MAX(b.booking_date) as last_order_date
    FROM tbl_booking b
    INNER JOIN tbl_cart c ON b.booking_id = c.booking_id
    INNER JOIN tbl_product p ON c.product_id = p.product_id
    INNER JOIN tbl_user u ON b.user_id = u.user_id
    WHERE p.seller_id='$seller_id' AND c.cart_status='1' $dateCondition
    GROUP BY u.user_id
    ORDER BY total_spent DESC
    LIMIT 10
";
$customerRes = $con->query($customerQry);

// ---------- 6. STOCK & INVENTORY REPORT ----------
$stockQry = "
    SELECT 
        p.product_id,
        p.product_name, 
        p.product_price,
        cat.category_name,
        subcat.subcategory_name,
        IFNULL((SELECT SUM(stock_count) FROM tbl_stock WHERE product_id = p.product_id), 0) as total_added_stock,
        IFNULL((
            SELECT SUM(c.cart_quantity) 
            FROM tbl_cart c 
            INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
            WHERE c.product_id = p.product_id 
            AND c.cart_status = '1' 
            AND b.booking_status = '5'
        ), 0) as sold_quantity,
        (
            IFNULL((SELECT SUM(stock_count) FROM tbl_stock WHERE product_id = p.product_id), 0) -
            IFNULL((
                SELECT SUM(c.cart_quantity) 
                FROM tbl_cart c 
                INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                WHERE c.product_id = p.product_id 
                AND c.cart_status = '1' 
                AND b.booking_status = '5'
            ), 0)
        ) as current_stock,
        CASE 
            WHEN (
                IFNULL((SELECT SUM(stock_count) FROM tbl_stock WHERE product_id = p.product_id), 0) -
                IFNULL((
                    SELECT SUM(c.cart_quantity) 
                    FROM tbl_cart c 
                    INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                    WHERE c.product_id = p.product_id 
                    AND c.cart_status = '1' 
                    AND b.booking_status = '5'
                ), 0)
            ) <= 0 THEN 'Out of Stock'
            WHEN (
                IFNULL((SELECT SUM(stock_count) FROM tbl_stock WHERE product_id = p.product_id), 0) -
                IFNULL((
                    SELECT SUM(c.cart_quantity) 
                    FROM tbl_cart c 
                    INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                    WHERE c.product_id = p.product_id 
                    AND c.cart_status = '1' 
                    AND b.booking_status = '5'
                ), 0)
            ) <= 5 THEN 'Low Stock'
            ELSE 'In Stock'
        END as stock_status
    FROM tbl_product p
    LEFT JOIN tbl_subcategory subcat ON p.subcategory_id = subcat.subcategory_id
    LEFT JOIN tbl_category cat ON subcat.category_id = cat.category_id
    WHERE p.seller_id='$seller_id'
    ORDER BY current_stock ASC
";
$stockRes = $con->query($stockQry);

// ---------- 7. CUSTOMIZATION REPORTS ----------
$customizationSummaryQry = "
    SELECT 
        SUM(CASE WHEN customization_status='6' THEN CAST(customization_amount AS DECIMAL(10,2)) ELSE 0 END) as total_custom_revenue,
        COUNT(CASE WHEN customization_status='6' THEN customization_id END) as completed_customs,
        COUNT(customization_id) as total_custom_requests,
        AVG(CASE WHEN customization_status='6' THEN CAST(customization_amount AS DECIMAL(10,2)) END) as avg_custom_value
    FROM tbl_customization
    WHERE seller_id='$seller_id' $customDateCondition
";
$customSummary = $con->query($customizationSummaryQry)->fetch_assoc();

$customStatusQry = "
    SELECT 
        customization_status, 
        COUNT(customization_id) as count,
        SUM(CAST(customization_amount AS DECIMAL(10,2))) as total_amount
    FROM tbl_customization
    WHERE seller_id='$seller_id' $customDateCondition
    GROUP BY customization_status 
    ORDER BY customization_status
";
$customStatusRes = $con->query($customStatusQry);

// ---------- 8. REVIEWS & RATINGS ----------
$reviewQry = "
    SELECT 
        AVG(r.user_rating) as avg_rating,
        COUNT(r.review_id) as total_reviews,
        SUM(CASE WHEN r.user_rating >= 2 THEN 1 ELSE 0 END) as positive_reviews,
        SUM(CASE WHEN r.user_rating <= 1 THEN 1 ELSE 0 END) as negative_reviews
    FROM tbl_review r
    INNER JOIN tbl_product p ON r.product_id = p.product_id
    WHERE p.seller_id = '$seller_id'
";
$reviewSummary = $con->query($reviewQry)->fetch_assoc();

// ---------- 9. COMPLAINT ANALYSIS ----------
$complaintQry = "
    SELECT 
        COUNT(c.complaint_id) as total_complaints,
        SUM(CASE WHEN c.complaint_status = '1' THEN 1 ELSE 0 END) as resolved_complaints,
        SUM(CASE WHEN c.complaint_status = '0' THEN 1 ELSE 0 END) as pending_complaints
    FROM tbl_complaint c
    INNER JOIN tbl_booking b ON c.booking_id = b.booking_id
    INNER JOIN tbl_cart cart ON b.booking_id = cart.booking_id
    INNER JOIN tbl_product p ON cart.product_id = p.product_id
    WHERE p.seller_id = '$seller_id' AND cart.cart_status='1'
";
$complaintSummary = $con->query($complaintQry)->fetch_assoc();

// ---------- 10. CATEGORY WISE PERFORMANCE ----------
$categoryQry = "
    SELECT 
        cat.category_name,
        subcat.subcategory_name,
        COUNT(DISTINCT p.product_id) as product_count,
        SUM(CASE WHEN b.booking_status='5' AND c.cart_status='1' THEN c.cart_quantity ELSE 0 END) as total_sold,
        SUM(CASE WHEN b.booking_status='5' AND c.cart_status='1' THEN c.cart_quantity * p.product_price ELSE 0 END) as revenue
    FROM tbl_product p
    LEFT JOIN tbl_subcategory subcat ON p.subcategory_id = subcat.subcategory_id
    LEFT JOIN tbl_category cat ON subcat.category_id = cat.category_id
    LEFT JOIN tbl_cart c ON p.product_id = c.product_id
    LEFT JOIN tbl_booking b ON c.booking_id = b.booking_id
    WHERE p.seller_id = '$seller_id' $dateCondition
    GROUP BY cat.category_id, subcat.subcategory_id
    HAVING revenue > 0
    ORDER BY revenue DESC
";
$categoryRes = $con->query($categoryQry);

// Prepare chart data
$monthlyData = [];
$monthlyLabels = [];
$monthlyRes->data_seek(0);
while($row = $monthlyRes->fetch_assoc()) {
    $monthlyLabels[] = $row['month'];
    $monthlyData[] = floatval($row['revenue']);
}
$monthlyLabels = array_reverse($monthlyLabels);
$monthlyData = array_reverse($monthlyData);

$productNames = [];
$productSales = [];
$topProductRes->data_seek(0);
while($row = $topProductRes->fetch_assoc()) {
    $productNames[] = substr($row['product_name'], 0, 20);
    $productSales[] = intval($row['qty_sold']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comprehensive Seller Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            margin-bottom: 20px;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .metric-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .metric-value {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }
        .status-badge {
            font-size: 0.9rem;
            padding: 5px 12px;
            border-radius: 20px;
        }
        .chart-container {
            position: relative;
            height: 400px;
            padding: 20px;
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-6 text-primary mb-0">
                <i class="fas fa-chart-line"></i> Seller Analytics Dashboard
            </h1>
            <p class="text-muted">Comprehensive business insights and reports</p>
        </div>
    </div>

    <!-- Date Filter -->
    <div class="card dashboard-card no-print">
        <div class="card-body">
            <form method="get" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label"><i class="fas fa-calendar-alt"></i> From Date</label>
                    <input type="date" name="from" class="form-control" value="<?php echo htmlspecialchars($from); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="fas fa-calendar-alt"></i> To Date</label>
                    <input type="date" name="to" class="form-control" value="<?php echo htmlspecialchars($to); ?>">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Apply Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="metric-card">
                <i class="fas fa-rupee-sign fa-2x"></i>
                <div class="metric-value">₹<?php echo number_format($summary['total_revenue'] ?? 0, 2); ?></div>
                <div>Total Revenue</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="metric-card" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <i class="fas fa-shopping-cart fa-2x"></i>
                <div class="metric-value"><?php echo $summary['completed_orders'] ?? 0; ?></div>
                <div>Completed Orders</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="metric-card" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
                <i class="fas fa-box fa-2x"></i>
                <div class="metric-value"><?php echo $summary['total_items_sold'] ?? 0; ?></div>
                <div>Items Sold</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="metric-card" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                <i class="fas fa-chart-bar fa-2x"></i>
                <div class="metric-value">₹<?php echo number_format($summary['avg_order_value'] ?? 0, 2); ?></div>
                <div>Avg Order Value</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="metric-card" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                <i class="fas fa-palette fa-2x"></i>
                <div class="metric-value">₹<?php echo number_format($customSummary['total_custom_revenue'] ?? 0, 2); ?></div>
                <div>Custom Revenue</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="metric-card" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                <i class="fas fa-star fa-2x"></i>
                <div class="metric-value"><?php echo number_format($reviewSummary['avg_rating'] ?? 0, 1); ?></div>
                <div>Avg Rating</div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row mb-4">
        <!-- Monthly Sales Trend -->
        <div class="col-md-8">
            <div class="card dashboard-card">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fas fa-line-chart"></i> Monthly Sales Trend</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Booking Status Distribution -->
        <div class="col-md-4">
            <div class="card dashboard-card">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-clipboard-list"></i> Order Status</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Status Details -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card dashboard-card">
                <div class="card-header bg-info text-white">
                    <h5><i class="fas fa-list"></i> Detailed Order Status Report</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Status</th>
                                    <th>Order Count</th>
                                    <th>Total Amount</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $totalOrders = $summary['total_orders'] ?? 1;
                                $bookingStatusRes->data_seek(0);
                                while($row = $bookingStatusRes->fetch_assoc()): 
                                    $percentage = $totalOrders > 0 ? ($row['order_count'] / $totalOrders) * 100 : 0;
                                ?>
                                <tr>
                                    <td>
                                        <span class="status-badge bg-primary text-white">
                                            <?php echo $statusLabels[$row['booking_status']] ?? 'Unknown'; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $row['order_count']; ?></td>
                                    <td>₹<?php echo number_format($row['total_amount'], 2); ?></td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" role="progressbar" 
                                                 style="width: <?php echo $percentage; ?>%">
                                                <?php echo number_format($percentage, 1); ?>%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products & Customer Insights -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card dashboard-card">
                <div class="card-header bg-warning text-dark">
                    <h5><i class="fas fa-trophy"></i> Top Performing Products</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Sold</th>
                                    <th>Revenue</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $topProductRes->data_seek(0);
                                while($row = $topProductRes->fetch_assoc()): 
                                ?>
                                <tr>
                                    <td class="text-truncate" style="max-width: 150px;">
                                        <?php echo htmlspecialchars($row['product_name']); ?>
                                    </td>
                                    <td><?php echo $row['qty_sold']; ?></td>
                                    <td>₹<?php echo number_format($row['revenue'], 2); ?></td>
                                    <td>
                                        <span class="badge bg-success">
                                            <?php echo number_format($row['avg_rating'], 1); ?> ⭐
                                        </span>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card dashboard-card">
                <div class="card-header bg-secondary text-white">
                    <h5><i class="fas fa-users"></i> Top Customers</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Orders</th>
                                    <th>Total Spent</th>
                                    <th>Avg Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $customerRes->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                    <td><?php echo $row['total_orders']; ?></td>
                                    <td>₹<?php echo number_format($row['total_spent'], 2); ?></td>
                                    <td>₹<?php echo number_format($row['avg_order_value'], 2); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Management -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card dashboard-card">
                <div class="card-header bg-danger text-white">
                    <h5><i class="fas fa-warehouse"></i> Stock & Inventory Management</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>SubCategory</th>
                                    <th>Price</th>
                                    <th>Total Added</th>
                                    <th>Total Sold</th>
                                    <th>Available</th>
                                    <th>Status</th>
                                    <th class="no-print">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if($stockRes && $stockRes->num_rows > 0):
                                    while($row = $stockRes->fetch_assoc()): 
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['subcategory_name']); ?></td>
                                    <td>₹<?php echo number_format($row['product_price'], 2); ?></td>
                                    <td><span class="badge bg-info"><?php echo $row['total_added_stock']; ?></span></td>
                                    <td><span class="badge bg-primary"><?php echo $row['sold_quantity']; ?></span></td>
                                    <td><strong><?php echo $row['current_stock']; ?></strong></td>
                                    <td>
                                        <?php 
                                        $statusClass = 'bg-success';
                                        if($row['stock_status'] == 'Low Stock') $statusClass = 'bg-warning text-dark';
                                        if($row['stock_status'] == 'Out of Stock') $statusClass = 'bg-danger';
                                        ?>
                                        <span class="badge <?php echo $statusClass; ?>">
                                            <?php echo $row['stock_status']; ?>
                                        </span>
                                    </td>
                                    <td class="no-print">
                                        <a href="Stock.php?pid=<?php echo $row['product_id'] ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-boxes"></i> Add Stock
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                    endwhile;
                                else:
                                ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No products found</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customization & Category Reports -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card dashboard-card">
                <div class="card-header text-white" style="background-color: #6f42c1 !important;">
                    <h5><i class="fas fa-paint-brush"></i> Customization Status</h5>
                </div>
                <!-- Status 0 = Pending  
                Status 1 = Accepted 
                Status 2 = Reject
                Status 3 = Payment Complted <br> 
                Status 4 = Product Packed 
                Status 5 = Product Shipped 
                Status 6 = Order Completed -->
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="customStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card dashboard-card">
                <div class="card-header bg-dark text-white">
                    <h5><i class="fas fa-tags"></i> Category Performance</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>SubCategory</th>
                                    <th>Products</th>
                                    <th>Units Sold</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $categoryRes->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['subcategory_name']); ?></td>
                                    <td><?php echo $row['product_count']; ?></td>
                                    <td><?php echo $row['total_sold']; ?></td>
                                    <td>₹<?php echo number_format($row['revenue'], 2); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Business Health Metrics -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card dashboard-card text-center">
                <div class="card-body">
                    <i class="fas fa-comments fa-3x text-primary mb-3"></i>
                    <h5>Customer Feedback</h5>
                    <p class="text-muted">Total Reviews: <?php echo $reviewSummary['total_reviews'] ?? 0; ?></p>
                    <p class="text-success">Positive: <?php echo $reviewSummary['positive_reviews'] ?? 0; ?></p>
                    <p class="text-danger">Negative: <?php echo $reviewSummary['negative_reviews'] ?? 0; ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card dashboard-card text-center">
                <div class="card-body">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h5>Customer Complaints</h5>
                    <p class="text-muted">Total: <?php echo $complaintSummary['total_complaints'] ?? 0; ?></p>
                    <p class="text-success">Resolved: <?php echo $complaintSummary['resolved_complaints'] ?? 0; ?></p>
                    <p class="text-danger">Pending: <?php echo $complaintSummary['pending_complaints'] ?? 0; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card dashboard-card text-center">
                <div class="card-body">
                    <i class="fas fa-cog fa-3x text-info mb-3"></i>
                    <h5>Customization Orders</h5>
                    <p class="text-muted">Total Requests: <?php echo $customSummary['total_custom_requests'] ?? 0; ?></p>
                    <p class="text-success">Completed: <?php echo $customSummary['completed_customs'] ?? 0; ?></p>
                    <p class="text-primary">Revenue: ₹<?php echo number_format($customSummary['total_custom_revenue'] ?? 0, 2); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Monthly Sales Chart
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
const monthlyGradient = monthlyCtx.createLinearGradient(0, 0, 0, 400);
monthlyGradient.addColorStop(0, 'rgba(54, 162, 235, 0.8)');
monthlyGradient.addColorStop(1, 'rgba(54, 162, 235, 0.1)');

new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($monthlyLabels); ?>,
        datasets: [{
            label: 'Monthly Revenue (₹)',
            data: <?php echo json_encode($monthlyData); ?>,
            borderColor: '#007bff',
            backgroundColor: monthlyGradient,
            borderWidth: 3,
            pointBackgroundColor: '#007bff',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(context) {
                        return 'Revenue: ₹' + context.parsed.y.toLocaleString();
                    }
                }
            }
        },
        scales: {
            x: {
                display: true,
                grid: {
                    display: false
                }
            },
            y: {
                display: true,
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                },
                ticks: {
                    callback: function(value) {
                        return '₹' + value.toLocaleString();
                    }
                }
            }
        }
    }
});

// Order Status Pie Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
const statusData = [];
const statusLabels = [];
const statusColors = [
    '#6c757d', // Pending - Gray
    '#17a2b8', // Confirmed - Info
    '#ffc107', // Processing - Warning  
    '#fd7e14', // Shipped - Orange
    '#20c997', // Out for Delivery - Teal
    '#28a745', // Delivered - Success
    '#dc3545'  // Cancelled - Danger
];

<?php 
$bookingStatusRes->data_seek(0);
while($row = $bookingStatusRes->fetch_assoc()): 
?>
statusLabels.push('<?php echo $statusLabels[$row['booking_status']] ?? 'Status ' . $row['booking_status']; ?>');
statusData.push(<?php echo $row['order_count']; ?>);
<?php endwhile; ?>

new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: statusLabels,
        datasets: [{
            data: statusData,
            backgroundColor: statusColors,
            borderColor: '#fff',
            borderWidth: 3,
            hoverOffset: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                        return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                    }
                }
            }
        }
    }
});

// Top Products Bar Chart
const productCtx = document.getElementById('topProductsChart');
if(productCtx) {
    new Chart(productCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productNames); ?>,
            datasets: [{
                label: 'Units Sold',
                data: <?php echo json_encode($productSales); ?>,
                backgroundColor: [
                    '#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff',
                    '#ff9f40', '#8dd17e', '#e07b91', '#50c878', '#ff6f61'
                ],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Sold: ' + context.parsed.x + ' units';
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
}

// Customization Status Chart
const customCtx = document.getElementById('customStatusChart').getContext('2d');
const customStatusData = [];
const customStatusLabels = [];
const customStatusMap = {
    '0': 'Pending',
    '1': 'Accepted', 
    '2': 'Rejected',
    '3': 'In Progress',
    '4': 'Completed',
    '5': 'Paid',
    '6': 'Cancelled'
};

<?php 
$customStatusRes->data_seek(0);
while($row = $customStatusRes->fetch_assoc()): 
?>
customStatusLabels.push('<?php echo $customStatusMap[$row['customization_status']] ?? 'Status ' . $row['customization_status']; ?>');
customStatusData.push(<?php echo $row['count']; ?>);
<?php endwhile; ?>

if(customStatusData.length > 0) {
    new Chart(customCtx, {
        type: 'pie',
        data: {
            labels: customStatusLabels,
            datasets: [{
                data: customStatusData,
                backgroundColor: [
                    '#ffc107', '#28a745', '#17a2b8', '#6f42c1', 
                    '#20c997', '#dc3545', '#fd7e14'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + ' orders';
                        }
                    }
                }
            }
        }
    });
} else {
    customCtx.canvas.parentNode.innerHTML = '<p class="text-center text-muted mt-5">No customization data available</p>';
}

// Print functionality
function printReport() {
    window.print();
}

// Export functionality
function exportData() {
    alert('Export functionality - Integrate with libraries like jsPDF or xlsx for actual implementation');
}
</script>

<!-- Additional Action Buttons -->
<div class="fixed-bottom p-3 no-print" style="z-index: 1000;">
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-primary btn-sm" onclick="printReport()">
            <i class="fas fa-print"></i> Print Report
        </button>
        <button type="button" class="btn btn-success btn-sm" onclick="exportData()">
            <i class="fas fa-download"></i> Export Data
        </button>
        <button type="button" class="btn btn-info btn-sm" onclick="location.reload()">
            <i class="fas fa-sync"></i> Refresh
        </button>
    </div>
</div>

</body>
</html>

<?php include('Footer.php'); ?>