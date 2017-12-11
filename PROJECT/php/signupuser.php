<!doctype html>
<html lang="en">
  <head>
  </head>
  <body>
<?php 

include "../databases.php";

// Craete connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])){
	$EMAIL ="";
	if(isset($_POST['email']))
	{$EMAIL = $_POST["email"];}
	$REALNAME = "";
	if(isset($_POST['name']))
	{$REALNAME = $_POST["name"];}
	$CITY = "";
	if(isset($_POST['city']))
	{$CITY= $_POST["city"];}
	
	if(isset($_POST['username']))
	{$USERNAME= $_POST["username"];}
	
	$PASSWORD = $_POST["password"];
	$user = $_POST["username"];
	if (preg_match('/[\'^£$%.&*()}{@#~?><>,|=_+¬-]/', $REALNAME) or preg_match('/[\'^£$%&.*()}{@#~?><>,|=_+¬-]/', $USERNAME) or preg_match('/[\'^£$%.&*()}{@#~?><>,|=_+¬-]/', $CITY)or preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/', $EMAIL)or preg_match('/[\'^£$%&*()}{@#~?><>,|=_+.¬-]/', $PASSWORD))
	{
		$issue = 1;
		echo "<script type='text/javascript'> 
		       window.location.href='../login.php?issue=$issue '
		      </script>";
	}
	$sql1= "INSERT INTO `user`(`Username`, `Password`, `uname`, `email`, `city`) VALUES ('".$USERNAME."','".password_hash($PASSWORD,PASSWORD_DEFAULT)."','".$REALNAME."','".$EMAIL."','".$CITY."')";
	$result1 = $conn->query($sql1);
	
	if($result1)
	{
	echo "<script type='text/javascript'> 
		           window.location.href='../welcome.php?user=$USERNAME'
		      	  </script>";

	}
	else
	{
	echo "<script type='text/javascript'> 
		           window.location.href='../login.php?issue=2 '
		      	  </script>";
	}
}
else
{
	echo "???";
}


?>
  </body>
</html>


