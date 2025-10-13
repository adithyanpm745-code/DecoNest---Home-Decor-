<option value="">Select</option>
<?php
include('../connection/connection.php');
$did=$_GET['disId'];
$SelQry="select * from tbl_place where district_id='".$did."'";
$row=$con->query($SelQry);

while($data=$row->fetch_assoc())
{
	?>
	<option value="<?php echo $data['place_id']?>">
	<?php echo $data['place_name']?>
    </option>
    <?php
    }
    ?>