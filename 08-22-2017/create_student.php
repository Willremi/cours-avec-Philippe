<?php

$connection = new mysqli("localhost", "root", "123", "coursSQL1");

?>
<!DOCTYPE html>
<html language="fr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des élèves</title>
    <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/base.css" />
  </head>
  <body>
    <?php
    if(isset($_POST["studentname"]) && $_POST["studentname"] != " ") {
      $request = sprintf("INSERT INTO eleves (firstname, lastname) VALUES ('', '%s')",
                  $_POST["studentname"]);
      if($connection->query($request)) {
        // Si on est ici, c’est que ça a marché
          printf("<div class='alert alert-success'>Elève créé</div>");
            }
      else {
              // Si on est ici, c’est que ça a foiré. Message pour la gestion d’erreur MySQL
              printf("<div class='alert alert-warning'>Erreur: %s</div>", $connection->error);
            }
    }


     ?>
    <form method="post" class="form-horizontal">
    <fieldset>

    <!-- Form Name -->
    <legend>Modifier un élève</legend>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="studentname">Nom de l’élève</label>
      <div class="col-md-4">
      <input id="studentname" name="studentname" placeholder="prénom et nom de l’élève" class="form-control input-md" required="" type="text">
      <span class="help-block">Indiquez ici le nom de l’élève</span>
      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="promotion">Promotion</label>
      <div class="col-md-4">
        <select id="promotion" name="promotion" class="form-control">
          <option value="1">Aaron Swartz</option>
          <option value="2">Jimmy Wales</option>
        </select>
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="validate"></label>
      <div class="col-md-4">
        <button id="validate" name="validate" class="btn btn-primary">Sauvegarder</button>
      </div>
    </div>

    </fieldset>
    </form>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </body>
</html>
