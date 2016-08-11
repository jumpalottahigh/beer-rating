<?php
  session_start();

  require("DB_config.php");

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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

  <!-- ADD HEADER -->
  <?php include("header.php"); ?>

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

  <!-- ADD FOOTER -->
  <?php include("footer.php"); ?>

  <!-- ADD MODALS -->
  <?php include("modals.php"); ?>

  <!-- jQuery3 -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- App -->
  <script src="assets/js/app.js"></script>
</body>

</html>
