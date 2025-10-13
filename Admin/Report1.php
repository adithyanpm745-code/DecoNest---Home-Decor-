<?php
// AdminReports.php (enhanced, seller-wise, full reports)
// Place in same folder as SideBar.php and ../Assets/Connection/Connection.php

include("../Assets/Connection/Connection.php");
@include("SideBar.php");

// ---------- Helpers ----------
function is_valid_date($d) {
    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $d);
}
function db_date_expr($col = 'booking_date') {
    // booking_date stored as 'YYYY-MM-DD' (varchar) in your DB dump.
    return "STR_TO_DATE($col, '%Y-%m-%d')";
}
function cast_money($col) {
    return "CAST($col AS DECIMAL(15,2))";
}
function cast_int($col) {
    return "CAST($col AS UNSIGNED)";
}

// ---------- Input / Filters ----------
$from_date = isset($_POST['from_date']) && is_valid_date($_POST['from_date']) ? $_POST['from_date'] : "";
$to_date   = isset($_POST['to_date'])   && is_valid_date($_POST['to_date'])   ? $_POST['to_date']   : "";
$seller_id = isset($_POST['seller_id']) ? (int)$_POST['seller_id'] : 0;

$dateFilter = "";
if ($from_date && $to_date) {
    $f = $con->real_escape_string($from_date);
    $t = $con->real_escape_string($to_date);
    $dateFilter = " AND " . db_date_expr('b.booking_date') . " BETWEEN '$f' AND '$t' ";
}

// Seller filter (apply to product/sales joins)
$sellerFilter = "";
if ($seller_id > 0) {
    $sellerFilter = " AND p.seller_id = $seller_id ";
}

// ---------- KPI QUERIES ----------
$Q = [
    'total_users' => "SELECT COUNT(*) AS c FROM tbl_user",
    'total_sellers' => "SELECT COUNT(*) AS c FROM tbl_seller WHERE seller_status='1'",
    'total_products' => "SELECT COUNT(*) AS c FROM tbl_product",
    'total_bookings_completed' => "SELECT COUNT(*) AS c FROM tbl_booking b WHERE ".cast_int('b.booking_status')." =5 ",
    'total_revenue' => "SELECT COALESCE(SUM(c.cart_quantity * ".cast_money('p.product_price')."),0) AS amt
                        FROM tbl_cart c
                        JOIN tbl_product p ON p.product_id=c.product_id
                        JOIN tbl_booking b ON b.booking_id=c.booking_id
                        WHERE ".cast_int('b.booking_status')." = 5 $sellerFilter $dateFilter"
];

$stats = [];
foreach ($Q as $k => $sql) {
    $res = $con->query($sql);
    $r = $res ? $res->fetch_assoc() : null;
    if ($r) {
        if (isset($r['c'])) $stats[$k] = (int)$r['c'];
        elseif (isset($r['amt'])) $stats[$k] = (float)$r['amt'];
        else $stats[$k] = 0;
    } else $stats[$k] = 0;
}

// ---------- Daily Sales (trend) ----------
$salesData = [];
$sql = "SELECT DATE_FORMAT(".db_date_expr('b.booking_date').", '%Y-%m-%d') AS d,
               COALESCE(SUM(c.cart_quantity * ".cast_money('p.product_price')."),0) AS total
        FROM tbl_booking b
        JOIN tbl_cart c ON c.booking_id=b.booking_id
        JOIN tbl_product p ON p.product_id=c.product_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilter $sellerFilter
        GROUP BY d ORDER BY d ASC";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) {
    $salesData[$row['d']] = (float)$row['total'];
}

// ---------- Monthly Sales ----------
$monthlySales = [];
$sql = "SELECT DATE_FORMAT(".db_date_expr('b.booking_date').", '%Y-%m') AS m,
               COALESCE(SUM(c.cart_quantity * ".cast_money('p.product_price')."),0) AS total
        FROM tbl_booking b
        JOIN tbl_cart c ON c.booking_id=b.booking_id
        JOIN tbl_product p ON p.product_id=c.product_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilter $sellerFilter
        GROUP BY m ORDER BY m ASC";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) $monthlySales[$row['m']] = (float)$row['total'];

// ---------- Top Products (units) ----------
$topProducts = [];
$sql = "SELECT p.product_id, p.product_name, COALESCE(SUM(c.cart_quantity),0) AS units,
               COALESCE(SUM(c.cart_quantity * ".cast_money('p.product_price')."),0) AS revenue
        FROM tbl_cart c
        JOIN tbl_product p ON p.product_id=c.product_id
        JOIN tbl_booking b ON b.booking_id=c.booking_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilter $sellerFilter
        GROUP BY p.product_id
        ORDER BY units DESC LIMIT 10";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) $topProducts[] = $row;

// ---------- Revenue by Seller ----------
$sellerRevenue = [];
$sql = "SELECT s.seller_id, s.seller_name,
               COALESCE(SUM(c.cart_quantity * ".cast_money('p.product_price')."),0) AS rev,
               COALESCE(SUM(c.cart_quantity),0) AS units
        FROM tbl_cart c
        JOIN tbl_product p ON p.product_id=c.product_id
        JOIN tbl_seller s ON s.seller_id=p.seller_id
        JOIN tbl_booking b ON b.booking_id=c.booking_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilter
        GROUP BY s.seller_id
        ORDER BY rev DESC";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) $sellerRevenue[] = $row;

// If seller filter applied, compute seller share separately
$sellerNameFilter = "";
if ($seller_id > 0) {
    $r = $con->query("SELECT seller_name FROM tbl_seller WHERE seller_id=$seller_id")->fetch_assoc();
    $sellerNameFilter = $r ? $r['seller_name'] : "";
}

// ---------- Revenue by Category ----------
$categoryRevenue = [];
$sql = "SELECT COALESCE(cat.category_name,'Uncategorized') AS cname,
               COALESCE(SUM(ca.cart_quantity * ".cast_money('p.product_price')."),0) AS rev
        FROM tbl_cart ca
        JOIN tbl_product p ON p.product_id=ca.product_id
        LEFT JOIN tbl_subcategory sub ON sub.subcategory_id=p.subcategory_id
        LEFT JOIN tbl_category cat ON cat.category_id=sub.category_id
        JOIN tbl_booking b ON b.booking_id=ca.booking_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilter $sellerFilter
        GROUP BY cname ORDER BY rev DESC";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) $categoryRevenue[$row['cname']] = (float)$row['rev'];

// ---------- Sales by District ----------
$districtSales = [];
$sql = "SELECT COALESCE(d.district_name,'Unknown') AS dname,
               COALESCE(SUM(c.cart_quantity * ".cast_money('p.product_price')."),0) AS rev
        FROM tbl_booking b
        JOIN tbl_user u ON u.user_id=b.user_id
        LEFT JOIN tbl_place pl ON pl.place_id=u.place_id
        LEFT JOIN tbl_district d ON d.district_id=pl.district_id
        JOIN tbl_cart c ON c.booking_id=b.booking_id
        JOIN tbl_product p ON p.product_id=c.product_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilter $sellerFilter
        GROUP BY dname ORDER BY rev DESC LIMIT 12";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) $districtSales[$row['dname']] = (float)$row['rev'];

// ---------- Complaints (global + by seller) ----------
$complaints = ['Pending'=>0,'Resolved'=>0];
$sql = "SELECT
        SUM(CASE WHEN complaint_status='0' THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN complaint_status='1' THEN 1 ELSE 0 END) AS resolved
        FROM tbl_complaint";
$r = $con->query($sql)->fetch_assoc();
if ($r) { $complaints['Pending'] = (int)$r['pending']; $complaints['Resolved'] = (int)$r['resolved']; }

// Complaints by seller (join bookings -> cart -> product -> seller)
$complaintsBySeller = [];
$sql = "SELECT s.seller_id, s.seller_name,
               SUM(CASE WHEN co.complaint_status='0' THEN 1 ELSE 0 END) AS pending,
               SUM(CASE WHEN co.complaint_status='1' THEN 1 ELSE 0 END) AS resolved
        FROM tbl_complaint co
        LEFT JOIN tbl_booking b ON b.booking_id = co.booking_id
        LEFT JOIN tbl_cart c ON c.booking_id = b.booking_id
        LEFT JOIN tbl_product p ON p.product_id = c.product_id
        LEFT JOIN tbl_seller s ON s.seller_id = p.seller_id
        GROUP BY s.seller_id ORDER BY pending DESC";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) $complaintsBySeller[] = $row;

// ---------- Low Stock Alerts ----------
$lowStock = [];
$sql = "SELECT p.product_id, p.product_name, COALESCE(MAX(s.stock_count),0) AS stock_count, p.seller_id, s2.seller_name
        FROM tbl_product p
        LEFT JOIN tbl_stock s ON s.product_id = p.product_id
        LEFT JOIN tbl_seller s2 ON s2.seller_id = p.seller_id
        GROUP BY p.product_id
        HAVING stock_count <= 5
        ORDER BY stock_count ASC";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) $lowStock[] = $row;

// ---------- Reviews & Ratings ----------
$ratings = [];
$sql = "SELECT COALESCE(ROUND(AVG(r.user_rating),2),0) AS avg_rating, COALESCE(COUNT(r.review_id),0) AS reviews
        FROM tbl_review r
        JOIN tbl_product p ON p.product_id=r.product_id
        WHERE 1 $sellerFilter";
$res = $con->query($sql);
$r = $res ? $res->fetch_assoc() : null;
$ratings['avg'] = $r ? (float)$r['avg_rating'] : 0;
$ratings['count'] = $r ? (int)$r['reviews'] : 0;

// ---------- Repeat vs New Customers (in filtered window) ----------
$repeatVsNew = ['new'=>0,'repeat'=>0];
$sql = "SELECT b.user_id, COUNT(DISTINCT b.booking_id) AS bkcount
        FROM tbl_booking b
        JOIN tbl_cart c ON c.booking_id=b.booking_id
        JOIN tbl_product p ON p.product_id=c.product_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilter $sellerFilter
        GROUP BY b.user_id";
$res = $con->query($sql);
while ($row = $res->fetch_assoc()) {
    $cnt = (int)$row['bkcount'];
    if ($cnt > 1) $repeatVsNew['repeat']++;
    else $repeatVsNew['new']++;
}

// ---------- Seller-specific details (if seller filter applied) ----------
$sellerDetails = [];
if ($seller_id > 0) {
    // Top products for the seller
    $sql = "SELECT p.product_id, p.product_name, COALESCE(SUM(c.cart_quantity),0) AS units, COALESCE(SUM(c.cart_quantity * ".cast_money('p.product_price')."),0) AS revenue
            FROM tbl_cart c
            JOIN tbl_product p ON p.product_id=c.product_id
            JOIN tbl_booking b ON b.booking_id=c.booking_id
            WHERE ".cast_int('b.booking_status').">1 AND p.seller_id = $seller_id $dateFilter
            GROUP BY p.product_id ORDER BY units DESC LIMIT 12";
    $res = $con->query($sql);
    while ($row = $res->fetch_assoc()) $sellerDetails['top_products'][] = $row;

    // Seller complaints
    $sql = "SELECT co.*, b.booking_date, u.user_name
            FROM tbl_complaint co
            LEFT JOIN tbl_booking b ON b.booking_id = co.booking_id
            LEFT JOIN tbl_user u ON u.user_id = co.user_id
            LEFT JOIN tbl_cart c ON c.booking_id = b.booking_id
            LEFT JOIN tbl_product p ON p.product_id = c.product_id
            WHERE p.seller_id = $seller_id
            ORDER BY co.complaint_date DESC LIMIT 50";
    $res = $con->query($sql);
    while ($row = $res->fetch_assoc()) $sellerDetails['complaints'][] = $row;

    // Seller stock summary
    $sql = "SELECT p.product_id, p.product_name, COALESCE(MAX(s.stock_count),0) AS stock_count
            FROM tbl_product p
            LEFT JOIN tbl_stock s ON s.product_id = p.product_id
            WHERE p.seller_id = $seller_id
            GROUP BY p.product_id ORDER BY stock_count ASC";
    $res = $con->query($sql);
    while ($row = $res->fetch_assoc()) $sellerDetails['stock'][] = $row;
}

// ---------- Prepare JSON blobs for JS ----------
$js_sales_labels = array_keys($salesData);
$js_sales_values = array_values($salesData);
$js_month_labels = array_keys($monthlySales);
$js_month_values = array_values($monthlySales);
$js_top_products = $topProducts;
$js_seller_rev_labels = array_column($sellerRevenue, 'seller_name');
$js_seller_rev_values = array_map(function($r){return (float)$r['rev'];}, $sellerRevenue);
$js_category_labels = array_keys($categoryRevenue);
$js_category_values = array_values($categoryRevenue);
$js_district_labels = array_keys($districtSales);
$js_district_values = array_values($districtSales);

// ---------- HTML / UI ----------
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Reports — Full</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3"></script>
    <style>
        .kpi-card { border-left: 6px solid #0d6efd; }
        .small-hint { font-size: .85rem; color: #6c757d; }
        .no-print { display: block; }
        @media print { .no-print { display:none } }
        .low-stock { background: #fff3cd; border-left:4px solid #ffc107; }
    </style>
</head>
<body class="bg-light">
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Admin Reports</h3>
        <div>
            <a href="#" onclick="window.print()" class="btn btn-outline-secondary btn-sm">Print</a>
        </div>
    </div>

    <!-- Filters -->
    <form method="post" class="card card-body mb-4 no-print">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">From</label>
                <input type="date" name="from_date" value="<?=htmlspecialchars($from_date)?>" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">To</label>
                <input type="date" name="to_date" value="<?=htmlspecialchars($to_date)?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Seller</label>
                <select name="seller_id" class="form-control">
                    <option value="0">All Sellers</option>
                    <?php
                        $sellers = $con->query("SELECT seller_id, seller_name FROM tbl_seller WHERE seller_status='1' ORDER BY seller_name ASC");
                        while ($s = $sellers->fetch_assoc()) {
                            $sel = ($seller_id == $s['seller_id']) ? "selected" : "";
                            echo "<option value='{$s['seller_id']}' $sel>" . htmlspecialchars($s['seller_name']) . "</option>";
                        }
                    ?>
                </select>
                <div class="small-hint mt-1">Filters apply to most reports (sales, products, category, district, reviews).</div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Apply</button>
            </div>
        </div>
    </form>

    <!-- KPIs -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 kpi-card">
                <div class="h5 mb-0"><?= number_format($stats['total_users']) ?></div>
                <div class="small-hint">Total Users</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 kpi-card">
                <div class="h5 mb-0"><?= number_format($stats['total_sellers']) ?></div>
                <div class="small-hint">Active Sellers</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 kpi-card">
                <div class="h5 mb-0"><?= number_format($stats['total_products']) ?></div>
                <div class="small-hint">Total Products</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 kpi-card">
                <div class="h5 mb-0">₹ <?= number_format($stats['total_revenue'],2) ?></div>
                <div class="small-hint">Total Revenue (filtered)</div>
            </div>
        </div>
    </div>

    <!-- Charts: Sales & Monthly -->
    <div class="row">
        <div class="col-lg-7 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Daily Sales</h5>
                    <small class="text-muted"><?= $from_date && $to_date ? "From $from_date to $to_date" : "All time" ?></small>
                </div>
                <div class="small-hint mb-2">Shows daily revenue (sums of cart qty * price). Seller filter applied if selected.</div>
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>

        <div class="col-lg-5 mb-3">
            <div class="card p-3">
                <h5 class="card-title">Monthly Revenue</h5>
                <div class="small-hint mb-2">Aggregated revenue by month.</div>
                <canvas id="monthlyChart" height="180"></canvas>
            </div>
        </div>
    </div>

    <!-- Top products / Seller revenue -->
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card p-3">
                <h5>Top Products (Units)</h5>
                <div class="small-hint mb-2">Top-selling products in the filtered range.</div>
                <canvas id="topProductsChart" height="180"></canvas>
                <hr>
                <div style="max-height:220px; overflow:auto;">
                    <table class="table table-sm">
                        <thead><tr><th>Product</th><th>Units</th><th>Revenue</th></tr></thead>
                        <tbody>
                        <?php foreach ($topProducts as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['product_name']) ?></td>
                                <td><?= (int)$p['units'] ?></td>
                                <td>₹ <?= number_format((float)$p['revenue'],2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-3">
            <div class="card p-3">
                <h5>Revenue by Seller</h5>
                <div class="small-hint mb-2">Compare sellers' revenue (all-time or filtered date range).</div>
                <canvas id="sellerRevenueChart" height="180"></canvas>
                <hr>
                <div style="max-height:220px; overflow:auto;">
                    <table class="table table-sm">
                        <thead><tr><th>Seller</th><th>Units</th><th>Revenue</th></tr></thead>
                        <tbody>
                        <?php foreach ($sellerRevenue as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['seller_name']) ?></td>
                                <td><?= (int)$s['units'] ?></td>
                                <td>₹ <?= number_format((float)$s['rev'],2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Category / District -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card p-3">
                <h5>Revenue by Category</h5>
                <div class="small-hint mb-2">Which categories bring the most revenue.</div>
                <canvas id="categoryChart" height="220"></canvas>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card p-3">
                <h5>Top Districts by Sales</h5>
                <div class="small-hint mb-2">Customer districts contributing highest revenue.</div>
                <canvas id="districtChart" height="220"></canvas>
            </div>
        </div>
    </div>

    <!-- Complaints / Low stock / Ratings / Repeat customers -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h6>Complaints Overview</h6>
                <div class="small-hint mb-2">Pending vs Resolved complaints.</div>
                <canvas id="complaintsChart" height="150"></canvas>
                <hr>
                <div style="max-height:140px; overflow:auto;">
                    <table class="table table-sm">
                        <thead><tr><th>Seller</th><th>Pending</th><th>Resolved</th></tr></thead>
                        <tbody>
                        <?php foreach($complaintsBySeller as $cs): ?>
                            <tr>
                                <td><?= htmlspecialchars($cs['seller_name']) ?></td>
                                <td><?= (int)$cs['pending'] ?></td>
                                <td><?= (int)$cs['resolved'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h6>Low Stock Alerts</h6>
                <div class="small-hint mb-2">Products with stock <= 5.</div>
                <div style="max-height:280px; overflow:auto;">
                    <table class="table table-sm">
                        <thead><tr><th>Product</th><th>Seller</th><th>Stock</th></tr></thead>
                        <tbody>
                        <?php if (count($lowStock)==0): ?>
                            <tr><td colspan="3">No low-stock items.</td></tr>
                        <?php else: ?>
                            <?php foreach($lowStock as $ls): ?>
                                <tr class="<?= ((int)$ls['stock_count']<=2)?'low-stock':'' ?>">
                                    <td><?= htmlspecialchars($ls['product_name']) ?></td>
                                    <td><?= htmlspecialchars($ls['seller_name']) ?></td>
                                    <td><?= (int)$ls['stock_count'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h6>Ratings & Customers</h6>
                <div class="small-hint mb-2">Average rating & repeat vs new customers.</div>
                <p class="mb-1"><strong>Average rating:</strong> <?= number_format($ratings['avg'],2) ?> (<?= $ratings['count'] ?> reviews)</p>
                <canvas id="repeatChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <!-- Seller-specific section -->
    <?php if ($seller_id > 0): ?>
        <div class="card p-3 mb-4">
            <h5>Seller: <?= htmlspecialchars($sellerNameFilter) ?> — Seller-specific reports</h5>
            <div class="small-hint mb-3">Top products, complaints and stock for this seller (filtered by date if set).</div>

            <div class="row">
                <div class="col-md-6">
                    <h6>Top Products (Seller)</h6>
                    <table class="table table-sm">
                        <thead><tr><th>Product</th><th>Units</th><th>Revenue</th></tr></thead>
                        <tbody>
                        <?php if (!empty($sellerDetails['top_products'])): ?>
                            <?php foreach($sellerDetails['top_products'] as $p): ?>
                                <tr>
                                    <td><?= htmlspecialchars($p['product_name']) ?></td>
                                    <td><?= (int)$p['units'] ?></td>
                                    <td>₹ <?= number_format((float)$p['revenue'],2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3">No sales for this seller in the selected range.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h6>Stock (Seller)</h6>
                    <table class="table table-sm">
                        <thead><tr><th>Product</th><th>Stock</th></tr></thead>
                        <tbody>
                        <?php if (!empty($sellerDetails['stock'])): ?>
                            <?php foreach($sellerDetails['stock'] as $st): ?>
                                <tr class="<?= ((int)$st['stock_count']<=2)?'low-stock':'' ?>">
                                    <td><?= htmlspecialchars($st['product_name']) ?></td>
                                    <td><?= (int)$st['stock_count'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="2">No stock records.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>
            <h6>Recent Complaints (Seller)</h6>
            <div style="max-height:240px; overflow:auto;">
                <table class="table table-sm">
                    <thead><tr><th>Date</th><th>User</th><th>Booking</th><th>Content</th><th>Status</th></tr></thead>
                    <tbody>
                    <?php if (!empty($sellerDetails['complaints'])): ?>
                        <?php foreach($sellerDetails['complaints'] as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['complaint_date']) ?></td>
                                <td><?= htmlspecialchars($c['user_name']) ?></td>
                                <td><?= htmlspecialchars($c['booking_date']) ?></td>
                                <td><?= htmlspecialchars($c['complaint_content']) ?></td>
                                <td><?= ($c['complaint_status']=='0')?'<span class="badge bg-warning">Pending</span>':'<span class="badge bg-success">Resolved</span>' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">No complaints for this seller.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <footer class="text-muted small my-4">Report generated <?= date('Y-m-d H:i:s') ?>. Data source: db_miniproject.</footer>
</div>

<!-- Charts script -->
<script>
const salesLabels = <?= json_encode($js_sales_labels) ?>;
const salesValues = <?= json_encode($js_sales_values) ?>;
const monthLabels = <?= json_encode($js_month_labels) ?>;
const monthValues = <?= json_encode($js_month_values) ?>;
const topProducts = <?= json_encode(array_map(function($p){ return ['name'=>$p['product_name'],'units'=>(int)$p['units'],'rev'=>(float)$p['revenue']]; }, $topProducts)) ?>;
const sellerLabels = <?= json_encode($js_seller_rev_labels) ?>;
const sellerValues = <?= json_encode($js_seller_rev_values) ?>;
const catLabels = <?= json_encode($js_category_labels) ?>;
const catValues = <?= json_encode($js_category_values) ?>;
const districtLabels = <?= json_encode($js_district_labels) ?>;
const districtValues = <?= json_encode($js_district_values) ?>;
const complaintsData = <?= json_encode(array_values($complaints)) ?>;
const repeatData = <?= json_encode(array_values($repeatVsNew)) ?>;

// Utility to create charts
function createChart(ctxId, type, labels, data, extras = {}) {
    const ctx = document.getElementById(ctxId).getContext('2d');
    return new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: extras.label || '',
                data: data,
                // Let Chart.js pick colors automatically
            }]
        },
        options: Object.assign({
            responsive: true,
            plugins: { legend: { display: !!extras.showLegend } },
            scales: { y: { beginAtZero: true } }
        }, extras.options || {})
    });
}

window.addEventListener('load', function(){
    // Daily sales: line
    createChart('salesChart','line', salesLabels, salesValues, { label:'Daily Revenue', showLegend:false });

    // Monthly bar
    createChart('monthlyChart','bar', monthLabels, monthValues, { label:'Monthly Revenue', showLegend:false });

    // Top products horizontal bar (units)
    const tpLabels = topProducts.map(p=>p.name);
    const tpUnits = topProducts.map(p=>p.units);
    createChart('topProductsChart','bar', tpLabels, tpUnits, { label:'Units Sold', showLegend:false, options:{indexAxis:'y'} });

    // Seller revenue bar
    createChart('sellerRevenueChart','bar', sellerLabels, sellerValues, { label:'Revenue', showLegend:false });

    // Category pie
    createChart('categoryChart','pie', catLabels, catValues, { showLegend:true });

    // District bar
    createChart('districtChart','bar', districtLabels, districtValues, { label:'Revenue', showLegend:false });

    // Complaints doughnut
    createChart('complaintsChart','doughnut', ['Pending','Resolved'], complaintsData, { showLegend:true });

    // Repeat vs New (pie)
    createChart('repeatChart','pie', ['New','Repeat'], repeatData, { showLegend:true });
});
</script>

</body>
</html>
