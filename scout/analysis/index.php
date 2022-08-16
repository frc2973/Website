<!-- Analysis Page --->

<?php
	require("../scoutConfig.php");
	placeStandardHeader();
	$num = 55;
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<main role='main' class='container bg-dark'>
	<div class='jumbotron'>
		<div class='container'>
			<h1 class='display-5'>Analysis</h1>
			<p>On this page, you will interview teams and have the ability to analyze their real time performance.</p>
		</div>
	</div>
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
	.select-size{
		padding: 0;
		width: 80px;
	}
	a.hidden{
		visibility:hidden;
	}
	.btn {
		width: 150px !important;
	}

	</style>
	   <center>
		 <form action="/scout/analysis/index.php" method="post">
			<!--<div class="form-group">Show
				<select name="selectedColumn_length" class="custom-select-sm inline-block">
					<option value="8">8</option>
					<option value="15">15</option>
					<option value="25">25</option>
					<option value="55">55</option>
				</select>
				entries</div>--->
      <div class='card' style='width: 30rem'>
				<div class='card-header'>Options</div>
				<div class='card-body'>
					<h6>Sort By:</h6>
					<div class="form-group">
						<select name="selectedColumn_Sort" class="custom-select-sm inline-block">
							<option value="teamnumber">Team Number</option>
							<option value="cargototal">Cargo</option>
							<option value="endinghablevel">Hab Climb</option>
							<option value="hatchtotal">Hatch Panels</option>
							<option value="rankpoint">Ranking Points</option>
						</select>
					</div>
					<h6>Filter by:</h6>
						<!--<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="typefilter" id="typefilter1" value="0">
						  <label style='font-size: 16px' class="form-check-label" for="typefilter1">
					    	Interviews ONLY
					  	</label>
						</div>
						<div class="form-check form-check-inline">
					  	<input class="form-check-input" type="radio" name="typefilter" id="typefilter2" value="1" checked>
					  	<label style='font-size: 16px' class="form-check-label" for="typefilter2">
					    	Matches ONLY
					  	</label>
						</div>--->
						<script>
							$().button('toggle')
						</script>

						<div class="btn-group btn-group-toggle" data-toggle="buttons">
						  <label class="btn btn-secondary">
						    <input type="radio" name="options" id="typefilter1" autocomplete="off"> Interviews
						  </label>
						  <label class="btn btn-secondary">
						    <input type="radio" name="options" id="typefilter2" autocomplete="off" checked> Matches
						  </label>
						</div>
					</div>
					<input type="submit" class="btn btn-warning" style='margin-bottom: 10px;' name="Update" value="Update"></input>
				</div>
			</form>
	   </center>

  <?php
	if ($_POST['selectedColumn_length'] != NULL) {
		$num = $_POST['selectedColumn_length'];

	}
	$length = (int) $num;
	try {
		$sortColumnSecure = "scout_teams.name ASC";
		switch($_POST['selectedColumn_Sort']) {
			case "teamnumber":
			{
				$sortColumnSecure = "scout_teams.teamnumber ASC";
			}break;
			case "cargototal":
			{
				$sortColumnSecure = "T.cargototalsum DESC";
			}break;
			case "hatchtotal":
			{
				$sortColumnSecure = "T.hatchtotalsum DESC";
			}break;
			case "rankpoint":
			{
				$sortColumnSecure = "T.rankpointsum DESC";
			}break;
			case "endinghablevel":
			{
				$sortColumnSecure = "T.highestendinghab DESC";
			}break;
		}
		$typefilter = (int) $_POST['typefilter'];
		$getTeams = $scoutPDO->prepare("SELECT name, T.matches, scout_teams.teamnumber, T.cargototalsum, T.hatchtotalsum, T.highestendinghab, T.rankpointsum, T.type FROM scout_teams LEFT OUTER JOIN (SELECT COUNT(teamnumber) AS matches, SUM(cargototal) AS cargototalsum, SUM(hatchtotal) AS hatchtotalsum, SUM(rankpoint) AS rankpointsum, MAX(endinghablevel) AS highestendinghab, teamnumber, type FROM scout_reports WHERE scout_reports.type = ".$typefilter." GROUP BY teamnumber) AS T ON scout_teams.teamnumber=T.teamnumber ORDER BY ".$sortColumnSecure." LIMIT ".$length."");
		$getTeams->execute();

		if ($getTeams->rowCount() == 0) {
			echo "No teams entered.<br>";
		}
		else {
			if ($typefilter == 1) {
				echo"<table class='table table-bordered table-dark table-hover table-small' style='color:white;'><tr><th>Team Name</th><th>Team Number</th><th>Interview</th><th>Analyze</th><th>Matches Played</th><th>Cargo Scored</th><th>Hatch Panels Scored</th><th>Highest Hab Climb</th><th>Ranking Points</th></tr>";
			}
			else if ($typefilter == 0) {
				echo"<table class='table table-bordered table-dark table-hover table-small' style='color:white;'><tr><th>Team Name</th><th>Team Number</th><th>Interview</th><th>Analyze</th><th>Interview #</th><th>Cargo Scored</th><th>Hatch Panels Scored</th><th>Highest Hab Climb</th><th>Ranking Points</th></tr>";
			}
			else {
				echo"<table class='table table-bordered table-dark table-hover table-small' style='color:white;'><tr><th>Team Name</th><th>Team Number</th><th>Interview</th><th>Analyze</th><th>Matches Played</th><th>Cargo Scored</th><th>Hatch Panels Scored</th><th>Highest Hab Climb</th><th>Ranking Points</th></tr>";
			}

			while($row = $getTeams->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>
								<td>".$row['name']."</td>
								<td>".$row['teamnumber']."</td>";
								if ($row['matches'] != NULL && $row['type'] == 0) {
									echo "<td><button onclick='location.replace(\"/scout/reports/addreport?returnto=analysis&matchid=0&teamnumber=".$row['teamnumber']."&type=3\");' class='btn btn-warning'><i class='fa fa-edit'></i> Edit</button></td>
										&nbsp;&nbsp;";
								}
								else {
									echo "<td><button onclick='location.replace(\"/scout/reports/addreport?returnto=analysis&matchid=0&teamnumber=".$row['teamnumber']."&type=2\");' class='btn btn-primary'><i class='fa fa-plus'></i> Interview</button></td>
										&nbsp;&nbsp;";
								}
								echo"
									<td><button onclick='location.replace(\"/scout/reports/viewreport?returnto=analysis&teamnumber=".$row['teamnumber']."&typefilter=1\");' class='btn btn-info'><i class='fa fa-chart-pie'></i> Analyze</button>
								</td>
								<td>".$row['matches']."</td>
								<td>".$row['cargototalsum']."</td>
								<td>".$row['hatchtotalsum']."</td>
								<td>".$row['highestendinghab']."</td>
								<td>".$row['rankpointsum']."</td>
							</tr>";
			}
			echo "</table>";
		}
	}
	catch (PDOException $e) {
		die("Error retrieving team listings: ".$e->getMessage());
	}
  ?>
</main>
</body>
</html>
