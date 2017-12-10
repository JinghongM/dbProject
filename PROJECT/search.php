<!DOCTYPE html>
<html>
<head>
  <title>Following</title>
    <link href="./css/profile.css" rel="stylesheet" media="screen">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/following.css">
    <script src="./jquery/jquery.min.js"></script> 

    <style type="text/css">
      body, html{
     height: 100%;
    background:url(https://i.ytimg.com/vi/4kfXjatgeEU/maxresdefault.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: 'Oxygen', sans-serif;
        background-size: cover;
    }
    </style>
    <script src="./jquery/jquery.min.js"></script> 

</head>
<body>
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

                             if(isset($_GET['unfo'])) {
                              $Username = $_GET["user"];
                              $unfo = $_GET['unfo'];
                              include 'databases.php';
                              $conn = new mysqli($servername, $username, $password, $dbname);
                              $sql1 = "DELETE FROM follows
                                       WHERE follower='$Username'and followee='$unfo'";
                              $conn->query($sql1);

                             }

                             if(isset($_GET['submit'])){
                              $array = $_GET['selector'];
                              $Username = $_GET['user'];
                              include 'databases.php';
                              $conn = new mysqli($servername, $username, $password, $dbname);
                              foreach ($array as $unfo) {
                                $sql1 = "DELETE FROM follows
                                       WHERE follower='$Username'and followee='$unfo'";
                                $conn->query($sql1);
                              }
                             }
?>
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
<form class="form-inline my-2 my-lg-0" action="./search.php" method="get">';
          <?php
          echo '<input type="hidden" name="user" value="'.$Username.'">';
          ?>
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="searchKey" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <main role="main">
<div style="background:transparent" class="jumbotron">
                <div class="btn-group">
                <button type="button" class="btn btn-success btn-filter" data-target="pagado" id="userButton" onclick="userButton()">User</button>
                <button type="button" class="btn btn-warning btn-filter" data-target="pendiente" id="artistButton" onclick="artistButton()">Artist</button>
                <button type="button" class="btn btn-danger btn-filter" data-target="cancelado" id="trackButton" onclick="trackButton()">Track</button>
                <button type="button" class="btn btn-info btn-filter" data-target="all" id="playlistButton" onclick="playlistButton()">Play list</button>
                <button type="button" class="btn btn-primary btn-filter" data-target="all" id="albumButton" onclick="albumButton()">Album</button>
              </div>
              <script type="text/javascript">
                var user=1;
                var artist=0;
                var track=0;
                var playlist=0;
                var album=0;
                function userButton()
                {
                  if(document.getElementById("user").style.display=="table")
                  {
                    return;
                  }
                  else
                  {
                    if(artist==1)
                    {
                      document.getElementById("artist").style.display = "none";
                    }
                    if(track==1)
                    {
                      document.getElementById("track").style.display = "none";
                    }
                    if(playlist==1)
                    {
                      document.getElementById("playlist").style.display = "none";
                    }
                    if(album==1)
                    {
                      document.getElementById("album").style.display = "none";
                    }
                    document.getElementById("user").style.display = "table";
                    user=1;
                  }
                }
                 function artistButton()
                {
                  if(document.getElementById("artist").style.display=="table")
                  {
                    return;
                  }
                  else
                  {
                    if(user==1)
                    {
                      document.getElementById("user").style.display = "none";
                    }
                    if(track==1)
                    {
                      document.getElementById("track").style.display = "none";
                    }
                    if(playlist==1)
                    {
                      document.getElementById("playlist").style.display = "none";
                    }
                    if(album==1)
                    {
                      document.getElementById("album").style.display = "none";
                    }
                    document.getElementById("artist").style.display = "table";
                    artist=1;
                  }
                }
                function trackButton()
                {
                  if(document.getElementById("track").style.display=="table")
                  {
                    return;
                  }
                  else
                  {
                    if(user==1)
                    {
                      document.getElementById("user").style.display = "none";
                    }
                    if(artist==1)
                    {
                      document.getElementById("artist").style.display = "none";
                    }
                    if(playlist==1)
                    {
                      document.getElementById("playlist").style.display = "none";
                    }
                    if(album==1)
                    {
                      document.getElementById("album").style.display = "none";
                    }
                    document.getElementById("track").style.display = "table";
                    track=1;
                  }
                }
                 function playlistButton()
                {
                  if(document.getElementById("playlist").style.display=="table")
                  {
                    return;
                  }
                  else
                  {
                    if(user==1)
                    {
                      document.getElementById("user").style.display = "none";
                    }
                    if(artist==1)
                    {
                      document.getElementById("artist").style.display = "none";
                    }
                    if(track==1)
                    {
                      document.getElementById("track").style.display = "none";
                    }
                    if(album==1)
                    {
                      document.getElementById("album").style.display = "none";
                    }
                    document.getElementById("playlist").style.display = "table";
                    playlist=1;
                  }
                }
                function albumButton()
                {
                  if(document.getElementById("album").style.display=="table")
                  {
                    return;
                  }
                  else
                  {
                    if(user==1)
                    {
                      document.getElementById("user").style.display = "none";
                    }
                    if(artist==1)
                    {
                      document.getElementById("artist").style.display = "none";
                    }
                    if(track==1)
                    {
                      document.getElementById("track").style.display = "none";
                    }
                    if(playlist==1)
                    {
                      document.getElementById("playlist").style.display = "none";
                    }
                    document.getElementById("album").style.display = "table";
                    album=1;
                  }
                }
</script>
                           <table class="table table-inbox table-hover" id="user" style="display: table;">
                            <tr>
                              <td class="inbox-small-cells">
                                <input type="checkbox" >
                                </td>
                                <th class="inbox-small-cells"><i class="fa fa-star"></i></th>
                                <th class="view-message  dont-show">User Name</th>
                                <th class="view-message  text-right">From</th>
                                <th class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></th>
                            </tr>
                            <tbody>
                             <?php 
                             $searchKey = $_GET["searchKey"];
                             include 'databases.php';
                             $conn = new mysqli($servername, $username, $password, $dbname);
                             $sql1 = "SELECT user.Username, user.city
                                           FROM user
                                           WHERE username like '%$searchKey%'";
                                  $result1 = $conn->query($sql1);
                                  $numrow = 1;
                                  while($row = $result1->fetch_assoc())
                                  {
                                    echo '
                                    <tr>
                                      <td class="inbox-small-cells">
                                        <input name="selector[]" type="checkbox" class="mail-checkbox" value="'.$row["Username"].'" />
                                      </td>
                                      <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                      <td class="view-message  dont-show"><a href="profile.php?user='.$_GET["user"].'&guest='.$row["Username"].'">'.$row["Username"].'</td>
                                      <td class="view-message  text-right">'.$row["city"].'</td>
                                      <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                      <td><a href="profile.php?user='.$_GET["user"].'&guest='.$row["Username"].'"><button type="button" class="btn btn-success">View</button></a></td>

                                        </tr>';
                                   $numrow++;
                                 }
                              ?>
                          </tbody>
                          </table>
                          <table class="table table-inbox table-hover" id="artist" style="display: none;">
                            <tr>
                              <td class="inbox-small-cells">
                                <input type="checkbox" >
                                </td>
                                <th class="inbox-small-cells"><i class="fa fa-star"></i></th>
                                <th class="view-message  dont-show">Artist Name</th>
                                <th class="view-message  text-right">Description</th>
                                <th class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></th>
                            </tr>
                            <tbody>
                             <?php 
                             include 'databases.php';
                             $conn = new mysqli($servername, $username, $password, $dbname);
                             $sql2 = "SELECT artistID,aname, description
                                           FROM artist
                                           WHERE aname like'%$searchKey%' or description like '%$searchKey%'";
                                  $result2 = $conn->query($sql2);
                                  $numrow = 1;
                                  while($row = $result2->fetch_assoc())
                                  {
                                    echo '
                                    <tr>
                                      <td class="inbox-small-cells">
                                        <input name="selector[]" type="checkbox" class="mail-checkbox" value="'.$row["aname"].'" />
                                      </td>
                                      <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                      <td class="view-message  dont-show"><a href="artistprofile.php?user='.$_GET["user"].'&artist='.$row["artistID"].'">'.$row["aname"].'</td>
                                      <td class="view-message  text-right">'.$row["description"].'</td>
                                      <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                      <td><a href="artistprofile.php?user='.$_GET["user"].'&artist='.$row["artistID"].'"><button type="button" class="btn btn-success">View</button></a></td>

                                        </tr>';
                                   $numrow++;
                                 }
                              ?>
                          </tbody>
                          </table>
                          <table class="table table-inbox table-hover" id="track" style="display: none;">
                            <tr>
                              <td class="inbox-small-cells">
                                <input type="checkbox" >
                                </td>
                                <th class="inbox-small-cells"><i class="fa fa-star"></i></th>
                                <th class="view-message  dont-show">Track Title</th>
                                <th class="view-message  text-right">Duration</th>
                                <th class="view-message  text-right">Genre</th>
                                <th class="view-message  text-right">Artist</th>

                            </tr>
                            <tbody>
                             <?php 
                             include 'databases.php';
                             $conn = new mysqli($servername, $username, $password, $dbname);
                             $sql3 = "SELECT track.trackid, track.ttitle, track.duration,track.genre,artist.aname
                                           FROM artist,track
                                           WHERE track.ttitle like'%$searchKey%' or track.genre like '%$searchKey%' or artist.aname like '%$searchKey%'";
                                  $result3 = $conn->query($sql3);
                                  $numrow = 1;
                                  while($row = $result3->fetch_assoc())
                                  {
                                    echo '
                                    <tr>
                                      <td class="inbox-small-cells">
                                        <input name="selector[]" type="checkbox" class="mail-checkbox" value="'.$row["trackid"].'" />
                                      </td>
                                      <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                      <td class="view-message  dont-show"><a href="trackprofile.php?user='.$_GET["user"].'&track='.$row["trackid"].'">'.$row["ttitle"].'</td>
                                      <td class="view-message  text-right">'.$row["duration"].'</td>
                                      <td class="view-message  text-right">'.$row["genre"].'</td>
                                      <td class="view-message  text-right">'.$row["aname"].'</td>
                                      <td><a href="trackprofile.php?user='.$_GET["user"].'&track='.$row["trackid"].'"><button type="button" class="btn btn-success">View</button></a></td>

                                        </tr>';
                                   $numrow++;
                                 }
                              ?>
                          </tbody>
                          </table>
                          <table class="table table-inbox table-hover" id="playlist" style="display: none;">
                            <tr>
                              <td class="inbox-small-cells">
                                <input type="checkbox" >
                                </td>
                                <th class="inbox-small-cells"><i class="fa fa-star"></i></th>
                                <th class="view-message  dont-show">Playlist</th>
                                <th class="view-message  text-right">Release Date</th>
                                <th class="view-message  text-right">User</th>
                            </tr>
                            <tbody>
                             <?php 
                             include 'databases.php';
                             $conn = new mysqli($servername, $username, $password, $dbname);
                             $sql4 = "SELECT playlist.*
                                           FROM playlist
                                           WHERE playlist.ptitle like'%$searchKey%'";
                                  $result4 = $conn->query($sql4);
                                  $numrow = 1;
                                  while($row = $result4->fetch_assoc())
                                  {
                                    echo '
                                    <tr>
                                      <td class="inbox-small-cells">
                                        <input name="selector[]" type="checkbox" class="mail-checkbox" value="'.$row["playlistID"].'" />
                                      </td>
                                      <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                      <td class="view-message  dont-show"><a href="myplaylist.php?user='.$_GET["user"].'&playlistid='.$row["playlistID"].'">'.$row["ptitle"].'</a></td>
                                      <td class="view-message  text-right">'.$row["ReleaseDate"].'</td>
                                      <td class="view-message  text-right">'.$row["Username"].'</td>
									  <td><a href="myplaylist.php?user='.$_GET["user"].'&playlistid='.$row["playlistID"].'"><button type="button" class="btn btn-success">View</button></a></td>

                                        </tr>';
                                   $numrow++;
                                 }
                              ?>
                          </tbody>
                          </table>
                          <table class="table table-inbox table-hover" id="album" style="display: none;">
                            <tr>
                              <td class="inbox-small-cells">
                                <input type="checkbox" >
                                </td>
                                <th class="inbox-small-cells"><i class="fa fa-star"></i></th>
                                <th class="view-message  dont-show">Album Title</th>
                                <th class="view-message  text-right">Issue Date</th>

                            </tr>
                            <tbody>
                             <?php 
                             include 'databases.php';
                             $conn = new mysqli($servername, $username, $password, $dbname);
                             $sql5 = "SELECT album.*
                                           FROM album
                                           WHERE album.atitle like'%$searchKey%'";
                                  $result5 = $conn->query($sql5);
                                  $numrow = 1;
                                  while($row = $result5->fetch_assoc())
                                  {
                                    echo '
                                    <tr>
                                      <td class="inbox-small-cells">
                                        <input name="selector[]" type="checkbox" class="mail-checkbox" value="'.$row["albumID"].'" />
                                      </td>
                                      <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                      <td class="view-message  dont-show"><a href="myplaylist.php?user='.$_GET['user'].'&albumid='.$row["albumID"].'">'.$row["atitle"].'</a></td>
                                      <td class="view-message  text-right">'.$row["IssueDate"].'</td>
									  <td><a href="myplaylist.php?user='.$_GET["user"].'&albumid='.$row["albumID"].'"><button type="button" class="btn btn-success">View</button></a></td>

                                        </tr>';
                                   $numrow++;
                                 }
                              ?>
                          </tbody>
                          </table>
</div>
</main>
</body>
</html>