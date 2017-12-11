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
	$USERNAME = $_POST["userName"];
	if(trim($_POST['name'])!="")
	{
		$REALNAME = $_POST['name'];
		$sqlForRealName = "UPDATE `user` SET `uname`='$REALNAME' WHERE username='$USERNAME'";
		$resultForRealName = $conn->query($sqlForRealName);

	}

	if(trim($_POST['email'])!="")
	{
		$EMAIL = $_POST["email"];
		$sqlForEmail = "UPDATE `user` SET `email`='$EMAIL' WHERE username='$USERNAME'";
		$resultForEmail = $conn->query($sqlForEmail);

	}

	if(trim($_POST['city'])!="")
	{
		$CITY = $_POST["city"];
		$sqlForCity = "UPDATE `user` SET `city`='$CITY' WHERE username='$USERNAME'";
		$resultForCity = $conn->query($sqlForCity);
	}

	if(trim($_POST['password'])!="")
	{
		$PASSWORD = $_POST["password"];
		$sqlForPass = "UPDATE `user` SET `password`='$PASSWORD' WHERE username='$USERNAME'";
		$resultForPass = $conn->query($sqlForPass);
	}
	echo "<script type='text/javascript'> window.location.href='../profile.php?user=$USERNAME'</script>";
}



?>
  </body>
</html>


