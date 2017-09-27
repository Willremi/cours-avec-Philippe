<?php
include("config/db.php");
$connection = new mysqli(
  $db_host,
  $db_user,
  $db_password,
  $db_base
);
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" />
  <title>TP PHP: Gestion des promotions et des élèves</title>
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="nav">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Accueil</a></li>
          <li><a href="promotions.php">Promotions</a></li>
          <li><a href="students.php">Élèves</a></li>
        </ul>
      </div>
    </nav>
  </div>
