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
	$rankpoint = retV($data->rankpoint);
	$matchid = retV($data->matchid);
	$teamnum = retV($data->teamnum);
	$type = retV($data->type);

	try {
		$getTeammatches = $scoutPDO->prepare("SELECT * FROM scout_reports WHERE teamnumber=".$teamnum." AND matchid=".$matchid." AND type=".$type." ");
		$getTeammatches->execute();
		if ($getTeammatches->rowCount() == 0) {
			//echo "No Matches entered.<br>";

		//}
		//else {
		$insertReport = $scoutPDO->prepare("INSERT INTO scout_reports (matchid,teamnumber,hatchlevel,cargolevel,startinghablevel,endinghablevel,type,hatchtotal,cargototal,rankpoint,lastmodified_date) VALUES (:matchid,:teamnumber,:hatchlevel,:cargolevel,:startinghablevel,:endinghablevel,:type,:hatchtotal,:cargototal,:rankpoint,NOW())");
		$insertReport->bindValue(":matchid", $matchid);
		$insertReport->bindValue(":teamnumber", $teamnum);
		$insertReport->bindValue(":hatchlevel", $hatch);
		$insertReport->bindValue(":cargolevel", $cargo);
		$insertReport->bindValue(":startinghablevel", $start);
		$insertReport->bindValue(":endinghablevel", $end);
		$insertReport->bindValue(":type", $type);
		$insertReport->bindValue(":hatchtotal", $hatchTotal);
		$insertReport->bindValue(":cargototal", $cargoTotal);
		$insertReport->bindValue(":rankpoint", $rankpoint);
		$insertReport->execute();
	}
	else {
		$updateReport = $scoutPDO->prepare("UPDATE scout_reports SET hatchlevel=:hatchlevel, cargolevel=:cargolevel,startinghablevel=:startinghablevel,endinghablevel=:endinghablevel,hatchtotal=:hatchtotal,cargototal=:cargototal,rankpoint=:rankpoint, lastmodified_date=NOW() WHERE teamnumber=".$teamnum." AND matchid=".$matchid." AND type=".$type."");
		//$updateReport->bindValue(":matchid", $matchid);
		//$updateReport->bindValue(":teamnumber", $teamnum);
		$updateReport->bindValue(":hatchlevel", $hatch);
		$updateReport->bindValue(":cargolevel", $cargo);
		$updateReport->bindValue(":startinghablevel", $start);
		$updateReport->bindValue(":endinghablevel", $end);
		//$updateReport->bindValue(":type", $type);
		$updateReport->bindValue(":hatchtotal", $hatchTotal);
		$updateReport->bindValue(":cargototal", $cargoTotal);
		$updateReport->bindValue(":rankpoint", $rankpoint);
		$updateReport->execute();
	}
}
	catch(PDOException $e) {
		die("excp ".$e->getMessage());
	}
?>
