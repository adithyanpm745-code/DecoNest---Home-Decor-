<?php

include("../Assets/Connection/Connection.php");
$adname="";
$ademail="";
$adpass="";
$adid="";
	if(isset($_POST["btn_submit"]))
	{
		$name=$_POST["txt_name"];

		$email=$_POST["txt_email"];
		
		$password=$_POST["txt_password"];
		
		$adid=$_POST["txt_id"];
		
		$Email="select * from tbl_admin where admin_email='".$email."'";
		$row=$con->query($Email);
		if($data=$row->fetch_assoc())
		  {
			?>
       		 <script>
			alert("This Email is Already Registered !")		
			</script>
     	   <?php	
		  }
		else
		{  
		if($adid=="")
			{
		
			$InsQry="insert into tbl_admin(admin_name,admin_email,admin_password) values('$name','$email','$password')";
		if($con->query($InsQry))
		{
			?>
        <script>
		alert("Your Registration has been Successfully Completed")
		window.location="AdminRegistration.php";
		</script>
        <?php	
		}
		else
		{
				?>
        <script>
		alert("Something has wrong")
		window.location="AdminRegistration.php";
		</script>
        <?php
		}
	
	}
		else
		{
			$upQry="update tbl_admin set admin_name='".$name."',admin_email='".$email."',admin_password='".$password."' where admin_id='".$adid."'";
		if($con->query($upQry))
		{
			?>
		<script>
		alert("Data has been Updated Successfully")
		window.location="AdminRegistration.php";
		</script>
			<?php 
		}
	}
	}
	}
	if(isset($_GET['delId']))
	{
		$DelQry="delete from tbl_admin where admin_id='".$_GET['delId']."'";
		if($con->query($DelQry))
		{
		?>
        <script>
		alert("Record Deleted Successfully")
		window.location="AdminRegistration.php";
		</script>
        <?php	
		}
	}   
	
	if(isset($_GET['editId']))
{
	$SelQry="select * from tbl_admin where admin_id='".$_GET['editId']."'";
	{
		$row=$con->query($SelQry);
		$data=$row->fetch_assoc();
		$adname=$data['admin_name'];
		$ademail=$data['admin_email'];
		$adpass=$data['admin_password'];
		$adid=$data["admin_id"];
	}
}	
	
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Registration</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value="<?php echo $adname?>" minlength="3" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required/>
      <input type="hidden" name="txt_id" id="txt_name" value="<?php echo $adid?>"/>
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" value="<?php echo $ademail?>" required />
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $adid?>"/>
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" value="<?php echo $adpass?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
               title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters" required/>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $adid?>"/>
      </td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>SL.NO</td>
      <td>Name</td>
      <td>Email</td>
      <td>Password</td>
      <td>Action</td>
    </tr>
    <?php

	$i=0;
	$SelQry="select * from tbl_admin";
	$row=$con->query($SelQry);
	while($data=$row->fetch_assoc())
	{
		$i++;

	?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['admin_name']?></td>
      <td><?php echo $data['admin_email']?></td>
      <td><?php echo $data['admin_password']?></td>
      <td>
      <a href="AdminRegistration.php?delId=<?php echo $data['admin_id'] ?>">Delete</a>
   <a href="AdminRegistration.php?editId=<?php echo $data['admin_id'] ?>">Edit</a>
      </td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>