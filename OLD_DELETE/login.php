<?php

  include("db.php");

  if (isset($_POST["login-email"]) && isset($_POST["login-password"])) {
    $email = $_POST["login-email"];
    $pass = $_POST["login-password"];

    if (login($email, $pass)) {
      $_SESSION["login-email"] = $email;
      // header("index.php");
      echo 'SUCCESS';
      // header("logged_IN.php");
      exit;
    } else {
      // header("user.php");
      echo 'FAIL';
      // header("FAIL.php");
      exit;
    }

  }

?>
