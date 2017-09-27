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
                <label class="col-md-4 control-label" for="edit_button">n°%s %s</label>
                <div class="col-md-8">
                  <a href="change_promotion.php?id=%s" id="edit_button%s" name="edit%s" class="btn btn-success">Éditer</a>
                  <a href="delete_promotion.php?id=%s" id="del_button%s" name="del%s" class="btn btn-danger">Supprimer</a>
                </div>
              </div>
            ',
            $row["id"],
            $row["name"],
            $row["id"],
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
