<?php include("db.php");
if (isset($_POST["name"]) && isset$_POST["psswrd"])) {
$name = $_POST["name"];
$psswrd = $_POST["psswrd"];
if(is_correct_login($name,$psswrd)) {
$_SESSION["name"] = $name;
header("index.php"); exit;
} else {
header("user.php"); exit;
}
}
?>
