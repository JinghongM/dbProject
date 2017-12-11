<!DOCTYPE html>
<html>
<head>
  <title>Play List</title>
    <link href="./css/profile.css" rel="stylesheet" media="screen">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/following.css">
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
        include 'databases.php';
        $vdelete = 0;
        if(isset($_GET['playlistid'])) {
          $vlist = 0;
          $listid = $_GET['playlistid'];
          $Username = $_GET['user'];
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql1 = "SELECT Username as name FROM playlist WHERE playlistID='$listid'";
          $result1 = $conn->query($sql1);
            while($row=mysqli_fetch_array($result1)){
              if($Username == $row['name']) {
                $vdelete = 1;}
            }
          } elseif(isset($_GET['albumid'])){
          $vlist = 1;
          $listid = $_GET['albumid'];
        } else {
          $vlist = 2;
          $artist = $_GET['artist'];
        }        
        if(isset($_GET['delete'])) {
          $Username = $_GET["user"];
          $delete = $_GET['delete'];
          $listid = $_GET['playlistid'];
          include 'databases.php';
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql1 = "DELETE FROM playlisttrack WHERE playlistid='$listid' AND trackid='$delete'";
          $conn->query($sql1);
        }
        if(isset($_POST['delform'])){
          $array = $_POST['selector'];
          $Username = $_GET["user"];
          $listid = $_GET['playlistid'];
          include 'databases.php';
          $conn = new mysqli($servername, $username, $password, $dbname);
          foreach ($array as $delete) {
            $sql1 = "DELETE FROM playlisttrack WHERE playlistid='$listid' AND trackid='$delete'";
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
                            include 'databases.php';
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                            }
                            if ($vlist == 0){
                              $sql1 = "SELECT ptitle FROM playlist WHERE playlistID='$listid'";
                              $result1 = $conn->query($sql1);
                              while($row=mysqli_fetch_array($result1)){
                                $cid=$row["ptitle"];
                              }
                            } elseif($vlist == 1){
                              $sql1 = "SELECT atitle FROM album WHERE albumID='$listid'";
                              $result1 = $conn->query($sql1);
                              while($row=mysqli_fetch_array($result1)){
                                $cid=$row["atitle"];
                              }
                            } else {
                              $cid = $artist;
                            }
                            echo $cid;
                          ?>
                        </h3>
                    </div>


                    <div class="user-pad">
                          <?php
                            include 'databases.php';
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                            }
                            if ($vlist == 0){
                              $sql1 = "SELECT count(*) as num FROM playlisttrack WHERE playlistid='$listid'";
                              $result1 = $conn->query($sql1);
                              while($row=mysqli_fetch_array($result1)){
                                $cid=$row["num"];
                              }
                            } elseif($vlist == 1){
                              $sql1 = "SELECT count(*) as num FROM albumtrack WHERE albumID='$listid'";
                              $result1 = $conn->query($sql1);
                              while($row=mysqli_fetch_array($result1)){
                                $cid=$row["num"];
                              }
                            } else {
                              $sql1 = "SELECT count(*) as count
                                       From track,artist
                                       WHERE artist.aname = '$artist' and artist.artistID=track.artistID";
                              $result1 = $conn->query($sql1);
                              while($row=mysqli_fetch_array($result1)){
                                $cid=$row["count"];
                              }
                            }
                            echo "Number of tracks:".$cid;
                          ?>
                    </div>

                    <div class="user-pad">
                          <?php
                            include 'databases.php';
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                            }
                            if ($vlist == 0){
                              $sql1 = "SELECT ReleaseDate FROM playlist WHERE playlistID='$listid'";
                              $result1 = $conn->query($sql1);
                              while($row=mysqli_fetch_array($result1)){
                                $cid=$row["ReleaseDate"];
                              }
                              echo "Release Date:".$cid;
                            } elseif($vlist == 1) {
                              $sql1 = "SELECT IssueDate FROM album WHERE albumID='$listid'";
                              $result1 = $conn->query($sql1);
                              while($row=mysqli_fetch_array($result1)){
                                $cid=$row["IssueDate"];
                              }
                              echo "Issue Date:".$cid;
                            } else {
                              $sql1 = "SELECT description
                                       From artist
                                       WHERE aname='$artist'";
                              $result1 = $conn->query($sql1);
                              while($row=mysqli_fetch_array($result1)){
                                $cid=$row["description"];
                              }
                              echo "Description:".$cid;
                            }
                            
                          ?>
                    </div>

                    </div>

                <div class="col-md-6 no-pad">
                    <div class="user-image">
                        <img src="./images/album.jpg" class="img-responsive thumbnail">
                    </div>
                </div>
            </div>
        </div>
                
      </div>

    <?php
      if ($vdelete == 1) {
        echo'<form action="myplaylist.php?user='.$Username.'&playlistid='.$listid.'" method="post">'; 
      }
    ?>

    <div class="chk-all">
      <input type="checkbox" id="checkAll" />
        <div class="btn-group">
          <a data-toggle="dropdown"  class="btn mini all" aria-expanded="false" id="checkAll">All</a>
          <?php
            if ($vdelete == 1) {
              echo '<button type="submit" class="btn btn-danger" style="visibility: hidden;" id="unfollowAll" name="delform" value="Unfollow Checked">Delete selected</button>';
            }
          ?>     
            </div>
                             </div>
                           <table class="table table-inbox table-hover">
                            <tr>
                              <td class="inbox-small-cells">
                                <input type="checkbox"  style="visibility: hidden;">
                                </td>
                                <td class="view-message  dont-show">Ttitle</td>
                                <td class="view-message  text-right">duration</td>
                                <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                <td class="view-message text-right">genre</td>
                            </tr>
                            <tbody>
                             <?php 
                             include 'databases.php';
                             function changeAuthorization($Authorization)
                             {
                              if($Authorization == "private")
                              {
                                return "For yourself only";
                              }
                              else
                              {
                                return "For everyone";
                              }
                             }
                                  $conn = new mysqli($servername, $username, $password, $dbname);
                                  if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                  }
                                  if ($vlist == 0) {
                                    $sql1 = "SELECT track.Ttitle, track.duration, track.genre, track.TrackID
                                             FROM track,playlisttrack
                                             WHERE playlisttrack.playlistid='$listid' and track.TrackID=playlisttrack.trackid";
                                    $result1 = $conn->query($sql1);
                                  } elseif($vlist == 1) {
                                    $sql1 = "SELECT track.Ttitle, track.duration, track.genre, track.TrackID
                                             FROM track,albumtrack
                                             WHERE albumtrack.albumid='$listid' and track.TrackID=albumtrack.trackID";
                                    $result1 = $conn->query($sql1);
                                  } else {
                                    $sql1 = "SELECT track.Ttitle, track.duration, track.genre, track.TrackID
                                             FROM track,artist
                                             WHERE track.artistID=artist.artistID and artist.aname = '$artist'";
                                    $result1 = $conn->query($sql1);
                                  }
                                  $numrow = 1;
                                  while($row = $result1->fetch_assoc())
                                  {
                                    echo '<tr>
                                      <td class="inbox-small-cells">
                                        <input name="selector[]" type="checkbox" class="mail-checkbox" value="'.$row["TrackID"].'" />
                                      </td>
                                      <td class="view-message  dont-show">'.$row["Ttitle"].'</td>
                                      <td class="view-message  text-right">'.$row["duration"].'</td>
                                      <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                      <td class="view-message text-right">'.$row["genre"].'</td>
                                      <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                   
                                      <td>
                                      <a href="trackprofile.php?user='.$Username.'&track='.$row["TrackID"].'"><button type="button" class="btn btn-warning">Play</button></a>';
                                    if ($vdelete == 1) {
                                      echo '<a href="myplaylist.php?user='.$Username.'&delete='.$row["TrackID"].'&playlistid='.$listid.'"><button type="button" class="btn btn-danger">Delete</button></a>';
                                    }
                                    echo '</td></tr>';
                                   $numrow++;
                                 }
                              ?>
                          </tbody>
                          </table>

</div>
</main>
 <script type="text/javascript">
$("#checkAll").click(function () {
  $(".mail-checkbox").prop('checked', $(this).prop('checked'));
  $("#unfollowAll").css("visibility","visible");
  $("#unfollowAll1").css("visibility","visible")
});
$('#checkAll').change(function() {
   if ( ! this.checked) {
        $("#unfollowAll").css("visibility","hidden");
        $("#unfollowAll1").css("visibility","hidden")
   }
});
$(".mail-checkbox").change(function(){
    if ($('.mail-checkbox:checked')) {
       //do something
         $("#unfollowAll").css("visibility","visible");
         $("#unfollowAll1").css("visibility","visible")
    }
    if ($('.mail-checkbox:checked').length ==0)
    {
        $("#unfollowAll").css("visibility","hidden");
        $("#unfollowAll1").css("visibility","hidden")
    }
});
$(function(){
      $('#unfollowAll').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
      });
      $('#unfollowAll1').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
      });
    });
</script>
</body>
</html>