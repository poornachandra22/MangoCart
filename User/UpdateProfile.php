<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if ( isset($_SESSION['login_user']) )
{
	if ($_SESSION['login_user'] == "admin")
	{
		echo "<br><br>This feature for users only";
	}
	else
	{
		?>
			<html>
			<head><title>Update Profile</title></head>
			<body>
			<form  method="GET" action="">
			<h1>Update Profile</h1>
			<input type="hidden" name="UserId" value=<?php echo $UserId; ?> >
			Enter Name:<br><br>
			<input type="text" name="UserUpdatedName" <?php echo (isset($UserName)) ? ('value = "'.$UserName.'"') : "value= \"\""; ?> ><br><br>
			MailId:<br><br>
			<input type="text" name="UserMailId" value=<?php echo $UserMailId ?> readonly><br><br>
			Enter Phone Number:<br><br>
			<input type="tel" name="UserUpdatedPhoneNumber" minlength="10" maxlength="10" pattern="\d{10}" value=<?php echo $UserPhoneNo ?> ><br><br>
			Enter City:<br><br>
			<input type="text" name="UserUpdatedCity" <?php echo (isset($UserCity)) ? ('value = "'.$UserCity.'"') : "value= \"\""; ?> ><br><br>
			Enter Peramanent Address:<br><br>
			<textarea name="UserUpdatedPerAddress" cols="25" rows="4" required><?php echo (isset($UserPerAddress)) ? (''.$UserPerAddress.'') : "value= \"\""; ?></textarea><br><br>
			Enter Shipping Address:<br><br>
			<textarea name="UserUpdatedShipAddress" cols="25" rows="4" required><?php echo (isset($UserPerAddress)) ? (''.$UserShipAddress.'') : "value= \"\""; ?></textarea><br><br>
			<a href="/MangoCart/User/ViewProfile.php">Cancel</a>
			<input type="submit" name="UpdateProfile" value="Update">
			</form></body></html>
		<?php
		if ( isset($_GET['UpdateProfile']))
		{
			$UserUpdatedName = $_GET['UserUpdatedName'];
			$UserUpdatedPhoneNumber = $_GET['UserUpdatedPhoneNumber'];
			$UserUpdatedCity = $_GET['UserUpdatedCity'];
			$UserUpdatedPerAddress = $_GET['UserUpdatedPerAddress'];
			$UserUpdatedShipAddress = $_GET['UserUpdatedShipAddress'];
			$result = mysqli_query($dbconn, "update user set UserName='$UserUpdatedName', UserPhoneNo='$UserUpdatedPhoneNumber', UserCity='$UserUpdatedCity', UserPeramanentAddress='$UserUpdatedPerAddress', UserShippingAddress='$UserUpdatedShipAddress' where UserMailId='$UserMailId' ");
			if($result)
			{
				echo "<br>Profile Updated!!";
			}
			else
			{
				echo "<br>Could not Update!!";
			}
		}
	}
}