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
        $message = '<label>All fields are required!</label>';
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
        $message = '<label>All fields are required!</label>';
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
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
      <!-- STATUS MESSAGE AREA -->

      <!-- If a user is logged in display status message -->
      <?php
        if (isset($_SESSION["email"])) {
          echo '<h4 class="text-right">You are currently logged in as: <span class="text-success">'.$_SESSION["email"].'</span></h4>';
        }
      ?>

      <!-- Display php errors and status messages here -->
      <?php
        if (isset($message)) {
          echo '<h4 class="text-danger text-right">'.$message.'</h4>';
        }
      ?>

      <div class="row">
        <h1 class="alert alert-info text-center">Comments for <span class="text-success"><?php echo $_GET['beer'] ?></span></h1>
      </div>
    </div>
  </section>

  <section>
    <?php
      //INNER JOIN comments and beers tables and fetch the corresponding comments
      foreach($connect->query('SELECT * FROM comments INNER JOIN beers ON comments.beer_name = beers.name') as $row) {
        echo 'Comment N' . $row['comment_id'];
        echo $row['comment'];
        echo ' by ' . $row['username'];
      }
    ?>
  </section>


  <!-- ADD FOOTER -->
  <?php include("footer.php"); ?>

  <!-- ADD MODALS -->
  <?php include("modals.php"); ?>

  <!-- jQuery3 -->
  <script src="assets/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- App -->
  <script src="assets/js/app.js"></script>
</body>

</html>
