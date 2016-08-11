<header>
  <!-- Navigation -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand text-primary" href="index.php">Beer comments</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <!-- If no user is logged in, show login and create account buttons -->
          <!-- Otherwise show logout button -->
          <?php
            if (isset($_SESSION["email"])) {
              echo '<li><a href="logout.php" class="btn btn-primary login-button">Logout</a></li>';
            } else {
              echo '<li><a href="#create-account-modal" class="" data-toggle="modal" data-target="#create-account-modal">Create account</a></li>';
              echo '<li><a href="#login-modal" class="btn btn-primary login-button" data-toggle="modal" data-target="#login-modal">Login</a></li>';
            }
          ?>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</header>
