<!-- About Page Bootstrap --->

<?php
	require ('../sitescript/mrDb.php');
  require ('../mobile/head.php');
?>
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
      				  <a class='nav-link active' href="/mobile/about.php">About</a> <!-- Active --->
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
          <h2 class='text-muted'><i class='fa fa-info-circle'></i> About</h2>
        </div>
      </div>--->
      <div class='container'>
        <section>
          <h4>Who are the Mad Rockers?</h4>
          <p>The Mad Rockers Team 2973 are a proud representation of the impact of engineering in the Madison City Schools System. Combining the two high schools in the Madison City region (Bob Jones and James Clemens), our team works to implement the critical thinking and engineering skills required to be successful in the fields of science, engineering, and technology. With the help of our generous sponsors, caring mentors, encouraging schools, and eager students, we hope to spread the values of FIRST and BEST within our community.</p>
        </section>
        <hr>
        <section>
          <h4>Thank you 2019-2020 Sponsors</h4>
          <p>Thanks to our sponsors, students can pursue interests and jobs in careers of engineering. Sponsors support the team with mechanical parts, software, computers, tools, services, knowledge and allow us to compete. We are in debt to everything they provide for us. Check them out below! If you or your company wish to sponsor the team, 2973 The MadRockers, email the team at <a href="mailto:jbailey@madisoncity.k12.al.us" target="_top" style='text-decoration: underline; cursor: pointer;'>jbailey@madisoncity.k12.al.us</a>.</p>
          <hr>
          <ul class='list-unstyled'>
            <li class="media">
              <img src="/images/sponsors/JIT Logo.png" class="mr-3" alt="..." height='64px' width='64px'>
              <div class="media-body">
                <h5 class="mt-0">JIT Services LLC</h5>
                <p>JIT Services is a recognized industry leader in developing and providing supply chain management solutions.</p>
                <p><a href='https://jitservices.com/about/' target='_blank'>More Info</a></p>
              </div>
            </li>
            <hr>
						<li class="media">
              <img src="/images/sponsors/IFP Logo.png" class="mr-3" alt="..." height='64px' width='64px'>
              <div class="media-body">
                <h5 class="mt-0">International Fire Protection Inc.</h5>
                <p>IFP provides the best life safety service to their customers through quality, integrity, honesty, and customer satisfaction.</p>
                <p><a href='https://www.candoifp.com/' target='_blank'>More Info</a></p>
              </div>
            </li>
            <!--<hr>
            <li class="media">
              <img src="/images/sponsors/NSC Logo.png" class="mr-3" alt="..." height='64px' width='64px'>
              <div class="media-body">
                <h5 class="mt-0">National Space Club</h5>
                <p>The National Space Club and Foundation is the foremost entity devoted to fostering excellence in space activity through interaction between industry and government, and through a continuing program of educational support.</p>
                <p><a href='http://www.spaceclub.org/' target='_blank'>More Info</a></p>
              </div>
            </li>
            <hr>
            <li class="media">
              <img src="/images/sponsors/DODSTEM.png" class="mr-3" alt="..." height='64px' width='64px'>
              <div class="media-body">
                <h5 class="mt-0">Department of Defense</h5>
                <p>DoD STEM seeks to attract, inspire, and develop exceptional STEM talent across the education continuum and advance the current DoD STEM workforce to meet future defense technological challenges.</p>
                <p><a href='https://dodstem.us/' target='_blank'>More Info</a></p>
              </div>
            </li>
            <hr>
            <li class="media">
              <img src="/images/sponsors/Boeing Logo.png" class="mr-3" alt="..." height='64px' width='64px'>
              <div class="media-body">
                <h5 class="mt-0">The Boeing Company</h5>
                <p>Boeing is the world's largest aerospace company and leading manufacturer of commercial jetliners, defense, space and security systems, and service provider of aftermarket support.</p>
                <p><a href='https://www.boeing.com' target='_blank'>More Info</a></p>
              </div>
            </li>
            <hr>
            <li class="media">
              <img src="/images/sponsors/UTC Logo.png" class="mr-3" alt="..." height='64px' width='64px'>
              <div class="media-body">
                <h5 class="mt-0">United Technologies</h5>
                <p>UTC serves customers in the commercial aerospace, defense and building industries and ranks among the world’s most respected and innovative companies.</p>
                <p><a href='http://www.utc.com/' target='_blank'>More Info</a></p>
              </div>
            </li>
            <hr>
            <li class="media">
              <img src="/images/sponsors/TVA Logo.png" class="mr-3" alt="..." height='64px' width='64px'>
              <div class="media-body">
                <h5 class="mt-0">Tennessee Valley Authority</h5>
                <p>The Tennessee Valley Authority is a corporate agency of the United States that provides electricity for business customers and local power companies serving 9 million people in parts of seven southeastern states.</p>
                <p><a href='https://www.tva.gov/' target='_blank'>More Info</a></p>
              </div>
            </li>
            <hr>
            <li class="media">
              <img src="/images/sponsors/Proto Logo.png" class="mr-3" alt="..." height='64px' width='64px'>
              <div class="media-body">
                <h5 class="mt-0">Proto Machine Works</h5>
                <p>Industrial Company in Huntsville, Alabama</p>
                <p><a href='https://www.facebook.com/protomachineworks/' target='_blank'>More Info</a></p>
              </div>
            </li>-->
          </ul>
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
