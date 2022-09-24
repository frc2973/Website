



<!-- Index.php for the new match page-->



<html lang="en">
<head>
  <title>Rockers 2973 Scouting</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/site.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">
  <link rel="stylesheet" href="/scout/scout.css" type="text/css" />
</head>
<body>
	<?php require("../headerMenu.php"); ?>
  <div class="contentContainer">
  	<h3 class="text-white" align="center">New Match</h3><br>
  	<!-- potential to slide the field all the way to the edge and put a rocket next to the field for easy access -->
  	
  	<br>
  	<div class="text-center">
    	<form action="stat_submission.php">
			<input type="radio"><a class="text-white"> Sandstorm Period</a></input>
			<input type="radio"><a class="text-white">Mid Game Period</a></input>
			<input type="radio"><a class="text-white">End Game Period</a></input><br><br>
			<input type="submit" value="Hatch Panel Scored"></input>
			<input type="submit" value="Cargo Scored"></input>
			<input type="submit" value="LVL 1 Hab"></input>
			<input type="submit" value="LVL 2 Hab"></input>
			<input type="submit" value="LVL 3 Hab"></input>
		</form>
	</div>
  </div>
</body>
</html>
