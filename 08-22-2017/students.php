<?php
  include("include/header.php");
  

?>
  <form class="form-horizontal">
    <fieldset>

      <!-- Form Name -->
      <legend>Liste des élèves</legend>

      <!-- Button (Double) -->
      <?php
      if ($result = $connection->query("SELECT * FROM eleves")) {
            while ($row = $result->fetch_assoc()) {
              printf('
                <div class="form-group">
                  <label class="col-md-4 control-label" for="button1id">%s %s</label>
                  <div class="col-md-8">
                    <a href="change_student.php?id=%s" class="btn btn-success">Éditer</a>
                    <a href="delete_student.php?id=%s" class="btn btn-danger">Supprimer</a>
                  </div>
                </div>
              ',
              $row["firstname"],
              $row["lastname"],
              $row["id"],
              $row["id"]
              );
            }
      }
      ?>
    </fieldset>
  </form>

<?php include("include/footer.php"); ?>
