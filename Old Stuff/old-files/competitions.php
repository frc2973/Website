<?php include "pageParts/topPart.php"; ?>

<link rel="stylesheet" type="text/css" href="css/competitions.css" />
<link rel="stylesheet" type="text/css" href="css/about.css" />

<div id='pageContainer'>
	<div class='compInformation'>
		<h1>FIRST Competitions</h1>
		<img id='splash' src='/images/competitions/FIRSTcompKickOff.png' width='100%' height='300px'/>
		<style>
				#splash {
					object-fit: cover;
					border-radius: 10px;
				}
		</style>
		<p> Each year, FIRST release a new theme for the annual competition. On FIRST Kickoff Day, the game is revealed and teams begin building the robot. In 2019, the game was called FIRST DEEP SPACE. In 2018 and 2017 the game was called FIRST POWER UP and FIRST STEAMWORKS respectively. This year marks a fundamental shift in the FIRST challenges, as the build period has been extended significantly from 6 weeks to about 12 weeks.</p>
	</div>
<!--
	<div id='compInformation'>
		<div id='InformationText'>
			<h2>FIRST Launch 2019</h2>
			<h3>DESTINATION: DEEP SPACE</h3>
			<p>This year's competiton marks the 50th anniversary of the Apollo 11 mission to land a man on the moon! DEEP SPACE is presented by The Boeing Company. This year, the competition revolves around Planet Primus, a world humanity is yet to colonize. The main objectives of the game are to place hatch pieces over port holes in the cargo ship and rockets so that cargo can be placed and transported. The game ends with a "climb" of the hab platform.</p>
			<h3>Find out more:</h3>
			<a target='_blank' href='http://info.firstinspires.org/destination-deep-space'><button class='aboutButton'>DEEP SPACE <i class='fa fa-arrow-circle-right'></i></button></a>
		</div>
		<div id='InformationImage'>
			<iframe width='100%' height='100%' src='https://www.youtube.com/embed/Mew6G_og-PI' frameborder='0' allowfullscreen></iframe>
		</div>
	</div>--->

	<div id='compDescriptionContainer'>
			<h1>Upcoming Competitions</h1>
			<div class='compDescription'>
				<div id='two' class='descLogo'></div>
				<div class='descText'>
					<h2>Smoky Mountain Regional – Possible</h2>
					<h3>WHERE</h3>
					<p>Thompson Boling Arena in Knoxville, TN</p>
					<h3>WHEN</h3>
					<p>March 25-28, 2020</p>
				</div>
			</div>
			<div class='compDescription'>
				<div id='one' class='descLogo'></div>
				<div class='descText'>
					<h2>Rocket City Regional – Confirmed</h2>
					<h3>WHERE</h3>
					<p>Von Braun Center in Huntsville, AL</p>
					<h3>WHEN</h3>
					<p>April 1-4, 2020</p>
				</div>
			</div>

	</div>
	<div id='compDescriptionContainer' style='background-color: rgba(0,0,0,0.25); width: 500px; margin: 20px calc((100% - 500px - 40px) / 2); border-radius: 10px; padding: 20px; text-align: justify;'>
			<h2>Competition Scouting App</h2>
				<img src='/images/logos/ScoutingAppIcon.png' width='100px' height='100px'/>
				<p> Check out our scouting app we created for FIRST competitions! The bulk of it was coded by former team captain Riley Bong and added to by current senior Tom Teper. </p>
				<p><a style='color: white; text-decoration: none'target='_blank' href='/scout/index.php'>Open App <i class='fa fa-external-link'></i></a></p>
	</div>
</div>

<script>
var CountDownDate = new Date("Jan 6, 2019 17:00:00").getTime();
function updCDD() {
  var now = new Date().getTime();
  var timeLeft = CountDownDate - now;
  var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
  var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
  document.getElementById("InnerText").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
  if (timeLeft < 0) {
    clearInterval(update);
    document.getElementById("InnerText").innerHTML = "The Competition Has Begun";
  }
}
$(document).ready(function(){updCDD();setInterval(updCDD, 1000);});


//Thank you W3Schools for this code template

</script>
<div style='display:none;'>
<?php include "pageParts/bottomPart.php"; ?>
