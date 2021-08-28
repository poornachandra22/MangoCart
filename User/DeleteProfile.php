<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if ( isset ($_SESSION['login_user']) )
{
	if ($_SESSION['login_user'] == "admin")
	{
		echo "<br><br>This feature for users only";
	}
	else
	{
		?>
			<html>
			<head><title>Delete Account</title></head>
			<body>
			<h2>Are you sure you want to delete account ??</h2>
			<b>This will..</b><br>Revoke your access to the application<br>Cancel all your orders<br>Delete your account peramanently.
			<br><br>You will have to SignUp again to access the application.
			<form method="GET" action="">
			<br><a href="/MangoCart/User/ViewProfile.php">Cancel</a>
			<input type="submit" name="DeleteProfile" value="YES, DELETE"/>
			</form></body></html>
		<?php
		if ( isset ($_GET['DeleteProfile']) )
		{
			//Deleting User's all orders
			$DeleteOrderQuery = mysqli_query($dbconn, " delete from productorder where orderuserid='$UserId' ");
			if ( $DeleteOrderQuery )
			{
				//Deleting Profile
				$DeleteProfileQuery = mysqli_query($dbconn, " delete from user where UserId='$UserId' ");
				if ( $DeleteProfileQuery )
				{
					//Calling Sign Out to unset session and redirect to login form
					header("location: /MangoCart/SignOut.php");
				}
				else
				{
					echo "There was some problem in deleting profile";
				}
			}
			else
			{
				echo "User's orders not deleted";
			}
		}
	}
}
?>