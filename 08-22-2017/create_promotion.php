<?php
include("include/header.php");



    // Si on a reçu des paramètres en POST grâce au formulaire
    if(isset($_POST["promotionname"]) && $_POST["promotionname"] != " ") {
      // On prépare la requête au serveur de base de données
      $request = sprintf("INSERT INTO promotions (id, name) VALUES ('', '%s')",
                  $_POST["promotionname"]);
      // On execute la requête
      if($connection->query($request)) {
          // Si on est ici, c’est que ça a marché
          printf("<div class='alert alert-success'>Promotion créée</div>");
      }
      else {
        // Si on est ici, c’est que ça a foiré. Message pour la gestion d’erreur MySQL
        printf("<div class='alert alert-warning'>Erreur: %s</div>", $connection->error);
      }
    }

    ?>

    <form method="POST" class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Créer une promotion</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="promotionname">Nom de la promotion</label>
          <div class="col-md-4">
          <input id="promotionname" name="promotionname" placeholder="Nom de la promotion" class="form-control input-md" required="" type="text">
          <span class="help-block">Indiquez ici le nom de la promotion</span>
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="validate"></label>
          <div class="col-md-4">
            <button id="validate" name="validate" class="btn btn-primary">Valider</button>
          </div>
        </div>

    </fieldset>
    </form>

<?php include("include/footer.php") ?>
