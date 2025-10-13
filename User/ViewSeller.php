<?php
include("../Assets/Connection/Connection.php");
include("Header.php");
?>
<br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Shop</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
/* Custom styles with unique class names to avoid conflicts */
.seller-view-main {
    background: linear-gradient(135deg, #5e6586ff 0%, #b2a693ff 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.seller-filter-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-bottom: 30px;
    backdrop-filter: blur(10px);
}

.seller-filter-heading {
    color: #4a5568;
    font-size: 1.8rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
    position: relative;
}

.seller-filter-heading:before {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
}

.seller-select-custom {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 9px 15px;
    background: #ffffff;
    transition: all 0.3s ease;
    font-size: 14px;
}

.seller-select-custom:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    outline: none;
}

.seller-table-wrapper {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.seller-data-table {
    margin: 0;
    border: none;
    background: transparent;
}

.seller-data-table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 20px 15px;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
    vertical-align: middle;
}

.seller-data-table tbody td {
    border: 1px solid rgba(102, 126, 234, 0.1);
    padding: 20px 15px;
    vertical-align: middle;
    text-align: center;
    color: #4a5568;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.8);
}

.seller-data-table tbody tr:hover td {
    background: rgba(102, 126, 234, 0.05);
    transform: scale(1.001);
    transition: all 0.3s ease;
}

.seller-photo-cell img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e2e8f0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.seller-photo-cell img:hover {
    transform: scale(1.1);
    border-color: #667eea;
}

.seller-action-btn {
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 12px;
    transition: all 0.3s ease;
    display: inline-block;
    border: none;
    cursor: pointer;
    text-align: center;
    min-width: 120px;
}

.seller-customization-btn {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
}

.seller-customization-btn:hover {
    background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
}

.seller-products-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    margin-top: 5px;
}

.seller-products-btn:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.seller-no-customization {
    background: #fed7d7;
    color: #c53030;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.seller-sl-number {
    font-weight: 700;
    color: #667eea;
    font-size: 16px;
}

.seller-shop-name {
    font-weight: 600;
    color: #2d3748;
}

.seller-contact-info {
    color: #4a5568;
    font-size: 13px;
}

.seller-address-cell {
    max-width: 200px;
    word-wrap: break-word;
    font-size: 13px;
}

.seller-location-info {
    color: #718096;
    font-size: 13px;
}

.seller-action-cell {
    min-width: 150px;
}

@media (max-width: 1200px) {
    .seller-data-table {
        font-size: 12px;
    }
    
    .seller-data-table thead th,
    .seller-data-table tbody td {
        padding: 15px 8px;
    }
    
    .seller-photo-cell img {
        width: 60px;
        height: 60px;
    }
    
    .seller-action-btn {
        font-size: 11px;
        padding: 6px 10px;
        min-width: 100px;
    }
}

@media (max-width: 768px) {
    .seller-table-wrapper {
        overflow-x: auto;
    }
    
    .seller-data-table {
        min-width: 1000px;
    }
}
</style>
</head>
<body>
<div class="seller-view-main">
    <div class="container-fluid">
        <!-- Filter Section -->
        <div class="seller-filter-card">
            <h2 class="seller-filter-heading">
                <i class="fas fa-filter me-2"></i>Find Your Perfect Decor
            </h2>
            <form id="form1" name="form1" method="post" action="">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="sel_district">District</label>
                        <select name="sel_district" id="sel_district" class="form-select seller-select-custom" onChange="AjaxPlace(this.value),AjaxSeller()">
                            <option value="">Select</option>
                            <?php
                            $sel="select * from tbl_district";
                            $res=$con->query($sel);
                            while($data=$res->fetch_assoc())
                            {
                            ?>
                            <option value="<?php echo $data["district_id"]?>">
                            <?php echo $data["district_name"]?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold" for="sel_place">Place</label>
                        <select name="sel_place" id="sel_place" class="form-select seller-select-custom" onChange="AjaxSeller()">
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="seller-table-wrapper">
            <table class="table seller-data-table" id="seller">
                <thead>
                    <tr>
                        <th>SL.NO</th>
                        <th>NAME</th>
                        <th>ADDRESS</th>
                        <th>PHOTO</th>
                        <th>DISTRICT</th>
                        <th>PLACE</th>
                        <th>CUSTOMIZATION</th>
                        <!-- <th>RATING</th> -->
                        <th>VIEW PRODUCTS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    $SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id 
                    where seller_status=1 ";
                    
                    $row=$con->query($SelQry);
                    while($data=$row->fetch_assoc())
                    {
                        $i++;
                    ?>
                    <tr>
                        <td><span class="seller-sl-number"><?php echo $i?></span></td>
                        <td><span class="seller-shop-name"><?php echo $data['seller_name']?></span><br>
                            <small class="seller-contact-info"><?php echo $data['seller_email']?></small><br>
                            <!-- <small class="seller-contact-info"><?php echo $data['seller_contact']?></small> -->
                        </td>
                        <td class="seller-address-cell"><?php echo $data['seller_address']?><br>
                      <small class="seller-contact-info"><?php echo $data['seller_contact']?></small>
                        </td>
                        <td class="seller-photo-cell">
                            <img src="../Assets/Files/SellerDocs/<?php echo $data['seller_photo']?>" alt="Shop Photo" />
                        </td>
                        <td class="seller-location-info"><?php echo $data['district_name'] ?></td>
                        <td class="seller-location-info"><?php echo $data['place_name']?></td>
                        <td>
                            <?php
                            if($data['seller_customization']==1)
                            {
                            ?>
                            <span class="badge bg-success">Available</span>
                            <?php
                            }
                            else 
                            {
                            ?>
                            <span class="badge bg-danger">Not Available</span>
                            <?php
                            }
                            ?> 
                             <br><br>
                            <?php
                            if($data['seller_customization']==1)
                            {
                            ?>
                            <a href="Customization.php?sid=<?php echo $data['seller_id']?>" class="seller-action-btn seller-customization-btn">
                                <i class="fas fa-tools me-1"></i>Customize
                            </a>
                            <?php
                            }
                            else 
                            {
                            ?>
                            <span class="seller-no-customization">No Customization</span>
                            <?php
                            }
                            ?> 
                        </td>
                        <!-- <td>
                            <div class="d-flex flex-column align-items-center">
                                <span class="badge bg-warning text-dark mb-1">
                                    <i class="fas fa-star"></i> 4.5
                                </span>
                                <small class="text-muted">(25 reviews)</small>
                            </div>
                        </td> -->
                        <td class="seller-action-cell">
                            <a href="ViewProductList.php?Morepid=<?php echo $data['seller_id']?>" class="seller-action-btn seller-products-btn">
                                <i class="fas fa-eye me-1"></i>View Products
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>  
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../Assets/JQ/jQuery.js"></script> 
<script>
    function AjaxPlace(disId) 
    {
        $.ajax({
        url:"../Assets/AjaxPages/AjaxPlace.php?disId="+disId,
        success: function(html){
            $("#sel_place").html(html);
        }
        });
    }
    
    
     function AjaxSeller()
    {
        var disId=document.getElementById("sel_district").value;
        var pid=document.getElementById("sel_place").value;
        
        $.ajax({
        url:"../Assets/AjaxPages/AjaxSeller.php?disId="+disId+"&pid="+pid,
        success: function(html){
            $("#seller").html(html);
        }
        });
    }
</script>
</body>
</html>

 <!--::footer_part:-->
    <?php include("Footer.php"); ?>