<!-- Dev Page --->

<?php
  session_start();

  /*-------------------------------------------------------------------------*/
  /* VERIFICATION */
  /*-------------------------------------------------------------------------*/

  require ("../sitescript/globalmr.php");
  require ("../sitescript/mrDb.php");
  require ("../sitescript/blogDecompiler.php");
  require ("../sitescript/DBHandler.php");
?>

<html>
  <head>
    <title>Mad Rockers Team 2973</title>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js'></script>
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js' integrity='sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js' integrity='sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k' crossorigin='anonymous'></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='https://getbootstrap.com/docs/4.4/examples/floating-labels/floating-labels.css'>
    <link rel='stylesheet' href='/css/boot.css' type="text/css">
  </head>
  <body class="w-100 h-100 bg-dark text-white">
    <!--<div class="container">--->
      <!-- PHP Code for Page --->

      <?php

        $madrockersdb = $GLOBALS['mrdb'];
        if ($madrockersdb->connect_error) {("An error has occured.");}

        $alert = "";

        //Check if password is correct
        if ($_POST['devAccessPassword']=="2973FTW") {
          $_SESSION['madr_devAccess'] = true;
          $alert = '<div class="alert alert-success alert-dismissible fade show container p-3 mt-3" role="alert">
                      <strong>Logged on!</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
          echo $alert;
        }
        else if($_POST['devAccessPassword']) {
          $_SESSION['madr_devAccess'] = false;
          $alert = '<div class="alert alert-danger alert-dismissible fade show container p-3 mt-3" role="alert">
                      <strong>Incorrect Password!</strong> Try again.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
          echo $alert;
        }

        //Logging Off
        if ($_GET['devAccessLogOff']=="TRUE")
        {
          $alert = '<div class="alert alert-danger alert-dismissible fade show container p-3 mt-3" role="alert">
                      <strong>Logged off!</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
          echo $alert;
          $_SESSION['madr_devAccess'] = false;
        }

        /*-------------------------------------------------------------------------*/
        /* SHOW PAGE CONTENTS */
        /*-------------------------------------------------------------------------*/

        if ($_SESSION['madr_devAccess'] == true) {
          echo '
          <header>
            <nav class="navbar navbar-expand-md fixed-top p-3">
              <div class="container">
                <div class="navbar-header">
                  <span class="navbar-brand mb-0 h2">MR Development Page</span>
                </div>
                <ul class="nav justify-content-end">
                  <li class="nav-item">
                    <a class="nav-link" href="/dev/index-new.php?p=blogs">Blogs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/dev/index-new.php?p=calendar">Calendar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/dev/index-new.php?p=uploadmedia">Upload Media</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/dev/index-new.php?p=viewmedia">View Media</a>
                  </li>
                  <li class="nav-item">
                    <button class="btn custom-red text-white btn-danger" onclick="location.replace(\'/dev/index-new.php?devAccessLogOff=TRUE\')";>Log off</button>
                  </li>
                </ul>
              </div>
            </nav>
          </header>';
          $p = $_GET['p'];

          //blogs
          if ($p=="blogs") {
            echo '<main role="main" class="container p-3">
                    <section>
                      <h2>Blogs</h2>
                      <p>This is the blogs page.</p>
                    </section>
                  </main>';
          }

          //calendar
          if ($p=="calendar") {
            echo '<main role="main" class="container p-3">
                    <section>
                      <h2>Calendar</h2>
                      <p>This is the calendar page. On here, you can view upcoming calendar events, see the season schedule, and add/edit events.</p>
                    </section>
                    <section>
                      <div class="card bg-light" style="color: black !important;">
                        <div class="card-header">Upcoming Events</div>
                        <div class="card-body">
                          <table style="color: black !important;">';
                            retrieveCalendar($madrockersdb);
            echo         '</table>
                        </div>
                      </div>
                    </section>
                  </main>';
          }

          //upload media
          if ($p=="uploadmedia") {
            echo '<main role="main" class="container p-3">
                    <section>
                      <h2>Upload Media</h2>
                      <p>This is the page where you can upload photos and videos to be used in blogs.</p>
                    </section>
                  </main>';
          }

          //gallery
          if ($p=="viewmedia") {
            echo '<main role="main" class="container p-3">
                    <section>
                      <h2>View Media</h2>
                      <p>This is the page where you can view photos and videos uploaded to the server.</p>
                    </section>
                  </main>';
          }

        }

        /*-------------------------------------------------------------------------*/
        /* SHOW SIGN IN CONTENTS */
        /*-------------------------------------------------------------------------*/

        if (!$_SESSION['madr_devAccess']) {
          //Sign in container
          echo '<form class="form-signin" action="/dev/index-new.php" method="post">
                  <div class="text-center mb-4">
                    <img class="mb-4" src="/images/logos/TBLMR.png" alt="" width="128" height="128">
                    <h2 class="h3 mb-3">Development Page</h2>
                    <p>Welcome to the development page. This is used for various things, like uploading blogs, images, and more. Login below.</p>
                  </div>
                  <div class="form-label-group">
                    <input type="password" class="form-control" id="devAccessPassword" name="devAccessPassword" placeholder="Password" required>
                    <label for="devAccessPassword">Password</label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block" value="login" type="submit">Login</button>
                  <p class="mt-5 mb-3 text-muted text-center">© 2020 Mad Rockers</p>
                </form>';
        }
       ?>
    <!--</div>--->
  </body>
</html>