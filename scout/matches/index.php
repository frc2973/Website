<!-- Matches Page --->

<?php
	require("../scoutConfig.php");
	placeStandardHeader();
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<main role='main' class='container bg-dark'>
	<div class='jumbotron'>
		<div class='container'>
			<h1 class='display-5'>Matches</h1>
			<p>This page is where you will input results for each match played during the competition. Matches are grouped by type: Practice, Qualifying, and Competitive. Blue means the team is on Blue Alliance, and red means the team is on Red Alliance. A yellow button means the game has already been entered but can be edited. Make sure you coordinate with teammates to ensure that no one observes the same team.</p>
		</div>
	</div>
	   <?php

	   if (isset($_GET['res']) && $_GET['res']=="good") {
				 echo '<div class="alert alert-success alert-dismissable fade show" role="alert">
				 				<strong>Nice!</strong> You have successfully submitted a report.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    							<span aria-hidden="true">&times;</span>
  							</button>
							</div>';
	   }

	   ?>
		 <script>
		 $('.alert').alert()
		 </script>


	<style>
		.btn {
			width: 100px !important;
		}
	</style>
  <?php
				/*function exists($id, $teamnumber, $matchnumber) {
						$getReports = $scoutPDO->prepare("SELECT * FROM scout_reports ORDER BY teamnumber ")
				}
*/




		function addBlueButton($matchid, $teamnumber, $status) {
			if ($status == 0) {
				echo "<td><button class='btn btn-primary' onclick='location.replace(\"/scout/reports/addreport?returnto=matches&matchid=".$matchid."&teamnumber=".$teamnumber."&type=1&exists=0\");'><i class='fa fa-plus'></i> ".$teamnumber."</button></td>";
			}
			else {
				echo "<td><button class='btn btn-warning' onclick='location.replace(\"/scout/reports/addreport?returnto=matches&matchid=".$matchid."&teamnumber=".$teamnumber."&type=1&exists=1\");'><i class='fa fa-edit'></i> ".$teamnumber."</button></td>";
			}
		}

		function addRedButton($matchid, $teamnumber, $status) {
			if ($status == 0) {
				echo "<td><button class='btn btn-danger' onclick='location.replace(\"/scout/reports/addreport?returnto=matches&matchid=".$matchid."&teamnumber=".$teamnumber."&type=1&exists=0\");'><i class='fa fa-plus'></i> ".$teamnumber."</button></td>";
			}
			else {
				echo "<td><button class='btn btn-warning' onclick='location.replace(\"/scout/reports/addreport?returnto=matches&matchid=".$matchid."&teamnumber=".$teamnumber."&type=1&exists=1\");'><i class='fa fa-edit'></i> ".$teamnumber."</button></td>";
			}
		}


		try {
			//access matches table
			$getMatches = $scoutPDO->prepare("SELECT competitionstage, matchnumber, rednumber1, rednumber2, rednumber3, bluenumber1, bluenumber2, bluenumber3, get_lock_status(matchnumber, rednumber1) r1status, get_lock_status(matchnumber, rednumber2) r2status, get_lock_status(matchnumber, rednumber3) r3status, get_lock_status(matchnumber, bluenumber1) b1status, get_lock_status(matchnumber, bluenumber2) b2status, get_lock_status(matchnumber, bluenumber3) b3status FROM scout_matches ORDER BY competitionstage ASC, matchnumber ASC, id ASC");
			$getMatches->execute();

			//check if matches exist
			if ($getMatches->rowCount() == 0) {
				echo "No matches entered.<br>";
			}

			//if matches exist, begin populating table
			else {
				echo"<div style='width:100%;overflow-x:auto;'><table class='table table-bordered table-dark table-hover table-small' style='color:white;width:100%;'><tr><th>Stage</th><th>Match #</th><th>B1</th><th>B2</th><th>B3</th><th>R1</th><th>R2</th><th>R3</th></tr>";
			//loop through all data values
				while($row = $getMatches->fetch(PDO::FETCH_ASSOC)) {

					//place competition type
					if ($row['competitionstage'] == 0) {
						echo "<tr><td>Practice</td>";
					}
					else if ($row['competitionstage'] == 1) {
						echo "<tr><td>Qualifying</td>";
					}
					else if ($row['competitionstage'] == 2) {
						echo "<tr><td>Playoff</td>";
					}
					else {
						echo "<tr><td>N/A</td>";
					}

					echo "<td>".$row['matchnumber']."</td>";



					addBlueButton($row['matchnumber'],$row['bluenumber1'],$row['b1status']);
					addBlueButton($row['matchnumber'],$row['bluenumber2'],$row['b2status']);
					addBlueButton($row['matchnumber'],$row['bluenumber3'],$row['b3status']);
					addRedButton($row['matchnumber'],$row['rednumber1'],$row['r1status']);
					addRedButton($row['matchnumber'],$row['rednumber2'],$row['r2status']);
					addRedButton($row['matchnumber'],$row['rednumber3'],$row['r3status']);
					echo "</tr>";
				}
				echo "</table></div>";
			}
		}
		catch (PDOException $e) {
			die("Error retrieving team listings: ".$e->getMessage());
		}


  ?>
</main>
</body>
</html>
