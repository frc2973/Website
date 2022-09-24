<?php
	require ('../sitescript/mrDb.php');
?>

<html>
	<head>
		<title>Mad Rockers Team 2973 DEV</title>
		<link rel="shortcut icon" href="images/mrFavicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" type="text/css" href="mobile/mobile.css" />
		<link rel="stylesheet" type="text/css" href="../css/about.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto Mono:300" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto Mono+Mono:300" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/globalScripts.js"></script>
		<script src="js/colorLib.js"></script>
		<script src="js/primScript.js"></script>
		</script>
	</head>
	<body style='margin:0;'>
		<div id='mobileContainer'>
			<div id='mobileHeader'>
				<img src='/images/MRText.svg' height='25px'/>
			</div>
			<div id='mobileHolder'>
        <div id='holderUpcoming'>
          <center style='font-size: 2em; font-family: Open Sans;'>Schedule</center>
            <table style='padding-top: 20px; width:100%; text-align: center;'>
  				  <?php
  						//Redo this to only capture upcoming dates, and only get the most recent ones. Calender date comparison should include today's calender events, but it might not.
  						$result = $GLOBALS['mrdb']->query("SELECT name, calenderDate, hoursText FROM calender WHERE calenderDate >= CURTIME() ORDER BY calenderDate ASC LIMIT 4");
							if ($result->num_rows>0)
							{
							echo " <tr>
									<th>Date</th>
									<th>Time</th>
									<th>Event</th>
							</tr>";
									 while($row = $result->fetch_assoc()) {
										 if (date("Y-m-d", strtotime($row['calenderDate'])) == date("Y-m-d")) {
											 echo "
													 <tr>
													 <td>Today</td>
													 <td>".date("h:i A", strtotime($row['calenderDate']))."</td>
													 <td>".$row['name']."</td>
													 </tr>
													 ";
										 }
										 else {
											echo "
													<tr>
													<td>".date("l, M d", strtotime($row['calenderDate']))."</td>
													<td>".date("h:i A", strtotime($row['calenderDate']))."</td>
													<td>".$row['name']."</td>
													</tr>
													";
												}
										}
							}
							else {
									echo "
										<tr>
											<th>Day</th>
											<th>Time</th>
										</tr>
										<tr>
											<td>Monday</td>
											<td>4:00-6:30pm</td>
										</tr>
										<tr>
											<td>Tuesday</td>
											<td>4:00-8:30pm</td>
										</tr>
										<tr>
											<td>Thursday</td>
											<td>6:00-8:30pm</td>
										</tr>
										<tr>
											<td>Saturday</td>
											<td>10:00am-3:30pm</td>
										</tr>
									";

							}
  				   ?>
  				</table>
        </div>
        <div id='holderContactInfo'>
          <center style='font-size: 2em; font-family: Open Sans;'>Contact Us</center>
				  <h4 style='color: white;'>Address of the Pit:</h4>
          <p>222-314 Clipper Ln, Hunstville, AL 35824</p>
          <h4 style='color: white;'>Email the Team:</h4>
          <p><a href='mailto:rockers@enrog.com' style='color: white; text-decoration: underline;'>rockers@enrog.com</a></p>
        </div>
        <div id='holderSponsors'>
          <center style='font-size: 2em; font-family: Open Sans;'>Sponsors</center>
            <ul>Department of Defense STEM</ul>
            <ul>The Boeing Company</ul>
            <ul>United Technologies</ul>
            <ul>Tennessee Valley Authority</ul>
            <ul>Intergraph</ul>
            <ul>Proto Machine Works</ul>
            <ul>National Space Club</ul>
        </div>
				<div id='holderContactInfo' style='margin-bottom: 10px;'>
          <center style='font-size: 2em; font-family: Open Sans;'>Scouting App</center>
				  <h4 style='color: white;'>Mad Rockers Scouting App Link</h4>
          <a target='_blank' href='/scout/index.php'><button class='aboutButton'>Open App <i class='fa fa-arrow-circle-right'></i></button></a>
        </div>
				<div id='disclaimer' style='margin-bottom: 10px;'><center>Mobile website still in development</center></div>
			</div>
		</div>
    <style>
        * {
          font-family: "Roboto Mono", serif;
        }

        h1, h2, h3, h4, th {
          font-family: "Open Sans", sans-serif;
        }

        #mobileContainer {
          height: 100%;
          width: 100%;
					overflow-y: scroll;
					padding-bottom: 10px;
          background: linear-gradient(to top left, #171d22, #1F47A9, #1F47A9, #CC483F); background-size: cover; background-position: center;
        }

        #mobileHeader {
          height: 25px;
          text-align: center;
          padding: 12.5px 0;
        }

        #mobileHolder {
          height: -webkit-fill-available;
          width: -webkit-fill-available;
          color: white;
          overflow-y: visible;
        }

        #holderUpcoming {
          width: -webkit-fill-available;
          height: auto;
          padding: 20px;
					background-color: rgba(0,0,0,0.25);
					border-radius: 10px;
					margin: 10px;
        }

        table {
          text-align: center;
					color: white;
        }

        #holderContactInfo {
  				width: -webkit-fill-available;
          height: auto;
          padding: 20px;
          text-align: center;
					background-color: rgba(0,0,0,0.25);
					margin: 10px;
					border-radius: 10px;
        }

        #holderSponsors {
  				width: -webkit-fill-available;
          height: auto;
          padding: 20px;
          text-align: center;
					background-color: rgba(0,0,0,0.25);
					margin: 10px;
					border-radius: 10px;
        }

        ul {
          padding: 0;
        }

        #disclaimer {
          height: auto;
  				width: -webkit-fill-available;
          padding: 20px;
          color: #FFF;
					background-color: rgba(0,0,0,0.25);
					margin: 10px;
					border-radius: 10px;
        }
    </style>
	</body>
</html>
