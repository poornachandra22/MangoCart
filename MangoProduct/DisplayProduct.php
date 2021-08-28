<html>
<head><title>MangoCart Products</title></head>
</html>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if( isset($_SESSION['login_user']) )
{
	echo '<h1>Welcome to MangoCart</h1>';
	$DisplayProductQuery=mysqli_query($dbconn,"select * from mangoproduct");
	if(mysqli_num_rows($DisplayProductQuery)>=1)
	{
		echo '<h2>Product Details</h2>';
		echo '<table border="1px"> <tr> <th>ProductName</th> <th>ProductStock</th> <th>ProductPrice</th>';
		
		if($ActiveUser == "admin")
		{
			echo "<th><a href='/MangoCart/MangoProduct/AddProduct.php'>Add Product</a></th>";
			echo "<th><a href='/MangoCart/Orders/ViewOrder.php'>View All Orders</a></th>";
		}
		else
		{
			echo "<th><a href='/MangoCart/Orders/ViewOrder.php'>View Your Orders</a></th>";
		}
		echo '</tr>';
		while ($DisplayProductQueryRow = mysqli_fetch_array($DisplayProductQuery))
		{
			echo '<tr> <td>'.$DisplayProductQueryRow['mangoproductname'].'</td>
			<td>'.$DisplayProductQueryRow['mangoproductstock'].'</td>
			<td>'.$DisplayProductQueryRow['mangoproductprice'].'</td>';
			
			if($ActiveUser == "admin")
			{
				echo "<td> <a href='UpdateProduct.php?mangoproductid=".$DisplayProductQueryRow['mangoproductid']."'>Update Product</a></td>";
				echo "<td> <a href='RemoveProduct.php?mangoproductid=".$DisplayProductQueryRow['mangoproductid']."'>Remove Product</a></td>";
			}
			else
			{
				echo "<td> <a href='/MangoCart/Orders/PlaceOrder.php?mangoproductid=".$DisplayProductQueryRow['mangoproductid']."'>Place An Order</a></td>";
			}
			echo '</tr>';
		}
	}
	else
	{
		echo "<br><br>No products available now.. We will notify you when they are available!! "; 
	}
}
?> 