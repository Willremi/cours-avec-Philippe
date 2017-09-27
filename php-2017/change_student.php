<?php
include("include/header.php");

if (isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != 0) {

  // Si on a des variables en POST, on tente de modifier la promotion ciblée
  if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["promotion_id"])) {
    $request = sprintf("UPDATE eleves SET
      firstname='%s',
      lastname='%s',
      promotion_id=%s
      WHERE id='%s'",
      $_POST["firstname"],
      $_POST["lastname"],
      $_POST["promotion_id"],
      $_POST["id"]);
      if($connection->query($request)) {
        printf("<div class='alert alert-success'>Éléve modifié</div>\n<a href='students .php'>Retour à la liste des élèves</a>");
      }
      else {
        // Gestion d’erreur SQL
        printf("<div class='alert alert-warning'>Erreur: %s</div>", $connection->error);
      }
    }

    // On a un id en GET, on sélectionne la promotion et ses informations
    $request = sprintf("SELECT * FROM eleves WHERE id=%s", $_GET["id"]);
    $result = $connection->query($request);
    $student = $result->fetch_assoc();
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
      <legend>Modifier un élève</legend>

      <!-- Text input
      Notez les balises PHP qui permettent l’affichage dynamique -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="firstname">Prénom</label>
        <div class="col-md-4">
          <input id="firstname" name="firstname"
          placeholder="Prénom" class="form-control input-md"
          required="" value="<?php printf("%s",$student["firstname"]); ?>"
          type="text">
          <span class="help-block">Indiquez ici le prénom de l’élève</span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="lastname">Nom</label>
        <div class="col-md-4">
          <input id="lastname" name="lastname"
          placeholder="Nom" class="form-control input-md"
          required="" value="<?php printf("%s",$student["lastname"]); ?>"
          type="text">
          <span class="help-block">Indiquez ici le nom de l’élève</span>
        </div>
      </div>

      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="promotion_id">Promotion</label>
        <div class="col-md-4">
          <select id="promotion_id" name="promotion_id" class="form-control">
            <option value="1">Aaron Swartz</option>
            <option value="2">Jimmy Wales</option>
          </select>
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

<?php include("include/footer.php") ?>
