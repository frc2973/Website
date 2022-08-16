<?php

    //Pre-Requirements: REQUIRED-NONE


   $GLOBALS['siteRoot']= "http://rockers2973.com"; // This will be updated as the site changes hosts. Don't remove this, you will literally cause so many errors you will regret ever opening this file :)
   $GLOBALS['linkRoot']= substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'], ".com/") + 5);

    //The following functions are used by the blogDecompiler.php to make sure code isn't being injected. They are here to allow the mrImage.php in the future to use them too.

    function getGoodTitle($nameT)//Use to ensure correct formatting of titles
    {
        return preg_replace("/[^a-zA-Z0-9 :]+/", "", $nameT);
    }

    function getGoodName($nameT)//Old function name
    {
        return getGoodTitle($nameT);
    }

    function getGoodID($nameT)//Use to ensure correct formatting of ids
    {
        return preg_replace("/[^0-9]+/", "", $nameT);
    }

    function getGoodType($nameT)
    {
        return preg_replace("/[^0-9-]+/", "", $nameT);
    }

?>
