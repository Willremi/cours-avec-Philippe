<?php
header("Access-Control-Allow-Origin: *");
include("../config/db.php");
$connection = new mysqli(
  $db_host,
  $db_user,
  $db_password,
  $db_base
);
$connection->set_charset("utf8");

// The parameter's name is student
if(!isset($_POST["student"])) {
  die(json_encode("No data provided"));
}

$params = json_decode($_POST["student"]);
$request = sprintf("INSERT INTO eleves
                (firstname, lastname, promotion_id)
                VALUES ('%s', '%s', %d)",
                $params->firstname,
                $params->lastname,
                $params->promotion_id);

if($connection->query($request)) {
  echo json_encode("success");
}
else {
  echo json_encode("failure");
}
?>
