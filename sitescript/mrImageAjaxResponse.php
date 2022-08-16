<?php

    //Purpose: Respond to requests made by the image selector in mrImage.php
    //Copyright Mad Rockers (Evan K) 2017.

    //Pre-Requires: NOTHING

    //Note(s):
    //Do not include or require this file. This is supposed to be a pure standalone AJAX responder.

    include "globalmr.php";
    include "mrDb.php";
    include "mrImage.php";
    $requestP = $_GET['requestP'];
    if ($requestP=="getImageAddress")
    {
        $curId = getGoodID($_GET['id']);
        $imageData = "Empty";
        if ($curId!="")
         $imageData = getImage($curId);

         if ($imageData!="Empty")
         {
             echo $imageData['address'];
         }
    }
    else if ($requestP=="showlist")
    {
        $inst = $_GET['inst'];
        if ($result =  $GLOBALS['mrdb']->query("SELECT * FROM images ORDER BY time DESC"))
        {
            if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                    echo "<img id='hover' style='height:150px; width: 150px; object-fit: cover; cursor: pointer;' onclick='sii".$inst."(".$row['id'].",\"".$row['title']."\",\"". $GLOBALS['imageHeaderLink'].$row['address']."\");' src=\"". $GLOBALS['imageHeaderLink'].$row['address']."\"></img>";
                }
            } else {
                echo "ERROR";
            }
        }
    }
    else {
        echo "error";
    }
?>

<style>
  #hover:hover {
    opacity: 0.5;
  }
</style>
