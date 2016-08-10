<?php

  include("db.php");

  if (isset($_POST["create-account-name"]) && isset($_POST["create-account-email"]) && isset($_POST["create-account-password"])) {
    $name = $_POST["create-account-name"];
    $email = $_POST["create-account-email"];
    $pass = $_POST["create-account-password"];

    create_user($name, $email, $pass);

  }
?>
