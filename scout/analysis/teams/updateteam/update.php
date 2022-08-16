<?php require "../../sitescript/mrDb.php"; ?>
<html lang="en">
<head>
  <title>Rockers 2973 Scouting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">
  <link rel="stylesheet" href="/scout/scout.css" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>
	<style CSS>
	body{
		background-color: #404040;
	}
	.custom-blue{
		background-color: #1a00a0;
	}
	.custom-red{
		background-color: #cc0000;
	}
	.list-group-reports .list-group-item {
	  border-top: 1px solid #fff;
	  <!--
	  border-left-color: #fff;
	  border-right-color: #fff;-->
	}

	.list-group-reports .list-group-item:hover {
	  background-color: #1a00a0;
	}
	</style>
	<nav class = "navbar navbar-expand-sm custom-blue">
		<ul class="navbar-nav">
			<li class="nav-item">
			  <a class="nav-link text-white" href="/scout/index.php">Home</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link text-white" href="/scout/team_add/index.php">Add a Team</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link text-white" href="/scout/update_team/index.php">Update Team Profile</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link text-white" href="/scout/team_report/index.php">Team Reports</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link text-white" href="/scout/new_match/index.php">New Match</a>
			</li>
		</ul>
	</nav>
  <div class='contentContainer'>
  	<div class='formContainer'>
      <?php
      $conn = $GLOBALS['mrdb'];
      //echo 'test';
      if ($conn->connect_error) {("An error has occured (connect_error).");}
          $id = $_GET['id'];
          //echo $id;
          //access db for previous data
          if ($result = $GLOBALS['mrdb']->query("SELECT * FROM capabilities WHERE id = ".$id." "))
          {
              while($row = $result->fetch_assoc()) {
                //echo $result->num_rows
                $name = $row['NAME'];
                $num = $row['NUM'];
                $hab = $row['HABCLIMB'];
                $climb = $row['HABCLIMB'];
                $hatch = $row['HATCH'];
                $hlvl = $row['HLVL'];
                $cargo = $row['CARGO'];
                $clvl = $row['CLVL'];
                $comments = $row['COMMENTS'];
              }

          }
          else {
            echo "query->(SELECT * FROM capabilities WHERE id = page_id) did not execute.";
          }

          echo "
          <form action='../team.php?action=update&id=".$id."' method='post'>
        		<input type='text' placeholder='".$name."' name='name' value='".$name."'><br>
            <input type='text' placeholder='".$num."' name='number' value='".$num."'><hr>
        		<a class='text-white'>Highest Hab Climb: </a><br>
        		<select name='climb' value='".$climb."'>
        			<option value='1'>Level 1</option>
        			<option value='2'>Level 2</option>
        			<option value='3'>Level 3</option>
        		</select><hr>
        		<input type='checkbox' name='hatch' value='".$hatch."'><a class='text-white'>Hatch Panel? </a><br>
        		<a class='text-white'>If so, highest level? </a><br>
        		<select name='hatch_level' value='".$hlvl."'>
        			<option value='1'>Level 1</option>
        			<option value='2'>Level 2</option>
        			<option value='3'>Level 3</option>
        		</select><hr>
        		<input type='checkbox' name='cargo' value='".$cargo."'><a class='text-white'>Cargo? </a><br>
        		<a class='text-white'>If so, highest level? </a><br>
        		<select name='cargo_level' value='".$clvl."'>
        			<option value='1'>Level 1</option>
        			<option value='2'>Level 2</option>
        			<option value='3'>Level 3</option>
        		</select><hr>
        		<a class='text-white'>Comments:<br></a><textarea value='".$comments."'style='width: -webkit-fill-available; border: none; border-radius: 4px; font-size: 16px; background-color: rgba(0,0,0,0.25); color: white; padding: 20px; resize: none; font-family: 'Roboto Mono';' name='comments' rows='5' cols='50'>".$comments."</textarea><br>
        		<input type='submit' style='background-color: #1a00a0 !important;' name='update_team' value='Update Team'></input><br>
            <input type='reset' name='new_team' value='Clear All'></input>
        	</form>
          <form action='../team.php?action=delete&id=".$id."' method='post'>
            <input type='submit' name='delete_team' value='Delete Team'</input>
          </form>
          ";
      ?>
    </div>
  </div>

</body>
</html>
