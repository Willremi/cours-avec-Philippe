<?php
  include("include/header.php");


?>

  <form class="form-horizontal">
    <fieldset>

      <!-- Form Name -->
      <legend>Liste des promotions</legend>

      <!-- Button (Double) -->
      <?php
      if ($result = $connection->query("SELECT * FROM promotions")) {
            while ($row = $result->fetch_assoc()) {
              printf('
                <div class="form-group">
                  <label class="col-md-4 control-label" for="edit_button">%s - %s</label>
                  <div class="col-md-8">
                    <button id="edit_button%s" name="edit%s" class="btn btn-success">Éditer</button>
                    <button id="del_button%s" name="del%s" class="btn btn-danger">Supprimer</button>
                  </div>
                </div>
              ',
              $row["name"],
              $row["id"],
              $row["id"],
              $row["id"],
              $row["id"],
              $row["id"]
              );
            }
      }
      ?>
    </fieldset>
  </form>

<?php include("include/footer.php") ?>
