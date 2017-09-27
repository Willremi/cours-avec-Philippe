
  <?php
  include("include/header.php");


  if ($result = $connection->query("SELECT * FROM promotions")) {
    printf("\nLe résultat de la requête contient %d lignes.", $result->num_rows);
    printf("\n<ul>");
    while ($row = $result->fetch_assoc()) {
      printf ("\n<li>%s %s %s</li>", $row["name"], $row["startdate"], $row["enddate"]);
    }

  }
  else {

    printf("Erreur dans la requête");
  }
  ?>
</ul>

<?php include("include/footer.php") ?>
