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
    <script src="./jquery/jquery.min.js"></script> 
    <style type="text/css">
		.overflow{
      overflow:hidden;
      height: 200px;
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
          echo '<input type="hidden" name=user value='.$Username.'>';
          ?>
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="searchKey" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>


    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div style="background:transparent" class="jumbotron">
        <div class="container">
          <h3>Hello!
          <?php
             $Username = $_GET["user"];
             echo $Username;
             ?></h3>
          <p><div class="container">
              <div class="row">
                <div class="col-sm-4">Your following</div>
                <div class="col-sm-4">Your followers</div>
                <div class="col-sm-4">Your likes</div>

                </div>
                
              </div>
               <div class="row">
                <div class="col-sm-4">
                  <button type="button" id="following" class="btn btn-primary">
                        <?php 

                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "spotify";

                        // Craete connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                         $sql1 = "SELECT count(*) as num
                                  FROM follows
                                  WHERE follower = '$Username'";
                         $result1 = $conn->query($sql1);
                        while($row=mysqli_fetch_array($result1))
                        {
                             $cid=$row["num"];
                        }
                        echo $cid;
                        ?>
                      </button>
                      <script>
                        $("#following").hover(function()
                        {
                        $("#hidden-following").show();
                        },function()
                        {
                        $("#hidden-following").hide();

                        }
                        )
                        $("#following").click(function()
                        {
                          var val = "<?php echo $Username ?>";
                          window.location = "./following.php?user=" + val;
                        })
                      </script>
                </div>
                  <div class="col-sm-4">
                    <button type="button" id="followee" class="btn btn-success">
                  <?php 

                         $sql1 = "SELECT count(*) as num
                                  FROM follows
                                  WHERE followee = '$Username'";
                         $result1 = $conn->query($sql1);
                        while($row=mysqli_fetch_array($result1))
                        {
                             $cid=$row["num"];
                        }
                        echo $cid;
                        ?>
                      </button>
                      <script>
                        $("#followee").hover(function()
                        {
                        $("#hidden-followee").show();
                        },function()
                        {
                        $("#hidden-followee").hide();
                        }
                        )
                        $("#followee").click(function()
                        {
                          var val = "<?php echo $Username ?>";
                          window.location = "./followee.php?user=" + val;
                        })
                      </script>
                    </div>
                  <div class="col-sm-4">
                    <button type="button" id="likes"  class="btn btn-info">
                    <?php 

                         $sql1 = "SELECT count(*) as num
                                  FROM likes
                                  WHERE Username = '$Username'";
                         $result1 = $conn->query($sql1);
                        while($row=mysqli_fetch_array($result1))
                        {
                             $cid=$row["num"];
                        }
                        echo $cid;
                        ?>
                      </button>
                      <script>
                        $("#likes").hover(function()
                        {
                        $("#hidden-likes").show();
                        },function()
                        {
                        $("#hidden-likes").hide();
                        }
                        )
                          $("#likes").click(function()
                        {
                          var val = "<?php echo $Username ?>";
                          window.location = "./likes.php?user=" + val;
                        })
                      </script>
                  </div>
              </div>

          </p>
                        <div class="row">
              	<div class="container">
                <div class="col-sm-12" id="hidden-following" style="display:none;">"Show the users you are following!"</div>
                <div class="col-sm-12" id="hidden-followee" style="display: none;">"Let's see who are following you!"</div>
                <div class="col-sm-12" id="hidden-likes" style="display: none;">"Check out those artists you like!"</div>
            </div>
            </div>
        </div>
      </div>




      <div class="container">
        <!-- Example row of columns -->
        <h3>New Feeding</h3>
        <div class="row">
          <div class="col-md-4">
            <h5>New Releases from your following</h5>
            <div id="following-table" class="overflow">
            	<table class="table table-dark" id="following-table">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Username</th>
				      <th scope="col">Play List</th>
				      <th scope="col">Release Date</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				       <?php
				       $sql1 = "SELECT playlist.ptitle, playlist.Username, playlist.ReleaseDate 
                                  FROM playlist,follows 
							      WHERE playlist.Username=follows.followee AND follows.follower='$Username'
							      ORDER BY ReleaseDate DESC
								  LIMIT 10";
                         $result1 = $conn->query($sql1);
                         $numrow = 1;
                         while($row = $result1->fetch_assoc())
                         {
                              echo '<tr>
				                    <th scope="row">'.$numrow.'</th>
				                    <td>'.$row["Username"].'</td>
				                    <td>'.$row["ptitle"].'</td>
				                    <td>'.$row["ReleaseDate"].'</td>
                                    </tr>';
                              $numrow++;
                         }
                        ?>
				    </tr>
				  </tbody>
				</table>
				</div>
				<script type="text/javascript">
			          var scrollingUpFollowing = 0;
			          var dontScrollFollowing = 0; 					
          			function scrollitFollowing() {
					 if(scrollingUpFollowing == 0 && dontScrollFollowing == 0) {
					        $('#following-table').animate({ scrollTop: $("#following-table").scrollTop() + 50 }, 'slow');
					    }
					}
					$('#following-table').bind('scroll', function () {
					    if (dontScrollFollowing == 0) {
					        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
					            scrollingUpFollowing = 1;      
					            $('#following-table').delay(500).animate({scrollTop: 0 }, 500, function() {
					                scrollingUpFollowing = 0;    
					            });
					        }
					    }
					});
					window.setInterval(scrollitFollowing, 500);
					$('#following-table').hover(function() {
					    dontScrollFollowing = 1;
					}, function() {
					    dontScrollFollowing = 0;
					});
 				</script>
 				<p></p>
            <p>
            	<a class="btn btn-secondary" href="#" role="button">View details &raquo;</a>
            </p>
          </div>
          <div class="col-md-4">
            <h5>New Releases from your likes artists</h5>
				<div id="like-table" class="overflow">
            	<table class="table table-dark"  id="like-table">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Artst</th>
				      <th scope="col">Album</th>
				      <th scope="col">Issuedate</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
             <?php 

                         $sql2 = "SELECT DISTINCT artist.aname, album.atitle, album.issueDate FROM likes,artist,track,albumtrack,album WHERE artist.artistID=likes.artistID AND track.artistID=artist.artistID AND albumtrack.trackID=track.trackID AND album.albumID=albumtrack.albumID AND likes.username='$Username' ORDER BY album.issueDate DESC LIMIT 10";
                         $result2 = $conn->query($sql2);
                         $numrow = 1;
                         while($row = $result2->fetch_assoc())
                         {
                              echo $row["artist"];
                              echo '<tr>
                                            <th scope="row">'.$numrow.'</th>
                                            <td>'.$row["aname"].'</td>
                                            <td>'.$row["atitle"].'</td>
                                            <td>'.$row["issueDate"].'</td>
                                    </tr>';
                              $numrow++;
                         }
              ?> 
                        
				    </tr>
				  </tbody>
				</table>
				</div>
				<script type="text/javascript">
			          var scrollingUpLike=0;
			          var dontScrollLike=0; 					
          /*function doScroll()
 					{
   						$('#following-table').scrollTop($('#following-table').scrollTop() + 10);
					}*/
					function scrollitLike() {
					 if(scrollingUpLike == 0 && dontScrollLike == 0) {
					        $('#like-table').animate({ scrollTop: $("#like-table").scrollTop() + 50 }, 'slow');
					    }
					}
					$('#like-table').bind('scroll', function () {
					    if (dontScrollLike == 0) {
					        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
					            scrollingUpLike = 1;      
					            $('#like-table').delay(500).animate({scrollTop: 0 }, 500, function() {
					                scrollingUpLike = 0;    
					            });
					        }
					    }
					});
					window.setInterval(scrollitLike, 500);
					$('#like-table').hover(function() {
					    dontScrollLike = 1;
					}, function() {
					    dontScrollLike = 0;
					});
 				</script>
 				<p></p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h5>Your recently listening Tracks</h5>
				<div id="play-table" class="overflow">
            	<table class="table table-dark"  id="play-table">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Track Name</th>
				      <th scope="col">Artist</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				       <?php
				       $sql3 = "SELECT track.Ttitle,artist.aname FROM track,plays,user,artist WHERE user.Username=plays.username and plays.trackid=track.TrackID and track.artistID=artist.artistID AND user.Username='$Username' ORDER BY timestamp DESC LIMIT 10";
               echo $sql3;
                         $result3 = $conn->query($sql3);
                         $numrow = 1;
                         while($row = $result3->fetch_assoc())
                         {
                            echo '<tr>
				                    <th scope="row">'.$numrow.'</th>
				                    <td>'.$row["Ttitle"].'</td>
				                    <td>'.$row["aname"].'</td>
                                    </tr>';
                              $numrow++;
                         }
                        ?>
				    </tr>
				  </tbody>
				</table>
				</div>
				<script type="text/javascript">
			          var scrollingUpPlay=0;
			          var dontScrollPlay=0; 					
          /*function doScroll()
 					{
   						$('#following-table').scrollTop($('#following-table').scrollTop() + 10);
					}*/
					function scrollitPlay() {
					 if(scrollingUpPlay == 0 && dontScrollPlay == 0) {
					        $('#play-table').animate({ scrollTop: $("#play-table").scrollTop() + 50 }, 'slow');
					    }
					}
					$('#play-table').bind('scroll', function () {
					    if (dontScrollPlay == 0) {
					        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
					            scrollingUpPlay = 1;      
					            $('#play-table').delay(500).animate({scrollTop: 0 }, 500, function() {
					                scrollingUpPlay = 0;    
					            });
					        }
					    }
					});
					window.setInterval(scrollitPlay, 500);
					$('#play-table').hover(function() {
					    dontScrollPlay = 1;
					}, function() {
					    dontScrollPlay = 0;
					});
 				</script>
            <p></p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
      </body>
</html>
