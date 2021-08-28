<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/MangoCart/hsvj.php";
include_once($path);

if( isset($_SESSION['login_user']) )
{
	if($_SESSION['login_user'] == "admin")
	{
		echo "<br><br>This feature for users only";
	}	
	else
	{
		$UserQuery = mysqli_query($dbconn," select * from user where UserMailId='$UserMailId' ");
		if(mysqli_num_rows($UserQuery)>=1)
		{
			echo '<h1>User Profile</h1>';
			echo '<table border="1px"> <tr> <th>User Details</th> </tr>';
			while( $UserQueryRow = mysqli_fetch_array($UserQuery) )
			{
				echo '<tr> <td>User Name</td> <td> '.$UserQueryRow['UserName'].' </td> </tr>
				<tr> <td>User Mail Id</td> <td> '.$UserQueryRow['UserMailId'].' </td> </tr>
				<tr> <td>User Phone No</td> <td> '.$UserQueryRow['UserPhoneNo'].' </td> </tr>
				<tr> <td>User City</td> <td> '.$UserQueryRow['UserCity'].' </td> </tr>
				<tr> <td>User Peramanent Address</td> <td> '.$UserQueryRow['UserPeramanentAddress'].' </td> </tr>
				<tr> <td>User Shipping Address</td> <td> '.$UserQueryRow['UserShippingAddress'].' </td> </tr>';
				echo "<tr> <th> <a href='UpdateProfile.php'>Update Profile</a> </th> <th> <a href='DeleteProfile.php'>Delete Profile</a> </th> </tr>";
			}
			echo "</table>";
		}
		else
		{
			echo "<br><br>User Not Found";
		}
	}
}