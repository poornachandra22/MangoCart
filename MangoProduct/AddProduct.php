<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if( isset($_SESSION['login_user']) )
{
	if($_SESSION['login_user'] == "admin")
	{
		?>
			<html>
			<head><title>Add Product</title></head>
			<body>
			<form action="" method="POST">
			<h1>Add Product Form</h1>
			Enter Mango Variety : <input type="text" name="ProductName" required /><br><br>
			Enter Stock : <input type="number" name="ProductStock" required /><br><br>
			Enter Price : <input type="number" step=".00" name="ProductPrice" required /><br><br>
			<br><a href="/MangoCart/MangoProduct/DisplayProduct.php">Go back</a>
			<input type="submit" name="AddProduct" value="Add"/>
			</form></body></html>
		<?php
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$Name = $_POST['ProductName'];
			$Stock = $_POST['ProductStock'];
			$Price = $_POST['ProductPrice'];
		
			$result=mysqli_query($dbconn, "insert into mangoproduct (mangoproductname, mangoproductstock, mangoproductprice) values ('$Name','$Stock','$Price')");
			
			if($result)
			{
				echo "<br/>Product $Name Added";
			}
			else
			{
				echo "<br/>Couldn't Add the Product!!";
			}
		}
	}
	else
	{
		echo "<br><br>Access for Admin Only";
	}
}
?>

