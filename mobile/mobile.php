<!-- Mobile Home Page Bootstrap --->
<?php
	require ('../sitescript/mrDb.php');
	 require ('../mobile/head.php');
	  
	$mobileDBA = $GLOBALS['mrdb_pdo'];

	if ($_GET['action']=="submitEmail") {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			try {
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$email = $_POST['email'];
				$role = $_POST['role'];
				$insertEmail = $mobileDBA->prepare("INSERT INTO clickup_email (`firstname`, `lastname`, `email`, `role`) VALUES ('".$firstname."','".$lastname."','".$email."','".$role."')");
				$insertEmail->execute();
			}
			catch(PDOException $e) {
				die("excp ".$e->getMessage());
			}
		}
		else {
			die("Not POST");
		}
	}
?>

  <body>
    <header>
      <nav class = "navbar navbar-expand-md navbar-dark bg-dark">
      	<div class="container">
      		<div class='navbar-header'>
				<img style='line-height: 50px' src='/images/MRText.svg' height='25px'/>
      		</div>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target='#navbarMR' aria-controls="navbarMR" aria-expanded="false" aria-label="Toggle navigation">
          	<span class="navbar-toggler-icon"></span>
      		</button>
      		<div class='navbar-collapse collapse' id='navbarMR'>
      			<ul class="navbar-nav mr-auto flex-md-row">
      				<li class='nav-item'>
      				  <a class='nav-link active' href="/mobile/mobile.php">Home</a> <!-- Active --->
      				</li>
      				<li class='nav-item'>
      				  <a class='nav-link' href="/mobile/about.php">About</a>
      				</li>
      				<li class='nav-item'>
      				  <a class='nav-link' href="/mobile/competitions.php">Competitions</a>
      				</li>
              <li class='nav-item'>
      				  <a class='nav-link' href="/mobile/contact.php">Contact</a>
      				</li>
      			</ul>
      		</div>
      	</div>
      </nav>
    </header>
    <main role='main' class='flex-shrink-0'>
			<!--<div class='jumbotron' style='color: black'>
				<div class='container'>
					<h2 class='text-muted'><i class='fa fa-home'></i> Home</h2>
				</div>
			</div>--->
			<section>
				<img src="/images/landingPage.png" class="d-block w-100 img-fluid mb-3" alt="Robot at competition">
			</section>
			<div class='container'>
				<!--<section>
					<h4>News</h4>
					<p>Lorem ipsum dolor es</p>
				</section>
				<hr>--->
				<!---
				<section>
					<div class='card'>
						<div class='card-body'>
							<h5 class='card-title mb-2'>Sign up for ClickUp</h5>
							<img src='/images/logos/clickup.png' width='100px' height='100px'/>
							<p class='card-text' style='font-weight: 400'>ClickUp is the season project organization app we are using this year. Submit your name and email below so that you will be added to the app. You will receive an invite soon asking you to download the app. This is where you will see all of the projects and goals we have over the season.</p>
							<form method="post" action="mobile.php?action=submitEmail" enctype="multipart/form-data">
								<div class="form-group">
									<label for="firstname">First Name</label>
									<input name="firstname" type="text" class="form-control" id="firstname" placeholder="Johnny"></input>
								</div>
								<div class="form-group">
									<label for="lastname">Last Name</label>
									<input name="lastname" type="text" class="form-control" id="lastname" placeholder="Appleseed"></input>
								</div>
								<div class="form-group">
									<label for="email">Preferred Email Address</label>
									<input name="email" type="email" class="form-control" id="email" placeholder="apple@android.com"></input>
								</div>
								<div class="form-group">
									<label for="role">What do you want to primarily work on?</label>
									<select name="role" class='custom-select' id='role'>
		                <option value="N/A" selected>Choose...</option>
		                <option value="H">Hardware</option>
		                <option value="S">Software</option>
		                <option value="M">Marketing</option>
										<option value="DT">Drive Team</option>
		                <option value="TBD">Other / No preference at the moment</option>
		              </select>
								</div>
								<small class='text-muted mb-3'>Your name and email will not be shared with anyone outside of the Mad Rockers team administration. Your choice of project does not mean you cannot work in another discipline or change later on. This is simply for organization purposes.</small>
								<br>
								<br>
								<button type="submit" class="btn btn-primary" value="submit">Submit</button>
							</form>
						</div>
					</div>
				</section>
				<hr>
				--->
				<section>
					<h4>Meeting Schedule</h4>
					<!--<p>These are the upcoming events over the next few weeks. The time section shows the starting time. Note that the ending time may be a couple of hours after that.</p>-->
					<table class='table table-sm table-borderless' style='text-align: left;'>
					<?php
						//Redo this to only capture upcoming dates, and only get the most recent ones. Calender date comparison should include today's calender events, but it might not.
						$result = $GLOBALS['mrdb']->query("SELECT name, calenderDate, hoursText FROM calender WHERE calenderDate >= CURTIME() ORDER BY calenderDate ASC LIMIT 4");
						if ($result->num_rows>0)
						{
							echo"<tr>
										<thead>
											<th>Date</th>
											<th>Time</th>
											<th>Event</th>
										</thead>
									 </tr>";
									 while($row = $result->fetch_assoc()) {
											echo "
													<tr>
														<td>".date("l, M d", strtotime($row['calenderDate']))."</td>
														<td>".date("h:i A", strtotime($row['calenderDate']))."</td>
														<td>".$row['name']."</td>
													</tr>
													";
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
											<td>4:15pm-6:30pm</td>
										</tr>
										<tr>
											<td>Tuesday</td>
											<td>4:15pm-8:30pm</td>
										</tr>
										<tr>
											<td>Thursday</td>
											<td>4:15pm-6:30pm</td>
										</tr>
										<tr>
											<td>Saturday</td>
											<td>9:15am-2:30pm</td>
										</tr>
									";

						}
					 ?>
					</table>
				</section>
				<hr>
				<!--<section>
					<div class='card'>
						<div class='card-body'>
							<h5 class='card-title mb-2'>Mad Rockers Scouting App</h5>
							<img src='/images/logos/ScoutingAppIcon.png' width='64px' height='64px'/>
							<p class='card-text' style='font-weight: 400'>Check out our scouting app we created for FIRST competitions! The bulk of it was coded by former team captain Riley Bong and added to by current senior Tom Teper.</p>
							<button class='btn btn-primary' onclick='location.replace("../scout/index.php");'>Open App</button>
						</div>
					</div>
				</section>
				<hr>-->
				<section>
					<h4>Address</h4>
					<p>These are the typical meeting locations for the team this season. "The Pit" is the primary meeting area where we build the robot. Sometimes, we will meet at Bob Jones for logistics and team meetings.</p>
					<div class='card mb-3'>
						<div class='card-body'>
							<h5 class='card-title'>JIT Services LLC</h5>
							<h6 class='card-subtitle mb-2 text-muted'>"The Pit"</h6>
							<p class='card-text' style='font-weight: 400'>125 SW Electronics Blvd, Huntsville, AL 35824</p>
						</div>
					</div>
					<div class='card mb-3'>
						<div class='card-body'>
							<h5 class='card-title'>Bob Jones High School</h5>
							<h6 class='card-subtitle mb-2 text-muted'>Secondary Meeting Location</h6>
							<p class='card-text' style='font-weight: 400'>650 Hughes Rd., Madison, AL 35758</p>
						</div>
					</div>
				</section>
			</div>
    </main>
    <footer class='footer mt-auto py-3' style='background-color: #f5f5f5;'>
			<center>
				<div class='container'>
	        <p class='text-muted'>Mad Rockers FIRST Team 2973 ©2022</p>
	      </div>
			</center>
    </footer>
  </body>
</html>
