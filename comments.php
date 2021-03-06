<?php
  // If user arrives to comments page with no GET parameter
  if (!isset($_GET['beer']) || empty($_GET['beer'])) {
    header("location:index.php");
  }

  session_start();

  require("DB_config.php");

  try {
    $connect = new PDO("mysql:host=$DB_host;dbname=$DB_database", $DB_username, $DB_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // User clicked submit button
    if (isset($_POST["login"])) {
      // A field was left empty
      if (empty($_POST["email"]) || empty($_POST["password"])) {
        $message = '<label>All fields are required!</label>';
      } else {
        // Prep query
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $statement = $connect->prepare($query);

        // Query DB for matching email and password
        $statement->execute(
          array(
            'email' => $_POST["email"],
            'password' => $_POST["password"]
          )
        );

        // Set session name
        foreach ($statement as $row) {
          $_SESSION["name"] = $row["name"];
        }

        // Count returned rows
        $count = $statement->rowCount();

        if ($count > 0) {
          // Update session email var
          $_SESSION["email"] = $_POST["email"];

          // User logged in, redirect to logged in page
          header("location:" . $_SERVER['REQUEST_URI']);
        } else {
          // No match
          $message = '<label>Wrong email or password!</label>';
        }
      }
    }

    // If user clicked create account button
    if (isset($_POST["create_account_button"])) {
      if (empty($_POST["create_account_name"]) || empty($_POST["create_account_email"]) || empty($_POST["create_account_password"])) {
        $message = '<label>All fields are required!</label>';
      } else {
        // Prep and execute insert query
        $query = "INSERT INTO users (name, email, password) VALUES (:create_account_name, :create_account_email, :create_account_password)";
        $statement = $connect->prepare($query);
        // Bind variables
        $statement->bindParam(':create_account_name', $_POST["create_account_name"]);
        $statement->bindParam(':create_account_email', $_POST["create_account_email"]);
        $statement->bindParam(':create_account_password', $_POST["create_account_password"]);
        // Execute
        $statement->execute();

        // After account creation, also log the user in
        $_SESSION["email"] = $_POST["create_account_email"];
        $_SESSION["name"] = $_POST["create_account_name"];
        header("location:" . $_SERVER['REQUEST_URI']);
      }
    }

    // If user has clicked submit a comment button
    if (isset($_POST["sendCommentBtn"])) {
      // And user is logged in
      if (isset($_SESSION["email"]) && isset($_SESSION["name"])) {
        // Can't submit an empty comment
        if (empty($_POST["addCommentTextbox"])) {
          $message = '<label>Can\'t submit an empty comment!</label>';
        } else {
          // Prep and execute insert query
          $query = "INSERT INTO comments (username, comment, beer_name) VALUES (:username, :comment, :beer_name)";
          $statement = $connect->prepare($query);
          // Bind variables
          $statement->bindParam(':username', $_SESSION["name"]);
          $statement->bindParam(':comment', $_POST["addCommentTextbox"]);
          $statement->bindParam(':beer_name', $_GET["beer"]);
          // Execute
          $statement->execute();

          // Refresh the page
          header("location:" . $_SERVER['REQUEST_URI']);
        }
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
        <h2 class="alert alert-info text-center">Comments for <span class="text-success"><?php echo $_GET['beer'] ?></span></h2>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row">
        <div class="panel panel-default">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Comment</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // Grab beer param and prepare SQL statement
                $param = $_GET['beer'];
                $n = 1;
                // INNER JOIN comments and beers tables and fetch the corresponding comments
                $queryStr = 'SELECT * FROM comments INNER JOIN beers ON comments.beer_name = beers.name WHERE name = "'.$param.'"';

                foreach($connect->query($queryStr) as $row) {
                  echo '<tr>
                          <th scope="row">'.$n.'</th>
                          <td>'.$row['username'].'</td>
                          <td>'.$row['comment'].'</td>
                        </tr>';
                  $n++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- Only logged in users can send comments -->
  <?php
    if (isset($_SESSION["email"])) {
      echo '<section>
              <div class="container">
                <div class="row">
                  <h3 class="alert alert-info text-center">Send your comment:</h3>
                  <form method="POST">
                    <div class="form-group">
                      <textarea class="col-xs-12 form-control" id="addCommentTextbox" name="addCommentTextbox" rows="3" placeholder="Review this beer..." required></textarea>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="sendCommentBtn" value="Send" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </section>';
    } else {
      echo '<section>
              <div class="container">
                <div class="row">
                  <h3 class="alert alert-warning text-center">Login or create account if you want to write a comment.</h3>
                </div>
              </div>
            </section>';
    }
  ?>



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
