<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head></html>

<?php
$dbconn=mysqli_connect('localhost','root','12345678');
mysqli_select_db($dbconn,'mangocart');
session_start();
if( isset($_SESSION['login_user']) )
{
	$ActiveUser = $_SESSION['login_user'];
	if ($ActiveUser == "admin")
	{
		echo "Welcome $ActiveUser !!";
		echo "\t\tClick here to <a href='/MangoCart/MangoProduct/DisplayProduct.php'>Go to HomePage</a> / <a href='/MangoCart/SignOut.php'>Sign Out</a>";
	}
	else
	{		
		$UserNameQuery = mysqli_query($dbconn," select * from user where UserMailId='$ActiveUser' ");
		if(mysqli_num_rows($UserNameQuery)>=1)
		{
			while($UserNameQueryRow = mysqli_fetch_array($UserNameQuery))
			{
				$UserId = $UserNameQueryRow['UserId'];
				$UserName = $UserNameQueryRow['UserName'];
				$UserMailId = $UserNameQueryRow['UserMailId'];
				$UserPhoneNo = $UserNameQueryRow['UserPhoneNo'];
				$UserCity = $UserNameQueryRow['UserCity'];
				$UserPerAddress = $UserNameQueryRow['UserPeramanentAddress'];
				$UserShipAddress = $UserNameQueryRow['UserShippingAddress'];
			}
			echo "Welcome $UserName !!";
			echo "\t\tClick here to <a href='/MangoCart/MangoProduct/DisplayProduct.php'>Go to HomePage</a> / <a href='/MangoCart/User/ViewProfile.php'>View Profile</a> / <a href='/MangoCart/SignOut.php'>Sign Out</a>";
		}
		else
		{
			echo "User Not Found... Click here to SignOut and Login Again<a href='/MangoCart/SignOut.php'>SignOut</a>";
		}
	}
}
else
{
	header("location: /MangoCart/Login.php");
}
?>