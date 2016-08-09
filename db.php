<!-- THIS IS A DUMMY FILE. DONT EVEN TRY IT :) -->

<?php
if (!isset($_SESSION)) {session_start();}
function is_correct_login($name, $password) {
$db = new PDO("mysql:dbname=myDB;host=localhost;
port=80", "myUsername", "myPassword");
$nm = $db->quote($name);
$rows = $db->query("SELECT password FROM users
WHERE name = $name");
if($rows) {
foreach ($rows as $row) {
if($password===$row["password"]){return TRUE;}
}
return FALSE;
}
?>
