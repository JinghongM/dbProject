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

                            echo $_GET["artist"];
                            $checkName = $_GET["artist"];                          

                          ?>
                        </h3>
                        <h4 class="white"><i class="fa fa-check-circle-o"></i>

                          <?php
                          include "databases.php";
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                          $sql1 = "SELECT description
                                  From artist
                                  WHERE aname = '$checkName'";
                          $result1=mysqli_query($dbConnected,$sql1);
                          while($row=mysqli_fetch_array($result1)){
                            $description = $row["description"];
                            echo $description;
                          }
                          ?></h4>
                    </div>
                </div>
                <div class="col-md-6 no-pad">
                    <div class="user-image">
                        <img src="./images/musician.jpg" class="img-responsive thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <div class="row overview">
                
                <div class="col-md-3 user-pad text-center">
                    <h3>Track</h3>
                    <h4>
                      <?php
                      $sql2 = "SELECT count(*) as count
                                  From track,artist
                                  WHERE artist.aname = '$checkName' and artist.artistID=track.artistID";
                          $result2=mysqli_query($dbConnected,$sql2);
                          $trackNumber = 0;
                          while($row=mysqli_fetch_array($result2)){
                            $trackNumber=$row["count"];
                            
                          }
                          echo $trackNumber;

                    ?>
                    </h4>
                </div>
                <div class="col-md-3 user-pad text-center">
                    <h3>Liked</h3>
                    <h4>
                      <?php
                      $sql3 = "SELECT count(*) as count
                                  From likes,artist
                                  WHERE artist.aname = '$checkName' and likes.artistID=artist.artistID";
                          $result3=mysqli_query($dbConnected,$sql3);
                          $likedNumber = 0;
                          while($row=mysqli_fetch_array($result3)){
                            $likedNumber=$row["count"];
                            
                          }
                          echo $likedNumber;

                    ?>
                      
                    </h4>
                </div>
                

                
            </div>
      </div>
</div>
</main>
</body>
</html>