<?php
	require("../../scoutConfig.php");
	placeStandardHeader();
?>
  <div class="contentContainer">
	   <h3 class="text-white" align="center">Analysis - Teams</h3>
	   <center>
	   </center>
  </div>
  <?php
	try {
		$getTeams = $scoutPDO->prepare("SELECT * FROM scout_teams ORDER BY teamnumber ASC");
		$getTeams->execute();

		if ($getTeams->rowCount() == 0) {
			echo "No teams entered.<br>";
		}
		else {
		echo"<table class='table' style='color:white;'><tr><td>Team Name</td><td>Team Number</td><td>Option(s)</td></tr>";
			while($row = $getTeams->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr><td>".$row['name']."</td><td>".$row['teamnumber']."</td><td><button>New Interview</button><button>View Reports</button></td></tr>";
			}
			echo "</table>";
		}
	}
	catch (PDOException $e) {
		die("Error retrieving team listings: ".$e->getMessage());
	}
  ?>
