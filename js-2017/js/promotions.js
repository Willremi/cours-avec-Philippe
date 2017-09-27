/*  this file contains CRUD functions for promotions */

// Read function for promotions
var getPromotions = function() {
    // creation of the XHR / API call / call / request … object
    var request = new XMLHttpRequest();
    // open(méthode, URL à taper, asynchrone true/false)
    request.open('GET', url + "promotions.php", true);
    // what do we do when the request is done ?
    // e is event information (you can have a look with a console.log if it pleases you)
    request.onreadystatechange = function(e) {
        // First step
        // for the moment we write the raw response text in app
        // the whole data of the response is in a variable called "this"
        // app.innerHTML = this.responseText;

        // Better step
        // PromotionsJSON contains the JSON of the promotions
        // app.innerHTML = "<ul>";
        // if (this.readyState == XMLHttpRequest.DONE) {
        //   var promotionsJSON = this.responseText;
        //   // Promotions contains an array with the promotions
        //   var promotions = JSON.parse(promotionsJSON);
        //   // For each promotion, we display information
        //   promotions.forEach(function(promotion) {
        //     app.innerHTML += "<li>" + promotion.name + "</li>";
        //   });
        // }
        // app.innerHTML += "</ul>";

        // Best step
        if (this.readyState == XMLHttpRequest.DONE) {
            var promotions = JSON.parse(this.responseText);
            app.innerHTML = "<fieldset><legend>Liste des promotions</legend>";
            promotions.forEach(function(promotion) {
                    app.innerHTML += '<div class="form-group">';
                    app.innerHTML += '<label class="col-md-4 control-label" for="edit_button">' + promotion.name + '</label>';
                    app.innerHTML += '<div class="col-md-8">';
                    app.innerHTML += '<a onclick="updatePromotionForm(' + promotion.id + ', \'' + promotion.name + '\');" class="btn btn-success">Éditer</a> ';
                    app.innerHTML += '<a onclick="deletePromotionForm(' + promotion.id + ', \'' + promotion.name + '\');" class="btn btn-danger">Supprimer</a>';
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

// Create promotion form
var createPromotionForm = function() {
    app.innerHTML = '<fieldset>';
    app.innerHTML += '<legend>Créer une promotion</legend>';
    app.innerHTML += '<div class="form-group">';
    app.innerHTML += '<label class="col-md-4 control-label" for="promotionname">Nom de la promotion</label>';
    app.innerHTML += '<div class="col-md-4">';
    // The name of the promotion is in this input field's value
    app.innerHTML += '<input id="promotionname" name="promotionname" placeholder="Nom de la promotion" class="form-control input-md" required="" type="text">';
    app.innerHTML += '<span class="help-block">Indiquez ici le nom de la promotion</span>';
    app.innerHTML += '</div>';
    app.innerHTML += '</div>';
    app.innerHTML += '<div class="form-group">';
    app.innerHTML += '<label class="col-md-4 control-label" for="validate"></label>';
    app.innerHTML += '<div class="col-md-4">';
    // We call the createPromotion function with document… as promotionName's value
    app.innerHTML += '<button onclick="createPromotion(document.getElementById(\'promotionname\').value);" class="btn btn-primary">Valider</button>';
    app.innerHTML += '</div>';
    app.innerHTML += '</div>';
    app.innerHTML += '</fieldset>';
};

// Create function for promotions
var createPromotion = function(promotionName) {
    console.log("You tried to create a promotion " + promotionName);
    // We forge an object called promotion
    var promotion = {
        "name": promotionName,
        "startdate": "2018-01-01",
        "enddate": "2018-06-30",
    };
    var promotionJSON = JSON.stringify(promotion);
    // Check of the promotion variable
    console.log(promotion);
    // Check of the promotion JSON variable
    console.log(promotionJSON);

    // We create request object
    var request = new XMLHttpRequest();
    // We prepare paramaters
    var parameters = "promotion=" + promotionJSON;
    // We establish connection, but don't launch a proper request
    request.open("POST", url + "create_promotion.php", true);
    // We warn that we will send parameters
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // We tell the request what it will have to do when it's over
    request.onreadystatechange = function(e) {
        if (this.readyState == XMLHttpRequest.DONE) {
            var responseCode = JSON.parse(this.response);
            if (responseCode == "success") {
                app.innerHTML = "<div class='alert alert-success'>Promotion " + promotionName + " créée</div>";
            }
            else if (responseCode == "failure") {
                app.innerHTML = "<div class='alert alert-warning'>Promotion " + promotionName + " non-créée</div>";
            }
            else {
                app.innerHTML = "<div class='alert alert-danger'>Oups ! Quelque chose cloche sur le serveur, contactez l’administrateur</div>";
            }
        }
    };
    // We launch the request for real, this time
    request.send(parameters);
};

// Update promotion form
var updatePromotionForm = function(promotionId, promotionName) {
    // Let's build the form
    updateForm = "<fieldset>";
    updateForm += "<legend>Modifier une promotion</legend>";
    updateForm += "<div class='form-group'>";
    updateForm += "<label class='col-md-4 control-label' for='promotionname'>Nom de la promotion</label>";
    updateForm += "<div class='col-md-4'>";
    updateForm += "<input id='promotionname' name='promotionname'";
    updateForm += "placeholder='Nom de la promotion' class='form-control input-md'";
    // Display the name of the promotion in the input threw value=
    updateForm += "required='' value='" + promotionName + "'";
    updateForm += "type='text'>";
    updateForm += "</div>";
    updateForm += "</div>";
    updateForm += "<div class='form-group'>";
    updateForm += "<label class='col-md-4 control-label' for='validate'></label>";
    updateForm += "<div class='col-md-4'>";
    // We write in HTML the values of promotionId but we write JS with JS to fetch
    // the new name of the promotion at the time the button is clicked
    updateForm += "<button onclick='updatePromotion(" + promotionId + ",document.getElementById(\"promotionname\").value);' class='btn btn-primary'>Valider</button>";
    updateForm += "</div>";
    updateForm += "</div>";
    updateForm += "</fieldset>";
    // display the update form in the app
    app.innerHTML = updateForm;
};

// Update function for promotions
var updatePromotion = function(promotionId, promotionName) {
        // create a promotion object
        var promotion = { id: promotionId, name: promotionName };
        // create a JSON from the promotion object we made
        var promotionJSON = JSON.stringify(promotion);
        // We create request object
        var request = new XMLHttpRequest();
        // We prepare paramaters
        var parameters = "promotion=" + promotionJSON;
        // We establish connection, but don't launch a proper request
        request.open("POST", url + "change_promotion.php", true);
        // We warn that we will send parameters
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // We tell the request what it will have to do when it's over
        request.onreadystatechange = function(e) {
            if (this.readyState == XMLHttpRequest.DONE) {
                var responseCode = JSON.parse(this.response);
                if (responseCode == "success") {
                    app.innerHTML = "<div class='alert alert-success'>Promotion " + promotionName + " mise à jour</div>";
                }
                else if (responseCode == "failure") {
                    app.innerHTML = "<div class='alert alert-warning'>Promotion " + promotionName + " non mise à jour</div>";
                }
                else {
                    app.innerHTML = "<div class='alert alert-danger'>Oups ! Quelque chose cloche sur le serveur, contactez l’administrateur</div>";
                }
            }
        };
        // We launch the request for real, this time
        request.send(parameters);
};


// Delete promotion form
var deletePromotionForm = function(promotionId, promotionName) {
    // Let's build the form
    deleteForm = "<fieldset>";
    deleteForm += "<legend>Supprimer une promotion</legend>";
    deleteForm += "<div class='form-group'>";
    deleteForm += "<label class='col-md-4 control-label' for='promotionname'>Nom de la promotion</label>";
    deleteForm += "<div class='col-md-4'>";
    deleteForm += "<input id='promotionname' name='promotionname'";
    deleteForm += "placeholder='Nom de la promotion' class='form-control input-md'";
    // Display the name of the promotion in the input threw value=
    deleteForm += "required='' value='" + promotionName + "'";
    deleteForm += "type='text' disabled='true'>";
    deleteForm += "</div>";
    deleteForm += "</div>";
    deleteForm += "<div class='form-group'>";
    deleteForm += "<label class='col-md-4 control-label' for='user_validation'>Êtes-vous sûr de vouloir supprimer cette promotion ?</label>";
    deleteForm += "<div class='col-md-4'>";
    deleteForm += "  <div class='checkbox'>";
    deleteForm += "    <label for='user_validation-0'>";
    deleteForm += "      <input name='user_validation' id='user_validation' value='1' type='checkbox'>";
    deleteForm += "      Oui, je suis certain";
    deleteForm += "    </label>";
    deleteForm += "  </div>";
    deleteForm += "</div>";
    deleteForm += "</div>";
    deleteForm += "<div class='form-group'>";
    deleteForm += "<label class='col-md-4 control-label' for='validate'></label>";
    deleteForm += "<div class='col-md-4'>";
    // We write in HTML the values of promotionId and promotionName
    // Beware we also write JS code with JS … document.get… is required
    // in order to have a look to the checkbox at the time the button is clicked
    deleteForm += "  <button onclick='deletePromotion(" + promotionId + ",\"" + promotionName + "\", document.getElementById(\"user_validation\").checked);' class='btn btn-primary'>Valider</button>";
    deleteForm += "</div>";
    deleteForm += "</div>";
    deleteForm += "</fieldset>";
    // display the delete form in the app
    app.innerHTML = deleteForm;
};

// Delete function for promotions
var deletePromotion = function(promotionId, promotionName, validation) {
    // was the checkbox checked ?
    if (validation) {
        // Checkbox checked, let's perform deletion
        // create a promotion object
        var promotion = { id: promotionId, name: promotionName };
        // create a JSON from the promotion object we made
        var promotionJSON = JSON.stringify(promotion);
        // We create request object
        var request = new XMLHttpRequest();
        // We prepare paramaters
        var parameters = "promotion=" + promotionJSON;
        // We establish connection, but don't launch a proper request
        request.open("POST", url + "delete_promotion.php", true);
        // We warn that we will send parameters
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // We tell the request what it will have to do when it's over
        request.onreadystatechange = function(e) {
            if (this.readyState == XMLHttpRequest.DONE) {
                var responseCode = JSON.parse(this.response);
                if (responseCode == "success") {
                    app.innerHTML = "<div class='alert alert-success'>Promotion " + promotionName + " supprimée</div>";
                }
                else if (responseCode == "failure") {
                    app.innerHTML = "<div class='alert alert-warning'>Promotion " + promotionName + " non-supprimée</div>";
                }
                else {
                    app.innerHTML = "<div class='alert alert-danger'>Oups ! Quelque chose cloche sur le serveur, contactez l’administrateur</div>";
                }
            }
        };
        // We launch the request for real, this time
        request.send(parameters);
    }
    else {
        // checkbox not checked
        // prepare a warning div
        warningDiv = "<div class='alert alert-warning'>Vous devez cochez la case de confirmation</div>";
        // add the warning div and the form
        app.innerHTML = warningDiv + app.innerHTML;
    }
};
