<!-- NEW FEATURE TEST PAGE --->

<?php include "pageParts/topPart.php";?>

<link rel="stylesheet" type="text/css" href="css/testPage.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">

<div id='pageContainer'>
  <center>
    <h1>Experimental Calendar</h1>
  </center>
    <?php
    include 'calendar.php';

    $calendar = new Calendar();

    echo $calendar->show();
    ?>

</div>

<div style='display:none;'>
<?php include "pageParts/bottomPart.php"; ?>
