<?php
	$id = $_GET['id'];
?>

<html lang="en">
<head>
  <title>Rockers 2973 Scouting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">
  <link rel="stylesheet" href="/scout/scout.css" type="text/css" />
</head>
<body>

  <div class="contentContainer">
  	<h3 class="text-white" align="center">Add Team</h3>
    <div class='formContainer'>
      <form action="../interview.php?id=<?= $id ?>" method="post">
        <h4 class="text-white">Team Number <?= $id ?></h4>
        <hr>
    		<a class="text-white">Highest Hab Climb: </a><br>
    		<select class='custom-select' name="climb">
    			<option value="1">Level 1</option>
    			<option value="2">Level 2</option>
    			<option value="3">Level 3</option>
    		</select><hr>
        <div class="text-white form-check">
          <input class='form-check-input' type="checkbox" id="hatch" name="hatch" value="1">
          <label class="form-check-label" for="hatch">Hatch Panel?</label>
        </div>
    		<a class="text-white">If so, highest level? </a><br>
    		<select class='custom-select' name="hatch_level">
    			<option value="1">Level 1</option>
    			<option value="2">Level 2</option>
    			<option value="3">Level 3</option>
    		</select><hr>
        <div class='text-white form-check'>
      		<input class='form-check-input' type="checkbox" name="cargo" id="cargo" value="1">
          <label class="form-check-label" for="cargo">Cargo?</label>
        </div>
      		<a class="text-white">If so, highest level? </a><br>
    		<select class='custom-select' name="cargo_level">
    			<option value="1">Level 1</option>
    			<option value="2">Level 2</option>
    			<option value="3">Level 3</option>
    		</select><hr>
    		<a class="text-white">Comments:<br></a><textarea class='form-control' placeholder='Comments' name="comments" rows="5" cols="50"></textarea><br>
    		<input class='btn btn-primary btn-lg btn-block' type="Submit" value="Submit"></input>
        <input class='btn btn-secondary btn-lg btn-block' type="Reset"  value="Clear All"></input>
    	</form>
      <center><a href='/scout/analysis'><button style='font-family: "Open Sans";' class='btn btn-warning'>Back to List</button></a></center>
    </div>
  </div>
</body>
</html>
