<?php

    //The following includes are required for the site to function.

    require "sitescript/globalmr.php";

    require "sitescript/mrDb.php";

    require "sitescript/mrImage.php";

    require ("sitescript/blogDecompiler.php");

    $GLOBALS['blogHeaderLink']="data/blogs/allblogs/";//Prepare the blog decompiler to handle requests from the front page.

?>



<html>

    <head>

        <title>Mad Rockers Team 2973</title>

        <link rel="icon" href="http://rockers2973.com/favicon.ico" type="image/icon" target="_top"/>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" href="css/main.css" />

        <link rel="stylesheet" type="text/css" href="css/rockersStandard.css" />

        <link rel="stylesheet" type="text/css" href="css/site.css" /> <!-- FULL SITE CSS --->

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="js/globalScripts.js"></script>

        <script src="js/colorLib.js"></script>

    </head>

    <body style='background: linear-gradient(to top left, #171d22, #1F47A9, #1F47A9, #CC483F); background-size: cover; background-position: center;'>

            <div id='mr_pageHeader' style='z-index:100; font-family: "Open Sans", sans-serif;'>

                <ul id='navigation'>

                    	<li style='color:white;' class='leftTitle'><img src='/images/MRText.svg'></img></li>

                    	<li style='color:white;' id='NavText' class='largeElement leftId'></li>

                      <!--

                      test code for slide over menu

                      <li>
                        <div class='container' onclick='myFunction(this)'>
                          <div class='bar1'></div>
                          <div class='bar2'></div>
                          <div class='bar3'></div>
                        </div>
                      </li>

                      <script>
                      function myFunction(x) {
                          x.classList.toggle('change');
                        }
                      </script>

                      <style>
                      .container {
                        display: inline-block;
                        cursor: pointer;
                      }

                      .bar1, .bar2, .bar3 {
                        width: 35px;
                        height: 5px;
                        background-color: #333;
                        margin: 6px 0;
                        transition: 0.4s;
                      }

                      .change .bar1 {
                        -webkit-transform: rotate(-45deg) translate(-9px, 6px);
                        transform: rotate(-45deg) translate(-9px, 6px);
                      }

                      .change .bar2 {opacity: 0;}

                      .change .bar3 {
                        -webkit-transform: rotate(45deg) translate(-8px, -8px);
                        transform: rotate(45deg) translate(-8px, -8px);
                      }
                    </style>--->

											<li><a class='resize' id='cDDH' href='https://www.firstinspires.org/' target='_blank' style='background-color: white;line-height:0px;padding-left:0px;padding-right:0px; border-radius: 10px;'>

													<img style='margin: 15px 25px;' width='50px' height='30px' id='cDDH' src="images/icon2.png"></img>

												</a>

											</li>

                      <li><a class='resize' id='cDDH' href='http://www.bestinc.org/' target='_blank' style='background-color: white;line-height:0px;padding-left:0px;padding-right:0px; border-radius: 10px;'>

													<img style='margin: 7.5px 12.5px;' width='75px' height='45px' id='cDDH' src="images/BEST icon.png"></img>

												</a>

											</li>

											<?php

                        $fileCur = 0;

                        $fileName = basename($_SERVER['SCRIPT_NAME']);

                        $ctp = "background-color:rgba(0,0,0,0.25);";

                        if ($fileName=="index.php")

                            $fileCur = 1;

                        else if ($fileName=="blog.php")

                            $fileCur = 2;

                        else if ($fileName=="about.php")

                            $fileCur = 3;

                        else if ($fileName=="competitions.php")

                            $fileCur = 4;

                    	?>
                    <li><a class='largeElement' style='color:white;' href='http://rockers2973.com/parentpage.php'>FAQs</a></li>

                    <li><a class='largeElement' style='color:white;' href='http://rockers2973.com/about.php#Contact'>Contact</a></li>

                    <li><a class='largeElement' style='color:white;<?php if($fileCur==4){echo $ctp;}?>' href='<?php echo  $GLOBALS['linkRoot']; ?>competitions.php' target="_top">Competitions</a></li>

                    <li><a class='largeElement' style='color:white;<?php if($fileCur==3){echo $ctp;}?>' href='<?php echo  $GLOBALS['linkRoot']; ?>about.php' target="_top">About</a></li>

                    <li><a class='largeElement' style='color:white;<?php if($fileCur==2){echo $ctp;}?>' href='<?php echo  $GLOBALS['linkRoot']; ?>blog.php' target="_top">Blog</a></li>

                    <li><a class='largeElement' style='color:white;<?php if($fileCur==1){echo $ctp;}?>' href='<?php echo  $GLOBALS['linkRoot']; ?>index.php' target="_top">Home</a></li>



                    <!-- Small Screen Elements -->
                    <li><a class='smallElement' style='display: none;color:white;' href='http://rockers2973.com/parentpage.php'><i class='fa fa-users' aria-hidden='true'></i></a></li>

                    <li><a class='smallElement' style='display: none;color:white;' href='http://rockers2973.com/about.php#Contact'><i class='fa fa-envelope' aria-hidden='true'></i></a></li>

                    <li><a class='smallElement' style='display: none;color:white;<?php if($fileCur==4){echo $ctp;}?>' href='<?php echo  $GLOBALS['linkRoot']; ?>competitions.php' target="_top"><i class='fa fa-gamepad' aria-hidden='true'></i></a></li>

                    <li><a class='smallElement' style='display: none;color:white;<?php if($fileCur==3){echo $ctp;}?>' href='<?php echo  $GLOBALS['linkRoot']; ?>about.php' target="_top"><i class='fa fa-info' aria-hidden='true'></i></a></li>

                    <li><a class='smallElement' style='display: none;color:white;<?php if($fileCur==2){echo $ctp;}?>' href='<?php echo  $GLOBALS['linkRoot']; ?>blog.php' target="_top"><i class='fa fa-rss' aria-hidden='true'></i></a></li>

                    <li><a class='smallElement' style='display: none;color:white;<?php if($fileCur==1){echo $ctp;}?>' href='<?php echo  $GLOBALS['linkRoot']; ?>index.php' target="_top"><i class='fa fa-home' aria-hidden='true'></i></a></li>



                </ul>

            </div>

            <div id='mr_docContainer' onscroll='' style=''>

            <div id='mr_pageHolder' style=''>
