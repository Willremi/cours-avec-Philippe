<?php

$connection = new mysqli("localhost", "root", "123", "coursSQL1");

?>
<!DOCTYPE html>
<html language="fr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des promotions</title>
    <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/base.css" />
  </head>
  <body>
    <?php
  // Si on n’a pas de id dans les paramètres de l’URL, on bloque la page
  if (isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != 0) {

    // Si on a des variables en POST, on tente de modifier la promotion ciblée
    if (isset($_POST["promotionname"]) && $_POST["promotionname"] != " ") {
      $request = sprintf("UPDATE promotions SET name='%s' WHERE id='%s'",
                  $_POST["promotionname"], $_POST["id"]);
      if($connection->query($request)) {
          printf("<div class='alert alert-success'>Promotion modifiée</div>");
      }
      else {
        // Gestion d’erreur SQL
        printf("<div class='alert alert-warning'>Erreur: %s</div>", $connection->error);
      }
    }

    // On a un id en GET, on sélectionne la promotion et ses informations
    $request = sprintf("SELECT * FROM promotions WHERE id=%s", $_GET["id"]);
    $result = $connection->query($request);
    $promotion = $result->fetch_assoc();
  }
  else {
    // message d’alerte si on n’a pas d’id en paramètre d’URL
    printf("<div class='alert alert-danger'>Pas d’ID renseigné</div>");
    die();
  }
?>
  <form method="post" class="form-horizontal">
  <fieldset>

  <!-- Form Name -->
  <legend>Modifier une promotion</legend>

  <!-- Text input
  Notez les balises PHP qui permettent l’affichage dynamique -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="promotionname">Nom de la promotion</label>
    <div class="col-md-4">
    <input id="promotionname" name="promotionname"
    placeholder="Nom de la promotion" class="form-control input-md"
    required="" value="<?php printf("%s",$promotion["name"]); ?>"
    type="text">
    <span class="help-block">Indiquez ici le nom de la promotion</span>
    </div>
  </div>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="validate"></label>
    <div class="col-md-4">
      <input type="hidden" name="id" value="<?php printf("%s", $promotion["id"]);?>">
      <button id="validate" name="validate" class="btn btn-primary">Valider</button>
    </div>
  </div>

  </fieldset>
  </form>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </body>
</html>