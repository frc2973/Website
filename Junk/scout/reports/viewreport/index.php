<?php
	require("../../scoutConfig.php");
	placeStandardHeader();
	//Retrieve match information
?>
<main class='container bg-dark'>
	<div class="contentContainer">
  <style>
  .selectedBtn {
  background-color:white;
  color:black;
  }
  .selectedBtn:hover {
  background-color:white;
  color:black;
  }

  .unselectedBtn {
  }

  </style>

  <?php
	try {
		$typefilter = (int) $_POST['typefilter'];
		$teamnum = $_GET['teamnumber'];
		$num = (int) $teamnum;
		echo "<div class='jumbotron'>
						<div class='container'>
							<h1 class='display-5'>Team $num Report</h1>
							<p>This page contains Team $num's game statistics.</p>
						</div>
					</div>";

					//total ranking points and ranking score
					$getTeams = $scoutPDO->prepare("SELECT scout_teams.name, scout_teams.teamnumber, T.rankpointsum, T.rankscore FROM scout_teams INNER JOIN (SELECT scout_reports.teamnumber, SUM(scout_reports.rankpoint) AS rankpointsum, AVG(scout_reports.rankpoint) AS rankscore FROM scout_reports WHERE scout_reports.type = 1 GROUP BY teamnumber) AS T WHERE T.teamnumber=".$num." ");
					$getTeams->execute();
					echo "<div class='card text-white bg-dark'>
										<div class='card-header'>
											Tournament Position
										</div>
										<div class='card-body'>
											<div class='row'>";
					if ($getTeams->rowCount() == 0) {
						echo "Missing Data.<br>";
					}
					else {
						$row = $getTeams->fetch(PDO::FETCH_ASSOC);
						echo"<table class='table table-bordered table-dark text-white table-hover'>
									<tr>
										<th>Total Ranking Points</th>
										<th>Ranking Score</th>
									</tr>
									<tr>
										<td>".$row['rankpointsum']."</td>
										<td>".$row['rankscore']."</td>
									</tr>
									</table>";
					}
					echo "</div></div></div><br>";
					echo "<div class='card text-white bg-dark'>
									<div class='card-header'>
										Statistics
									</div>
									<div class='card-body'>
										<div class='row'>";
					//individual match report
					$getTeammatches = $scoutPDO->prepare("SELECT * FROM scout_reports WHERE teamnumber=".$num." ORDER BY matchid ASC");
					$getTeammatches->execute();
					if ($getTeammatches->rowCount() == 0) {
						echo "No Matches entered.<br>";
					}
					else {
					echo"<table class='table table-bordered table-dark text-white table-hover'><tr><th>Match #</th><th>Cargo Scored</th><th>Hatch Panels Scored</th><th>Hab Climb</th><th>Ranking Points</th></tr>";
						while($row = $getTeammatches->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr>";
											if ($row['matchid'] == 0) {
												echo "<td>Interview</td>";
											}else {
												echo "<td>".$row['matchid']."</td>";
											}
							echo"
											<td>".$row['cargototal']."</td>
											<td>".$row['hatchtotal']."</td>
											<td>".$row['endinghablevel']."</td>
											<td>".$row['rankpoint']."</td>
										</tr>";
						}
						echo "</table>";
					}
		 echo"</div></div></div></div><br>";
	}
	catch (PDOException $e) {
		die("Error retrieving team listings: ".$e->getMessage());
	}
	echo "<center><button class='btn btn-warning' onclick='location.replace(\"/scout/analysis/index.php\");'>Back to Analysis</button></center><br>";
  ?>
  </div>
</main>
