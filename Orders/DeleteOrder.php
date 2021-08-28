<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);
?>

<html>
<head><title>Delete Order</title></head>
<body>
<h2>Are you sure you want to delete this order ??</h2>
<form method="POST" action="">
<br><a href="/MangoCart/Orders/ViewOrder.php">Cancel</a>
<input type="submit" name="DeleteOrder" value="Delete"/>
</form></body></html>

<?php
if( isset($_SESSION['login_user']) )
{
	if ( isset($_POST['DeleteOrder']))
	{
		$orderid=$_GET['orderid'];
		$result=mysqli_query($dbconn,"delete from productorder where orderid='$orderid'");
		if($result)
		{
			header("location: /MangoCart/Orders/ViewOrder.php");
		}
	}
}