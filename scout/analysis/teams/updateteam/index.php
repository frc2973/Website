



<!-- Index.php for the team update page-->



<?php require "../../sitescript/mrDb.php"; ?>
<html lang="en">
<head>
  <title>Rockers 2973 Scouting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">
  <link rel="stylesheet" href="../scout.css" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>
	
	<?php require("../headerMenu.php"); ?>
  <div class="contentContainer">
  	<h3 class="text-white" align="center">Update Team Profile</h3>
  	<div class="list-group-reports">
  		<?php
  			$conn = $GLOBALS['mrdb'];
  			$sql = "SELECT id, Name, Num FROM capabilities";
  			$result = $conn->query($sql);
  			$total = $result->num_rows;
  			if ($total > 0) {
  			// output data of each row
  			$head1 = '<h3 class="text-white" align="center">';
  			$head2 = ' results</h3>';
  			echo "$head1 $total $head2";
  			while($row = $result->fetch_assoc()) {
  				$name = $row["Name"];
  				$num = $row["Num"];
          $id = $row["id"];
  				$item_front = '<a href="update.php?id='.$id.'" class="list-group-item list-group-item-action custom-red text-white"> Team';
  				$item_back = '</a>';
  				echo "$item_front $num $name $item_back";
  			}
  			} else {
  			echo "0 results";
  			}
  		?>
  	</div>
  </div>

</body>
</html>
