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
          header("location:login_success.php");
        } else {
          //No match
          $message = '<label>Wrong email or password!</label>';
        }
      }
    }

  } catch (PDOException $error) {
    $message = $error->getMessage();
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test</title>
  </head>
  <body>
    <h3>PHP login script using PDO</h3>
    <form method="post">
      <label for="email">Email</label>
      <input type="text" name="email">
      <label for="password">Password</label>
      <input type="password" name="password">
      <br>
      <input type="submit" name="login" value="login">
    </form>

    <br><br><br>
    <!-- Display php errors and status messages here -->
    <?php
      if (isset($message)) {
        echo '<label class="text-danger">'.$message.'</label>';
      }
    ?>
  </body>
</html>
