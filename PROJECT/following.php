<!DOCTYPE html>
<html>
<head>
  <title>Following</title>
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

    <main role="main">
<div style="background:transparent" class="jumbotron">
          <div class="container">
           <div class="row user-menu-container square">
          <div class="row coralbg white">
                <div class="col-md-6 no-pad">
                    <div class="user-pad">
                        <h3>
                          <?php
                            echo $checkName;
                          ?>
                        </h3>
                    </div>
                    <div class="user-pad">
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
                                  WHERE follower = '$checkName'";
                         $result1 = $conn->query($sql1);
                        while($row=mysqli_fetch_array($result1))
                        {
                             $cid=$row["num"];
                        }
                        echo "Following:".$cid;
                        ?>
                      </div>
                        <div class="user-pad">
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
                                  WHERE followee = '$checkName'";
                         $result1 = $conn->query($sql1);
                        while($row=mysqli_fetch_array($result1))
                        {
                             $cid=$row["num"];
                        }
                        echo "Follower:".$cid;
                        ?>
                        </div>
                        <div class="user-pad">
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
                                  FROM likes
                                  WHERE username = '$checkName'";
                         $result1 = $conn->query($sql1);
                        while($row=mysqli_fetch_array($result1))
                        {
                             $cid=$row["num"];
                        }
                        echo "likes:".$cid;
                        ?>
                        </div>
                    </div>
                <div class="col-md-6 no-pad">
                    <div class="user-image">
                        <img src="https://farm7.staticflickr.com/6163/6195546981_200e87ddaf_b.jpg" class="img-responsive thumbnail">
                    </div>
                </div>
            </div>
        </div>
                
      </div>
    <?php echo'<form action="./following.php?user='.$Username.'" method="post">';
     if(!isset($_GET['guest'])){
    echo '<div class="chk-all">
      <input type="checkbox" id="checkAll" />
        <div class="btn-group">';
}

             if(! isset($_GET['guest']))
             {
            echo '<a data-toggle="dropdown"  class="btn mini all" aria-expanded="false" id="checkAll">All</a>

            <button type="submit" class="btn btn-danger" style="visibility: hidden;" id="unfollowAll" name="submit" value="Unfollow Checked">Unfollow selected</button>';
            }
  ?>

            </div>
                             </div>
                           <table class="table table-inbox table-hover">
                            <tr>
                              <td class="inbox-small-cells">
                                <input type="checkbox"  style="visibility: hidden;">
                                </td>
                                <th class="inbox-small-cells"><i class="fa fa-star"></i></th>
                                <th class="view-message  dont-show">User Name</th>
                                <th class="view-message  text-right">From</th>
                                <th class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></th>
                                <th class="view-message ">Follow Since</th>
                            </tr>
                            <tbody>
                             <?php 
                             include 'databases.php';
                             $conn = new mysqli($servername, $username, $password, $dbname);
                             $sql1 = "SELECT user.Username, follows.timestamp, user.city
                                           FROM follows,user
                                           WHERE follows.follower='$checkName' and follows.followee=user.username";
                                  $result1 = $conn->query($sql1);
                                  $numrow = 1;
                                  while($row = $result1->fetch_assoc())
                                  {
                                    if(isset($_GET['guest']))
                                    {
                                      echo '<tr>
                                      <td class="inbox-small-cells">
                                      </td>
                                      <td class="inbox-small-cells"><i class="fa fa-star"></i></td>

                                      <td class="view-message  dont-show"><a href="profile.php?user='.$Username.'&guest='.$row["Username"].'">'.$row["Username"].'</a></td>
                                      <td class="view-message  text-right">'.$row["city"].'</td>
                                      <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                      <td class="view-message ">'.$row["timestamp"].'</td>


                                          </tr>';
                                        }
                                        else{
                                    
                                    echo '<tr>
                                      <td class="inbox-small-cells">
                                        <input name="selector[]" type="checkbox" class="mail-checkbox" value="'.$row["Username"].'" />
                                      </td>
                                      <td class="inbox-small-cells"><i class="fa fa-star"></i></td>

                                      <td class="view-message  dont-show"><a href="profile.php?user='.$Username.'&guest='.$row["Username"].'">'.$row["Username"].'</a></td>
                                      <td class="view-message  text-right">'.$row["city"].'</td>
                                      <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                      <td class="view-message ">'.$row["timestamp"].'</td>

                                      <td><a href="following.php?user='.$Username.'&unfo='.$row["Username"].'"><button type="button" class="btn btn-danger">Unfollow</button></a></td>

                                          </tr>';
                                        }
                                   $numrow++;
                                 }
                              ?>
                          </tbody>
                          </table>

</form>
</div>
</main>
 <script type="text/javascript">
$("#checkAll").click(function () {
  $(".mail-checkbox").prop('checked', $(this).prop('checked'));
  $("#unfollowAll").css("visibility","visible")
});
$('#checkAll').change(function() {
   if ( ! this.checked) {
        $("#unfollowAll").css("visibility","hidden")
   }

});
$(".mail-checkbox").change(function(){
    if ($('.mail-checkbox:checked')) {
       //do something
         $("#unfollowAll").css("visibility","visible")

    }
    if ($('.mail-checkbox:checked').length ==0)
    {
        $("#unfollowAll").css("visibility","hidden")

    }
});
$(function(){
      $('#unfollowAll').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
      });
    });
</script>
</body>
</html>