<?

	require("../../scoutConfig.php");
	if ($_SERVER['REQUEST_METHOD']!='POST')
	die("Not post");
	$data = json_decode(file_get_contents("php://input"));

	function retV($val) {
		if (substr($val,0,1)=="n")
			return -intval(substr($val,1));
		return intval($val);
	}
	$hatch = retV($data->hatch);
	$start = retV($data->start);
	$end = retV($data->end);
	$cargo = retV($data->cargo);
	$hatchTotal = retV($data->hatchTotal);
	$cargoTotal = retV($data->cargoTotal);
	$rankPoint = retV($data->rankPoint);
	$matchid = retV($data->matchid);
	$teamnum = retV($data->teamnum);
	$type = retV($data->type);

	try {
		$getTeam = $scoutPDO->prepare("SELECT (Select name from scout_teams), matchid, cargototal, hatchtotal, endinghablevel, rankpoint FROM scout_reports WHERE teamnumber);
		if ($getTeam->rowCount() == 0) {
			echo "No Matches Entered.<br>";
		}
		else {
		echo"<table class='table table-bordered table-dark table-hover' style='color:white;'><tr><td>"Match #"</td><td>Cargo Scored</td><td>Hatch Panels Scored</td><td>Hab Climb</td><td>Ranking Points</td><td>Defense</td></tr>";
			while($row = $getTeams->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>
								<td>".$row['matchid']."</td>
								<td>".$row['cargototal']."</td>
								<td>".$row['hatchtotal']."</td>
								<td>".$row['endinghablevel']."</td>
								<td>".$row['rankpoint']."</td>
								if($row['defense'] == NULL){
									<td>"0"</td>
								}
								else {
									<td>".$row['defense']."</td>
								}
							</tr>";
			}
			echo "</table>";
		}
	}
	catch(PDOException $e) {
		die("excp ".$e->getMessage());
	}
?>
