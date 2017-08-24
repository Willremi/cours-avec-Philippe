<?php
include("include/header.php");


if(isset($_POST["user_validation"]) && $_POST["user_validation"] == 1 && is_numeric($_POST["id"])) {
  $request = sprintf("DELETE FROM eleves WHERE id='%s'", $_POST["id"]);
  $result = $connection->query($request);
  if($result) {
    die("<div class='alert alert-success'>Suppression réussie</div>");
  }
  else {
    die("<div class='alert alert-danger'>Suppression échouée</div>");
  }
}

if(isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != 0) {

$request = sprintf("SELECT * FROM eleves WHERE id=%d",$_GET["id"]);
$result = $connection->query($request);
$student = $result->fetch_assoc();
}
else {
  die("<div class='alert alert-warning'>Vous devez renseigner un id</div>");
}
?>

<form method="post" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Suppression d'un élève</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="studentname">Nom de l'élève</label>
  <div class="col-md-4">
  <input id="studentname" name="studentname" value="<?=$student["firstname"]?> <?=$student["lastname"]?>" disabled="true" class="form-control input-md" type="text">

  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="checkboxes">Etes-vous certains ?</label>
  <div class="col-md-4">
    <label class="checkbox-inline" for="checkboxes-0">
      <input name="user_validation" id="user_validation" value="1" type="checkbox">
      oui
    </label>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="deletestudent"></label>
  <div class="col-md-4">
    <input type="hidden" name="id" value="<?=$_GET["id"]?>">
    <button class="btn btn-danger">Supprimer</button>
  </div>
</div>

</fieldset>
</form>


<?php
include("include/footer.php");
 ?>
