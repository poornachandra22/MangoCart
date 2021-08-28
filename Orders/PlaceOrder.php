<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if( isset($_SESSION['login_user']) )
{
	if($_SESSION['login_user'] == "admin")
	{
		echo "<br><br>Only users can place orders";
	}
	else
	{
		$mangoproductid=$_GET['mangoproductid'];
		?>
			<html>
			<head><title>Place Order</title></head>
			<body>
			<form  method="GET" action="">
			<input type="hidden" name="mangoproductid" value=<?php echo $mangoproductid; ?> ><br>
			Enter Quantity: <input type="number" name="OrderQuantity" required><br>
			<br><a href="/MangoCart/MangoProduct/DisplayProduct.php">Cancel</a>
			<input type="submit" name="PlaceOrder" value="Order">
			</form></body></html>
		<?php
		if(isset($_GET['PlaceOrder']))	
		{
			//Getting Value for OrderUserId
			$OrderUserId = $UserId;
			
			//Getting Value for OrderProductId
			$OrderProductId = $mangoproductid;
			
			//Getting Value for OrderQuantity
			$OrderQuantity = $_GET["OrderQuantity"];
			
			//Getting Value for OrderProductPrice and OrderProductStock
			$ProductPriceQuery = mysqli_query($dbconn,"select * from mangoproduct where mangoproductid='$OrderProductId'");
			if(mysqli_num_rows($ProductPriceQuery)>=1)
			{
				while($ProductPriceQueryRow = mysqli_fetch_array($ProductPriceQuery))
				{
					$OrderProductPrice = $ProductPriceQueryRow['mangoproductprice'];
					$OrderProductStock = $ProductPriceQueryRow['mangoproductstock'];
				}
			}
			
			//Getting Value for OrderAmount
			$OrderAmount = $OrderQuantity * $OrderProductPrice;
			
			//Getting Value for OrderDate
			$OrderDate = date('Y-m-d H-i-s');
			
			//Inserting into order table
			if($OrderQuantity < $OrderProductStock)
			{
				$OrderPlacing=mysqli_query($dbconn, " Insert into productorder (orderuserid,orderproductid,orderquantity,orderamount,orderdate) values ('$OrderUserId','$OrderProductId','$OrderQuantity','$OrderAmount','$OrderDate')");
				if($OrderPlacing)
				{
					$ProductRemainingStock = $OrderProductStock - $OrderQuantity;
					
					//Updating stock in product table
					$UpdatingStock=mysqli_query($dbconn, " update mangoproduct set mangoproductstock='$ProductRemainingStock' where mangoproductid='$OrderProductId' ");
					
					if($UpdatingStock)
					{
						echo "Order Placed Successfully";
						echo "<br><a href='/MangoCart/Orders/ViewOrder.php'>View Orders here</a>";
					}
				}
			}
			else
			{
				echo "Enter less quantity";
			}
		}
	}
}
?>