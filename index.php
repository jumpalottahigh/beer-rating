<?php
  session_start();

  $DB_host = "localhost";
  $DB_username = "root";
  $DB_password = "";
  $DB_database = "test";
  $message = "";

  try {
    $connect = new PDO("mysql:host=$DB_host;dbname=$DB_database", $DB_username, $DB_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //User clicked submit button
    if (isset($_POST["login"])) {
      //A field was left empty
      if (empty($_POST["email"]) || empty($_POST["password"])) {
        $message = '<label>All fields are required</label>';
      } else {
        //Prep query
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $statement = $connect->prepare($query);

        //Query DB for matching email and password
        $statement->execute(
          array(
            'email' => $_POST["email"],
            'password' => $_POST["password"]
          )
        );

        //Count returned rows
        $count = $statement->rowCount();

        if ($count > 0) {
          //Update session email var
          $_SESSION["email"] = $_POST["email"];
          //User logged in, redirect to logged in page
          header("location:index.php");
        } else {
          //No match
          $message = '<label>Wrong email or password!</label>';
        }
      }
    }

    //If user clicked create account button
    if (isset($_POST["create_account_button"])) {
      if (empty($_POST["create_account_name"]) || empty($_POST["create_account_email"]) || empty($_POST["create_account_password"])) {
        $message = '<label>All fields are required</label>';
      } else {
        //Prep and execute insert query
        $query = "INSERT INTO users (name, email, password) VALUES (:create_account_name, :create_account_email, :create_account_password)";
        $statement = $connect->prepare($query);
        //Bind variables
        $statement->bindParam(':create_account_name', $_POST["create_account_name"]);
        $statement->bindParam(':create_account_email', $_POST["create_account_email"]);
        $statement->bindParam(':create_account_password', $_POST["create_account_password"]);
        //Execute
        $statement->execute();

        //After account creation, also log the user in
        $_SESSION["email"] = $_POST["create_account_email"];
        header("location:index.php");
      }
    }

  } catch (PDOException $error) {
    $message = $error->getMessage();
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Beer Comments</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
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
        <a class="navbar-brand" href="index.php">Beer comments</a>
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

  <section>
    <div class="container">
      <!-- If a user is logged in display status message -->

      <?php
        if (isset($_SESSION["email"])) {
          echo '<h4 class="text-right">You are currently logged in as: <span class="text-success">'.$_SESSION["email"].'</span></h4>';
        }
      ?>

      <div class="row">
        <div class="col-xs-12">
          <h1 class="alert alert-info text-center">Beer Comments</h1>
        </div>
      </div>
      <div class="row">
        <!-- Card start -->
        <div class="col-xs-12 col-sm-6">
          <div class="card">
            <div class="col-xs-3">
              <img class="card-image" src="assets/img/carlsberg.jpg" alt="Carlsberg">
            </div>
            <div class="col-xs-8 padding-top">
              <p class="card-description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque fugit natus facere similique obcaecati magni, laudantium excepturi voluptate blanditiis vitae, ad ducimus quasi rerum eveniet mollitia consequatur esse temporibus vel.
              </p>
              <div>
                <a class="btn-card-comments" href="#">Comments</a>
              </div>
            </div>
            <div class="col-xs-1 text-center padding-none card-rating">
              <div class="vote-count" data-count="0">0</div>
              <i class="glyphicon glyphicon-chevron-up text-success vote-control vote-up"></i>
              <i class="glyphicon glyphicon-chevron-down text-danger vote-control vote-down"></i>
            </div>
            <!-- COMMENTS PART OF THE CARD - HIDDEN AT START -->
            <div class="card-comments col-xs-12" style="display:none;">
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Card end -->
        <!-- Card start -->
        <div class="col-xs-12 col-sm-6">
          <div class="card">
            <div class="col-xs-3">
              <img class="card-image" src="assets/img/becks.jpg" alt="Becks">
            </div>
            <div class="col-xs-8 padding-top">
              <p class="card-description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque fugit natus facere similique obcaecati magni, laudantium excepturi voluptate blanditiis vitae, ad ducimus quasi rerum eveniet mollitia consequatur esse temporibus vel.
              </p>
              <div>
                <a class="btn-card-comments" href="#">Comments</a>
              </div>
            </div>
            <div class="col-xs-1 text-center padding-none card-rating">
              <div class="vote-count" data-count="0">0</div>
              <i class="glyphicon glyphicon-chevron-up text-success vote-control vote-up"></i>
              <i class="glyphicon glyphicon-chevron-down text-danger vote-control vote-down"></i>
            </div>
            <!-- COMMENTS PART OF THE CARD - HIDDEN AT START -->
            <div class="card-comments col-xs-12" style="display:none;">
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Card end -->
        <!-- Card start -->
        <div class="col-xs-12 col-sm-6">
          <div class="card">
            <div class="col-xs-3">
              <img class="card-image" src="assets/img/Heineken.jpg" alt="Heineken">
            </div>
            <div class="col-xs-8 padding-top">
              <p class="card-description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque fugit natus facere similique obcaecati magni, laudantium excepturi voluptate blanditiis vitae, ad ducimus quasi rerum eveniet mollitia consequatur esse temporibus vel.
              </p>
              <div>
                <a class="btn-card-comments" href="#">Comments</a>
              </div>
            </div>
            <div class="col-xs-1 text-center padding-none card-rating">
              <div class="vote-count" data-count="0">0</div>
              <i class="glyphicon glyphicon-chevron-up text-success vote-control vote-up"></i>
              <i class="glyphicon glyphicon-chevron-down text-danger vote-control vote-down"></i>
            </div>
            <!-- COMMENTS PART OF THE CARD - HIDDEN AT START -->
            <div class="card-comments col-xs-12" style="display:none;">
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
              <div class="comment">
                <time>8.8.2016</time>
                <span>Username:</span>
                <span>Comment content</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Card end -->
      </div>
    </div>
  </section>

  <!-- Modals -->
  <!-- Login modal -->
  <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center">Login</h4>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <input type="submit" name="login" value="Login" class="btn btn-primary">
            </div>
          </form>
          <!-- Display php errors and status messages here -->
          <?php
            if (isset($message)) {
              echo '<label class="text-danger">'.$message.'</label>';
            }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Create account modal -->
  <div id="create-account-modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center">Create an account</h4>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="form-group">
              <label for="create_account_name">Display name</label>
              <input type="text" class="form-control" id="create_account_name" name="create_account_name" placeholder="Name" required>
            </div>
            <div class="form-group">
              <label for="create_account_email">Email address</label>
              <input type="email" class="form-control" id="create_account_email" name="create_account_email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="create_account_password">Password</label>
              <input type="password" class="form-control" id="create_account_password" name="create_account_password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label for="create_account_confirm_password">Confirm password</label>
              <input type="password" class="form-control" id="create_account_confirm_password" name="create_account_confirm_password" placeholder="Password again" required>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" required> I agree with the TOS.
              </label>
            </div>
            <input type="submit" value="Create" name="create_account_button" class="btn btn-primary">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- jQuery3 -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- App -->
  <script src="assets/js/app.js"></script>
</body>

</html>
