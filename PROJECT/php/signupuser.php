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

	$sql1= "INSERT INTO `user`(`Username`, `Password`, `uname`, `email`, `city`) VALUES ('".$USERNAME."','".$PASSWORD."','".$REALNAME."','".$EMAIL."','".$CITY."')";
	$result1 = $conn->query($sql1);
	if($result1)
	{
	echo "<script type='text/javascript'> 
		           window.location.href='/PROJECT/welcome.php?user=$Username'
		      	  </script>";

	}
	else
	{
	echo "<script type='text/javascript'> 
		           window.location.href='/PROJECT/login.php?issue=2 '
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


