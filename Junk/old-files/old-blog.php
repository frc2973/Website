<?php include "pageParts/topPart.php";
?>

<script src="js/primScript.js"></script>

<div style='color: white !important; width:calc(100vw); max-width: 1000px; min-height:calc(100vh - 60px); padding: 0px calc((100% - 1000px) / 2);'>
    <?php
        if ($_GET['viewBlog'])
        {
            //echo "<div style='height:20px;'></div>";//Margin
            $blogId = $_GET['viewBlog'];
            $id = preg_replace("/[^a-zA-Z0-9]+/", "", $blogId);
            $info = retrieveData($id);
            echo decompileStructured(blogRawToStructured(retrieveSource($info), $info),$info);
            echo "<center><a href='blog.php'>
                    <button onclick id='blogButton' style='text-align:center; margin: 20px;'><i class='fa fa-arrow-circle-left'></i> Blogs</button>
                  </a></center>";
        }
        else
        {//Show list of blogs
            $offsetText = "";

            if ($_GET['offset'])
            {
                $offsetText = "OFFSET ".preg_replace("/[^0-9]+/", "", $_GET['offset'])*6;
            }
            $totalPages = 0;

            if ($result = $GLOBALS['mrdb']->query("SELECT id FROM blogs"))
            {
                $totalPages = $result->num_rows;
            }
            echo "<div style='line-height:0px;'>";

            if ($result = $GLOBALS['mrdb']->query("SELECT * FROM blogs ORDER BY time DESC ".$offsetText))
            {//THIS WHOLE THING NEEDS TO BE FORMATTED B A D
                if ($result->num_rows > 0) {
                  $count = 0;
                  while($row = $result->fetch_assoc()) {
                    if ($count === 0) {
                        $info = retrieveData($row['id']);
                        $strucd = blogRawToStructured(retrieveSource($info),$info);
                        $gimg2 = getImage($strucd['blog icon']);
                        echo "<div id='bcontLand'>
                                <div id='bActionsLand' onclick='location.replace(\"blog.php?viewBlog=".$info['id']."\");' style='background-image:url(".$gimg2['imageAddress'].");background-size: cover;background-position:center;background-repeat: no-repeat;'></div>
    														<div id='blogContentLand' onclick='location.replace(\"blog.php?viewBlog=".$info['id']."\");'>
                                  <div id='blogDateLand'><span>".date("M d", strtotime($info['time']))."</span></div>
                                  <div id='blogTextLand'>
                                    <h2>".$info['title']."</h2>
                                  </div>
    														</div>
    													</div>";
                        $count++;
                    }

                    else {
                        $info = retrieveData($row['id']);
                        $strucd = blogRawToStructured(retrieveSource($info),$info);
    			              $gimg2 = getImage($strucd['blog icon']);
                        echo "<div id='bcont'>
                                <div id='bActions' onclick='location.replace(\"blog.php?viewBlog=".$info['id']."\");' style='background-image:url(".$gimg2['imageAddress'].");background-size: cover;background-position:center;background-repeat: no-repeat;'></div>
                                <div id='blogContent' onclick='location.replace(\"blog.php?viewBlog=".$info['id']."\");'>
                                  <div id='blogDate'><span>".date("M d", strtotime($info['time']))."</span></div>
                                  <div id='blogText'>
                                    <h4>".$info['title']."</h4>
                                  </div>
    														</div>
    												  </div>";
                    }
                  }
                } else {
                    echo "ERROR";
                }
            }
            echo "</div>";

        //Page options
        /*echo "<br><br><div style='text-align:center;'>Blog listings <span style='font-style:italic;'>sets of 6, most recent</span>: ";
        for ($i= 0;$i<ceil($totalPages/6);$i++)
        {
            echo "<a href='blog.php?offset=".$i."'>".($i+1)."</a> ";
        }
        echo "</div><br><br>";*/
        }
    ?>
</div>

<style>

  @media only screen and (max-width: 910px)
  {
    #bActions {
      width: calc(100vw - 40px) !important;
      position: relative !important;
    }

    #bActions:hover {
        margin: 0 !important;
        width: 100vw !important;
    }

    #BlogContent {
      width: calc(100vw - 40px) !important;
    }

    #bActions:hover > #blogContent {
        width: 100vw !important;
        -webkit-transition-duration: 0s !important;
        -o-transition-duration: 0s !important;
        -moz-transition-duration: 0s !important;
    }
    #bcont {
      width: calc(100vw - 40px) !important;
    }
  }

  #bcont {
      position:relative;
      width:calc((100vw / 3) - 20px);
      max-width: calc((1000px / 3) - 20px);
      margin: 10px;
      height:calc(30vh - 30px - 20px);
      display:inline-block;
      overflow: hidden;
      border-radius: 10px;
      cursor: pointer;
  }

  #bcont:hover #bActions {
      transform: scale(1.05);
  }

  #bcont:hover #blogContent {
      background-color: rgba(0,0,0,1);
  }

  /* in testing for blog page */
  #bcontLand {
      position: relative;
      width: calc(100vw - 20px);
      max-width: 980px;
      margin: 10px;
      height: calc(60vh - 30px - 20px);
      display: inline-block;
      overflow: hidden;
      border-radius: 10px;
      cursor: pointer;
  }

  #bcontLand:hover #bActionsLand {
      transform: scale(1.05);
  }

  #bcontLand:hover #blogContentLand {
      background-color: rgba(0,0,0,1);
  }

  #bActionsLand {
      cursor: pointer;
      position: relative;
      width: 100%;
      height: 100%;
      border-radius: 10px;
      transition-duration: 0.2s;
  }

  #blogContentLand {
      background-color: rgba(0,0,0,0.85);
      width: 30%;
      max-width: 500px;
      height:100%;
      position:absolute;
      left:0px;
      bottom: 0px;
      border-radius: 10px;
      border-top-right-radius: 0px;
      border-bottom-right-radius: 0px;
      transition-duration: 0.2s;
  }

  #blogTextLand {
      text-align:center;
      color: white;
      transform: translate(-50%, -50%);
      left: 50%;
      top: 50%;
      position: absolute;
      width: 100%;
      font-family: 'Open Sans';
      height: auto;
      line-height: 30px;
      overflow: visible;
  }

  #blogDateLand {
      height: 30px;
      width: 90px;
      background-color: white;
      border-radius: 10px;
      color: black;
      transform: translate(-50%,-50%);
      left: 45px;
      top: 10%;
      border-top-left-radius: 0px;
      border-bottom-left-radius: 0px;
      position: absolute;
      font-size: 12px;
  }

  #blogDateLand > span {
      transform: translate(-50%, -50%);
      top: 50%;
      left: 50%;
      text-align: center;
      position: absolute;
      color: black;
      height: 30px;
      line-height: 30px;
  }

  /* end testing styles */

  #bActions {
      cursor:pointer;
      position:relative;
      width:100%;
      height:100%;
      border-radius: 10px;
      transition-duration: 0.2s;
  }

  #bActions:hover > #blogContent {
      width: 100% !important;
      max-width: none !important;
  }

  #blogContent {
      background-color: rgba(0,0,0,0.75);
      width: calc((100vw / 3) - 20px);
      max-width: calc((1000px / 3) - 20px);
      height:75px;
      position:absolute;
      left:0px;
      bottom: 0px;
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
      transition-duration: 0.2s;
  }

  #blogDate {
      height: 30px;
      width: 90px;
      background-color: white;
      border-radius: 10px;
      color: black;
      transform: translate(-50%,-50%);
      left: 45px;
      border-top-left-radius: 0px;
      border-bottom-left-radius: 0px;
      position: absolute;
      font-size: 12px;
  }

  #blogDate > span {
      transform: translate(-50%, -50%);
      top: 50%;
      left: 50%;
      text-align: center;
      position: absolute;
      color: black;
      height: 30px;
      line-height: 30px;
  }

  #blogText {
      text-align:center;
      color: white;
      transform: translate(-50%, -50%);
      left: 50%;
      top: 50%;
      position: absolute;
      width: calc(100% - 75px);
      font-family: 'Open Sans', sans-serif;
  }

  @media only screen and (max-width: 550px)
  {
    h2 {
      font-size: 24px;
    }

    h4 {
      font-size: 18px;
    }
  }
</style>



<div style='display:none;'>

<?php include "pageParts/bottomPart.php"; ?>
