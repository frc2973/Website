<!-- Competitions Page Bootstrap --->

<?php
	require ('../sitescript/mrDb.php');
  require ('../mobile/head.php');
?>
<style>
.cover {
  object-fit: cover;
  height: 200px;
}
</style>

  <body>
    <header>
      <nav class = "navbar navbar-expand-md navbar-dark bg-dark mb-3">
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
      				  <a class='nav-link' href="/mobile/mobile.php">Home</a>
      				</li>
      				<li class='nav-item'>
      				  <a class='nav-link' href="/mobile/about.php">About</a>
      				</li>
      				<li class='nav-item'>
      				  <a class='nav-link active' href="/mobile/competitions.php">Competitions</a> <!-- Active --->
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
      <!--<div class='jumbotron'  style='color: black'>
        <div class='container'>
          <h2 class='text-muted'><i class='fa fa-gamepad'></i> Competitions</h2>
        </div>
      </div>--->
      <div class='container'>
        <section>
          <h4>FIRST Competitions</h4>
          <img src="/images/competitions/FIRSTcompKickOff.png" class="img-fluid rounded mb-3" alt="Responsive image">
          <p>Each year, FIRST release a new theme for the annual competition. On FIRST Kickoff Day, the game is revealed and teams begin building the robot. In 2019, the game was called FIRST DEEP SPACE. In 2018 and 2017 the game was called FIRST POWER UP and FIRST STEAMWORKS respectively. This year marks a fundamental shift in the FIRST challenges, as the build period has been extended significantly from 6 weeks to about 12 weeks.</p>
        </section>
        <hr>
        <section>
          <h4>Upcoming Competitions</h4>
          <p>These are the competitions we are planning for this season.</p>
          <div class='card mb-3'>
            <div class='row no-gutters'>
              <div class='col-5'>
                <img class='cover card-img' src='/images/DevWallpaper.jpg'/>
              </div>
              <div class='col-7'>
                <div class='card-body'>
                  <h5 class='card-title mb-2'>Arkansas Regional</h5>
    							<p class='card-text' style='font-weight: 400'>Harding University in Searcy, AR</p>
                  <p class='card-text' style='font-weight: 400'><small class='text-muted'>March 31-April 2, 2022</small></p>
    						</div>
              </div>
					  </div>
          </div>
          <div class='card mb-3'>
            <div class='row no-gutters'>
              <div class='col-5'>
                <img class='cover card-img' src='/images/Comp RCR.jpg'/>
              </div>
              <div class='col-7'>
                <div class='card-body'>
                  <h5 class='card-title'>Rocket City Regional</h5>
    							<p class='card-text' style='font-weight: 400'>Von Braun Center in Huntsville, AL</p>
                  <p class='card-text' style='font-weight: 400'><small class='text-muted'>April 7-9, 2022</small></p>
    						</div>
    					</div>
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
