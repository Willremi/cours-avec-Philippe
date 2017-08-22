<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>


  <?php

  $connection = new mysqli("localhost", "root", "123", "coursSQL1");

  if ($result = $connection->query("SELECT * FROM eleves")) {
    printf("\nLe résultat de la requête contient %d lignes.", $result->num_rows);
    printf("\n<ul>");
    while ($row = $result->fetch_assoc()) {
      printf ("\n<li>%s %s %s</li>", $row["firstname"], $row["lastname"], $row["id"]);
    }

  }
  else {

    printf("Erreur dans la requête");
  }
  ?>
</ul>
</body>
</html>
