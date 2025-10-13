<?php
// CustomizationInvoice.php
// Invoice/bill page for a customization order (tbl_customization).
// Usage: CustomizationInvoice.php?Cid=123

include("../Assets/Connection/Connection.php");
session_start();
include("Header.php");

// Check login
if (!isset($_SESSION['uid'])) {
    header("Location: ../Guest/Login.php");
    exit;
}

$uid = intval($_SESSION['uid']);
$cid = isset($_GET['Cid']) ? intval($_GET['Cid']) : 0;

if ($cid <= 0) {
    header("Location: MyBooking.php");
    exit;
}

/* Fetch customization row along with seller and user info */
$sql = "SELECT c.*, u.user_name, u.user_email, u.user_contact, u.user_address,
               s.seller_name, s.seller_email, s.seller_contact, s.seller_address, s.seller_photo
        FROM tbl_customization c
        LEFT JOIN tbl_user u ON c.user_id = u.user_id
        LEFT JOIN tbl_seller s ON c.seller_id = s.seller_id
        WHERE c.customization_id = ? AND c.user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $cid, $uid);
$stmt->execute();
$res = $stmt->get_result();
$custom = $res->fetch_assoc();

if (!$custom) {
    // either not found or not owned by this user
    header("Location: MyBooking.php");
    exit;
}

// Map status to human-friendly text
$statusText = 'Pending';
switch ($custom['customization_status']) {
    case '0': $statusText = 'In Progress'; break;
    case '1': $statusText = 'Accepted'; break;
    case '2': $statusText = 'Rejected'; break;
    case '3': $statusText = 'Payment Completed'; break;
    case '4': $statusText = 'Product Packed'; break;
    case '5': $statusText = 'Product Shipped'; break;
    case '6': $statusText = 'Order Completed'; break;
    default: $statusText = 'Pending';
}

// Amount handling: ensure numeric
$amount = is_numeric($custom['customization_amount']) ? floatval($custom['customization_amount']) : 0.00;

// Taxes / fees (customize if needed)
$tax_percent = 0.00; // set tax percent if applicable
$tax_amount = ($amount * $tax_percent) / 100;
$total_amount = $amount + $tax_amount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customization Invoice #<?php echo htmlspecialchars($custom['customization_id']); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color:#f8f9fa; font-family: 'Helvetica Neue', Arial, sans-serif; }
        .invoice-box { max-width:900px; margin:auto; padding:28px; background:#fff; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,.08); }
        .company-name { color:#3d5a80; font-weight:700; font-size:28px; }
        .invoice-details { text-align:right; }
        .table-items th { background:#3d5a80; color:#fff; padding:12px; text-align:left; }
        .table-items td { padding:12px; border-bottom:1px solid #eee; }
        .total-row { font-weight:700; font-size:18px; color:#3d5a80; }
        .thank-you { margin-top:25px; padding:18px; background:#eef1f3; border-radius:8px; text-align:center; font-style:italic; }
        .btn-print { background:#3d5a80; color:#fff; border:none; padding:10px 20px; border-radius:6px; }
        .btn-back { background:#6c757d; color:#fff; padding:8px 14px; border-radius:6px; text-decoration:none; display:inline-block; }
        .meta { color:#6c757d; font-size:14px; }
        .status-badge { padding:5px 10px; border-radius:20px; font-weight:600; }
        .status-complete { background:#d4edda; color:#155724; }
        .status-pending { background:#fff3cd; color:#856404; }
        @media print { .no-print{ display:none !important; } body *{ visibility:hidden } .invoice-box, .invoice-box *{ visibility:visible } .invoice-box{ position:absolute; left:0; top:0; width:100%; box-shadow:none; } }
        .custom-file-preview { max-width:220px; max-height:220px; object-fit:contain; border:1px solid #eee; padding:6px; border-radius:6px; background:#fff; }
    </style>
</head>
<body>
    <div class="container my-4 no-print">
        <a href="MyCustomization.php" class="btn-back">← Back</a>
    </div>

    <div class="container mb-5">
        <div class="invoice-box p-4">
            <div class="row align-items-center mb-3">
                <div class="col-md-6 d-flex align-items-center">
                    <div style="width:64px;height:64px;background:#3d5a80;color:#fff;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-right:12px;font-weight:700;">DN</div>
                    <div>
                        <div class="company-name">DecoNest</div>
                        <div class="meta">A Cozy & Stylish Home Decor Store</div>
                        <!-- <div class="meta">Ernakulam, Kerala, India</div>
                        <div class="meta">Phone: +91 6282270579 | Email: deconest001@gmail.com</div> -->
                    </div>
                </div>
                <div class="col-md-6 invoice-details">
                    <h3>INVOICE - CUSTOMIZATION</h3>
                    <p><strong>Invoice #:</strong> <?php echo htmlspecialchars($custom['customization_id']); ?></p>
                    <p><strong>Date:</strong> <?php echo date('F d, Y', strtotime($custom['customization_date'])); ?></p>
                    <p>
                        <strong>Status:</strong>
                        <span class="status-badge <?php echo ($custom['customization_status'] == '2' ? 'status-complete' : 'status-pending'); ?>">
                            <?php echo htmlspecialchars($statusText); ?>
                        </span>
                    </p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Bill To:</h5>
                    <p>
                        <strong><?php echo htmlspecialchars($custom['user_name'] ?? ''); ?></strong><br>
                        <?php echo htmlspecialchars($custom['user_email'] ?? ''); ?><br>
                        <?php echo htmlspecialchars($custom['user_contact'] ?? ''); ?><br>
                        <?php echo nl2br(htmlspecialchars($custom['user_address'] ?? '')); ?>
                    </p>
                </div>

                <div class="col-md-6">
                    <h5>Shop Details:</h5>
                    <p>
                        <strong><?php echo htmlspecialchars($custom['seller_name'] ?? 'DecoNest (Platform)'); ?></strong><br>
                        <?php echo htmlspecialchars($custom['seller_email'] ?? ''); ?><br>
                        <?php echo htmlspecialchars($custom['seller_contact'] ?? ''); ?><br>
                        <?php echo nl2br(htmlspecialchars($custom['seller_address'] ?? '')); ?>
                    </p>
                </div>
            </div>

            <!-- Customization details -->
            <div class="mb-4">
                <h5>Customization Details</h5>
                <div class="row">
                    <div class="col-md-8">
                        <p><strong>Request:</strong><br><?php echo nl2br(htmlspecialchars($custom['customization_content'])); ?></p>
                        <p><strong>Customization Date:</strong> <?php echo date('F d, Y', strtotime($custom['customization_date'])); ?></p>
                        <p><strong>Customization ID:</strong> <?php echo htmlspecialchars($custom['customization_id']); ?></p>
                    </div>
                    <div class="col-md-4 text-center">
                        <?php if (!empty($custom['customization_file']) && file_exists("../Assets/Files/CustomizationDocs/".$custom['customization_file'])): ?>
                            <img src="../Assets/Files/CustomizationDocs/<?php echo rawurlencode($custom['customization_file']); ?>" class="custom-file-preview" alt="Customization file">
                            <p class="mt-2"><a href="../Assets/Files/CustomizationDocs/<?php echo rawurlencode($custom['customization_file']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary">View File</a></p>
                        <?php elseif (!empty($custom['customization_file'])): ?>
                            <p class="meta">File: <?php echo htmlspecialchars($custom['customization_file']); ?> (not found)</p>
                        <?php else: ?>
                            <p class="meta">No attached file</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Amount table -->
            <table class="table-items" width="100%">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="width:110px;">Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Customization Charge</td>
                        <td>₹<?php echo number_format($amount, 2); ?></td>
                    </tr>

                    <tr>
                        <td>Tax (<?php echo number_format($tax_percent, 2); ?>%)</td>
                        <td>₹<?php echo number_format($tax_amount, 2); ?></td>
                    </tr>

                    <tr class="total-row">
                        <td align="right">Total</td>
                        <td>₹<?php echo number_format($total_amount, 2); ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="thank-you">
                <p>Thank you for choosing DecoNest for your custom design. Our team will contact you shortly about the details and timeline.</p>
            </div>

            <div class="text-center mt-4 no-print">
                <button onclick="window.print()" class="btn-print">Print Invoice</button>
            </div>
        </div>
    </div>

    <footer class="no-print text-center mb-4">
        <small>Copyright &copy; <?php echo date('Y'); ?> DecoNest. All Rights Reserved.</small>
    </footer>

    <!-- Optional bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
