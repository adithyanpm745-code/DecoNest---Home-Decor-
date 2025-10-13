<?php
// AdminReports.php
include("../Assets/Connection/Connection.php");

// Optional: include your existing sidebar (comment this line if you don't use it)
// @include("SideBar.php");

// ---------- Helpers ----------
function is_valid_date($d) {
    // expects Y-m-d from <input type="date">
    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $d);
}
function db_date_expr($col = 'booking_date') {
    // Your dates are stored as varchar; this parses 2025-07-1 or 2025-07-12
    // %e handles non-zero-padded days (1..31)
    return "STR_TO_DATE($col, '%Y-%m-%e')";
}
function cast_money($col) {
    return "CAST($col AS DECIMAL(15,2))";
}
function cast_int($col) {
    return "CAST($col AS UNSIGNED)";
}

// ---------- Filters ----------
$from_date = isset($_POST['from_date']) && is_valid_date($_POST['from_date']) ? $_POST['from_date'] : "";
$to_date   = isset($_POST['to_date'])   && is_valid_date($_POST['to_date'])   ? $_POST['to_date']   : "";

$dateFilterBooking = "";
if ($from_date && $to_date) {
    $f = $con->real_escape_string($from_date);
    $t = $con->real_escape_string($to_date);
    $dateFilterBooking = " AND " . db_date_expr('b.booking_date') . " BETWEEN '$f' AND '$t' ";
}

// ---------- Overall Stats ----------
$Q = [
    'total_users' =>
        "SELECT COUNT(*) AS c FROM tbl_user",
    'total_sellers' =>
        "SELECT COUNT(*) AS c FROM tbl_seller WHERE seller_status='1'",
    'total_products' =>
        "SELECT COUNT(*) AS c FROM tbl_product",
    'total_bookings_completed' =>
        "SELECT COUNT(*) AS c FROM tbl_booking b WHERE ".cast_int('b.booking_status')."=5",
    // Revenue as sum of completed line-items (safer than booking_amount field)
    'total_sales' =>
        "SELECT SUM(c.cart_quantity * ".cast_money('p.product_price').") AS amt
         FROM tbl_cart c
         JOIN tbl_product p ON p.product_id=c.product_id
         JOIN tbl_booking b ON b.booking_id=c.booking_id
         WHERE ".cast_int('b.booking_status')."=5"
];

$stats = [];
foreach ($Q as $k=>$sql) {
    $r = $con->query($sql)->fetch_assoc();
    $stats[$k] = isset($r['c']) ? (int)$r['c'] : (isset($r['amt']) ? (float)$r['amt'] : 0);
}

// ---------- Sales Overview (daily) ----------
$salesData = [];
$sql = "SELECT DATE_FORMAT(".db_date_expr('b.booking_date').", '%Y-%m-%d') AS d,
               SUM(c.cart_quantity * ".cast_money('p.product_price').") AS total
        FROM tbl_booking b
        JOIN tbl_cart c ON c.booking_id=b.booking_id
        JOIN tbl_product p ON p.product_id=c.product_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY d ORDER BY d ASC";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $salesData[$row['d']] = (float)$row['total'];

// ---------- Monthly Sales Trend ----------
$monthlySales = [];
$sql = "SELECT DATE_FORMAT(".db_date_expr('b.booking_date').", '%Y-%m') AS m,
               SUM(c.cart_quantity * ".cast_money('p.product_price').") AS total
        FROM tbl_booking b
        JOIN tbl_cart c ON c.booking_id=b.booking_id
        JOIN tbl_product p ON p.product_id=c.product_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY m ORDER BY m ASC";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $monthlySales[$row['m']] = (float)$row['total'];

// ---------- Top Products (completed orders only) ----------
$topProducts = [];
$sql = "SELECT p.product_name, SUM(c.cart_quantity) AS units
        FROM tbl_cart c
        JOIN tbl_product p ON p.product_id=c.product_id
        JOIN tbl_booking b ON b.booking_id=c.booking_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY p.product_id
        ORDER BY units DESC
        LIMIT 7";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $topProducts[$row['product_name']] = (int)$row['units'];

// ---------- Revenue by Seller (line-items) ----------
$sellerRevenue = [];
$sql = "SELECT s.seller_name, SUM(c.cart_quantity * ".cast_money('p.product_price').") AS rev
        FROM tbl_cart c
        JOIN tbl_product p ON p.product_id=c.product_id
        JOIN tbl_seller s ON s.seller_id=p.seller_id
        JOIN tbl_booking b ON b.booking_id=c.booking_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY s.seller_id
        ORDER BY rev DESC
        LIMIT 8";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $sellerRevenue[$row['seller_name']] = (float)$row['rev'];

// ---------- Best Sellers (Units & Revenue) ----------
$bestSellerUnits = [];
$sql = "SELECT s.seller_name, SUM(c.cart_quantity) AS units
        FROM tbl_cart c
        JOIN tbl_product p ON p.product_id=c.product_id
        JOIN tbl_seller s ON s.seller_id=p.seller_id
        JOIN tbl_booking b ON b.booking_id=c.booking_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY s.seller_id
        ORDER BY units DESC
        LIMIT 6";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $bestSellerUnits[$row['seller_name']] = (int)$row['units'];

$bestSellerRevenue = [];
$sql = "SELECT s.seller_name, SUM(c.cart_quantity * ".cast_money('p.product_price').") AS rev
        FROM tbl_cart c
        JOIN tbl_product p ON p.product_id=c.product_id
        JOIN tbl_seller s ON s.seller_id=p.seller_id
        JOIN tbl_booking b ON b.booking_id=c.booking_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY s.seller_id
        ORDER BY rev DESC
        LIMIT 6";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $bestSellerRevenue[$row['seller_name']] = (float)$row['rev'];

// ---------- Products by Category (count) ----------
$categoryCounts = [];
$sql = "SELECT COALESCE(c.category_name,'Uncategorized') AS cname, COUNT(p.product_id) AS cnt
        FROM tbl_product p
        LEFT JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
        LEFT JOIN tbl_category c ON c.category_id=s.category_id
        GROUP BY cname
        ORDER BY cnt DESC";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $categoryCounts[$row['cname']] = (int)$row['cnt'];

// ---------- Revenue by Category (completed orders) ----------
$categoryRevenue = [];
$sql = "SELECT COALESCE(c.category_name,'Uncategorized') AS cname,
               SUM(ca.cart_quantity * ".cast_money('p.product_price').") AS rev
        FROM tbl_cart ca
        JOIN tbl_product p ON p.product_id=ca.product_id
        LEFT JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
        LEFT JOIN tbl_category c ON c.category_id=s.category_id
        JOIN tbl_booking b ON b.booking_id=ca.booking_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY cname
        ORDER BY rev DESC";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $categoryRevenue[$row['cname']] = (float)$row['rev'];

// ---------- Sales by District (completed orders) ----------
$districtSales = [];
$sql = "SELECT d.district_name AS dname,
               SUM(c.cart_quantity * ".cast_money('p.product_price').") AS rev
        FROM tbl_booking b
        JOIN tbl_user u ON u.user_id=b.user_id
        LEFT JOIN tbl_place pl ON pl.place_id=u.place_id
        LEFT JOIN tbl_district d ON d.district_id=pl.district_id
        JOIN tbl_cart c ON c.booking_id=b.booking_id
        JOIN tbl_product p ON p.product_id=c.product_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY dname
        ORDER BY rev DESC";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) {
    $label = $row['dname'] ? $row['dname'] : 'Unknown';
    $districtSales[$label] = (float)$row['rev'];
}

// ---------- Booking Status (count) ----------
$bookingStatus = ['Pending'=>0,'Completed'=>0];
$sql = "SELECT
        SUM(CASE WHEN ".cast_int('booking_status')." <= 4 THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN ".cast_int('booking_status')."  = 5 THEN 1 ELSE 0 END) AS completed
        FROM tbl_booking";
$r = $con->query($sql)->fetch_assoc();
if ($r) {
    $bookingStatus['Pending']   = (int)$r['pending'];
    $bookingStatus['Completed'] = (int)$r['completed'];
}

// ---------- Complaints Status ----------
$complaints = ['Pending'=>0,'Resolved'=>0];
$sql = "SELECT
        SUM(CASE WHEN complaint_status='0' THEN 1 ELSE 0 END) AS pending,
        SUM(CASE WHEN complaint_status='1' THEN 1 ELSE 0 END) AS resolved
        FROM tbl_complaint";
$r = $con->query($sql)->fetch_assoc();
if ($r) {
    $complaints['Pending']  = (int)$r['pending'];
    $complaints['Resolved'] = (int)$r['resolved'];
}

// ---------- Top Rated Products ----------
$topRated = [];
$sql = "SELECT p.product_name, ROUND(AVG(r.user_rating),1) AS avg_rating
        FROM tbl_review r
        JOIN tbl_product p ON p.product_id=r.product_id
        GROUP BY p.product_id
        HAVING avg_rating IS NOT NULL
        ORDER BY avg_rating DESC
        LIMIT 7";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $topRated[$row['product_name']] = (float)$row['avg_rating'];

// ---------- Customizations by Month ----------
$customTrend = [];
$sql = "SELECT DATE_FORMAT(".db_date_expr('c.customization_date').", '%Y-%m') AS m, COUNT(*) AS cnt
        FROM tbl_customization c
        GROUP BY m ORDER BY m ASC";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $customTrend[$row['m']] = (int)$row['cnt'];

// ---------- Product Launch Trend (products per month) ----------
$productLaunch = [];
$sql = "SELECT DATE_FORMAT(".db_date_expr('p.product_date').", '%Y-%m') AS m, COUNT(*) AS cnt
        FROM tbl_product p
        GROUP BY m ORDER BY m ASC";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) $productLaunch[$row['m']] = (int)$row['cnt'];

// ---------- Feedback Sentiment (naive keyword-based) ----------
$feedbackSentiment = ['Positive'=>0,'Negative'=>0,'Neutral'=>0];
$sql = "SELECT
        SUM(CASE WHEN LOWER(feedback_content) REGEXP 'good|nice|great|excellent|love' THEN 1 ELSE 0 END) AS pos,
        SUM(CASE WHEN LOWER(feedback_content) REGEXP 'bad|poor|worst|hate|terrible' THEN 1 ELSE 0 END) AS neg,
        COUNT(*) AS total
        FROM tbl_feedback";
$r = $con->query($sql)->fetch_assoc();
if ($r) {
    $pos = (int)$r['pos'];
    $neg = (int)$r['neg'];
    $tot = (int)$r['total'];
    $neu = max(0, $tot - $pos - $neg);
    $feedbackSentiment['Positive'] = $pos;
    $feedbackSentiment['Negative'] = $neg;
    $feedbackSentiment['Neutral']  = $neu;
}

// ---------- Stock (latest per product) ----------
$lowStockList = [];     // table list below threshold
$stockBars    = [];     // chart of lowest stock items
$STOCK_THRESHOLD = 10;

// latest record per product by greatest stock_id
$sql = "SELECT p.product_name, s.stock_count
        FROM tbl_product p
        LEFT JOIN (
            SELECT t1.product_id, t1.stock_count
            FROM tbl_stock t1
            INNER JOIN (
                SELECT product_id, MAX(stock_id) AS maxid
                FROM tbl_stock
                GROUP BY product_id
            ) t2 ON t1.product_id=t2.product_id AND t1.stock_id=t2.maxid
        ) s ON s.product_id=p.product_id";
$res = $con->query($sql);
$tmp = [];
while($row = $res->fetch_assoc()) {
    $name = $row['product_name'];
    $stk  = is_null($row['stock_count']) ? 0 : (int)$row['stock_count'];
    $tmp[$name] = $stk;
    if ($stk <= $STOCK_THRESHOLD) $lowStockList[$name] = $stk;
}
// pick 10 lowest to display chart
asort($tmp); // ascending
$stockBars = array_slice($tmp, 0, 10, true);

// ---------- Sankey Flow (Category -> Seller) based on units sold ----------
$flowPairs = []; // [['Category','Seller',units], ...]
$sql = "SELECT COALESCE(cat.category_name,'Uncategorized') AS cname,
               s.seller_name,
               SUM(c.cart_quantity) AS units
        FROM tbl_cart c
        JOIN tbl_product p ON p.product_id=c.product_id
        LEFT JOIN tbl_subcategory sc ON sc.subcategory_id=p.subcategory_id
        LEFT JOIN tbl_category cat ON cat.category_id=sc.category_id
        JOIN tbl_booking b ON b.booking_id=c.booking_id
        JOIN tbl_seller s ON s.seller_id=p.seller_id
        WHERE ".cast_int('b.booking_status').">1 $dateFilterBooking
        GROUP BY cname, s.seller_id
        HAVING units>0
        ORDER BY units DESC
        LIMIT 20";
$res = $con->query($sql);
while($row = $res->fetch_assoc()) {
    $flowPairs[] = [$row['cname'] ?: 'Uncategorized', $row['seller_name'], (int)$row['units']];
}

// ---------- Simple registrations split (Users vs Sellers) ----------
$registrations = [];
$r1 = $con->query("SELECT COUNT(*) AS c FROM tbl_user")->fetch_assoc();
$r2 = $con->query("SELECT COUNT(*) AS c FROM tbl_seller")->fetch_assoc();
$registrations['Users']   = (int)$r1['c'];
$registrations['Sellers'] = (int)$r2['c'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Reports</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap & Charts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3"></script>
    <!-- Google Charts for Sankey -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body{ background:#f6f7fb; }
        .page-title{ font-weight:700; letter-spacing:.3px; }
        .card{ border:0; border-radius:18px; box-shadow:0 8px 20px rgba(18,38,63,.06); margin-bottom:18px; }
        .stat-card{ text-align:center; }
        .stat-card h3{ margin:0; font-size:1.4rem; }
        .stat-card .value{ font-size:1.2rem; font-weight:700; }
        .grid-compact canvas{ max-height:240px !important; }
        .small-note{ font-size:.86rem; color:#6c757d; }
        .table-sm td, .table-sm th { padding: .4rem .5rem; }
        .badge-soft{ background:#eef2ff; color:#3b5bdb; }
        .filter-box{ background:#fff; padding:12px; border-radius:12px; box-shadow:0 4px 12px rgba(18,38,63,.05); }
        .btn-back {
            background-color: #146fbfff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .btn-back:hover {
            background-color: #e91434ff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container my-4 no-print">
        <a href="HomePage.php" class="btn-back">← Back to Dashboard</a>
    </div>
<div class="container-fluid py-3">
    <h2 class="page-title text-center mb-3">📊 Admin Reports</h2>

    <!-- Filter -->
    <form method="post" class="filter-box mx-auto mb-3" style="max-width:820px;">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">From</label>
                <input type="date" name="from_date" value="<?php echo htmlspecialchars($from_date);?>" class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <label class="form-label">To</label>
                <input type="date" name="to_date" value="<?php echo htmlspecialchars($to_date);?>" class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary btn-sm w-100" name="btn_filter">Apply Filter</button>
            </div>
        </div>
        <div class="small-note mt-2">Filter applies to sales, top products, sellers, category revenue, district sales, Sankey flow.</div>
    </form>
   
        <div class="container my-4 no-print">
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="Report1.php" class="btn-back">View Seller Wise Reports</a>
    </div>
    <!-- Stats -->
    <div class="row g-2 text-center mb-2">
        <div class="col-6 col-md-2">
            <div class="card p-3 stat-card">
                <h3>Users</h3>
                <div class="value"><?php echo number_format($stats['total_users']);?></div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card p-3 stat-card">
                <h3>Active Sellers</h3>
                <div class="value"><?php echo number_format($stats['total_sellers']);?></div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card p-3 stat-card">
                <h3>Products</h3>
                <div class="value"><?php echo number_format($stats['total_products']);?></div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card p-3 stat-card">
                <h3>Completed Orders</h3>
                <div class="value"><?php echo number_format($stats['total_bookings_completed']);?></div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card p-3 stat-card">
                <h3>Total Revenue</h3>
                <div class="value">₹<?php echo number_format($stats['total_sales'],2);?></div>
                <div class="small-note">Based on completed line items</div>
            </div>
        </div>
    </div>

    <!-- Row 1 -->
    <div class="row grid-compact">
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Sales Overview</h5>
                <div class="small-note">Daily revenue<?php if($from_date && $to_date){ echo " (".$from_date." → ".$to_date.")"; } ?></div>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Monthly Sales Trend</h5>
                <div class="small-note">Aggregated by month</div>
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 2 -->
    <div class="row grid-compact">
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Top Selling Products</h5>
                <div class="small-note">Units (completed orders)</div>
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Revenue by Seller</h5>
                <div class="small-note">Top sellers by revenue</div>
                <canvas id="sellerRevenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 3 -->
    <div class="row grid-compact">
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>🏆 Best Sellers (Units)</h5>
                <canvas id="bestSellerUnitsChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Product Launch Trend</h5>
                <canvas id="productLaunchChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 4 -->
    <div class="row grid-compact">
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Products by Category</h5>
                <canvas id="categoryCountChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Revenue by Category</h5>
                <canvas id="categoryRevenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 5 -->
    <div class="row grid-compact">
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Sales by District</h5>
                <div class="small-note">Based on order address (user district)</div>
                <canvas id="districtSalesChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Order Flow (Category → Seller)</h5>
                <div class="small-note">Sankey diagram (units)</div>
                <div id="sankeyChart" style="height: 240px;"></div>
            </div>
        </div>
    </div>

    <!-- Row 6 -->
    <div class="row grid-compact">
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Booking Status</h5>
                <canvas id="bookingStatusChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Complaints Status</h5>
                <canvas id="complaintsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 7 -->
    <div class="row grid-compact">
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Top Rated Products</h5>
                <canvas id="topRatedChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Customizations Trend</h5>
                <canvas id="customTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Row 8 -->
    <!-- <div class="row grid-compact">
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>💰 Best Sellers (Revenue)</h5>
                <canvas id="bestSellerRevenueChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <h5>Feedback Sentiment</h5>
                <canvas id="feedbackChart"></canvas>
            </div>
        </div>
    </div> -->

    <!-- Low Stock -->
    <div class="row">
        <div class="col-lg-7">
            <div class="card p-3">
                <h5>Lowest Stock Items</h5>
                <div class="small-note">Top 10 items with the lowest current stock (latest stock entry)</div>
                <canvas id="stockBarChart"></canvas>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card p-3">
                <h5>⚠️ Low Stock (≤ <?php echo (int)$STOCK_THRESHOLD; ?>)</h5>
                <table class="table table-sm">
                    <thead><tr><th>Product</th><th class="text-end">Stock</th></tr></thead>
                    <tbody>
                    <?php if(count($lowStockList)): foreach($lowStockList as $p=>$q): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($p);?></td>
                            <td class="text-end"><span class="badge badge-soft rounded-pill px-3"><?php echo (int)$q;?></span></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="2" class="text-center text-muted">No items are at or below the threshold.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="small-note">Update stock in <code>tbl_stock</code>; the dashboard reads the latest row per product.</div>
            </div>
        </div>
    </div>
</div>

<script>
// ---------- Helpers ----------
function makeChart(id, type, labels, data, label, colors) {
    const el = document.getElementById(id);
    if (!el) return;
    const dataset = {
        label: label || '',
        data: data || [],
    };
    if (Array.isArray(colors)) {
        dataset.backgroundColor = colors;
        dataset.borderColor = colors;
    }
    if (typeof colors === 'string') {
        dataset.backgroundColor = colors;
        dataset.borderColor = colors;
    }
    new Chart(el, {
        type: type,
        data: { labels: labels || [], datasets: [dataset] },
        options: {
            responsive: true,
            plugins: { legend: { display: true }},
            scales: (type === 'pie' || type === 'doughnut') ? {} : { y: { beginAtZero: true } }
        }
    });
}

// ---------- Data from PHP ----------
const SALES_DATES   = <?php echo json_encode(array_keys($salesData));?>;
const SALES_VALUES  = <?php echo json_encode(array_values($salesData));?>;

const MONTHS        = <?php echo json_encode(array_keys($monthlySales));?>;
const MONTH_TOTALS  = <?php echo json_encode(array_values($monthlySales));?>;

const TOP_PROD_L    = <?php echo json_encode(array_keys($topProducts));?>;
const TOP_PROD_V    = <?php echo json_encode(array_values($topProducts));?>;

const SELLER_REV_L  = <?php echo json_encode(array_keys($sellerRevenue));?>;
const SELLER_REV_V  = <?php echo json_encode(array_values($sellerRevenue));?>;

const BEST_U_L      = <?php echo json_encode(array_keys($bestSellerUnits));?>;
const BEST_U_V      = <?php echo json_encode(array_values($bestSellerUnits));?>;

const BEST_R_L      = <?php echo json_encode(array_keys($bestSellerRevenue));?>;
const BEST_R_V      = <?php echo json_encode(array_values($bestSellerRevenue));?>;

const CAT_COUNT_L   = <?php echo json_encode(array_keys($categoryCounts));?>;
const CAT_COUNT_V   = <?php echo json_encode(array_values($categoryCounts));?>;

const CAT_REV_L     = <?php echo json_encode(array_keys($categoryRevenue));?>;
const CAT_REV_V     = <?php echo json_encode(array_values($categoryRevenue));?>;

const DIST_L        = <?php echo json_encode(array_keys($districtSales));?>;
const DIST_V        = <?php echo json_encode(array_values($districtSales));?>;

const BOOK_L        = <?php echo json_encode(array_keys($bookingStatus));?>;
const BOOK_V        = <?php echo json_encode(array_values($bookingStatus));?>;

const COM_L         = <?php echo json_encode(array_keys($complaints));?>;
const COM_V         = <?php echo json_encode(array_values($complaints));?>;

const RATE_L        = <?php echo json_encode(array_keys($topRated));?>;
const RATE_V        = <?php echo json_encode(array_values($topRated));?>;

const CUST_M_L      = <?php echo json_encode(array_keys($customTrend));?>;
const CUST_M_V      = <?php echo json_encode(array_values($customTrend));?>;

const PL_M_L        = <?php echo json_encode(array_keys($productLaunch));?>;
const PL_M_V        = <?php echo json_encode(array_values($productLaunch));?>;

const FB_L          = <?php echo json_encode(array_keys($feedbackSentiment));?>;
const FB_V          = <?php echo json_encode(array_values($feedbackSentiment));?>;

const STOCK_L       = <?php echo json_encode(array_keys($stockBars));?>;
const STOCK_V       = <?php echo json_encode(array_values($stockBars));?>;

const FLOW_PAIRS    = <?php echo json_encode($flowPairs);?>;

// ---------- Charts ----------
makeChart('salesChart','line',SALES_DATES,SALES_VALUES,'Daily Sales','rgba(54,162,235,.6)');
makeChart('monthlySalesChart','line',MONTHS,MONTH_TOTALS,'Monthly Sales','rgba(75,192,192,.6)');

makeChart('topProductsChart','bar',TOP_PROD_L,TOP_PROD_V,'Units Sold','rgba(0,0,0,.6)');
makeChart('sellerRevenueChart','bar',SELLER_REV_L,SELLER_REV_V,'Revenue','rgba(153,102,255,.6)');

makeChart('bestSellerUnitsChart','bar',BEST_U_L,BEST_U_V,'Units','rgba(255,159,64,.7)');
makeChart('bestSellerRevenueChart','bar',BEST_R_L,BEST_R_V,'Revenue','rgba(255,99,132,.7)');

makeChart('categoryCountChart','pie',CAT_COUNT_L,CAT_COUNT_V,'Products by Category',[
    '#4bc0c0','#ff6384','#36a2eb','#ffcd56','#9966ff','#c9cbcf','#2ecc71','#e67e22'
]);
makeChart('categoryRevenueChart','doughnut',CAT_REV_L,CAT_REV_V,'Revenue by Category',[
    '#8e44ad','#3498db','#2ecc71','#f39c12','#e74c3c','#16a085','#7f8c8d'
]);

makeChart('districtSalesChart','bar',DIST_L,DIST_V,'Revenue by District','rgba(52,152,219,.6)');
makeChart('bookingStatusChart','doughnut',BOOK_L,BOOK_V,'Bookings',['#e74c3c','#2ecc71']);
makeChart('complaintsChart','bar',COM_L,COM_V,'Complaints',['#e67e22','#3498db']);

makeChart('topRatedChart','bar',RATE_L,RATE_V,'Avg Rating','rgba(255,206,86,.7)');
makeChart('customTrendChart','line',CUST_M_L,CUST_M_V,'Customizations','rgba(46,204,113,.7)');
makeChart('productLaunchChart','line',PL_M_L,PL_M_V,'Products Added','rgba(52,73,94,.7)');
makeChart('feedbackChart','pie',FB_L,FB_V,'Feedback',['#2ecc71','#e74c3c','#95a5a6']);

makeChart('stockBarChart','bar',STOCK_L,STOCK_V,'Current Stock','rgba(127,140,141,.7)');

// ---------- Google Charts Sankey ----------
google.charts.load('current', {'packages':['sankey']});
google.charts.setOnLoadCallback(() => {
    if (!document.getElementById('sankeyChart')) return;
    const data = new google.visualization.DataTable();
    data.addColumn('string', 'From');
    data.addColumn('string', 'To');
    data.addColumn('number', 'Units');

    const rows = [];
    (FLOW_PAIRS || []).forEach(r => {
        // r = [category, seller, units]
        if (r && r.length === 3) rows.push([String(r[0]||'Uncategorized'), String(r[1]||'Unknown'), Number(r[2]||0)]);
    });
    if (rows.length === 0) rows.push(['No Data','No Data',1]);
    data.addRows(rows);

    const chart = new google.visualization.Sankey(document.getElementById('sankeyChart'));
    chart.draw(data, { node: { label: { fontName: 'system-ui', fontSize: 12 } }});
});
</script>
</body>
</html>
