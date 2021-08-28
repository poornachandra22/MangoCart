<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if( isset($_SESSION['login_user']) )
{
	if($_SESSION['login_user'] == "admin")
	{
		$mangoproductid=$_GET['mangoproductid'];
		?>
			<html>
			<head><title>Remove Product</title></head>
			<body>
			<h2>Are you sure you want to delete this product ??</h2>
			<form method="POST" action="">
			<br><a href="/MangoCart/MangoProduct/DisplayProduct.php">Cancel</a>
			<input type="submit" name="RemoveProduct" value="Remove"/>
			</form></body></html>
		<?php
		if( isset($_POST['RemoveProduct']) )
		{
			$result=mysqli_query($dbconn,"delete from mangoproduct where mangoproductid='$mangoproductid'");
			if($result)
			{
				header("location: /MangoCart/MangoProduct/DisplayProduct.php");
			}
		}
	}
	else
	{
		echo "<br><br>Access for Admin Only";
	}
}
?>