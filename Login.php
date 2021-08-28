<?php
$dbconn = mysqli_connect('localhost','root','12345678');
mysqli_select_db($dbconn,'mangocart');
session_start();
if ( isset($_SESSION['login_user']) )
{
	echo "Already logged in..";
	echo "<br>Click here to <a href='/MangoCart/MangoProduct/DisplayProduct.php'>Go to Homepage</a> / <a href='/MangoCart/SignOut.php'>Sign Out</a>";
}
else
{
	?>
		<html>
		<head><title>Login Page</title></head>
		<form action="" method = "post">
		<h1>Login Form</h1>
		<i>Login here to access the system</i><br><br>
		Enter MailId: <input type="text" name="mailid" required /><br/><br/>
		Enter Password: <input type="password" name="password" required /><br/><br/>
		<input type="submit" value = "Login"/><br/><br/>
		New here?? <a href='/MangoCart/User/SignUp.php'>SignUp</a>
		</form></body></html>
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$myusername = mysqli_real_escape_string($dbconn,$_POST['mailid']);
		$mypassword = mysqli_real_escape_string($dbconn,$_POST['password']);
		if($myusername=="admin" && $mypassword=="admin")
		{
			$_SESSION['login_user'] = "admin";
			header("location: /MangoCart/MangoProduct/DisplayProduct.php");
		}
		$result = mysqli_query($dbconn,"SELECT UserId FROM user WHERE UserMailId = '$myusername' and UserPassword = '$mypassword'");
		$count = mysqli_num_rows($result);
		//If result matched $myusername and $mypassword, table row must be 1 row
		if($count == 1)
		{
			$_SESSION['login_user'] = $myusername;
			header("location: /MangoCart/MangoProduct/DisplayProduct.php");
		}
		else
		{
			echo "Credentials doesnt exist";
		}
	}
}
?>