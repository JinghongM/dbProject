<!doctype html>
<html lang="en">
  <head>
    <title>Spotify Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://abs.twimg.com/a/1512085154/css/t1/twitter_core.bundle.css" class="coreCSSBundles">
    
 	<link rel="stylesheet" href="css/signup.css">
    
  </head>
   <body>
    <?php
    if(isset($_GET['issue'])) {
      if($_GET['issue']==1){
    echo '<div class="alert-messages " id="message-drawer" style="top: 46px;">
        <div class="message ">
          <div class="message-inside">  
              "The username and password you entered did not match our records. Please double-check and try again."
            <a role="botton" class="Icon Icon--close Icon--medium dismiss" id="close">
              <script type="text/javascript">
                document.getElementById("close").onclick = function()
            {
              document.getElementById("message-drawer").style.display = "none";
            }

              </script>
              <span class ="visuallyhidden">Dismiss</span>
            </a>
          </div>
        </div>
      </div>';
    }
    else if($_GET['issue']==2)
    {
       echo '<div class="alert-messages " id="message-drawer" style="top: 46px;">
        <div class="message ">
          <div class="message-inside">  
              "The username Exist!"
            <a role="botton" class="Icon Icon--close Icon--medium dismiss" id="close">
              <script type="text/javascript">
                document.getElementById("close").onclick = function()
            {
              document.getElementById("message-drawer").style.display = "none";
            }

              </script>
              <span class ="visuallyhidden">Dismiss</span>
            </a>
          </div>
        </div>
      </div>';
    }
  }
    ?>
    
    <div class="container">
    <p class="h1">Spotify</p>
  </div>
    <div class="container">
      <form class="form-signin" action="./php/checkuser.php" method="post">
        <h2 class="form-signin-heading">Please Sign in</h2>
        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name='password' required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="submit">Log in</button>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" onclick="openWindow()">Sign Up</button>
      <script type="text/javascript">
                function openWindow() {
                  window.location.href='./signup.php'
            }
      </script>
    </div> <!-- /container -->
  </body>
</html>