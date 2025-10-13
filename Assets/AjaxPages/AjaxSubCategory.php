<option value="">Select</option>
<?php
include('../connection/connection.php');
$cid=$_GET['catId'];
$SelQry="select * from tbl_subcategory where category_id='".$cid."'";
$row=$con->query($SelQry);

while($data=$row->fetch_assoc())
{
	?>
	<option value="<?php echo $data['subcategory_id']?>">
	<?php echo $data['subcategory_name']?>
    </option>
    <?php
    }
    ?>