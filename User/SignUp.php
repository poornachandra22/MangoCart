<?php
$dbconn = mysqli_connect('localhost','root','12345678');
mysqli_select_db($dbconn,'mangocart');
session_start();
if ( isset($_SESSION['login_user']) )
{
	echo "User logged in Already..";
	echo "<br><br>Click here to <a href='/MangoCart/MangoProduct/DisplayProduct.php'>Go to Homepage</a> / <a href='/MangoCart/SignOut.php'>Sign Out</a>";
}
else
{
	?>
		<html>
		<head><title>SignUp Page</title></head>
		<body>
		<form action="" method="POST">
		<h1>SignUp Form</h1>
		<label> Enter your Name : <br>
		<input type="text" name="UserName" required />
		</label><br><br>
		<label> Enter your Mail Id : <br>
		<input type="email" name="UserMailId" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
		<br><i>Must be in the format acb@abc.ab</i> 
		</label><br><br>
		<label> Enter your Phone Number : <br>
		<input type="tel" name="UserPhoneNo" minlength="10" maxlength="10" pattern="\d{10}" required />
		</label><br><br>
		<label> Enter your City : <br>
		<input type="text" name="UserCity" required />
		</label><br><br>
		<label> Enter your Address : <br>
		<textarea name="UserPeramanentAddress" cols="25" rows="4" required ></textarea>
		</label><br><br>
		<label> Enter your Shipping Address : <br>
		<textarea name="UserShippingAddress" cols="25" rows="4" required ></textarea>
		</label><br><br>
		<label> Enter your Password :<br>
		<input type="text" name="UserPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" maxlength="12" required />
		<br><i>Must contain 8 to 12 characters including a number, an uppercase and a lowercase letter.</i> 
		</label><br><br>
		<label> Confirm your Password : <br>
		<input type="text" name="UserConfirmPassword" maxlength="12" required />
		</label><br><br>
		<input type="submit" name="AddUser" value="Submit"/><br/><br/>
		Already a User?? <a href='/MangoCart/Login.php'>Login</a>
		</form></body></html>
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$Name = $_POST['UserName'];
		$MailId = $_POST['UserMailId'];
		$PhoneNo = $_POST['UserPhoneNo'];
		$City = $_POST['UserCity'];
		$PeramanentAddress = $_POST['UserPeramanentAddress'];
		$ShippingAddress = $_POST['UserShippingAddress'];
		$Password = $_POST['UserPassword'];
		$ConfirmPassword = $_POST['UserConfirmPassword'];
		
		if($Password == $ConfirmPassword)
		{
			$UniqueMailIdQuery=mysqli_query($dbconn,"select * from user where UserMailId='$MailId'");
			if(mysqli_num_rows($UniqueMailIdQuery)>0)
			{
				echo "Mail Id already registered.. ";
			}
			$result=mysqli_query($dbconn, "insert into user (UserName,UserMailId,UserPhoneNo,UserCity,UserPeramanentAddress,UserShippingAddress,UserPassword) values ('$Name','$MailId','$PhoneNo','$City','$PeramanentAddress','$ShippingAddress','$Password')");
			if($result)
			{
				echo "User Registered";
				header("location: /MangoCart/Login.php");
			}
			else
			{
				echo "Couldn't register user!!";
			}
		}
		else
		{
			echo "Entered passwords does not match";
		}
	}
}
?>