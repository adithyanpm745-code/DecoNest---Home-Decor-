<?php
include("../Connection/Connection.php");
session_start();
$selqry="select * from tbl_booking where user_id='".$_SESSION["uid"]."' and booking_status='0'";

$result=$con->query($selqry);
if($result->num_rows>0)
{
	
	if($row=$result->fetch_assoc())
	{
		$bid = $row["booking_id"];
		
		$pdt = "select * from tbl_product where product_id=".$_GET['id'];
		$pdtrow = $con->query($pdt);
		$pdtdata = $pdtrow -> fetch_assoc();
		$seller_id = $pdtdata['seller_id'];
		
		$sel = "select * from tbl_cart c inner join tbl_product p on c.product_id=p.product_id where booking_id='".$bid."'";
		$rows = $con->query($sel);
		if($rows->num_rows > 0)
		{
			$data = $rows->fetch_assoc();
			$sell = $data['seller_id'];
			
			if($seller_id == $sell)
			{
				$selqry="select * from tbl_cart where booking_id='".$bid."' and product_id='".$_GET["id"]."'";
				//echo $selqry;
				$result=$con->query($selqry);
				if($result->num_rows>0)
				{		
					echo "Already Added to Cart";
					
				}
				else
				{
				
				$insQry1="insert into tbl_cart(product_id,booking_id)values('".$_GET["id"]."','".$bid."')";
				if($con->query($insQry1))
				{ 
					echo "Added to Cart";
								}
								else
								{
								echo"Failed";
								}
				}
			}
			else
			{
				echo "Please pay the previous booking because the product is held by other seller";
			}
		}	
		else
		{
			$selqry="select * from tbl_cart where booking_id='".$bid."' and product_id='".$_GET["id"]."'";
				//echo $selqry;
				$result=$con->query($selqry);
				if($result->num_rows>0)
				{		
					echo "Already Added to Cart";
					
				}
				else
				{
				
				$insQry1="insert into tbl_cart(product_id,booking_id)values('".$_GET["id"]."','".$bid."')";
				if($con->query($insQry1))
				{ 
					echo "Added to Cart";
								}
								else
								{
								echo"Failed";
								}
				}
		}	
	}
	
}
else
{
	

$insQry=" insert into tbl_booking(user_id,booking_date)values('".$_SESSION["uid"]."',curdate())";
			if($con->query($insQry))
			{
				$selqry1="select MAX(booking_id) as id from tbl_booking";
                $result=$con->query($selqry1);
				if($row=$result->fetch_assoc())
				{
					$bid=$row["id"];
					
					
					
	                   $insQry1="insert into tbl_cart(product_id,booking_id)values('".$_GET["id"]."','".$bid."')";
                        if($con->query($insQry1))
                        { 
                          echo "Added to Cart";
                        }
                        else
                        {
	                       echo"Failed";
                        }
					  
		}

                }
			
}
?>