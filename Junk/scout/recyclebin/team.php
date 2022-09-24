

<?php require "../sitescript/mrDb.php";?>

<?php
session_start();
?>

<html>
<head>
  <title>Rockers 2973 Scouting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">
  <link rel="stylesheet" href="/scout/scout.css" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=Hammersmith One' rel='stylesheet'>
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
	.nav-item-style{

	}
	a.hidden{
		visibility:hidden;
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
<?php

    $conn = $GLOBALS['mrdb'];
    if ($conn->connect_error) {("An error has occured (connect_error).");}
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //new team action sql function
        if ($_GET['action'] == 'newteam') {
            //variable assignment
            $name = $_POST["name"];
            $num = $_POST["number"];
            $climb = $_POST["climb"];
            $hatch = null;
            if(isset($_POST["hatch"])){
                $hatch = $_POST["hatch"];
            }else{
                $hatch = "0";
            }
            $HLVL = $_POST["hatch_level"];
            $cargo = null;
            if(isset($_POST["cargo"])){
                $cargo = $_POST["cargo"];
            }else{
                $cargo = "0";
            }
            $CLVL = $_POST["cargo_level"];
            $comment = $_POST["comments"];

            $sql = "INSERT INTO capabilities (`NAME`, `NUM`, `HABCLIMB`, `HATCH`, `HLVL`, `CARGO`, `CLVL`, `COMMENTS`) VALUES ('".$name."', '".$num."', '".$climb."', '".$hatch."', '".$HLVL."', '".$cargo."', '".$CLVL."', '".$comment."')";

            if ($conn->query($sql) === TRUE) {
                echo '<h3 class="text-white" align="center">Content Submitted</h3>';
            }
            else {
                die("Connection failed: " . mysqli_connect_error());
                echo '<h3 class="text-white" align="center">There was an error in your submission</h3>';
            }
        }

        //delete action sql function
        else if ($_GET['action'] == 'delete') {
          $id = $_GET['id'];
          $sql = "DELETE FROM capabilities WHERE id = '".$id."'";

          if ($conn->query($sql) === TRUE) {
              echo '<h3 class="text-white" align="center">Content Deleted</h3>';
          }
          else {
              die("SQL submission failed: " . mysqli_connect_error());
              echo '<h3 class="text-white" align="center">There was an error in your submission</h3>';
          }
        }

        //update action sql function
        else if ($_GET['action'] == 'update') {
          $name = $_POST["name"];
          $num = $_POST["number"];
          $climb = $_POST["climb"];
          $hatch = null;
          if(isset($_POST["hatch"])){
              $hatch = $_POST["hatch"];
          }else{
              $hatch = "0";
          }
          $HLVL = $_POST["hatch_level"];
          $cargo = null;
          if(isset($_POST["cargo"])){
              $cargo = $_POST["cargo"];
          }else{
              $cargo = "0";
          }
          $CLVL = $_POST["cargo_level"];
          $comment = $_POST["comments"];
          $id = $_GET['id'];

          $sql = "UPDATE capabilities SET
            `name` = '".$name."',
            `num` = '".$num."',
            `habclimb` = '".$climb."',
            `hatch` = '".$hatch."',
            `hlvl` = '".$HLVL."',
            `cargo` = '".$cargo."',
            `clvl` = '".$CLVL."',
            `comments` = '".$comment."'
            WHERE `id` = '".$id."'";

          if ($conn->query($sql) === TRUE) {
              echo '<h3 class="text-white" align="center">Content Updated</h3>';
          }
          else {
              die("SQL submission failed: " . mysqli_connect_error());
              echo '<h3 class="text-white" align="center">There was an error in your submission</h3>';
          }
        }
    }
    else {
      echo "Upload Attempt Failed (REQUEST_METHOD wasn't POST)";
    }

$conn->close();
?>
<div class="text-center">
<a role="button" class="btn custom-red text-white" href="../../scout/update_team/index.php">Return to Listings</a>
</div>
</body>
</html>
