<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if( isset($_SESSION['login_user']) )
{
	if($_SESSION['login_user'] == "admin")
	{
		$mangoproductid=$_GET['mangoproductid'];
		//Getting Value for OrderProductPrice and OrderProductStock
		$ProductQuery = mysqli_query($dbconn,"select * from mangoproduct where mangoproductid='$mangoproductid'");
		if(mysqli_num_rows($ProductQuery)>=1)
		{
			while($ProductQueryRow = mysqli_fetch_array($ProductQuery))
			{
				$FetchProductName = $ProductQueryRow['mangoproductname'];
				$FetchProductPrice = $ProductQueryRow['mangoproductprice'];
				$FetchProductStock = $ProductQueryRow['mangoproductstock'];
			}
		}	
		?>
			<html>
			<head><title>Update Product</title></head>
			<body>
			<form  method="GET" action="">
			<h1>Update Product</h1>
			<input type="hidden" name="mangoproductid" value=<?php echo $mangoproductid; ?> >
			Product Name:<br><br><input type="text" name="ProductName" <?php echo (isset($FetchProductName)) ? ('value = "'.$FetchProductName.'"') : "value= \"\""; ?> readonly><br><br>
			Enter Product Stock:<br><br><input type="number" name="ProductUpdatedStock" value=<?php echo $FetchProductStock ?> required><br><br>
			Enter Product Price:<br><br><input type="number" step=".00" name="ProductUpdatedPrice" value=<?php echo $FetchProductPrice ?> required><br><br>
			<br><a href="/MangoCart/MangoProduct/DisplayProduct.php">Go back</a>
			<input type="submit" name="UpdateProduct" value="Update">
			</form></body></html>
		<?php
		if(isset($_GET['UpdateProduct']))
		{	
			$ProductStock=$_GET["ProductUpdatedStock"];
			$ProductPrice=$_GET["ProductUpdatedPrice"];
		
			$result=mysqli_query($dbconn, "update mangoproduct set mangoproductstock='$ProductStock', mangoproductprice='$ProductPrice' where mangoproductid='$mangoproductid'");	
			if($result)
			{
				echo "Product $FetchProductName updated";
			}
			else
			{
				echo "Record not updated";
			}
		}
	}
	else
	{
		echo "<br><br>Access for Admin Only";
	}
}
?>