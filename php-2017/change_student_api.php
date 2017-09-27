<?php
  include("config/db.php");
  $connection = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_base
  );

  $_POST = json_decode($_POST);
  $request = sprintf("UPDATE eleves SET
    firstname='%s',
    lastname='%s',
    promotion_id='%s' WHERE id='%s'",
    $_POST["firstname"],
    $_POST["lastname"],
    $_POST["promotion_id"],
    $_POST["id"]);
  if ($connection->query($request)) {
    echo json_encode("success");
  }
  else {
    echo json_encode("failure");
  }
  ?>
