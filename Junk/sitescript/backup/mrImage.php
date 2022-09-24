<?php



    //Purpose: manage images

    //Copyright Mad Rockers (Evan K) 2017.



    //Pre-Requires globalmr.php and mrDB.php pre-definitions



    //Note(s):

    //This allow images to be renamed and moved while maintaining the image.

    //'name' is the renameable name.

    //'filename' is the physical location, it is in TIME_RAND.extention format

    //DO NOT delete listings of images in the database. You can change the title but only that. Also, don't delete file images.



    $GLOBALS['imageHeaderLink'] = "../images/uploaded/";//This can be altered by requesters.



    function getImage($imageid)//Returns a dataset from the server containing 'id', 'address', 'imageAddress', 'title' and 'image'

    {

        $temp;

        $temp2 = $GLOBALS['mrdb']->query("SELECT * FROM images WHERE id=".getGoodID($imageid));

        if ($temp2->num_rows==1)

        {

            $temp = $temp2->fetch_assoc();

        }

        else

        {

            $temp['id'] = -1;

            $temp['address'] = 'error.png';

            $temp['title'] = 'ERROR: ID '.$imageid." NOT FOUND";

        }

        $temp['imageAddress']= $GLOBALS['imageHeaderLink'].$temp['address'];

        return $temp;

    }



    function imageSelector($curId, $valToAssign)//To-do: make image listings better. Right now they are t e r r i b l e. Just wait until we have tons of images... lagggg

    {

        $instanceId = rand();

        $curId = getGoodID($curId);

        $currentImageSelected = "";

        $imageData = "Empty";

        if ($curId!="")

            $imageData = getImage($curId);

        if ($curId=="")

            $currentImageSelected="Empty";

        else

            $currentImageSelected=$imageData['title']." (".$imageData['id'].")";

        $comp = "";



        //Inline thing:

        $comp.="<div style='display:inline-block;padding:20px; background-color: rgba(0,0,0,0.25); border-radius: 4px;'>

        <table style='height: 50px; border-spacing: none !important;'><tr><td><span style='line-height: 50px; height: 50px;'id='inlineTitle".$instanceId."'>Current image selected: ".$currentImageSelected."</span><br><button type=button style='cursor:pointer; width: 200px;' onclick='cai".$instanceId."();'>Choose Image</button></td><td id='inlineImage".$instanceId."'>";

        if ($currentImageSelected=="Empty")

            $comp .= "<img style='border-radius: 4px;height:100px; margin-left: 20px;' src='". $GLOBALS['imageHeaderLink']."error.png"."'></img>";

        else

            $comp .= "<img style='border-radius: 4px;height:100px; margin-left: 20px;' src='".$imageData['imageAddress']."'></img>";

        $comp .= "</td></tr></table>

        </div><br>";



        //Popup:

        $comp .="

        <div id='overlaysel".$instanceId."' style='display:none;'>

        <div onclick='cai".$instanceId."hide();'  style='cursor:pointer;position:fixed;z-index:5000;left:0px;top:0px;width:100%;height:100%;background-color:rgba(50,50,50,0.3);'>



        </div>

        <div style='overflow-y:scroll;padding:20px;position:fixed;z-index:5001;left:20px;top:20px;width:calc(100% - 40px - 40px);height:calc(100% - 40px - 40px); border-radius: 10px; background-color:white;'>



            <button type='button' style='float:right;margin-left:20px;' onclick='cai".$instanceId."hide();'>Close</button>

        ";

        $comp.="<div style='float:right;'> <table><tr><td style='color: black;' id='trTitle".$instanceId."'>Current image selected: ".$currentImageSelected."<br></td><td id='trImage".$instanceId."'>";

        if ($currentImageSelected=="Empty")

              $comp .= "<img style='height:50px;' src='". $GLOBALS['imageHeaderLink']."error.png"."'></img>";

        else

              $comp .= "<img style='height:50px;' src='".$imageData['imageAddress']."'></img>";

              $comp .= "</td></tr></table></div>";

        $comp.="

            <h1 style='color: black; font-size: 2em;'>Image Selector</h1>

            This lets you select an image from the mad rockers database.<br>

            To upload an image, you have to go to the dev page and click on 'images,' then upload the image from there.<br>

            Select an image from below (It may take a bit for all images to load):

            ";



            $comp.="

            <div style='margin:0px;' id='imagelist".$instanceId."'>

            </div>

        </div>

        </div>

        ";

        //Script

        $comp .= "

        <script>

            var globalImgAddr".$instanceId." = \"".$GLOBALS['imageHeaderLink']."\";

            var inputTo".$instanceId."=\"".$valToAssign."\";

            function cai".$instanceId."()

            {

                document.getElementById('overlaysel".$instanceId."').style.display='block';

                //Show all images

                var tempStr = \"Loading...\";

                document.getElementById('imagelist".$instanceId."').innerHTML=tempStr;

                 var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {

      document.getElementById(\"imagelist".$instanceId."\").innerHTML =

      this.responseText;

    }

  };

  xhttp.open(\"GET\", \"".$GLOBALS['siteRoot']."sitescript/mrImageAjaxResponse.php?requestP=showlist&inst=".$instanceId."\", true);

  xhttp.send();

            }

            function cai".$instanceId."hide()

            {

                document.getElementById('overlaysel".$instanceId."').style.display='none';

            }

            function sii".$instanceId."(imgid,imgtitle,imgaddr)

            {

                document.getElementById(inputTo".$instanceId.").value=\"\"+imgid+\"\";

                document.getElementById(\"inlineImage".$instanceId."\").innerHTML=\"<img style='height:150px; width: 150px; object-fit: cover;' src='\"+imgaddr+\"'></img>\";

                document.getElementById(\"inlineImage".$instanceId."\").innerHTML=\"<img style='height:150px; width: 150px; object-fit: cover;' src='\"+imgaddr+\"'></img>\";

                document.getElementById(\"trImage".$instanceId."\").innerHTML=\"<img style='height:100px; width: 100px; object-fit: cover;' src='\"+imgaddr+\"'></img>\";

                document.getElementById(\"inlineTitle".$instanceId."\").innerHTML=\"Current image selected: \"+imgtitle+\" (\"+imgid+\")\";

                document.getElementById(\"trTitle".$instanceId."\").innerHTML=\"Current image selected: \"+imgtitle+\" (\"+imgid+\")\";

                cai".$instanceId."hide();

            }



        </script>

        ";

        return $comp;

    }



    function handleStandardImageUpload($name)

    {   //Some from W3, some not

        $target_dir = $GLOBALS['imageHeaderLink'];

        $pthi = pathinfo($_FILES["mrImageUpload"]["name"]);

        $fileName = time()."_".rand() .".". $pthi["extension"];

        $target_file = $target_dir . $fileName;

        $uploadOk = 1;

        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);



        // Check if image file is a actual image or fake image

        if(isset($_POST["submit"]) && isset($_FILES['mrImageUpload']) )

        {

            $check = getimagesize($_FILES["mrImageUpload"]["tmp_name"]);

            if($check !== false) {

                // echo "File is an image - " . $check["mime"] . ".";

                $uploadOk = 1;

            }

            else

            {

                die( "File is not an image.");

                $uploadOk = 0;

            }

        }

        else

        {

            die("Error. FAKE IMAGE.");

        }



        // Check if file already exists

        if (file_exists($target_file))

        {

            die( "Sorry, file already exists.");

            $uploadOk = 0;

        }

        // Allow certain file formats

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )

        {

            die( "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");

            $uploadOk = 0;

        }

        if ($uploadOk == 1)

        {

            if (move_uploaded_file($_FILES["mrImageUpload"]["tmp_name"], $target_file))

            {

                //No cap on file size; idc

                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

                //Now push the SQL

                $sql = "INSERT INTO images (title, address) VALUES ('".$name."', '".$fileName."')";

                $GLOBALS['mrdb']->query($sql);

            }

            else

            {

                die("Sorry, there was an error uploading your file.");

            }

        }

    }



?>



<style>

body {

  color: black;

}





</style>
