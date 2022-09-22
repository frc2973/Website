<?php
session_start();
?>

<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/dev.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body style='height: 100%; width: 100%; background: linear-gradient(to top left, #171d22, #1F47A9, #1F47A9, #CC483F); background-size: cover; background-position: center; background-repeat: no-repeat; color: white;'>

  <?php
      //To-do: reformat and label everything.
      //To-do: make all the actions more secure, as ALL of them can be done without the devAccessPassword

      include "../sitescript/mrDb.php";//Get access to $GLOBALS['mrdb']
      include "../sitescript/globalmr.php";
      include "../sitescript/mrImage.php";
      include ("../sitescript/blogDecompiler.php");//This should be included after globalmr.

      $madrockersdb = $GLOBALS['mrdb'];
      if ($madrockersdb->connect_error) {("An error has occured.");}

      $notificationText = "";

      if ($_POST['devAccessPassword']=="2973FTW")
      {
          $notificationText  = "Logged On";
          echo '<center><div class="alert">';
          echo $notificationText;
          echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
          echo '</div></center>';
          $_SESSION['madr_devAccess'] = true;
      }
      else if ($_POST['devAccessPassword'])
      {
          $notificationText = "Incorrect Password";
      }

      if ($_GET['devAccessLogOff']=="TRUE")
      {
          $notificationText =  "Logged Off";
          echo '<center><div class="alert">';
          echo $notificationText;
          echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
          echo '</div></center>';
          $_SESSION['madr_devAccess'] = false;
      }

    if ($_SESSION['madr_devAccess'])
    {
        if ($_GET['action']=="newblog")
        {
            $notificationText =  "New Blog Added";
            $title = getGoodTitle($_POST['title']);
            $type = getGoodType($_POST['type']);

            $address= time()."_".rand();
            $sql = "INSERT INTO blogs (title, type, address)
                    VALUES ('".$title."', '".$type."', '".$address."')"; //

            if ($title!=""&&$madrockersdb->query($sql) === TRUE)
            {
                $notificationText =  "New Blog Added";
                $myfile = fopen("../data/blogs/allblogs/".$address.".mrb.txt", "w") or die("Unable to open file!");
                if ($type=="1")
                {
                    fwrite($myfile,">blog icon
                                    Empty
                                    >image1
                                    Empty
                                    >paragraph1
                                    Empty");
                }
                else if ($type=="2")
                {
                    fwrite($myfile,">blog icon
                                    Empty
                                    >image1
                                    Empty
                                    >paragraph1
                                    Empty");
                }
                else if ($type=="-1")
                {
                    fwrite($myfile,">blog icon
                                    Empty
                                    >raw
                                    Empty");
                }
            }
            else
            {
                $notificationText =   "Error: " . $sql . " " . $conn->error;
                if ($title=="")
                {
                    $notificationText="No Title Specified";
                }
            }
        }
        else if ($_GET['action']=="delete")
        {
            $id = getGoodID($_GET['id']);
            $sql = "DELETE FROM blogs WHERE id = ".$id;
            $datar = retrieveData($id);
            //unlink('../data/blogs/allblogs/'.$datar['address'].".mrb.txt");//Be sure to handle deletion of resources. Don't delete dependencies like images.
            if ($madrockersdb->query($sql) === TRUE)
            {
                $notificationText =  "Blog Deleted";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
            else
            {
                $notificationText =   "Error: " . $sql . "" . $conn->error;
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
        }
        else if ($_GET['action']=="renameBlogGo")
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $id = getGoodID($_GET['id']);
                $newTitle = getGoodName($_POST['title']);
                $sql = "UPDATE blogs SET title = '".($newTitle)."' WHERE id = ".$id;
                $datar = retrieveData($id);
                if ($madrockersdb->query($sql) === TRUE)
                {
                    $notificationText =  "Renamed ".$datar['title']." to ".$newTitle."";
                    echo '<center><div class="alert">';
                    echo $notificationText;
                    echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                    echo '</div></center>';
                }
                else
                {
                    $notificationText =   "Error: " . $sql . "" . $conn->error;
                    echo '<center><div class="alert">';
                    echo $notificationText;
                    echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                    echo '</div></center>';
                }
            }
            else
            {
                $notificationText = "Blog rename was attempted but no data was received (REQUEST_METHOD wasn't POST)";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
        }
		 else if ($_GET['action']=="deletegalleryimage")
        {
            $id = getGoodID($_GET['id']);
            $sql = "DELETE FROM gallery WHERE id = ".$id;
            $datar = retrieveData($id);
            if ($madrockersdb->query($sql) === TRUE)
            {
                $notificationText =  "Image Deleted";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
            else
            {
                $notificationText =   "Error: " . $sql . "" . $madrockersdb->error;
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
        }
		else  if ($_GET['action']=="addgalleryimage")
        {
            $notificationText =  "New Image Added";
            $sql = "INSERT INTO gallery (imgid, `desc`) VALUES ('".getGoodID($_POST['gimg'])."', '".getGoodTitle($_POST['desc'])."')"; //
            if ($madrockersdb->query($sql) === TRUE)
            {
                $notificationText =  "Image Added";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
            else
            {
                $notificationText =   "Error: " . $sql . "" . $madrockersdb->error;
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }

        }

        //CALENDAR EVENT EDIT
        else if ($_GET['action']=="newEvent") {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $myDate = ($_POST['eventDate']);
                $myHoursText = getGoodTitle($_POST['eventTime']);
                $myEventName = getGoodTitle($_POST['eventName']);
                $sql = "INSERT INTO calender (name, calenderDate, hoursText) VALUES ('".$myEventName."', '".$myDate."', '".$myHoursText."')";

                if ($madrockersdb->query($sql) !== FALSE)
                {
                    $notificationText =  "Calendar Event Added";
                    echo '<center><div class="alert">';
                    echo $notificationText;
                    echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                    echo '</div></center>';
                }
                else
                {
                    $notificationText =   "Error: " . $sql . "" . $madrockersdb->error;
                    echo '<center><div class="alert">';
                    echo $notificationText;
                    echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                    echo '</div></center>';
                }
            }
            else
            {
                $notificationText = "Calendar upload was attempted but no data was received (REQUEST_METHOD wasn't POST)";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
        }
        else if ($_GET['action']=="deleteEvent") {
          $id = getGoodID($_GET['id']);
          $sql = "DELETE FROM calender WHERE id = ".$id;
          $datar = retrieveData($id);
          if ($madrockersdb->query($sql) === TRUE)
          {
              $notificationText =  "Event Deleted";
              echo '<center><div class="alert">';
              echo $notificationText;
              echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
              echo '</div></center>';
          }
          else
          {
              $notificationText =   "Error: " . $sql . "" . $madrockersdb->error;
              echo '<center><div class="alert">';
              echo $notificationText;
              echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
              echo '</div></center>';
          }
        }
        //Add event edit option later

        else if ($_GET['action']=="updateBlogGo")
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $id = getGoodID($_GET['id']);
                $type = getGoodType($_GET['type']);
                runBlogSaveCode($id,$type,$_POST);
                $notificationText = "Saved Blog ID ".$id."";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
            else
            {
                $notificationText = "Blog update was attempted but no data was received (REQUEST_METHOD wasn't POST)";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
        }
        else if ($_GET['action']=="goUpload")
        {
            $name = getGoodTitle($_POST['name']);
            if ($name=="")
            {
                $notificationText = "No Name Entered";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
            else
            {
                handleStandardImageUpload($name);
                $notificationText = "Image Uploaded With Name: ".$name."";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }
        }
        else if ($_GET['action']=="uploadVideo") {

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $myurl = $_POST['mrVideoUpload'];
                $mydesc = $_POST['desc'];
                $sql = "INSERT INTO videos (`URL`, `DESCRIPTION`) VALUES ('".$myurl."', '".$mydesc."')";
                if ($madrockersdb->query($sql) === TRUE)
                {
                    $notificationText =  "Video Added";
                    echo '<center><div class="alert">';
                    echo $notificationText;
                    echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                    echo '</div></center>';
                }
                else
                {
                    $notificationText =   "Error: " . $sql . "" . $madrockersdb->error;
                    echo '<center><div class="alert">';
                    echo $notificationText;
                    echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                    echo '</div></center>';
                }
            }
            else
            {
                $notificationText = "Video upload was attempted but no data was received (REQUEST_METHOD wasn't POST)";
                echo '<center><div class="alert">';
                echo $notificationText;
                echo '<span class="closebtn" onclick="this.parentElement.style.display="none";>&times;</span>';
                echo '</div></center>';
            }

        }
    }

    if ($_SESSION['madr_devAccess'] == true)
    {
        echo '<div id="contentContainer"><div id="contentHeader">';
        echo '<h2>MAD ROCKERS Development Page</h2></div>';
        echo '<div id="contentHolder"><div id="navContainer"><button onclick="location.replace(\'index.php?p=blogs\')";>BLOGS</button>';
        echo '<button onclick="location.replace(\'index.php?p=upload\')";>UPLOAD</button>';
        echo '<button onclick="location.replace(\'index.php?p=calender\')";>CALENDAR</button>';
        echo '<button onclick="location.replace(\'index.php?p=gallery\')";>GALLERY</button>';
        echo '<button onclick="location.replace(\'index.php?p=videos\')";>VIDEOS</button>';
        echo '<button style="background-color: rgba(220,20,60,0.25); border-bottom-left-radius: 10px; height: 50px !important;" onclick="location.replace(\'index.php?devAccessLogOff=TRUE\')";>LOG OFF</button>';
        echo '</div><div id="actionContainer">';
        $p = $_GET['p'];
        if ($p=="blogs") //BLOG PAGE
        {
            echo "<div><h1>Blogs</h1>";
            if ($_GET['action'] == "edit"||$_GET['action'] == "updateBlogGo")
            {
                echo "<hr>";
                $id = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['id']);
                $info = retrieveData($id);
                $structData = blogRawToStructured(retrieveSource($info), $info);
                echo "<h3>Edit blog: ".$info['title']." (".$info['id'].")</h3>Remember to hit update at the bottom when you are finished, or your work won't be saved.<br>";
                echo "<p>Blog type: ".$info['type']."";
                /*if ($info['type']=="-1")
                {
                    echo "<div style='display:inline-block;'>Title TimeDate<br><span class='editable'>raw</span></div><br><br>";
                }
                else if ($info['type']=="1")
                {
                    echo "<table style='display:inline-block;'><tr><td><span class='editable'>image1</span></td><td>Title TimeDate<br><span class='editable'>paragraph1</span></td></tr></table><br><br>";
                }
                else if ($info['type']=="2")
                {
                    echo "<table style='display:inline-block;'><tr><td>Title TimeDate<br><span class='editable'>paragraph1</span></td><td><span class='editable'>image1</span></td></tr></table><br><br>";
                }
                else {
                    echo "error";
                }*/
                //Make a function to replace " and < with temp characters... " with \" and < with
                echo '<form action="index.php?p=blogs&action=updateBlogGo&type='.$info['type'].'&id='.$id.'" method="post">';
                if ($info['type']==1)
                {
                    echo '<h3>Blog Icon</h3><input name="blogSicon" id="inp_blog icon" style="display:none;" type="text" placeholder="title" value="'.makeTempSafeDoubleQuote($structData['blog icon']).'">';//DO NOT REMOVE! No longer using this method, but it is still required.
                    echo imageSelector($structData['blog icon'], "inp_blog icon")."<br>";
                    echo '<h3>Blog Image</h3><input name="image1" id="inp_image1" style="display:none;" type="text" placeholder="title" value="'.makeTempSafeDoubleQuote($structData['image1']).'">';//DO NOT REMOVE! No longer using this method, but it is still required.
                    echo imageSelector($structData['image1'], "inp_image1")."<br>";
                    echo '<h3>Blog Text</h3><textarea style="border: none; border-radius: 4px; font-size: 16px; background-color: rgba(0,0,0,0.25); color: white; padding: 20px; resize: none;" name="paragraph1" rows="20" cols="100">'.makeTempSafeTag($structData['paragraph1']).'</textarea><br>';
                }
                else  if ($info['type']==2)
                {
                    echo '<h3>Blog Icon</h3><input name="blogSicon" id="inp_blog icon" style="display:none;" type="text" placeholder="title" value="'.makeTempSafeDoubleQuote($structData['blog icon']).'">';//DO NOT REMOVE! No longer using this method, but it is still required.
                    echo imageSelector($structData['blog icon'], "inp_blog icon")."<br>";
                    echo '<h3>Blog Image</h3><input name="image1" id="inp_image1" style="display:none;" type="text" placeholder="title" value="'.makeTempSafeDoubleQuote($structData['image1']).'">';//DO NOT REMOVE! No longer using this method, but it is still required.
                    echo imageSelector($structData['image1'], "inp_image1")."<br>";
                    echo '<h3>Blog Text</h3><br><textarea style="border: none; border-radius: 4px; font-size: 16px; background-color: rgba(0,0,0,0.25); color: white; padding: 20px; resize: none;" name="paragraph1" rows="20" cols="100">'.makeTempSafeTag($structData['paragraph1']).'</textarea><br>';
                }
                else if ($info['type']==-1)
                {
                    echo '<h3>Blog Icon</h3><input name="blogSicon" id="inp_blog icon" style="display:none;" type="text" placeholder="title" value="'.makeTempSafeDoubleQuote($structData['blog icon']).'">';//DO NOT REMOVE! No longer using this method, but it is still required.
                    echo imageSelector($structData['blog icon'], "inp_blog icon")."<br>";
                    echo 'RAW:<br><textarea name="raw" rows="20" cols="200">'.makeTempSafeTag($structData['raw']).'</textarea><br>';
                }
		    	      echo '<br><input id="login" type="submit" value="update"><br></form>';
                echo "<hr><h3>View blog:  ".$info['title']." (".$info['id'].")</h3><div style='margin:20px;'>";
                echo decompileStructured($structData,$info);
                echo "</div>";
            }
            else if ($_GET['action']=="rename")
            {
                echo "<hr>";
                $id = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['id']);
                $info = retrieveData($id);
                echo "<h3>Rename blog: ".$info['title']." (".$info['id'].")</h3>";
                echo '<form action="index.php?p=blogs&action=renameBlogGo&id='.$id.'" method="post">
    			               <input name="title" type="text" placeholder="title" value="'.$info['title'].'"><br>
		    	               <input id="login" type="submit" value="rename"><br>
	        	          </form>';
            }
            echo "<hr>";
            echo "<h2>Add a blog</h2>";
            echo '<form action="index.php?p=blogs&action=newblog" method="post">
    			           <input name="title" type="text" placeholder="title"><br>
    			           <h3>Select a layout</h3>
                     <label class="radioContainer">Image & Text
    			              <input type="radio" name="type" value="1" checked>
                        <span class="checkmark"></span>
                     </label>
                     <label class="radioContainer">Video & Text
    			              <input type="radio" name="type" value="2">
                        <span class="checkmark"></span>
                     </label>
                     <label class="radioContainer">RAW (in testing)
    			              <input type="radio" name="type" value="-1">
                        <span class="checkmark"></span>
                     </label>
		    	           <input id="login" type="submit" value="add"><br>
	    	         </form>';
            echo "<hr>";
            echo "<h3>Blogs:</h3><div>";

            $sql = "SELECT * FROM blogs ORDER BY time DESC";
            $result = $madrockersdb->query($sql);
            if ($result->num_rows > 0) {
                echo "<table><tr><th>ID</th><th>TITLE</th><th>ACTIONS</th><th>TIMEDATE</th><th>TYPE</th><th>OTHER</th></tr>";
                while($row = $result->fetch_assoc())
                {
                    $other= "";//In the future add something for missing images.
                    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["title"]. "</td><td>
                              <button style='width: 50px; overflow: hidden;' onclick=' if (confirm(\"Are you sure you want to delete blog ".$row['title']." (".$row['id'].")?\")){location.replace(\"index.php?p=blogs&action=delete&id=".$row['id']."\");}'><i class='fa fa-trash' aria-hidden='true'></i></button>
                              <button style='width: 50px; overflow: hidden;' onclick='location.replace(\"index.php?p=blogs&action=edit&id=".$row['id']."\")';><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>
                              <button style='width: 50px; overflow: hidden;' onclick='location.replace(\"index.php?p=blogs&action=rename&id=".$row['id']."\")';><i class='fa fa-font' aria-hidden='true'></i></button>
                          </td><td>" . $row["time"]. "</td><td>".$row["type"]."</td><td>".$other."</td></tr>";
                }
                echo "</table>";
            }
            else
            {
                echo "No blogs.<br>";
            }
            echo "</div>";
            echo "</div>";
        }
        else if ($p=="upload") //UPLOAD PAGE
        {
            echo "<h1>Upload Image</h1><hr>";
            echo '<form action="index.php?p=upload&action=goUpload" enctype="multipart/form-data" method="post">
                      <h3>Select an image to upload to the database:</h3>
                      <input type="file" name="mrImageUpload" id="file" class="inputfile">
                      <label for="file"><i class="fa fa-file-image-o" aria-hidden="true"></i> Choose a file</label>
                      <h3>This will be displayed in the gallery, and is just generally useful:</h3>
                      <input name="name" type="text" placeholder="title">
                      <br>
                      <input type="submit" value="upload" name="submit">
                  </form>';
            echo "<h1>Upload Video</h1><hr>";
            echo '<form action="index.php?p=upload&action=uploadVideo" enctype="multipart/form-date" method="post">
                      <h3>Paste URL of video to upload to the database:</h3>
                      <input type="text" name="mrVideoUpload" placeholder="URL">
                      <br>
                      <input type="text" name="desc" placeholder="Description">
                      <br>
                      <input type="submit" value="upload" name="submit">
                  </form>';
        }
	      else if ($p=="calender")
	      {
            //Redo this to only capture upcoming dates, and only get the most recent ones. Calender date comparison should include today's calender events, but it might not.
            $result = $GLOBALS['mrdb']->query("SELECT id, name, calenderDate, hoursText FROM calender WHERE calenderDate >= CURTIME() ORDER BY calenderDate");
            if ($result->num_rows>0)
            {
                 echo "<h1>Calendar</h1>";
                 echo "<hr>";
                 echo "<h2>Upcoming Events</h2>";
				         echo "<table>";
						     echo " <tr>
                          <th>ID</th>
                          <th>Date</th>
                            <th>Time</th>
                            <th>Event</th>
                            <th>Actions</th>
                        </tr>";
                        while($row = $result->fetch_assoc())
                        {
                            echo "<tr>
                                    <td>".$row['id']."</td>
                                    <td>".date("l, M d", strtotime($row['calenderDate']))."</td>
                                    <td>".$row['hoursText']."</td>
                                    <td>".$row['name']."</td>
                                    <td><button style='width: 50px !important;' onclick=' if (confirm(\"Are you sure you want to delete event ".$row['name']." (".$row['id'].")?\")){location.replace(\"index.php?p=calender&action=deleteEvent&id=".$row['id']."\");}'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                                  </tr>";
                        }
            }
            else
            {
                 echo "<h1>Calendar</h1>";
                 echo "<hr>";
                 echo "No upcoming calendar events.";
            }
				    echo "</table><hr>";
            echo '<h2>Add Event</h2>
                  <form action="index.php?p=calender&action=newEvent" enctype="multipart/form-data" method="post">
                    <input name="eventDate" type="datetime-local" placeholder="Date">
                    <br>
                    <input name="eventTime" type="text" placeholder="Time">
                    <br>
                    <input name="eventName" type="text" placeholder="Event Name">
                    <br>
                    <input type="submit" value="Add Event" name="submit">
                  </form>';
	      }
		  else if ($p=="gallery") //GALLERY PAGE
        {
            echo "<div><h1>Gallery</h1><hr><div>";

            $sql = "SELECT * FROM gallery";
            $result = $madrockersdb->query($sql);
            if ($result->num_rows > 0) {
                echo "<table><tr><th>ID</th><th>IMG ID</th><th>ACTIONS</th><th>DESCRIPTION</th></tr>";
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["imgid"]. "</td><td>
                              <button style='width: 50px !important;' onclick=' if (confirm(\"Are you sure you want to delete image ".$row['imgid']." (".$row['id'].")?\")){location.replace(\"index.php?p=gallery&action=deletegalleryimage&id=".$row['id']."\");}'><i class='fa fa-trash' aria-hidden='true'></i></button>
                          </td><td>".$row['desc']."</td></tr>";
                }
                echo "</table>";
            }
            else
            {
                echo "No images.<br>";
            }
            echo "</div>";

			echo "<hr>";
            echo "<h2>Add an image</h2>";
            echo '<form action="index.php?p=gallery&action=addgalleryimage" method="post">';

    			          echo ' <input name="desc" type="text" placeholder="description (max 255)" maxlength="255"><br>';
			 echo '<input name="gimg" id="inp_gimg icon" style="display:none;" type="text" placeholder="title" value="">';//DO NOT REMOVE! No longer using this method, but it is still required.
             echo imageSelector("", "inp_gimg icon")."<br>";

		    	           echo '<input id="login" type="submit" value="add"><br>
	    	         </form>';

            echo "</div>";
        }

    else if ($p == "videos") //VIDEOS PAGE
      {
          echo "<div><h1>VIDEOS</h1><hr><div>";

          $sql = "SELECT * FROM videos";
          $result = $madrockersdb->query($sql);
          if ($result->num_rows > 0) {
              echo "<table><tr><th>ID</th><th>DESCRIPTION</th><th>URL</th></tr>";
              while($row = $result->fetch_assoc())
              {
                  echo "<tr><td>" . $row["id"]. "</td><td>" . $row["DESCRIPTION"]. "</td>
                        </td><td>".$row['URL']."</td></tr>";
              }
              echo "</table>";
          }
          else
          {
              echo "No videos.<br>";
          }
          echo "</div>";
          echo "</div>";
      }
      echo '</div></div></div>';
  }

    else
    {
        echo '<div id="loginContainer">
                <div id="loginHeader"><h2 style="height: 18px;">Development Page</h2></div>
                <div id="loginForm">
                    <form action="index.php" method="post">
                       <center><h3>Enter Password:</h3></center>
			                 <input name="devAccessPassword" type="password" placeholder="password">
			                 <input id="login" type="submit" value="login">
		                </form>
                </div>';
        echo "<center><br><a style='color: white;'href='".$GLOBALS['siteRoot']."'>Back to Website</a></center>";
    }
    $madrockersdb->close();
?></body>
<script>
  // Get all elements with class="closebtn"
  var close = document.getElementsByClassName("closebtn");
  var i;

  // Loop through all close buttons
  for (i = 0; i < close.length; i++) {
    // When someone clicks on a close button
    close[i].onclick = function(){

        // Get the parent of <span class="closebtn"> (<div class="alert">)
        var div = this.parentElement;

        // Set the opacity of div to 0 (transparent)
        div.style.opacity = '0';
     //thank you w3schools

    // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
    setTimeout(function(){ document.getElementsByClassName('alert').style.display = 'none'; }, 600);
  }

  $(document).ready( function() {
        $('.alert').delay(2000).fadeOut(600);
      });

}
</script>
<style>
html, body {
  height:100%;
  width:100%;
  margin:0;
padding:0px;
overflow-y:auto;
}
/* The alert message box */
.alert {
    padding: 10px 15px;
    background-color: rgba(0,0,0,0.25);
    color: white;
    margin-bottom: 20px;
    width: 470px;
    border-radius: 10px;
    height: 25px;
    opacity: 1;
    line-height: 25px;
    font-family: "Open Sans", sans-serif;
    transition: opacity 0.6s;
    overflow: visible;
}

/* The close button */
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
    color: black;
}
</style></html>
