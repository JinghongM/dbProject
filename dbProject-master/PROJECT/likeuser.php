<!DOCTYPE html>
<html>
<head>
  <title>The users like the artist</title>
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

                             if(isset($_POST['submit'])){
                              $array = $_POST['selector'];
                              $Username = $_GET["user"];
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
             echo '<a class="nav-link" style="color:yellow;" href="likes.php?user='.$Username.'">Artists<span class="sr-only">(current)</span></a>';

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
                          <!--                                  BUTTON!!!                      -->
                      </h4>
                         <h4 class="white"><i class="fa fa-check-circle-o"></i>
                          <?php
                          echo '<form action="./artistprofile.php?user='.$Username.'&artist='.$checkName.'" method="post">
                            <input type="hidden" name="likeArtist" value="'.$checkName.'">';
                            ?>
                            <button type="submit" class="btn btn-success" id="addToLike">Like</button>
                          </form>
              </h4>
                          <!--                                  BUTTON!!!                      -->

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

                           <table class="table table-inbox table-hover">
                            <thead>
                            <tr>
                              <td class="inbox-small-cells">
                                </td>
                                <th class="view-message  dont-show">User Name</th>
                                <th class="view-message  text-right">From</th>
                                <th class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></th>
                                <th class="view-message ">Likes Since</th>
                            </tr>
                            </thead>
                            <tbody>
                             <?php 
                             include 'databases.php';
                             $conn = new mysqli($servername, $username, $password, $dbname);
                                  $sql1 = "SELECT user.Username, likes.timestamp, user.city
                                           FROM likes,user
                                           WHERE likes.artistID='".$_GET['artist']."' and likes.username=user.username";
                                  $result1 = $conn->query($sql1);
                                  $numrow = 1;
                                  while($row = $result1->fetch_assoc())
                                  {
                                    echo '<tr>

                                      <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                      <td class="view-message  dont-show"><a href="profile.php?user='.$Username.'&guest='.$row["Username"].'">'.$row["Username"].'</a></td>
                                      <td class="view-message  text-right">'.$row["city"].'</td>
                                      <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                      <td class="view-message ">'.$row["timestamp"].'</td>
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