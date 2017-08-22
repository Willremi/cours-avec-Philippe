<?php

  $connection = new mysqli("localhost", "root", "123", "coursSQL1");

?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="vendor/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/base.css" />
  <title>Liste des promotions</title>
</head>
<body>
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
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>
