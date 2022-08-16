<?php
	require("scoutConfig.php");
	placeStandardHeader();
?>
<main role='main' class='container'>
	<div class='jumbotron'>
		<div class='container'>
			<h1 class='display-5'>Team Performance</h1>
			<p>This page contains live updates of team performance based on the progress of each match.</p>
		</div>
	</div>
	<div class='card'>
		<div class='card-header'>Graph Test</div>
		<div class='card-body'>
			Graph showing 2973 performance vs Top 3 goes here in the future.
			<!--<canvas id='lineChart'></canvas>--->
		</div>
	</div>
	<br>
	<?php
	try {
		$getTeams = $scoutPDO->prepare("SELECT name, scout_teams.teamnumber, T.matches, T.rankscore FROM scout_teams LEFT OUTER JOIN (SELECT COUNT(teamnumber) AS matches, AVG(scout_reports.rankpoint) AS rankscore, scout_reports.teamnumber FROM scout_reports WHERE scout_reports.type = 1 GROUP BY teamnumber) AS T ON T.teamnumber = scout_teams.teamnumber ORDER BY T.rankscore DESC");
		$getTeams->execute();

		if ($getTeams->rowCount() == 0) {
			echo "No teams entered.<br>";
		}
		else {
			$pos = 1;
		echo"<table class='table table-small table-bordered table-hover'><tr><td>Position</td><td>Team Name</td><td>Team Number</td><td>Matches</td><td>Ranking Score</td></tr>";
			while($row = $getTeams->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>
								<td>".$pos."</td>
								<td>".$row['name']."</td>
								<td>".$row['teamnumber']."</td>
								<td>".$row['matches']."</td>
								<td>".$row['rankscore']."</td>
							</tr>";
				$pos++;
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

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<!--<script>
		//line
		var ctxL = document.getElementById("lineChart").getContext('2d');
		var myLineChart = new Chart(ctxL, {
		type: 'line',
		data: {
		labels: ["January", "February", "March", "April", "May", "June", "July"],
		datasets: [{
		label: "My First dataset",
		data: [65, 59, 80, 81, 56, 55, 40],
		backgroundColor: [
		'rgba(105, 0, 132, .2)',
		],
		borderColor: [
		'rgba(200, 99, 132, .7)',
		],
		borderWidth: 2
		},
		{
		label: "My Second dataset",
		data: [28, 48, 40, 19, 86, 27, 90],
		backgroundColor: [
		'rgba(0, 137, 132, .2)',
		],
		borderColor: [
		'rgba(0, 10, 130, .7)',
		],
		borderWidth: 2
		}
		]
		},
		options: {
		responsive: true
		}
		});
</script>--->
