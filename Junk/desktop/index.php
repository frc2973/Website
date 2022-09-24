<!-- Website Main Page --->

<?php
  require ('../pageParts/topPart.php');
  require ("sitescript/globalmr.php");
  require ("sitescript/mrDb.php");
  require ("sitescript/mrImage.php");
  require ("sitescript/blogDecompiler.php");
  $GLOBALS['blogHeaderLink']="data/blogs/allblogs/";//Prepare the blog decompiler to handle requests from the front page.
?>

<body class='text-center js-focus-visible'>
  <div class='cover-container d-flex w-100 h-100 p-3 mx-auto flex-column'>
    <header>
      <nav class = "navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
          <div class='navbar-header'>
            <img style='line-height: 50px' src='../images/MRText.svg' height='25px'/></img>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target='#navbarMR' aria-controls="navbarMR" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class='navbar-collapse collapse' id='navbarMR'>
            <ul class="navbar-nav mr-auto flex-md-row">
              <li class='nav-item'>
                <a class='nav-link active' href="/desktop/index.php">Home</a> <!-- Active --->
              </li>
              <li class='nav-item'>
                <a class='nav-link' href="/desktop/about.php">About</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href="/desktop/competitions.php">Competitions</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href="/desktop/contact.php">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main role='main'>
    </main>
  </div>
</body>


<?php
  require ('../desktop/pageParts/bottomPart.php');
?>
