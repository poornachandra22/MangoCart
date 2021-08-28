<html>
<head><title>View Orders</title></head>
</html>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if( isset($_SESSION['login_user']) )
{
	if($ActiveUser == "admin")
	{
		$OrderDisplayQuery=mysqli_query($dbconn,"select productorder.orderid, user.UserName, mangoproduct.mangoproductname, mangoproduct.mangoproductprice, productorder.orderquantity, productorder.orderamount, user.UserShippingAddress, user.UserPhoneNo, productorder.orderdate from user , productorder , mangoproduct where productorder.orderuserid = user.UserId and productorder.orderproductid = mangoproduct.mangoproductid ;");
		if(mysqli_num_rows($OrderDisplayQuery)>=1)
		{
			echo '<h1>Order details</h1>';
			echo '<table border="1px"> <tr> <th>OrderId</th> <th>Ordered By</th> <th>Product</th> <th>Price per unit</th> <th>Order Quantity</th> <th>OrderAmount</th> <th>Shipping Address</th> <th>Contact Number</th> <th>Order Date</th> </tr>';
			while ($OrderDisplayQueryRow = mysqli_fetch_array($OrderDisplayQuery))
			{
				echo '<tr>
				<td>'.$OrderDisplayQueryRow['orderid'].'</td>
				<td>'.$OrderDisplayQueryRow['UserName'].'</td>
				<td>'.$OrderDisplayQueryRow['mangoproductname'].'</td>
				<td>'.$OrderDisplayQueryRow['mangoproductprice'].'</td>
				<td>'.$OrderDisplayQueryRow['orderquantity'].'</td>
				<td>'.$OrderDisplayQueryRow['orderamount'].'</td>
				<td>'.$OrderDisplayQueryRow['UserShippingAddress'].'</td>
				<td>'.$OrderDisplayQueryRow['UserPhoneNo'].'</td>
				<td>'.$OrderDisplayQueryRow['orderdate'].'</td>';
				echo "<td> <a href='DeleteOrder.php?orderid=".$OrderDisplayQueryRow['orderid']."'>Clear Order</a></td>";
				echo '</tr>';
			}
		}
		else
		{
			echo "<br><br>No Orders found"; 
		}
	}
	else
	{
		$OrderDisplayQuery = mysqli_query($dbconn,"select productorder.orderid, mangoproduct.mangoproductname, mangoproduct.mangoproductprice, productorder.orderquantity, productorder.orderamount, productorder.orderdate from user , productorder , mangoproduct where user.UserId='$UserId' and productorder.orderuserid = user.UserId and productorder.orderproductid = mangoproduct.mangoproductid ");
		if(mysqli_num_rows($OrderDisplayQuery) > 0)
		{
			echo '<h1>Order details</h1>';
			echo '<table border="1px"> <tr> <th>OrderId</th> <th>Product</th> <th>Product Price</th> <th>OrderQuantity</th> <th>OrderAmount</th> <th>OrderDate</th> </tr>';
			while ($OrderDisplayQueryRow = mysqli_fetch_array($OrderDisplayQuery))
			{
				echo '<tr>
				<td>'.$OrderDisplayQueryRow['orderid'].'</td>
				<td>'.$OrderDisplayQueryRow['mangoproductname'].'</td>
				<td>'.$OrderDisplayQueryRow['mangoproductprice'].'</td>
				<td>'.$OrderDisplayQueryRow['orderquantity'].'</td>
				<td>'.$OrderDisplayQueryRow['orderamount'].'</td>
				<td>'.$OrderDisplayQueryRow['orderdate'].'</td>';
				echo "<td> <a href='DeleteOrder.php?orderid=".$OrderDisplayQueryRow['orderid']."'>Cancel Order</a></td>";
				echo '</tr>';
			}
			echo "</table>";
		}
		else
		{
			echo "<br><br>No Orders found"; 
		}
	}
}
?>