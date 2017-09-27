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

  $request = "SELECT * FROM promotions";
  $result = $connection->query($request);

  while ($row = $result->fetch_assoc()) {
    $students[] = $row;
  }
  echo json_encode($students);
?>
