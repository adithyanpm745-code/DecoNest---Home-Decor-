<?php
$server="localhost";
$user="root";
$password="";
$DB="db_miniproject";
$con = mysqli_connect($server,$user,$password,$DB);
if(!$con)
{
	echo"connection failed";
}
?>