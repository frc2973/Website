<?php



    //Purpose: compile, decompile, and interpret .mrb.txt files, along with getting database listings. (Interpret Blogs)

    //Copyright Mad Rockers (Evan K) 2017.



    //Note(s):

    //'raw' shouldn't be used as a storage-identifier in the MRB language to avoid confusion.

    //'type' shouldn't be used as a storage-identifier in the MRB language to avoid confusion.

    //Type -1 is a RAW file, aka direct copy code.

    //Storage-value 'Empty' refers to something that is, well, empty. This is not always the case, and for text-based storage, it should be read directly.

    //ALL storage-values are always have a \n or \r\n at the end.



    //When adding a new form layout, update:

    //Dev page selections

    //Decompile structured function

    //Run blog save code

    //'New blog' action in dev

    //Edit-page prelayout

    //Edit-page editors



    $GLOBALS['blogHeaderLink'] = "../data/blogs/allblogs/";//This can be altered by requesters.



    function retrieveData($idOfBlog)

    {

        if ($result = $GLOBALS['mrdb']->query("SELECT * FROM blogs WHERE id = ".$idOfBlog))

        {

            $content = $result->fetch_assoc();

            return $content;

        }

    }

    function retrieveSource($dataOfBlogLocal)//Require data to prevent double sql access

    {

        $path = $GLOBALS['blogHeaderLink'].$dataOfBlogLocal['address'].".mrb.txt";

        $myfile = fopen($path, "r") or die("Unable to open file!");

        $sourceLocal = fread($myfile,filesize($path));

        fclose($myfile);

        return $sourceLocal;

    }

    function makeSafe($value)//To file format

    {

         $value = str_replace(">","\\>",$value);

        $value = str_replace("<","\\<",$value);

        $value = str_replace("\\","\\\\",$value);

            return $value;

    }

    function makeEfft($value)//To variable format

    {

            $value = str_replace("\\\\","\\",$value);

         $value = str_replace("\\>",">",$value);

            $value = str_replace("\\<","<",$value);

            return $value;

    }

    function makeReturnsHTML($value)

    {

        return str_replace("\n","<br>",$value);

    }

    function makeTempSafeDoubleQuote($value)

    {

        return str_replace("\"","\\\"",$value);

    }
	//
    function makeTempSafeSingleQuote($value)

    {

        return str_replace("'","\\'",$value);

    }

    function makeTempSafeTag($value)

    {

        return str_replace("<","&lt;",$value);

    }

    function blogRawToStructured($sourceRaw, $dataOfBlogLocal)

    {

        $localMRB = array();



        $tempStorage = "";





      foreach(preg_split("/((\r?\n)|(\r\n?))/", $sourceRaw) as $line){

          if (substr($line,0,1)==">")

          {

              $tempStorage = substr($line,1);

              $localMRB[$tempStorage] = "";

          }

          else if ($tempStorage!="") {

               $localMRB[$tempStorage]=  $localMRB[$tempStorage].$line."\n";//\n is at the end of each line.

          }

        }



        //In values, > is stored as \>. This, of course, needs to be converted back out. \ is stored as \\.

        foreach ($localMRB as $value)

        {

            $value = makeEfft($value);

        }



        return $localMRB;

    }

    function decompileStructured($structuredData, $dataOfBlogLocal)

    {

				$blogfc = 'black';

        if ($dataOfBlogLocal['type']==-1)

        {

          $compileCode =

          "

            <iframe style='margin: 20px; border-radius: 10px; position: relative; float: left;width: calc(100% - 340px - 40px - 40px); height:500px;' id='BIMAGE' src='https://www.youtube.com/embed/Ehk819_2nL8' frameborder='0' allowfullscreen></iframe>

            <div id='BTEXT' style='text-align: justify; width: 300px; height: 500px; position: relative; margin: 20px; float: left; padding:0px 20px; overflow-y: auto; background-color: rgba(0,0,0,0.25); color: white; border-radius: 10px;'>

              <h2 style='text-align: left;'>".$dataOfBlogLocal['title']."</h2>

              <h3>".date("l, M d", strtotime($dataOfBlogLocal['time']))."</h3>

              <p>".makeReturnsHTML(makeTempSafeTag($structuredData['paragraph1']))."</p>

            </div>

          ";

          return $compileCode;

        }

        else if ($dataOfBlogLocal['type']==1)

        {

					$gimg = getImage($structuredData['image1']);

            $spath;

            $spath = $GLOBALS['siteRoot']."images/uploaded/".$gimg['address'];

            //$spath = "<img style='float:left;max-width:60vw;' src=\"".$spath."\"></img>";

            //shows the content

            $compileCode =

            "

              <div id='BIMAGE' style='width: calc(100% - 340px - 40px - 40px); height:500px; background-image: url(\"".$spath."\"); background-position: center; background-size: cover; margin: 20px; border-radius: 10px; position: relative; float: left;'></div>

              <div id='BTEXT' style='text-align: justify; width: 300px; height: 500px; position: relative; margin: 20px; float: left; padding:0px 20px; overflow-y: auto; background-color: rgba(0,0,0,0.25); color: white; border-radius: 10px;'>

                <h2 style='text-align: left;'>".$dataOfBlogLocal['title']."</h2>

                <h3>".date("l, M d", strtotime($dataOfBlogLocal['time']))."</h3>

                <p>".makeReturnsHTML(makeTempSafeTag($structuredData['paragraph1']))."</p>

              </div>

            ";

            return $compileCode;

        }

        //VIDEO STRUCTURE

        else if ($dataOfBlogLocal['type']==2)

        {
            $blogName = $dataOfBlogLocal['title'];
            $result = $GLOBALS['mrdb']->query("SELECT * FROM videos WHERE DESCRIPTION = \"".$blogName."\"");
            if ($row = $result->fetch_assoc())
            {
            $compileCode =

            "


              <iframe style='margin: 20px; border-radius: 10px; position: relative; float: left;width: calc(100% - 540px - 40px - 40px); height:500px; background-color: rgb(0,0,0);' id='BIMAGE' src='".$row['URL']."?autoplay=1&rel=0' allow='autoplay;' frameborder='0' allowfullscreen></iframe>

              <div id='BTEXT' style='width: 500px; height: 500px; position: relative; margin: 20px; float: left; padding:0px 20px; overflow-y: auto; background-color: rgba(0,0,0,0.25); color: white; border-radius: 10px;'>

                <h1>".$dataOfBlogLocal['title']."</h1>

                <h3>".date("l, M d", strtotime($dataOfBlogLocal['time']))."</h3>

                <p>".makeReturnsHTML(makeTempSafeTag($structuredData['paragraph1']))."</p>

              </div>

            ";
            }

            return $compileCode;

        }









        else{

            die("Type unrecognized.");

        }

    }

    function  runBlogSaveCode($id,$type,$inputs)//When saving, use trim() to remove ending and beginning whitespace. Remember to append a \n to all lines EXCEPT for the last one..

    //ALL LINES EXCEPT FOR THE LAST ONE!

    {

        $data = retrieveData($id);

        if ($type=="2")

        {

            $path = $GLOBALS['blogHeaderLink'].$data['address'].".mrb.txt";

            $myfile = fopen($path, "w") or die("Unable to open file!");

            /*fwrite($myfile,">blog icon\n");

            fwrite($myfile,getGoodID($inputs['blogSicon'])."\n");

            fwrite($myfile,">raw\n");

            fwrite($myfile,makeSafe($inputs['raw']));

            fclose($myfile);*/



            fwrite($myfile,">blog icon\n");

            fwrite($myfile,getGoodID($inputs['blogSicon'])."\n");

            fwrite($myfile,">image1\n");

            fwrite($myfile,getGoodID($inputs['image1'])."\n");

            fwrite($myfile,">paragraph1\n");

            fwrite($myfile,makeSafe(trim($inputs['paragraph1'])));

            fclose($myfile);

        }

        else if ($type=="1")

        {

            $path = $GLOBALS['blogHeaderLink'].$data['address'].".mrb.txt";

            $myfile = fopen($path, "w") or die("Unable to open file!");

            fwrite($myfile,">blog icon\n");

            fwrite($myfile,getGoodID($inputs['blogSicon'])."\n");

            fwrite($myfile,">image1\n");

            fwrite($myfile,getGoodID($inputs['image1'])."\n");

            fwrite($myfile,">paragraph1\n");

            fwrite($myfile,makeSafe(trim($inputs['paragraph1'])));

            fclose($myfile);



        }

        else if ($type=="2")

        {

            $path = $GLOBALS['blogHeaderLink'].$data['address'].".mrb.txt";

            $myfile = fopen($path, "w") or die("Unable to open file!");

            fwrite($myfile,">blog icon\n");

            fwrite($myfile,getGoodID($inputs['blogSicon'])."\n");

            fwrite($myfile,">image1\n");

            fwrite($myfile,getGoodID($inputs['image1'])."\n");

            fwrite($myfile,">paragraph1\n");

            fwrite($myfile,makeSafe(trim($inputs['paragraph1'])));

            fclose($myfile);



        }

        else

        {

            die("Failed to find type in run blog save code");

        }



    }









?>



<style>

  @media only screen and (max-width: 900px) {

    #BIMAGE {

      display: none !important;

    }

    #BTEXT {

      width: calc(100% - 40px - 40px) !important;

    }

  }

</style>
