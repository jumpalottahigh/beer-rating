<?php
  session_start();

  require("DB_config.php");

  try {
    $connect = new PDO("mysql:host=$DB_host;dbname=$DB_database", $DB_username, $DB_password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If we have a post event
    if (isset($_POST['beerId']) && isset($_SESSION['email'])) {

      // Save this beer into the user's collection
      // Prep and execute insert query
      $query = 'UPDATE users SET votes = concat(votes, ",'.$_POST['beerId'].'") WHERE email = "'.$_SESSION['email'].'"';
      $statement = $connect->prepare($query);
      // Execute
      $statement->execute();

      //TODO This error checking part needs work
      // // Check if user has already voted
      // foreach($connect->query('SELECT * FROM users WHERE email = "'.$_SESSION['email'].'"') as $user) {
      //   // Create an array with user votes
      //   $userBeerVotes = explode(',', $user['votes']);
      // }
      //
      // // If the user has not voted for the beer with the particular id
      // if (in_array($_POST['beerId'], $userBeerVotes)) {
      //   echo "IN ARRAY" ;
      // } else {
      //   echo "NOT ARRAY";
      // }

      // Update the beer's score
      $query = 'UPDATE beers SET score = score + 1 WHERE id = "'.$_POST['beerId'].'"';
      $statement = $connect->prepare($query);
      $statement->execute();

    }

  } catch (PDOException $error) {
    $message = $error->getMessage();
  }

?>
