<?php
$srvrname = "localhost";
$uname = "id20933189_fnf";
$pass = "P@ssword1234";
$dbname = "id20933189_project_fnf";

$mysqli = new mysqli($srvrname, $uname, $pass, $dbname);

if ($mysqli->connect_errno) {
  die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}
?> 