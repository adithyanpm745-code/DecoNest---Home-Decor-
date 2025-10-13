<?php
include("../Assets/Connection/Connection.php");
session_start();

if (!isset($_SESSION['sid'])) {
    header("Location: ../Login.php");
    exit();
}

if (isset($_GET['cid']) && isset($_GET['sts'])) {
    $bookingId = $_GET['cid'];
    $newStatus = $_GET['sts'];

    // Update query to change booking status
    $updateQuery = "UPDATE tbl_booking SET booking_status = '$newStatus' WHERE booking_id = '$bookingId'";
    if ($con->query($updateQuery)) {
        // Redirect to the same page to see the changes
        header("Location: ViewBooking.php");
        exit();
    } else {
        echo "Error updating record: " . $con->error;
    }
}

$sellerId = $_SESSION['sid'];

$selqry = "SELECT 
                *
           FROM tbl_booking b
           INNER JOIN tbl_user u ON b.user_id = u.user_id
           INNER JOIN tbl_cart c ON c.booking_id = b.booking_id
           INNER JOIN tbl_product p ON c.product_id = p.product_id
           WHERE p.seller_id = '$sellerId' AND b.booking_status <= 4 AND c.cart_status != 0
           ORDER BY b.booking_id DESC";

$res = $con->query($selqry);

// Group rows by booking_id
$bookings = [];

while ($row = $res->fetch_assoc()) {
    $bookings[$row['booking_id']]['info'] = [
        'booking_date' => $row['booking_date'],
        'booking_status' => $row['booking_status'],
        'booking_amount' => $row['booking_amount'],
        'booking_address' => $row['booking_address'],
        'user_name' => $row['user_name'],
        'user_email' => $row['user_email'],
        'user_contact' => $row['user_contact'],
    ];
    $bookings[$row['booking_id']]['products'][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Cards</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f7f9fb;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
            font-size: 32px;
        }

        .card {
            background: #fff;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            transform: translateY(-5px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            color: #34495e;
        }

        .card-header h3 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }

        .card-header span {
            font-size: 14px;
            background: #3498db;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .user-details {
            margin-bottom: 15px;
            font-size: 16px;
            color: #34495e;
            line-height: 1.5;
        }

        .user-details strong {
            color: #2980b9;
        }

        .status {
            margin-top: 10px;
            font-weight: bold;
            font-size: 18px;
        }

        .product-list {
            margin-top: 20px;
            border-top: 1px solid #ecf0f1;
            padding-top: 20px;
        }

        .product {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .product img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 6px;
        }

        .product-info {
            flex-grow: 1;
        }

        .product-info h4 {
            font-size: 18px;
            margin: 0;
            color: #2c3e50;
        }

        .product-info span {
            font-size: 14px;
            color: #7f8c8d;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin-top: 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .product {
                flex-direction: column;
                align-items: flex-start;
            }

            .product img {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header inclusion -->
    <?php include('Header.php'); ?>

<div class="container">
    <h2>Booking Orders</h2><br><br>

    <a href="CompletedOrder.php" class="btn"> View Completed Orders </a><br><br><br>

    <?php foreach ($bookings as $bookingId => $data): ?>
        <div class="card">
            <div class="card-header">
                <h3>Booking #<?php echo $bookingId; ?></h3>
                <span>
                    <?php 
                        $statusText = [
                            1 => "Payment Pending...",
                            2 => "Payment Completed",
                            3 => "Product Packed",
                            4 => "Product Shipped",
                            5 => "Order Completed"
                        ];
                        echo $statusText[$data['info']['booking_status']];
                    ?>
                </span>
            </div>

            <div class="user-details">
                <strong>Customer:</strong> <?php echo $data['info']['user_name']; ?> <br>
                <strong>Email:</strong> <?php echo $data['info']['user_email']; ?> <br>
                <strong>Address:</strong> <?php echo $data['info']['booking_address']; ?> <br>
                <strong>Phone:</strong> <?php echo $data['info']['user_contact']; ?> <br>
                <strong>Booking Amount:</strong> ₹<?php echo number_format($data['info']['booking_amount'], 2); ?><br>
                <strong>Date:</strong> <?php echo $data['info']['booking_date']; ?> <br>
            </div>

            <div class="product-list">
                <?php foreach ($data['products'] as $product): ?>
                    <div class="product">
                        <img src="../Assets/Files/ProductDocs/<?php echo $product['product_photo']; ?>" alt="<?php echo $product['product_name']; ?>">
                        <div class="product-info">
                            <h4><?php echo $product['product_name']; ?></h4>
                            <span>Price: ₹<?php echo number_format($product['product_price'], 2); ?></span><br>
                            <span>Quantity: <?php echo $product['cart_quantity']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php 
            $currentStatus = $data['info']['booking_status'];
            if ($currentStatus >= 2 && $currentStatus < 5) {
                $nextStatus = $currentStatus + 1;
                $btnLabel = [
                    2 => "Pack Product",
                    3 => "Ship Product",
                    4 => "Mark as Delivered"
                ];
                echo "<a class='btn' href='ViewBooking.php?cid=$bookingId&sts=$nextStatus'>{$btnLabel[$currentStatus]}</a>";
            }
            ?>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
