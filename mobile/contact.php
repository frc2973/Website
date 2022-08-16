<!-- Contact Page Bootstrap --->

<?php
	require ('../sitescript/mrDb.php');
  require ('../mobile/head.php');
?>
<html class='full-screen'>
  <body class='full-screen'>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
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
      				  <a class='nav-link' href="/mobile/competitions.php">Competitions</a>
      				</li>
              <li class='nav-item'>
      				  <a class='nav-link active' href="/mobile/contact.php">Contact</a> <!-- Active --->
      				</li>
      			</ul>
      		</div>
      	</div>
      </nav>
    </header>
    <main role='main' class='flex-shrink-0 full-screen'>
      <!--<div class='jumbotron' style='color: black'>
        <div class='container'>
          <h2 class='text-muted'><i class='fa fa-envelope'></i> Contact</h2>
        </div>
      </div>--->
      <div class='container'>
        <section>
          <h4>Email</h4>
          <p>Interested in joining or sponsoring our team? Looking for some more information? Send us an email at <a href="mailto:jbailey@madisoncity.k12.al.us" target="_top" style='text-decoration: underline; cursor: pointer;'>jbailey@madisoncity.k12.al.us</a>.</p>
          <!--<form method="post" action="/mobile/contact.php">
            <div class='form-group'> <!-- First Name ->
              <label for="firstname">First Name</label>
              <input name="firstclass" type="text" class="form-control" placeholder='Bob' id="firstname">
            </div>
            <div class='form-group'> <!-- Last Name ->
              <label for="firstname">Last Name</label>
              <input name="lastname" type="text" class="form-control" placeholder='Clemens' id="lastname">
            </div>
            <div class='form-group'> <!-- Email ->
              <label for="email">Email</label>
              <input name="email" type="email" class="form-control" placeholder='bobclemens@madisoncity.k12.al.us' id="email">
            </div>
            <div class='form-group'> <!-- I am a... ->
              <label for="iama">I am a...</label>
              <select class='custom-select' id='iama'>
                <option selected>Choose...</option>
                <option>Student</option>
                <option>Parent</option>
                <option>Sponsor</option>
                <option>Other</option>
              </select>
            </div>
            <div class='form-group'> <!-- Message ->
              <label for="firstname">Message</label>
              <textarea name="message" class="form-control" id="emailmessage" rows="3"></textarea>
            </div>
            <button type='submit' class='btn btn-primary'>Send Email</button>
          </form>-->
        </section>
        <hr>
        <section class='mb-3'>
          <h4>Follow us!</h4>
          <p>Check us out on Instagram!</p>
          <button class='btn btn-primary' target='_blank' href='location.replace("https://www.instagram.com/madrockers2973/");'><i class='fa fa-instagram'></i> Our Page</button>
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
