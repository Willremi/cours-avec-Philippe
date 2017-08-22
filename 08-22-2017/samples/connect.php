<?php

$connection = new mysqli("localhost", "root", "123", "coursSQL1");

if ($connection->connect_error) {
  printf(
    "Erreur de connexion.<br>Message d’erreur: %s<br>Code d’erreur: %s",
    $connection->connect_error,$connection->connect_errno
  );
}
else {
  printf("On est connecté, hourra");
}
?>
