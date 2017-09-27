// Read function for students
var getStudents = function() {
  // creation of the XHR / API call / call / request … object
  var request = new XMLHttpRequest();
  // open(méthode, URL à taper, asynchrone true/false)
  request.open('GET', url + "students.php", true);
  request.onreadystatechange = function(e) {
    if (this.readyState == XMLHttpRequest.DONE) {
      var students = JSON.parse(this.responseText);
      app.innerHTML = "<fieldset><legend>Liste des élèves</legend>";
      students.forEach(function(student) {
        app.innerHTML += '<div class="form-group">';
        app.innerHTML += '<label class="col-md-4 control-label" for="button1id">' + student.firstname + " " + student.lastname + '</label>';
        app.innerHTML += '<div class="col-md-8">';
        // Objectif: <a onclick="updateStudentForm('Bouvier','Marc',5)" class="btn btn-success">Éditer</a>
        app.innerHTML += '<a onclick="updateStudentForm(\'' + student.lastname + '\', \'' + student.firstname + '\', ' + student.id + ')" class="btn btn-success">Éditer</a>';
        app.innerHTML += ' ';
        app.innerHTML += '<a onclick="deleteStudentForm(\'' + student.lastname + '\', \'' + student.firstname +  '\', ' + student.id + ')" class="btn btn-danger">Supprimer</a>';
        app.innerHTML += '</div>';
        app.innerHTML += '</div>';
      });
      app.innerHTML += "</fieldset>";
      app.innerHTML += "<br />";
      app.innerHTML += "<br />";
    }
  };
  // at this point, we have done nothing yet. We launch the request now
  request.send();
}

var createStudentForm = function() {
  app.innerHTML = '<fieldset>';
  app.innerHTML += '<legend>Créer un élève</legend>';
  app.innerHTML += '<div class="form-group">';
  app.innerHTML += '<label class="col-md-4 control-label" for="studentlastname">Nom de l’élève</label>';
  app.innerHTML += '<div class="col-md-4">';
  app.innerHTML += '<input id="studentlastname" name="studentlastname" placeholder="nom de l’élève" class="form-control input-md" required="" type="text">';
  app.innerHTML += '</div>';
  app.innerHTML += '</div>';
  app.innerHTML += '<label class="col-md-4 control-label" for="studentfirstname">Prénom de l’élève</label>';
  app.innerHTML += '<div class="col-md-4">';
  app.innerHTML += '<input id="studentfirstname" name="studentfirstname" placeholder="prénom de l’élève" class="form-control input-md" required="" type="text">';
  app.innerHTML += '</div>';
  app.innerHTML += '</div>';
  app.innerHTML += '<div class="form-group">';
  app.innerHTML += '<label class="col-md-4 control-label" for="validate"></label>';
  app.innerHTML += '<div class="col-md-4">';
  app.innerHTML += '<button onclick="createStudent(document.getElementById(\'studentlastname\').value, document.getElementById(\'studentfirstname\').value);" class="btn btn-primary">Valider</button>';
  app.innerHTML += '</div>';
  app.innerHTML += '</div>';
  app.innerHTML += '</fieldset>';
};

var createStudent = function(studentLastname, studentFirstname) {
  console.log("You tried to create a student " + studentLastname + " " + studentFirstname);

  var student = {
    "firstname": studentFirstname,
    "lastname": studentLastname,
  };
  var studentJSON = JSON.stringify(student);
  console.log(student);
  console.log(studentJSON);

  var request = new XMLHttpRequest();
  // We prepare parameter and its name is student
  var paramaters = "student=" + studentJSON;
  request.open("POST", url + "create_student.php", true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function(e) {
    if (this.readyState == XMLHttpRequest.DONE) {
      var responseCode = JSON.parse(this.response);
      console.log(responseCode);
      if (responseCode == "success") {
        app.innerHTML = "<div class='alert-success'>Elève " + studentLastname + " " + studentFirstname + " créé</div>";
      } else if (responseCode == "failure") {
        app.innerHTML = "<div class='alert-warning'>Elève " + studentLastname + " " + studentFirstname + " non créé</div>";
      } else {
        app.innerHTML = "<div class='alert-danger'>Oups ! Quelque chose cloche sur le serveur, contactez l'administrateur</div>";
      }
    }
  };
  request.send(paramaters);
};

//Uppdate student form
var updateStudentForm = function(studentLastname, studentFirstname, studentId) {
  updateForm = "<fieldset>";
  updateForm += "<legend>Modifier un élève</legend>";
  updateForm += "<div class='form-group'>";
  updateForm += "<label class='col-md-4 control-label' for='studentlastname'>Nom de l’élève</label>";
  updateForm += "<div class='col-md-4'>";
  updateForm += "<input id='studentlastname' name='studentlastname'";
  updateForm += " placeholder='Nom de l\'élève' class='form-control input-md'";
  updateForm += " required= '' value='" + studentLastname + "'";
  updateForm += " type='text'>";
  updateForm += "</div>";
  updateForm += "</div>";
  updateForm += "<br  />";
  updateForm += "<div class='form-group'>";
  updateForm += "<label class='col-md-4 control-label' for='studentfirstname'>Prénom de l'élève</label>";
  updateForm += "<div class='col-md-4'>";
  updateForm += "<input id='studentfirstname' name='studentfirstname'";
  updateForm += " placeholder='Prénom de l\'élève' class='form-control input-md'";
  updateForm += " required='' value='" + studentFirstname + "'";
  updateForm += "type='text'>";
  updateForm += "</div>";
  updateForm += "</div>";
  updateForm +="<div class='form-group'>";
  updateForm +="<label class='col-md-4 control-label' for='validate'></label>";
  updateForm +="<div class='col-md-4'>";
  updateForm +="<button onclick='updateStudent(document.getElementById(\"studentlastname\").value, document.getElementById(\"studentfirstname\").value, " + studentId + ");' class='btn btn-primary'>Valider</button>";
  updateForm +="</div>";
  updateForm +="</div>";
  updateForm +="</fieldset>";
  app.innerHTML = updateForm;
};

//Udapte function for student
var updateStudent = function(studentLastname, studentFirstname, studentId) {
  var student = { lastname: studentLastname, firstname: studentFirstname, id: studentId };
  var studentJSON = JSON.stringify(student);
  console.log(student);
  var request = new XMLHttpRequest();
  var parameters = "student=" + studentJSON;
  request.open("POST", url + "change_student.php", true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function(e) {
    if(this.readyState == XMLHttpRequest.DONE) {
      var responseCode = JSON.parse(this.response);
      console.log(responseCode);
      if (responseCode == "success") {
        app.innerHTML = "<div class='alert alert-success'>Elève " + studentFirstname + " " + studentLastname + " mis à jour</div>";
      }
      else if (responseCode == "failure") {
        app.innerHTML = "<div class='alert alert-warning'>Elève " + studentFirstname + " " + studentLastname + " non mis à jour</div>";
      }
      else {
        app.innerHTML = "<div class='alert alert-danger'>Oups ! Quelque chose cloche sur le serveur, contactez l'administrateur</div>";
      }
    }
  };
  request.send(parameters);
};

// Delete student form
var deleteStudentForm = function (studentLastname, studentFirstname, studentId) {
  deleteForm = "<fieldset>";
  deleteForm += "<legend>Supprimer un élève</legend>";
  deleteForm += "<div class='form-group'>";
  deleteForm += "<label class='col-md-4 control-label' for='studentlastname'>Nom de l’élève</label>";
  deleteForm += "<div class='col-md-4'>";
  deleteForm += "<input id='studentfirstname' name='studentfirstname'";
  deleteForm += "placeholder='Nom de l\'élève' class='form-control input-md'";
  deleteForm += "required= '' value='" + studentLastname + "'";
  deleteForm += "type='text' disabled='true'>";
  deleteForm += "</div>";
  deleteForm += "</div>";
  deleteForm += "<br />";
  deleteForm += "<div class='form-group'>";
  deleteForm += "<label class='col-md-4 control-label' for='studentfirstname'>Prénom de l'élève</label>";
  deleteForm += "<div class='col-md-4'>";
  deleteForm += "<input id='studentfirstname' name='studentfirstname'";
  deleteForm += "placeholder='Prénom de l\'élève' class='form-control input-md'";
  deleteForm += "required='' value='" + studentFirstname + "'";
  deleteForm += "type='text' disabled='true'>";
  deleteForm += "</div>";
  deleteForm += "</div>";
  deleteForm += "<br />"
  deleteForm += "<div class='form-group'>";
  deleteForm += "<label class='col-md-4 control-label' for='user_validation'>Êtes-vous sûr de vouloir supprimer cet élève ?</label>";
  deleteForm += "<div class='col-md-4'>";
  deleteForm += "<div class='checkbox'>";
  deleteForm += "<label for='user_validation-0'>";
  deleteForm += "<input name='user_validation' id='user_validation' value='1' type='checkbox'>";
  deleteForm += "Oui, je suis certain";
  deleteForm += "</label>";
  deleteForm += "</div>";
  deleteForm += "</div>";
  deleteForm += "</div>";
  deleteForm += "<div class='form-group'>";
  deleteForm += "<label class='col-md-4 control-label' for='validate'></label>";
  deleteForm += "<div class='col-md-4'>";
  deleteForm += "<button onclick='deleteStudent(\"" + studentLastname + "\", \"" + studentFirstname + "\", " + studentId + ", document.getElementById(\"user_validation\").checked);' class='btn btn-primary'>Valider</button>";
  deleteForm += "</div>";
  deleteForm += "</div>";
  deleteForm += "</fieldset>";
  app.innerHTML = deleteForm;
};

// Delete function for students
var deleteStudent = function(studentLastname, studentFirstname, studentId, validation) {
  if(validation) {
    var student = { lastname: studentLastname, firstname: studentFirstname, id: studentId };
    var studentJSON = JSON.stringify(student);
    var request = new XMLHttpRequest();
    var parameters = "student=" + studentJSON;
    request.open("POST", url + "delete_student.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function(e) {
      if (this.readyState == XMLHttpRequest.DONE) {
        var responseCode = JSON.parse(this.response);
        if (responseCode == "success") {
          app.innerHTML = "<div class='alert alert-success'>Elève " + studentFirstname + " " + studentLastname + " supprimé</div>";
        }
        else if (responseCode == "failure") {
          app.innerHTML = "<div class='alert alert-warning'>Elève " + studentFirstname + " " + studentLastname + " non supprimé</div>";
        }
        else {
          app.innerHTML = "<div class='alert alert-danger'>Oups ! Quelque chose cloche sur le serveur, contactez l’administrateur</div>";
        }
      }
    };
    request.send(parameters);
  }
  else {
    warningDiv = "<div class='alert alert-warning'>Vous devez cochez la case de confirmation</div>";
    // add the warning div and the form
    app.innerHTML = warningDiv + app.innerHTML;
  }
};
