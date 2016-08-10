<?php
  // REFACTOR
  include("db.php");

  function create_user ($name, $email, $password) {
    global $DBservername, $DBusername, $DBpassword, $DBname;

    try {
      $conn = new PDO("mysql:host=$DBservername;dbname=$DBname", $DBusername, $DBpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO users (name, email, password)
      VALUES ('$name', '$email', $password)";
      // use exec() because no results are returned
      $conn->exec($sql);
      echo "New record created successfully";
    }
    catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
  }

  if (isset($_POST["create-account-name"]) && isset($_POST["create-account-email"]) && isset($_POST["create-account-password"])) {
    $name = $_POST["create-account-name"];
    $email = $_POST["create-account-email"];
    $pass = $_POST["create-account-password"];

    create_user($name, $email, $pass);

  }
?>
