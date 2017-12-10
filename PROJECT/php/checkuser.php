<!doctype html>
<html lang="en">
  <head>
    <title>Spotify Sign up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="css/signup.css">
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

	$Username = $_POST["username"];
	$Password = $_POST["password"];
    $sql1 = "SELECT Username, Password
	         From user
	         WHERE Username = '$Username'";
	$result1 = $conn->query($sql1);
	if($result1->num_rows ==0)
	{
		$issue = 1;
		echo "<script type='text/javascript'> 
		       window.location.href='../login.php?issue=$issue '
		      </script>";

	}
	else
	{
		while($row = mysqli_fetch_array($result1))
		{
			if(password_verify($Password, $row["Password"]))
			{
				echo "<script type='text/javascript'> 
		           window.location.href='../welcome.php?user=$Username'
		      	  </script>";
			}
			else
			{

			$issue = 1;
			echo "<script type='text/javascript'> 
		           window.location.href='../login.php?issue=$issue '
		      	  </script>";
			}
		}
		/*$result2 = $conn->query($sql2);
		if($result2->num_rows ==0)
		{
			$issue = 1;
			echo "<script type='text/javascript'> 
		           window.location.href='../login.php?issue=$issue '
		      	  </script>";
		}
		else
		{
			echo "<script type='text/javascript'> 
		           window.location.href='../welcome.php?user=$Username'
		      	  </script>";

		}*/

	}
} /*else {echo "no";}*/
?>
  </body>
</html>


