<?php
	require("../../scoutConfig.php");
	placeStandardHeader();

	$teamNumber = intval($_GET['teamnumber']);
	$matchid = intval($_GET['matchid']);
	$exists = intval($_GET['exists']);
	$type = intval($_GET['type']);


	if ($exists == 0) {
		if ($type == 2) {
			$title = "Interview Team";
		}
		else if ($type == 3) {
			$title = "Edit Interview";
		}
		else {
			$title = "Add Report";
		}
	}
	else if($exists == 1) {
		$title = "Update Report";
	}
	else {
		$title = "Type Undefined - DO NOT USE";
	}
	/*if (isset($_GET['type'])) {
		$type = intval($_GET['type']);
		if ($type != 0 && $type != 1) {
			$type = 0;
		}
	}*/

	//Retrieve match information
?>
<main role='main' class='container bg-dark'>
	<div class='jumbotron'>
		<div class='container'>
			<h1 class='display-5'>Reports</h1>
			<p>This page allows you to add and update reports for a certain team.</p>
		</div>
	</div>
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
	   <div id="loadingScreen" style="position:fixed;left:0px;top:0px;width:100%;background-color:rgba(0,0,0,0.5);height:100%;z-index:100;color:white;text-align:center;">Loading...</div>


	   <h3 class="text-white" align="center"><?= $title ?> - Team # <?= $teamNumber ?> </h3>
	   <hr>
	   <center>
		 <h4 style="text-align:center;color:white;">Starting Position</h4>
		 <div class='btn-group-vertical' id='startgroup' role='group'>
		   <button class="btn btn-primary" id="startn1">Start Unknown</button>
		   <button class="btn btn-primary" id="start1">Start 1</button>
		   <button class="btn btn-primary" id="start2">Start 2</button>
		 </div>
	   </center>
	   <hr>
	   <h4 style="text-align:center;color:white;">Hatch Level</h4>
	   <center>
		 <div class='btn-group-vertical' role='group'>
		   <button class="btn btn-primary" id="hatchn1">Hatch Unknown</button>
		   <button class="btn btn-primary" id="hatch0">Hatch None</button>
		   <button class="btn btn-primary" id="hatch1">Hatch 1</button>
		   <button class="btn btn-primary" id="hatch2">Hatch 2</button>
		   <button class="btn btn-primary" id="hatch3">Hatch 3</button>
		 </div>
	   </center>
	   <hr>
	   <h4 style="text-align:center;color:white;">Hatch Total</h4>
	   <center>
	   <button class="btn btn-primary" onclick="decr('hatchTotal');">Hatch --</button>
	   <span style="color:white;background-color:black;padding:10px;" id="hatchTotal">0</span>
	   <button class="btn btn-primary" onclick="incr('hatchTotal');">Hatch ++</button>
	   </center>
	   <hr>
	   <h4 style="text-align:center;color:white;">Cargo Level</h4>
	   <center>
		 <div class='btn-group-vertical' role='group'>
		   <button class="btn btn-primary" id="cargon1">Cargo Unknown</button>
		   <button class="btn btn-primary" id="cargo0">Cargo None</button>
		   <button class="btn btn-primary" id="cargo1">Cargo 1</button>
		   <button class="btn btn-primary" id="cargo2">Cargo 2</button>
		   <button class="btn btn-primary" id="cargo3">Cargo 3</button>
		 </div>
	   </center>
	   <hr>
	   <h4 style="text-align:center;color:white;">Cargo Total</h4>
	   <center>
	   <button class="btn btn-primary" onclick="decr('cargoTotal');">Cargo --</button>
	   <span style="color:white;background-color:black;padding:10px;" id="cargoTotal">0</span>
	   <button class="btn btn-primary" onclick="incr('cargoTotal');">Cargo ++</button>
	   </center>
	   <hr>
	   <h4 style="text-align:center;color:white;">Ending Position</h4>
	   <center>
		 <div class='btn-group-vertical' role='group'>
		   <button class="btn btn-primary" id="endn1">End Unknown</button>
		   <button class="btn btn-primary" id="end0">End 0</button>
		   <button class="btn btn-primary" id="end1">End 1</button>
		   <button class="btn btn-primary" id="end2">End 2</button>
		   <button class="btn btn-primary" id="end3">End 3</button>
		 </div>
	   </center>
	   <hr>
		 <h4 style='text-align:center;color:white;'>Ranking Points</h4>
		 <small class="form-text text-muted" style="color: white !important; text-align:center;">Don't ask about ranking points if conducting interview</small>
		 <br>
	   <center>

			   <button class='btn btn-primary' onclick='decr("rankpoint");'>Ranking Points --</button>
			   <span style='color:white;background-color:black;padding:10px;' id='rankpoint'>0</span>
			   <button class='btn btn-primary' onclick='incr("rankpoint");'>Ranking Points ++</button>

	   </center>
	   <hr>
	   <center>
	   <!--<button class="btn btn-warning" id="end3" onclick="if(confirm('Are you sure you want to submit?')){doSubmit();}">Submit</button>--->

		 <!-- Submit Button --->
		 <button class="btn btn-secondary" onclick="location.replace('/scout/matches/index.php')">Back to Matches</button>
		 <button class="btn btn-warning" data-toggle='modal' data-target='#reportsubmit'>Submit Report</button>
	 	 </center>
		 <br>
		 <!-- Modal -->
		 <div class="modal fade" id="reportsubmit" tabindex="-1" role="dialog" aria-labelledby="reportsubmit" aria-hidden="true">
		   <div class="modal-dialog modal-dialog-centered" role="document">
		     <div class="modal-content">
		       <div class="modal-header">
		         <h5 class="modal-title" id="exampleModalCenterTitle">Report Status</h5>
		         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		           <span aria-hidden="true">&times;</span>
		         </button>
		       </div>
		       <div class="modal-body">
		         Are you sure you want to submit? Make sure that all fields are entered correctly before proceeding.
		       </div>
		       <div class="modal-footer">
		         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		         <button type="button" class="btn btn-warning" id="end3" onclick='doSubmit();'>Submit Report</button>
		       </div>
		     </div>
		   </div>
		 </div>
	   <script>
	   var tglArr = [
	       ["hatchn1", "hatch0", "hatch1", "hatch2", "hatch3"],
	       ["cargon1", "cargo0", "cargo1", "cargo2", "cargo3"],
	       ["endn1", "end0", "end1", "end2", "end3"],
	       ["startn1", "start1", "start2"],
	   ];

	   function incr(id) {
	   	   $("#"+id).html(parseInt($("#"+id).html())+1);
	   }
	   function decr(id) {
	   	   $("#"+id).html(parseInt($("#"+id).html())-1);
	   }

	   function getVal(nme) {
	       var btnGenArrItr = -1;
	       for (var i=0;i<tglArr.length;i++) {
			if (tglArr[i][0].length>=nme.length&&tglArr[i][0].substr(0,nme.length)==nme) {
				btnGenArrItr = i;
				break;
			}
		   }
	       if (btnGenArrItr == -1)
	           alert("err");

	       for (var i=0;i<tglArr[btnGenArrItr].length;i++) {
			if ($("#"+tglArr[btnGenArrItr][i]).hasClass("active")) {
				return tglArr[btnGenArrItr][i].substr(nme.length);
				break;
			}
		   }
		   return "n2";
	   }
	   function doSubmit() {
				$("#loadingScreen").show();
		var dataObj = {
			"hatch":getVal("hatch"),
			"start":getVal("start"),
			"end":getVal("end"),
			"cargo":getVal("cargo"),
			"hatchTotal":$("#hatchTotal").html(),
			"cargoTotal":$("#cargoTotal").html(),
			"rankpoint":$("#rankpoint").html(),
			"matchid": <?=$matchid  ?>,
			"teamnum": <?=$teamNumber  ?>,
			"type": <?=$type  ?>
		};
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange=function() {
				if (this.readyState==4&&this.status==200) {
			//Check result, if good continue

				if (this.responseText.length>0) {
				alert("Failed to submit."+this.status+this.statusText+this.responseText);
				$("#loadingScreen").hide();
				return;
				}

				<?php
					$rt = $_GET['returnto'];
					if ($rt=="matches")
						echo "location.replace('../../matches?res=good');";
					else
						echo "location.replace('../../matches?red=good');";
				?>
				}
				else if (this.readyState==4) {
				alert("Failed to submit."+this.status+this.statusText);
				$("#loadingScreen").hide();
				}
			};
			ajax.open("POST","action.php");
			ajax.setRequestHeader("Content-Type","application/json;charset=UTF-8");
			ajax.send(JSON.stringify(dataObj));
	   }



	   function btnClickGeneral() {
	       var btnGenArrItr = -1;
	       var lclid = $(this).attr('id');
	       for (var i = 0; i < tglArr.length; i++) {
	           for (var i2 = 0; i2 < tglArr[i].length; i2++)
	               if (tglArr[i][i2] == lclid) {
	                   btnGenArrItr = i;
	                   i = tglArr.length;
	                   break;
	               }
	       }
	       if (btnGenArrItr == -1)
	           alert("err");
	       for (var i = 0; i < tglArr[btnGenArrItr].length; i++) {
	           if (tglArr[btnGenArrItr][i] != lclid) {
	               $("#" + tglArr[btnGenArrItr][i]).removeClass("active");
	               $("#" + tglArr[btnGenArrItr][i]).addClass("unselectedBtn");
	           } else {

	               $("#" + tglArr[btnGenArrItr][i]).addClass("active");
	               $("#" + tglArr[btnGenArrItr][i]).removeClass("unselectedBtn");
	           }
	       }
	   }
	   for (var i = 0; i < tglArr.length; i++) {
	       $("#" + tglArr[i][0]).addClass("active");
	       for (var i2 = 1; i2 < tglArr[i].length; i2++)
	           $("#" + tglArr[i][i2]).addClass("unselectedBtn");
	       for (var i2 = 0; i2 < tglArr[i].length; i2++)
	           $("#" + tglArr[i][i2]).click(btnClickGeneral);
	   }

				$("#loadingScreen").hide();


	   </script>
</main>
</body>
</html>
