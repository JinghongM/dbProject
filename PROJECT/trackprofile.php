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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--     <link rel="stylesheet" type="text/css" href="./css/test.css">
 --><style>
    .checked {
    color: orange;
      }
  #contactForm { 
  display: none;

  border: 6px solid salmon; 
  padding: 2em;
  width: 400px;
  text-align: center;
  background: #fff;
  position: fixed;
  top:50%;
  left:50%;
  transform: translate(-50%,-50%);
  -webkit-transform: translate(-50%,-50%)
  
}
#addToPlayListFrom { 
  display: none;

  border: 6px solid salmon; 
  padding: 2em;
  width: 400px;
  text-align: center;
  background: #fff;
  position: fixed;
  top:50%;
  left:50%;
  transform: translate(-50%,-50%);
  -webkit-transform: translate(-50%,-50%)
  
}
</style>
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
          echo '<input type="hidden" name="user" value="'.$Username.'">';
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
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                          $rating="";
                            if(isset($_POST['5']))
                            {
                              $rating=5;
                            }
                            if(isset($_POST['4']))
                            {
                              $rating=4;
                            }
                            if(isset($_POST['3']))
                            {
                              $rating=3;
                            }
                            if(isset($_POST['2']))
                            {
                              $rating=2;
                            }
                            if(isset($_POST['1']))
                            {
                              $rating=1;
                            }
                          $trackID=$_GET["track"];
                          if($rating!="")
                          {
                            $sql00="INSERT INTO `rates` (`username`, `trackid`, `timestamp`, `rating`) VALUES ('$Username', '$trackID', CURRENT_TIME(), '$rating')";
                            $result00=mysqli_query($dbConnected,$sql00);
                            if($result00)
                            {
                              echo '<script type="text/javascript">
                              alert("Rating Success!");
                              </script>';
                            }

                          }
                          $addList="";
                          if(isset($_POST["addList"]))
                          {
                          	$addList=$_POST["addList"];
							$sql000="INSERT INTO `playlisttrack` (`playlistid`, `trackid`, `order`) VALUES ((SELECT playlist.playlistID from playlist WHERE playlist.ptitle='$addList'), '$trackID', CURRENT_DATE())";
                            $result000=mysqli_query($dbConnected,$sql000);
                            if($result000){
							 echo '<script type="text/javascript">
                              alert("Add Success!");
                              </script>';
                            }
                            else
                            {
							echo '<script type="text/javascript">
                              alert("The track has already in your playlist '.$addList.'!");
                              </script>';
                            }
	                      }
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
                          echo "Rating: ";

                          if($rating=="")
                            {
                              $rating = 0;
                            }
                          else
                          {
                            $rating = intval($rating);
                          }
                          for($i=0;$i<$rating;$i++)
                          {
                            echo '<span class="fa fa-star checked"></span>';

                          }
                          for($i=0;$i<5-$rating;$i++)
                          {
                            echo '<span class="fa fa-star "></span>';

                          }
                          ?></h4>
                          <h4 class="white"><i class="fa fa-check-circle-o"></i>
							<button type="button" class="btn btn-success" id="addToPlayList">Add to My Playlist</button>
							<script type="text/javascript">
								$(function() {
								  // contact form animations
								  $('#addToPlayList').click(function() {
								    $('#addToPlayListFrom').fadeToggle();
								  })
								  $(document).mouseup(function (e) {
								    var container = $("#addToPlayListFrom");

								    if (!container.is(e.target) // if the target of the click isn't the container...
								        && container.has(e.target).length === 0) // ... nor a descendant of the container
								    {
								        container.fadeOut();
								    }
								  });
								  
								});
							</script>                        
                          </h4>
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
            var i ="";
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
            if(i=="SUCCESS")
            { 
            	var opened = window.open("https://open.spotify.com/embed?uri=spotify:user:spotify:playlist:3rgsDhGHZxZ9sB9DQWQfuf");

            	 

              $('#contactForm').fadeToggle();
              };
            } ;

    $(document).mouseup(function (e) {
    var container = $("#contactForm");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.fadeOut();
    }
  });

</script>
<div id="contactForm">
<?php
  $Username = $_GET["user"];
  $trackID=$_GET["track"];

  echo '<form action="./trackprofile.php?user='.$Username.'&track='.$trackID.'" method="post">';
?>
<form action="./trackprofile.php" method="post">

  <h3>How would you like to rate the track?</h3>
  <p>
    <input class="btn btn-outline-primary my-2 my-sm-0" name="5" type="submit" value="Perfect">
  </p>
  <p>
    <input class="btn btn-outline-secondary my-2 my-sm-0" name="4" type="submit" value="Awesome">
  </p>
  <p>
    <input class="btn btn-outline-success my-2 my-sm-0" name="3" type="submit" value="Good">
  </p>
  <p>
    <input class="btn btn-outline-info my-2 my-sm-0" name="2" type="submit" value="Not Bad">
  </p>
  <p>
    <input class="btn btn-outline-warning my-2 my-sm-0" name="1" type="submit" value="Bad">
    </p>
  </form>
</div>
<div id="addToPlayListFrom">
<?php
  $Username = $_GET["user"];
  $trackID=$_GET["track"];

  echo '<form action="./trackprofile.php?user='.$Username.'&track='.$trackID.'" method="post">';
  ?>

  <h3>Which playlist would you like to add?</h3>
  <?php
  $sql4="SELECT * FROM playlist where Username='$Username'";
  $result4=mysqli_query($dbConnected,$sql4);
	while($row=mysqli_fetch_array($result4))
	{
			echo '<p><input class="btn btn-outline-primary my-2 my-sm-0" name="addList" type="submit" value="'.$row["ptitle"].'"></p>';
	}
	?>
  </form>
</div>
<!-- Popup Div Ends Here -->
  </body>
  </html>
