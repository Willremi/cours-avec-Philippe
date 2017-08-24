<?php
include("include/header.php");



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

<?php include("include/footer.php") ?>
