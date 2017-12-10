<!DOCTYPE html>
<html lang="en">
    <head> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Website CSS style -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signup2.css" rel="stylesheet">
    <!-- Website Font style -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <title>Update Profiles</title>
  </head>
  <body>
  	<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
    <link href="./css/profile.css" rel="stylesheet" media="screen">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profile.css">
    <script src="./jquery/jquery.min.js"></script> 


</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
     <?php
        $Username = $_GET["user"];
        echo '<a class="navbar-brand" href="./welcome.php?user='.$Username.'">Spotify</a>';
      ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="./profile.php?user='.$Username.'">Profiles<span class="sr-only">(current)</span></a>';

             ?>
             
<!--             <a class="nav-link" href="profile.php">Profiles<span class="sr-only">(current)</span></a>
 -->       </li>
          <li class="nav-item active">
                        <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="./following.php?user='.$Username.'">Following<span class="sr-only">(current)</span></a>';

             ?>
             <!-- 
            <a class="nav-link" href="Follows.html">Following<span class="sr-only">(current)</span></a> -->
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="./followee.php?user='.$Username.'">Follower<span class="sr-only">(current)</span></a>';

             ?>
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="./likes.php?user='.$Username.'">Artists<span class="sr-only">(current)</span></a>';

             ?>
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="./playlist.php?user='.$Username.'">Playlists<span class="sr-only">(current)</span></a>';

             ?>
          </li>
      </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <div class="container">
      <div class="row main">
        <div class="main-login main-center">
        <h5>Profile Edit.</h5>
        <script type="text/javascript">
          function checkForm() {
    if (document.getElementById("password").value != document.getElementById("confirm").value)

    {
        alert('Those password don\'t match!');
        return false;
    }
    else{
    return true;
}
}
        </script> 
        <?php
			include "databases.php";
			if(isset($_GET["user"]))
			{
				$Username=$_GET["user"];
                $conn = new mysqli($servername, $username, $password, $dbname);
                          // Check connection
                if ($conn->connect_error) 
                {
					die("Connection failed: " . $conn->connect_error);
                }
                          
                $sql1 = "SELECT *
						From user
						WHERE Username = '$Username'";
				$result1 = $conn->query($sql1);
				$USERNAME="";
				$PASSWORD="";
				$REALNAME="";
				$EMAIL="";
				$CITY="";

				while($row=mysqli_fetch_array($result1))
				{
					$USERNAME=$row["Username"];
					$PASSWORD=$row["Password"];
					$REALNAME=$row["uname"];
					$EMAIL=$row["email"];
					$CITY=$row["city"];
				}
            }

        ?>
          <form class="form_class" id="form" action="./php/updateUser.php" method="post"  onsubmit="return checkForm()">
            <div class="form-group">
              <label for="name" class="cols-sm-2 control-label">Your Real Name</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="name" id="name"  placeholder="<?php echo $REALNAME;?>"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="cols-sm-2 control-label">Your Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="email" id="email"  placeholder="<?php echo $EMAIL;?>"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="cols-sm-2 control-label">Your City</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="city" id="city"  placeholder="<?php echo $CITY;?>"/>
                </div>
              </div>
            </div>

			<div class="form-group">
              <label for="password" class="cols-sm-2 control-label">New Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" >
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="confirm" class="cols-sm-2 control-label">Confirm New Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="confirm" id="confirm" placeholder="Confirm your Password" >
				  <input type="hidden" class="form-control" name="userName" value="<?php echo $USERNAME;?>">

                   </div>
              </div>
          </div>
            <div class="form-group ">
              <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Update">
            </div>

          </form>

            
        </div>
      </div>
    </div>

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        
  </body>
</html>