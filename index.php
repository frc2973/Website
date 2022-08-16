<!-- Bootstrap Testing Page --->

<?php
    //The following includes are required for the site to function.
    require "sitescript/globalmr.php";
    require "sitescript/mrDb.php";
    require "sitescript/mrImage.php";
    require ("sitescript/blogDecompiler.php");
    $GLOBALS['blogHeaderLink']="data/blogs/allblogs/";//Prepare the blog decompiler to handle requests from the front page.
    
    // mobile page pointer
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {

        header('location: http://rockers2973.com/mobile/mobile.php');
}
?>

<html lang="en">
  <head>
    <title>Mad Rockers Team 2973</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='/css/boot.css' type="text/css">
  </head>
  <body class='text-center js-focus-visible h-100' style='background: linear-gradient(to top left, #171d22, #1F47A9, #1F47A9, #CC483F); background-size: cover; background-position: center;'>
    <header class='bg-translucent'>
      <div class='container'>
        <nav class='navbar p-3'>
          <div class='navbar-header'>
            <img style='line-height: 50px' src='/images/MRText.svg' height='25px'/>
          </div>
          <ul class='nav justify-content-end'>
            <li class='nav-item'>
              <a class='nav-link active' href='/index.php'>Home</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='/about.php'>About</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='/competitions.php'>Competitions</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='/contact.php'>Contact</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <main role='main' class='h-100'>
      <div class='container p-3'>
        <div class='jumbotron h-50 shadow' style='background-image: url("/images/landingPage.png"); background-size: cover; background-position: bottom;'>
          <!--<img class='logoOnImage' style='line-height: 200px' src='/images/MRText.svg' height='100px'/>--->
        </div>
        <div class='row mb-3 h-50'>
          <div class='col-lg-6 h-100'>
            <div class='card mb-3 bg-translucent text-white shadow'>
              <div class='card-header bg-black'>Calendar</div>
              <div class='card-body'>
                <p>Current Meeting Schedule</p>
                <table class='table table-sm table-borderless text-white' style='text-align: left;'>
                  <tr>
                    <th>Day</th>
                    <th>Time</th>
                  </tr>
                  <tr>
                    <td>Monday</td>
                    <td>4:15pm-6:30pm</td>
                  </tr>
                  <tr>
                    <td>Tuesday</td>
                    <td>4:15pm-8:30pm</td>
                  </tr>
                  <tr>
                    <td>Thursday</td>
                    <td>4:15pm-6:30pm</td>
                  </tr>
                  <tr>
                    <td>Saturday</td>
                    <td>9:15am-2:30pm</td>
                  </tr>
                </table>
                <!--<p>Regular Meeting Schedule</p>
                <table class='table table-sm table-borderless text-white' style='text-align: left;'>
                  <tr>
                    <th>Day</th>
                    <th>Time</th>
                  </tr>
                  <tr>
                    <td>Monday</td>
                    <td>4:00-8:30pm</td>
                  </tr>
                  <tr>
                    <td>Tuesday</td>
                    <td>6:00-8:30pm</td>
                  </tr>
                  <tr>
                    <td>Thursday</td>
                    <td>6:00-8:30pm</td>
                  </tr>
                  <tr>
                    <td>Saturday</td>
                    <td>9:00am-4:00pm</td>
                  </tr>
                </table>-->
              </div>
            </div>
          </div>
          <!--<div class='col-lg-6'>
            <div class='card mb-3 bg-translucent text-white shadow'>
              <div class='card-header bg-black'>Mad Rockers Scouting App</div>
              <div class='card-body'>
                <img class='mb-3' src='/images/logos/ScoutingAppIcon.png' width='64px' height='64px'/>
                <p class='card-text' style='font-weight: 400'>Check out our scouting app we created for FIRST competitions! The bulk of it was coded by former team captain Riley Bong and added to by current senior Tom Teper.</p>
                <button class='btn btn-primary shadow' onclick='location.replace("../scout/index.php");'>Open App</button>
              </div>
            </div>
          </div>--->
          <div class='col-lg-6 h-100'>
            <div class='card mb-3 bg-translucent text-white shadow'>
              <div class='card-header bg-black'>Countdown to Competition</div>
              <div class='card-body'>
                <!--<div class='rounded-circle shadow mb-3' style='width: 120px; height: 120px; background-image: url("/images/Comp RCR.jpg"); background-position: center; background-size: cover;'></div>-->
                <!--<p class='card-text' style='font-weight: 400'>In the time of COVID, we have had to adjust to new challenges and take our competition virtual!</p>-->
                <p class='card-text' id='CText' style='font-weight: 400'></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer role='footer' class='mb-0 py-3 bg-translucent text-white'>
        <div class='container'>
          <a>© 2022 Mad Rockers</a> | 
          <a href='/privacy.php'>Privacy Policy</a>
          <!-- | <a href='/terms.php'>Terms of Service</a>-->
              <?php/*
               //Fair 'created by' :) now we all feel good about ourselves
               $terms = array("Evan","Riley","Tom");
               shuffle($terms);
               echo $terms[0].", ".$terms[2]." and ".$terms[1];*/
              ?>
        </div>
      </footer>
    </main>
  </body>
</html>
<!--<script>
  $(document).scroll(function() {
  var y = $(this).scrollTop();
  if (y > 72) {
    $('.logoOnImage').fadeIn();
  } else {
    $('.logoOnImage').fadeOut();
  }
  });
</script>--->
<script>
var CountDownDate = new Date("Sep 10, 2022 13:00").getTime();
function updCDD() {
  var now = new Date().getTime();
  var timeLeft = CountDownDate - now;
  var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
  var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
  document.getElementById("CText").innerHTML = "BEST Kickoff starts in <br><b style='font-size: 30px;'>" + days + "d " + hours + "h " + minutes + "m " + seconds + "s </b>";
  /*if (timeLeft < 0) {
    clearInterval(update);
    CountDownDate = new Date("Apr 1, 2020 10:30").getTime();
    document.getElementById("CText").innerHTML = "Rocket City Regional in <br><b style='font-size: 30px;'>" + days + "d " + hours + "h " + minutes + "m " + seconds + "s </b>";
  }*/
}
$(document).ready(function(){updCDD();setInterval(updCDD, 1000);});

//Thank you W3Schools for this code template

</script>
