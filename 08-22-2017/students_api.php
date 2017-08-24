<?php
  include("config/db.php");
  $connection = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_base
  );
  $request = "SELECT * FROM eleves";
  $result = $connection->query($request);

  while ($row = $result->fetch_assoc()) {
    $students[] = $row;
  }
  echo json_encode($students);
?>
