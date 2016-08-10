<?php
  if (!isset($_SESSION)) {
    session_start();
  }

  $DBservername = "localhost";
  $DBusername = "root";
  $DBpassword = "";
  $DBname = "test";

  function login ($email, $password) {
    global $DBservername, $DBusername, $DBpassword, $DBname;

    try {
      $conn = new PDO("mysql:host=$DBservername;dbname=$DBname", $DBusername, $DBpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT password FROM users WHERE email = '$email'";
      // use exec() because no results are returned
      $conn->exec($sql);
      if ($conn -> rowCount() > 0) {
        echo "Successfully logged in!";
        return TRUE;
      } else {
        echo "Bad credentials!";
        return FALSE;
      }
    }
    catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;


    // Another version to work on
    // try {
    //    $stmt = $this->db->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
    //   $stmt->execute(array(':email'=>$email, ':password'=>$password));
    //   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    //   if($stmt->rowCount() > 0)
    //   {
    //      if($password == $userRow['password'])
    //      {
    //         // $_SESSION['user_session'] = $userRow['user_id'];
    //         echo "Successfully logged in!";
    //         return true;
    //      }
    //      else
    //      {
    //        echo "FAiled to log in!";
    //         return false;
    //      }
    //   }
    //  }
    //  catch(PDOException $e) {
    //  echo $e->getMessage();
    // }
  }

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
?>
