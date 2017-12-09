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
        echo '<a class="navbar-brand" href="welcome.php?user='.$Username.'">Spotify</a>';
      ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="profile.php?user='.$Username.'">Profiles<span class="sr-only">(current)</span></a>';

             ?>
             
<!--             <a class="nav-link" href="profile.php">Profiles<span class="sr-only">(current)</span></a>
 -->       </li>
          <li class="nav-item active">
                        <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="following.php?user='.$Username.'">Following<span class="sr-only">(current)</span></a>';

             ?>
             <!-- 
            <a class="nav-link" href="Follows.html">Following<span class="sr-only">(current)</span></a> -->
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="followee.php?user='.$Username.'">Follower<span class="sr-only">(current)</span></a>';

             ?>
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="likes.php?user='.$Username.'">Artists<span class="sr-only">(current)</span></a>';

             ?>
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" href="playlist.php?user='.$Username.'">Playlists<span class="sr-only">(current)</span></a>';

             ?>
          </li>
      </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>





<main role="main">
<div style="background:transparent" class="jumbotron">
        <div class="container">
           <div class="row user-menu-container square">
          <div class="row coralbg white">
                <div class="col-md-6 no-pad">
                    <div class="user-pad">
                        <h3> 
                          <?php
                          if(isset($_GET["guest"]))
                          {
                            echo $_GET["guest"];
                            $checkName=$_GET["guest"];
                          }
                          else
                          {
                            $Username = $_GET["user"];
                            echo "Welcome back,".$Username;
                            $checkName=$_GET["user"];
                          }

                          ?>
                        </h3>
                        <h4 class="white"><i class="fa fa-check-circle-o"></i>

                          <?php
                          include "databases.php";
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                          $sql1 = "SELECT city
                                  From user
                                  WHERE Username = '$checkName'";
                          $result1=mysqli_query($dbConnected,$sql1);
                          while($row=mysqli_fetch_array($result1)){
                            $city=$row["city"];
                            
                          }

                          if($city=="")
                            {
                              echo "From:";
                            }
                          else
                          {
                            echo "From: ".$city;
                          }
                          
                          
                          ?></h4>
                        <h4 class="white"><i class="fa fa-twitter"></i>
                        <?php
                          $sql2 = "SELECT email
                                  From user
                                  WHERE Username = '$checkName'";
                          $result2=mysqli_query($dbConnected,$sql2);
                          while($row=mysqli_fetch_array($result2)){
                            $email=$row["email"];
                            
                          }

                          if($email=="")
                            {
                              echo "email:";
                            }
                          else
                          {
                            echo "email: ".$email;
                          }
                          
                          
                          ?></h4>
                          <?php
                          if(! isset($_GET["guest"]))
                          {
                            echo '<button type="button" class="btn btn-info" onclick="openWindow()">Update</button>';
                          }
            ?>
            <script type="text/javascript">
                    function openWindow() {
                        window.location.href='./updateprofile.php?user=<?php echo $Username;?>'}
                      </script>
                    </div>
                </div>
                <div class="col-md-6 no-pad">
                    <div class="user-image">
                        <img src="https://farm7.staticflickr.com/6163/6195546981_200e87ddaf_b.jpg" class="img-responsive thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <div class="row overview">
                
                <div class="col-md-3 user-pad text-center">
                    <h3>FOLLOWING</h3>
                    <h4><?php
                          if(isset($_GET["guest"]))
                          {
                            echo '<a href="./following.php?user='.$Username.'&guest='.$_GET["guest"].'">';
                          }
                          else
                          {
                            $Username = $_GET["user"];
                            echo '<a href="./following.php?user='.$Username.'">';
                          }

                      $sql3 = "SELECT count(*) as count
                                  From follows
                                  WHERE follower = '$checkName'";
                          $result3=mysqli_query($dbConnected,$sql3);
                          $followerNumber = 0;
                          while($row=mysqli_fetch_array($result3)){
                            $followerNumber=$row["count"];
                            
                          }
                          echo $followerNumber;

                    ?>
                    </a>
                    </h4>
                </div>
                <div class="col-md-3 user-pad text-center">
                    <h3>FOLLOWERS</h3>
                    <h4><?php
                    if(isset($_GET["guest"]))
                          {
                            echo '<a href="./followee.php?user='.$Username.'&guest='.$_GET["guest"].'">';
                          }
                          else
                          {
                            $Username = $_GET["user"];
                            echo '<a href="./followee.php?user='.$Username.'">';
                          }
                      $sql4 = "SELECT count(*) as count
                                  From follows
                                  WHERE followee = '$checkName'";
                          $result4=mysqli_query($dbConnected,$sql4);
                          $followeeNumber = 0;
                          while($row=mysqli_fetch_array($result4)){
                            $followeeNumber=$row["count"];
                            
                          }
                          echo $followeeNumber;

                    ?>
                      </a>
                    </h4>
                </div>
                <div class="col-md-3 user-pad text-center">
                    <h3>Likes</h3>
                    <h4><?php
                      if(isset($_GET["guest"]))
                          {
                            echo '<a href="./likes.php?user='.$Username.'&guest='.$_GET["guest"].'">';
                          }
                          else
                          {
                            $Username = $_GET["user"];
                            echo '<a href="./likes.php?user='.$Username.'">';
                          }
                      $sql5 = "SELECT count(*) as count
                                  From likes
                                  WHERE username = '$checkName'";
                          $result5=mysqli_query($dbConnected,$sql5);
                          $likeNumber = 0;
                          while($row=mysqli_fetch_array($result5)){
                            $likeNumber=$row["count"];
                            
                          }
                          echo $likeNumber;

                    ?>
                  </a>
                    </h4>
                </div>

                <div class="col-md-3 user-pad text-center">
                    <h3>Play List</h3>
                    <h4><?php
                      if(isset($_GET["guest"]))
                          {
                            echo '<a href="./playlist.php?user='.$Username.'&guest='.$_GET["guest"].'">';
                          }
                          else
                          {
                            $Username = $_GET["user"];
                            echo '<a href="./playlist.php?user='.$Username.'">';
                          }
                      $sql6 = "SELECT count(*) as count
                                  From playlist
                                  WHERE username = '$checkName'";
                          $result6=mysqli_query($dbConnected,$sql6);
                          $playlistNumber = 0;
                          while($row=mysqli_fetch_array($result6)){
                            $playlistNumber=$row["count"];
                            
                          }
                          echo $playlistNumber;

                    ?>
                    </h4>
                </div>
            </div>
      </div>
</div>
</main>
</body>
</html>