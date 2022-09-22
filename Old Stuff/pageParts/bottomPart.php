    </div><!---end bom remover--->
   </div>
            <div id='mr_pageFooter'>
                <a href='http://rockers.enrog.com/about.php#Contact'>contact</a> <a href='http://enrog.com/privacy'>privacy</a> <a href='http://enrog.com/terms'>terms</a> <a href='dev'>dev</a> <a href='http://rockers.enrog.com/testPage.php'>experimental</a><br>
                <a>Copyright Mad Rockers FIRST Team 2973, 2018</a><br>
                <a>Site coded by
                    <?php
                     //Fair 'created by' :) now we all feel good about ourselves
                     $terms = array("Evan","Riley","Tom");
                     shuffle($terms);
                     echo $terms[0].", ".$terms[2]." and ".$terms[1];
                    ?>
                </a><br>
                <!--<button onclick='backTop();' class='mr_button_medium' style='position:absolute;left:20px;bottom:20px;'><div class='arrowUp' style='display:block;'>&uarr;</div></button>--->
            </div>
        </div>
    </body>
    <script>
    var CountDownDate = new Date("Apr 1, 2020 10:30").getTime();
    function updCDD() {
      var now = new Date().getTime();
      var timeLeft = CountDownDate - now;
      var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
      var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
      document.getElementById("NavText").innerHTML = "Rocket City Regional in " + days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
      if (timeLeft < 0) {
        clearInterval(update);
        document.getElementById("NavText").innerHTML = "FIRST Team 2973";
      }
    }
    $(document).ready(function(){updCDD();setInterval(updCDD, 1000);});

    //Thank you W3Schools for this code template

    </script>
    <script>
    $("#mr_docContainer").scroll(function() {
      if ($(this).scrollTop() == 0) {
        $('#mr_pageHeader').css({
                'box-shadow': 'none',
                '-moz-box-shadow' : 'none',
                '-webkit-box-shadow' : 'none' });
      }
      else {

		var v = $(this).scrollTop();
		if (v>10)
		 v = 10;
        $('#mr_pageHeader').css({
                'box-shadow': '0px 0px '+v+'px black',
                '-moz-box-shadow' : '0px 0px '+v+'px black',
                '-webkit-box-shadow' : '0px 0px '+v+'px black' });
      }
    });


    </script>
    <style>
      .RobotSlides {
        display: none;
      }

      .collapseOnClick {
        display: block;
      }
    </style>
</html>
