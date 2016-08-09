<?php include("db.php");
session_destroy();
session_regenerate_id(TRUE);
session_start();
header("user.php"); exit;
}
?> 
