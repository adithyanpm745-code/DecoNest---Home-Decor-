<?php 
include("../Connection/Connection.php"); 
?>
<thead>
    <tr>
        <th>SL.NO</th>
        <th>NAME</th>
        <th>ADDRESS</th>
        <th>PHOTO</th>
        <th>DISTRICT</th>
        <th>PLACE</th>
        <th>CUSTOMIZATION</th>
        <th>VIEW PRODUCTS</th>
    </tr>
</thead>
<tbody>
    <?php 
    if($_GET['disId']!="" && $_GET['pid']=="") 
    { 
        $SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where p.district_id='".$_GET['disId']."' and seller_status=1"; 
        $row=$con->query($SelQry); 
    } 
    elseif($_GET['disId']!="" && $_GET['pid']!="") 
    { 
        $SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where p.place_id='".$_GET['pid']."' and seller_status=1"; 
        $row=$con->query($SelQry);
    } 
    elseif($_GET['disId']=="" && $_GET['pid']=="") 
    { 
        $SelQry="select * from tbl_seller s inner join tbl_place p on s.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where seller_status=1"; 
        $row=$con->query($SelQry);
    } 
    
    $i=0; 
    while($data=$row->fetch_assoc()) 
    { 
        $i++; 
    ?> 
    <tr>
        <td><span class="seller-sl-number"><?php echo $i?></span></td>
        <td><span class="seller-shop-name"><?php echo $data['seller_name']?></span><br>
            <small class="seller-contact-info"><?php echo $data['seller_email']?></small><br>
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