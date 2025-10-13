<?php
include("../Assets/Connection/Connection.php");
session_start();
?>

<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DecoNest - View Complaints</title>
    <link rel="icon" href="../Assets/Templates/Main/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="%23f8f5f0" width="100" height="100"/><path d="M0 50 L100 50 M50 0 L50 100" stroke="%23e9e5de" stroke-width="1"/></svg>');
            background-attachment: fixed;
        }
        
        .complaint-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.06);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .complaint-header {
            color: #5a5a5a;
            border-bottom: 2px solid #c8a97e;
            padding-bottom: 15px;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .complaint-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .complaint-table th {
            background-color: #f8f5f0;
            color: #5a5a5a;
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #e9e5de;
        }
        
        .complaint-table td {
            padding: 15px;
            vertical-align: top;
            border-bottom: 1px solid #e9e5de;
        }
        
        .complaint-table tr:last-child td {
            border-bottom: none;
        }
        
        .complaint-table tr:hover {
            background-color: #fcfaf7;
        }
        
        .user-details {
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .user-details strong {
            color: #c8a97e;
            display: block;
            margin-bottom: 3px;
        }
        
        .btn-reply {
            background-color: #c8a97e;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .btn-reply:hover {
            background-color: #b8986a;
            color: white;
        }
        
        .complaint-reply {
            background-color: #f8f5f0;
            padding: 12px 15px;
            border-radius: 6px;
            border-left: 3px solid #c8a97e;
            font-style: italic;

        }
        
        .section-title {
            position: relative;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #c8a97e;
        }
    </style>
</head>

<body>
    <!-- Header inclusion -->
    <?php include('Header.php'); ?>

    <div class="container my-5">
        <div class="complaint-container">
            <h2 class="complaint-header">New Complaints</h2>
            
            <div class="table-responsive">
                <table class="complaint-table">
                    <thead>
                        <tr>
                            <th>SL.NO</th>
                            <th>User Details</th>
                            <th>Details</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../Assets/Connection/Connection.php");
                        $i=0;
                         $SelQry="select * from tbl_complaint c 
                        inner join tbl_booking b on c.booking_id=b.booking_id 
                        inner join tbl_cart ca on ca.booking_id=b.booking_id
                        inner join tbl_product p on ca.product_id=p.product_id
                        inner join tbl_user u on c.user_id=u.user_id 
                        where complaint_status=0 and p.seller_id='".$_SESSION['sid']."'";
                        $row=$con->query($SelQry);
                        while($data=$row->fetch_assoc())
                        {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td>
                                <div class="user-details">
                                    <strong>Name:</strong> <?php echo $data['user_name']?><br>
                                    <strong>Email:</strong> <?php echo $data['user_email']?><br>
                                    <strong>Contact:</strong> <?php echo $data['user_contact']?><br>
                                    <strong>Address:</strong> <?php echo $data['user_address']?>
                                </div>
                            </td>
                            <td>
                                <div class="user-details">
                                    <strong>Product:</strong> <?php echo $data['product_name']?><br>
                                    <strong>Booking ID:</strong> <?php echo $data['booking_id']?><br>
                                </div>
                            </td> 
                            <td><?php echo $data['complaint_content']?></td>
                            <td><?php echo date('d M Y', strtotime($data['complaint_date']))?></td>
                            <td><a href="Reply.php?cid=<?php echo $data['complaint_id']?>" class="btn btn-reply"style="background-color: red; color: white;">Reply</a></td>
                            
                        </tr>
                        <?php
                        }
                        if($i == 0) {
                            echo '<tr><td colspan="5" class="text-center py-4">No new complaints found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="complaint-container mt-5">
            <h2 class="complaint-header">Replied Complaints</h2>
            
            <div class="table-responsive">
                <table class="complaint-table">
                    <thead>
                        <tr>
                            <th>SL.NO</th>
                            <th>User Details</th>
                            <th>Details</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        $SelQry="select * from tbl_complaint c 
                        inner join tbl_booking b on c.booking_id=b.booking_id 
                        inner join tbl_cart ca on ca.booking_id=b.booking_id
                        inner join tbl_product p on ca.product_id=p.product_id
                        inner join tbl_user u on c.user_id=u.user_id 
                        where complaint_status=1 and p.seller_id='".$_SESSION['sid']."'";
                        $row=$con->query($SelQry);
                        while($data=$row->fetch_assoc())
                        {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td>
                                <div class="user-details">
                                    <strong>Name:</strong> <?php echo $data['user_name']?><br>
                                    <strong>Email:</strong> <?php echo $data['user_email']?><br>
                                    <strong>Contact:</strong> <?php echo $data['user_contact']?><br>
                                    <strong>Address:</strong> <?php echo $data['user_address']?>
                                </div>
                            </td>
                            <td>
                                <div class="user-details">
                                    <strong>Product:</strong> <?php echo $data['product_name']?><br>
                                    <strong>Booking ID:</strong> <?php echo $data['booking_id']?><br>
                                </div>
                            </td>    
                            <td><?php echo $data['complaint_content']?></td>
                            <td><?php echo date('d M Y', strtotime($data['complaint_date']))?></td>
                            <td><div class="complaint-reply"><?php echo $data['complaint_reply']?></div></td>
                        </tr>
                        <?php
                        }
                        if($i == 0) {
                            echo '<tr><td colspan="5" class="text-center py-4">No replied complaints found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Assets/Templates/Main/js/jquery-1.12.1.min.js"></script>
    <script src="../Assets/Templates/Main/js/popper.min.js"></script>
    <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
</body>
</html>