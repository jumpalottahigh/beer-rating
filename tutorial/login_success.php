<?php
  session_start();

  //User can only access this page if they are logged in
  if (isset($_SESSION["email"])) {
    echo '<h3 class="text-success">Login success! Welcome, '.$_SESSION["email"].'</h3>';
    echo '<br><br><a href="logout.php">Logout</a>';
  } else {
    //Redirect user to login page
    header("location:index.php");
  }
  
?>
