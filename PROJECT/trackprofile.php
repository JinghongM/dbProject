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
             echo '<a class="nav-link" style="color:blue;" href="profile.php?user='.$Username.'">Profiles<span class="sr-only">(current)</span></a>';

             ?>
             
<!--             <a class="nav-link" href="profile.php">Profiles<span class="sr-only">(current)</span></a>
 -->       </li>
          <li class="nav-item active">
                        <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" style="color:red;" href="following.php?user='.$Username.'">Following<span class="sr-only">(current)</span></a>';

             ?>
             <!-- 
            <a class="nav-link" href="Follows.html">Following<span class="sr-only">(current)</span></a> -->
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" style="color:green;" href="followee.php?user='.$Username.'">Follower<span class="sr-only">(current)</span></a>';

             ?>
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" style="color:yellow;" href="likes.php?user='.$Username.'">Likes<span class="sr-only">(current)</span></a>';

             ?>
          </li>
          <li class="nav-item active">
            <?php
             $Username = $_GET["user"];
             echo '<a class="nav-link" style="color:grey;" href="playlist.php?user='.$Username.'">Playlists<span class="sr-only">(current)</span></a>';

             ?>
          </li>
      </ul>

      <form class="form-inline my-2 my-lg-0" action="./search.php" method="get">';
          <?php
          echo '<input type="hidden" name=user value='.$Username.'>';
          ?>
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="searchKey" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
<div style="background:transparent" class="jumbotron">

<div class="container">
          <div class="row user-menu-container square">
          <div class="row coralbg white">
                <div class="col-md-6 no-pad">
                    <div class="user-pad">
                        <h3> 
                          <?php
                          include "databases.php";
                          $trackID=$_GET["track"];
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                          $sql0 = "SELECT ttitle
                                  From track
                                  WHERE trackID = '$trackID'";
                          $ttitle="";
                          $result0=mysqli_query($dbConnected,$sql0);
                          while($row=mysqli_fetch_array($result0)){
                            $ttitle=$row["ttitle"];
                            
                          }
                          echo $ttitle;

                          ?>
                        </h3>
                        <h4 class="white"><i class="fa fa-check-circle-o"></i>

                          <?php
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                          $sql1 = "SELECT Genre
                                  From track
                                  WHERE trackID = '$trackID'";
                          $genre="";
                          $result1=mysqli_query($dbConnected,$sql1);
                          while($row=mysqli_fetch_array($result1)){
                            $genre=$row["Genre"];
                            
                          }

                          if($genre=="")
                            {
                              echo "Genre:";
                            }
                          else
                          {
                            echo "Genre: ".$genre;
                          }
                          
                          
                          ?></h4>
                        <h4 class="white"><i class="fa fa-check-circle-o"></i>

                          <?php
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                          $sql2 = "SELECT artist.aname
                                  From artist,track
                                  WHERE artist.artistID =track.artistID and track.trackID='$trackID'";
                          $artist="";
                          $result2=mysqli_query($dbConnected,$sql2);
                          while($row=mysqli_fetch_array($result2)){
                            $artist=$row["aname"];
                            
                          }

                          if($artist=="")
                            {
                              echo "artist:";
                            }
                          else
                          {
                            echo "artist: ".$artist;
                          }
                          
                          ?></h4>
                          <h4 class="white"><i class="fa fa-check-circle-o"></i>

                          <?php
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                          $sql3 = "SELECT avg(rating) as point
                                  From rates
                                  WHERE rates.trackID='$trackID'";
                          $rating="";
                          $result3=mysqli_query($dbConnected,$sql3);
                          while($row=mysqli_fetch_array($result3)){
                            $rating=$row["point"];
                            
                          }

                          if($rating=="")
                            {
                              echo "Rating: 0";
                            }
                          else
                          {
                            echo "Rating: ".$rating;
                          }
                          
                          ?></h4>
                    </div>
                </div>
                <div class="col-md-6 no-pad">
                    <div class="user-image">
                        <span style="cursor:pointer"><img src="./images/music.jpg" style="height: 300px;" class="img-responsive thumbnail" onclick="playTrack()"></span>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
          function playTrack()
            {
            var i = " fdsa";
            i = '<?php 
            $TRACKID='"'.$_GET["track"].'"';
            $USER='"'.$_GET["user"].'"';
            $sql3="INSERT INTO `plays` (`username`, `trackid`, `timestamp`) VALUES (".$USER.", ".$TRACKID.", CURRENT_TIME())";
            $result3=mysqli_query($dbConnected,$sql3);
            if($result3)
            {
              echo "SUCCESS";
            }
            else
            {
              echo "FALSE";
            }
             ?>';
            alert( i );
            }

</script>
  </body>
  </html>
