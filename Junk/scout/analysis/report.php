<html lang="en">

<?php require "../../sitescript/mrDb.php";?>
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
	  border-left-color: #fff;
	  border-right-color: #fff;
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
  <?php
  $conn = $GLOBALS['mrdb'];
  if ($conn->connect_error) {("An error has occured (connect_error).");}
    $id = $_GET['id'];
      if ($result = $GLOBALS['mrdb']->query("SELECT * FROM capabilities WHERE id = ".$id." "))
      {
          while($row = $result->fetch_assoc()) {
            $name = $row['NAME'];
            $num = $row['NUM'];
            echo "
              <h3 class='text-white' align='center'>Team ".$num."</h3>
              <div class='card' style='width:400px' align = 'center'>
                <div class='card-body'>
                  <h4 class='card-title'>".$name."</h4>
                  <p class='card-text'>Rocket City Regional</p>
                  <a href='https://www.thebluealliance.com/team/".$num."' class='btn custom-red text-white'>Blue Alliance Profile</a>
                </div>
              </div>
            ";
          }
      }
    ?>
    </div>
</body>
</html>
