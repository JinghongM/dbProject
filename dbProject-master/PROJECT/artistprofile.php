<!DOCTYPE html>
<html>
<head>
  <title>Artist Profile</title>
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
                          include "databases.php";
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                            $checkName = $_GET["artist"];
                            /*INSERTTTTTTTTTTTTTTTTTTT*/                      
                            if(isset($_POST['likeArtist']))
                            {
		                          $sql0 = "INSERT INTO `likes` (`username`, `artistID`, `timestamp`) VALUES ('".$_GET['user']."','".$_GET['artist']."'".",CURRENT_TIME())";
                          		  $result0=mysqli_query($dbConnected,$sql0);
                          		  if($result0)
                          		  {
                          		  	echo '<script type="text/javascript">
                              			alert("Like Success!");
                              			</script>';
                          		  }
                          		  else
                          		  {
                          		  	echo '<script type="text/javascript">
                              			alert("This artist has already in your like list!");
                              			</script>';
                          		  }

                            }
                                                        /*INSERTTTTTTTTTTTTTTTTTTT*/                      

                          ?>
                        </h3>
                        <h4 class="white">
                        	<i class="fa fa-check-circle-o"></i>

                          <?php
                          include "databases.php";
                          $dbConnected = @mysqli_connect($servername,$username,$password);
                          $dbSelected = @mysqli_select_db($dbConnected,$dbname);
                          $sql1 = "SELECT aname,description
                                  From artist
                                  WHERE artistID = '$checkName'";
                          $result1=mysqli_query($dbConnected,$sql1);
                          while($row=mysqli_fetch_array($result1)){
                          	$artist = $row["aname"];
                            $description = $row["description"];
                            echo '<div><h3>'.$artist.'</h3></div>';
                            echo '<div><h3>'.$description.'</h3></div>';
                          }
                          ?>	
                          <!-- 																	BUTTON!!!											 -->
                      </h4>
                         <h4 class="white"><i class="fa fa-check-circle-o"></i>
                         	<?php
                         	echo '<form action="./artistprofile.php?user='.$Username.'&artist='.$checkName.'" method="post">
                         		<input type="hidden" name="likeArtist" value="'.$checkName.'">';
                         		?>
                         		<button type="submit" class="btn btn-success" id="addToLike">Like</button>
                         	</form>
							</h4>
                          <!-- 																	BUTTON!!!											 -->

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
                      echo '<a href="./myplaylist.php?user='.$Username.'&artist='.$_GET["artist"].'">';
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
                    </a>
                    </h4>
                </div>
                <div class="col-md-3 user-pad text-center">
                    <h3>Follower</h3>
                    <h4>
                      <?php
                      echo '<a href="./likeuser.php?user='.$Username.'&artist='.$_GET["artist"].'">';
                      $sql3 = "SELECT count(*) as count
                                  From likes
                                  WHERE likes.artistID = '".$_GET['artist']."'";
                          $result3=mysqli_query($dbConnected,$sql3);
                          $likedNumber = 0;
                          while($row=mysqli_fetch_array($result3)){
                            $likedNumber=$row["count"];
                            
                          }
                          echo $likedNumber;
                    ?>
                    </a>  
                    </h4>
                </div>
                

                
            </div>
      </div>
</div>
</main>
</body>
</html>