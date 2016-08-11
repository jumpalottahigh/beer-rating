<?php
  session_start();

  require("DB_config.php");

  try {
    $connect = new PDO("mysql:host=$DB_host;dbname=$DB_database", $DB_username, $DB_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If we have a post event
    if (isset($_POST['beerId']) && isset($_SESSION['email'])) {
      // echo $_POST['value'] . ' ' .$_SESSION['email'];
      // echo $_POST['beerId'] . ' ' .$_SESSION['email'];

      // Save this beer into the user's collection
      // Prep and execute insert query
      $query = "UPDATE users (votes) VALUES (:votes)";
      $statement = $connect->prepare($query);
      // Bind variables
      $statement->bindParam(':votes', $_POST['value']);
      // Execute
      $statement->execute();

      // REFACTOR
      // header("location:index.php");

      // TODO
      // Update the beer's score
    }

  } catch (PDOException $error) {
    $message = $error->getMessage();
  }

?>
