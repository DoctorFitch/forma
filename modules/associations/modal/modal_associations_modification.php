<?php

require_once('../../../lib/config.php');

// on recupere l'id de l'utilisateur à modifier
$associations_id = $_POST['associations_id'];

// requete pour obtenir toutes les données correspondantes à cet utilisateur
$associations_data = $pdo->sqlRow("SELECT * FROM associations WHERE associations_id = ?", array($associations_id));

?>

<!-- Début du formulaire -->
<form action="modules/associations/ajax/iAssociation_modification.php" id="ajoutAssociations" class="smart-form"
      novalidate="novalidate" method="post" name="ajoutAssociations">

    <div class="modal-body col-12">

        <input class="hidden" type="text" name="associations_id" value="<?php echo $associations_id ?>"/>
        <!-- Afin d'empêcher l'autocompletion des navigateurs -->
        <input style="display:none" type="text" name="fakeusernameremembered"/>
        <input style="display:none" type="password" name="fakepasswordremembered"/>

        <!-- ASSOCIATION -->
        <fieldset>

            <legend>Informations association</legend>
            <div class="row">

                <!-- Nom de l'association -->
                <label class="label col col-2">Nom</label>
                <section class="col col-4">
                    <label class="input fe"> <i class="icon-prepend fa fa-building"></i>
                        <input type="text" name="associations_nom" placeholder="Nom de l'association" required
                               value="<?php echo $associations_data['associations_nom']; ?>">
                    </label>
                </section>
                <!-- Fin nom de l'association -->

                <!-- Numéro icom de l'association -->
                <label class="label col col-2">ICOM</label>
                <section class="col col-4">
                    <label class="input"> <i class="icon-prepend fa fa-sort-numeric-asc"></i>
                        <input type="text" name="associations_icom" placeholder="Numéro ICOM" required
                               value="<?php echo $associations_data['associations_numeroICOM']; ?>">
                    </label>
                </section>
                <!-- Fin numéro icom -->

            </div>

            <div class="row">

                <!-- E-mail de l'association -->
                <label class="label col col-2">E-mail</label>
                <section class="col col-4">
                    <label class="input fe"> <i class="icon-prepend fa fa-envelope"></i>
                        <input autocomplete="nope" type="text" name="associations_email"
                               placeholder="E-mail de l'association" required
                               value="<?php echo $associations_data['associations_email']; ?>">
                    </label>
                </section>
                <!-- Fin e-mail de l'association -->

                <!-- Mot de passe de l'association -->
                <label class="label col col-2">Mot de passe</label>
                <section class="col col-4">
                    <label class="input fe"> <i class="icon-prepend fa fa-lock"></i>
                        <input type="password" autocomplete="nope" name="associations_motDePasse"
                               placeholder="********" required">
                    </label>
                </section>
                <!-- Fin mot de passe de l'association -->

            </div>

        </fieldset>
        <!-- FIN ASSOCIATION -->

        <!-- INTERLOCUTEUR -->
        <fieldset>

            <legend>Informations interlocuteur</legend>
            <div class="row">

                <!-- Nom de l'interlocuteur -->
                <label class="label col col-2">Nom</label>
                <section class="col col-4">
                    <label class="input fe"> <i class="icon-prepend fa fa-user"></i>
                        <input type="text" name="associations_interlocuteur_nom" placeholder="Nom de l'interlocuteur"
                               required
                               value="<?php echo $associations_data['associations_interlocuteur_nom']; ?>">
                    </label>
                </section>
                <!-- Fin nom de l'interlocuteur -->

                <!-- Prénom de l'interlocuteur -->
                <label class="label col col-2">Prénom</label>
                <section class="col col-4">
                    <label class="input"> <i class="icon-prepend fa fa-user"></i>
                        <input type="text" name="associations_interlocuteur_prenom"
                               placeholder="Prénom de l'interlocuteur" required
                               value="<?php echo $associations_data['associations_interlocuteur_prenom']; ?>">
                    </label>
                </section>
                <!-- Fin prénom de l'interlocuteur -->

            </div>

            <div class="row">

                <!-- Téléphone de l'interlocuteur -->
                <label class="label col col-2">Téléphone</label>
                <section class="col col-4">
                    <label class="input fe"> <i class="icon-prepend fa fa-phone"></i>
                        <input type="text" name="associations_interlocuteur_telephone"
                               placeholder="Téléphone de l'interlocuteur" required
                               value="<?php echo $associations_data['associations_interlocuteur_telephone']; ?>">
                    </label>
                </section>
                <!-- Fin téléphone de l'interlocuteur -->

                <!-- Fax de l'interlocuteur -->
                <label class="label col col-2">Fax</label>
                <section class="col col-4">
                    <label class="input"> <i class="icon-prepend fa fa-phone-square"></i>
                        <input type="text" name="associations_interlocuteur_fax" placeholder="Fax de l'interlocuteur"
                               required
                               value="<?php echo $associations_data['associations_interlocuteur_fax']; ?>">
                    </label>
                </section>
                <!-- Fin fax de l'interlocuteur -->

            </div>

        </fieldset>
        <!-- FIN INTERLOCUTEUR -->

        <footer>
            <button type="submit" class="btn btn-success">Modifier !</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </footer>

    </div>
</form>
<!-- Fin formulaire -->


<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">

    pageSetUp();

    var pagefunction = function () {
        var $checkoutForm = $('#ajoutAssociations').validate({
            // Rules for form validation
            rules: {
                associations_nom: {
                    required: true
                },
                associations_icom: {
                    required: true,
                    digits: true
                },
                associations_email: {
                    required: true,
                    email: true
                },
                associations_motDePasse: {
                    required: false
                },
                associations_interlocuteur_nom: {
                    required: true
                },
                associations_interlocuteur_prenom: {
                    required: true
                },
                associations_interlocuteur_telephone: {
                    required: true,
                    digits: true
                },
                associations_interlocuteur_fax: {
                    required: false,
                    digits: true
                },
            },

            // Messages for form validation
            messages: {
                associations_nom: {
                    required: "Veuillez renseigner un nom pour l'association."
                },
                associations_icom: {
                    required: "Veuillez renseigner le numéro ICOM de l'association.",
                    digits: "Veuillez entrer seulement des chiffres."
                },
                associations_email: {
                    required: "Veuillez renseigner un e-mail pour l'assocation.",
                    email: "Veuillez saisir un e-mail correct."
                },
                associations_motDePasse: {
                    required: ""
                },
                associations_interlocuteur_nom: {
                    required: "Veuillez indiquer un nom pour l'interlocuteur."
                },
                associations_interlocuteur_prenom: {
                    required: "Veuillez indiquer un prénom pour l'interlocuteur."
                },
                associations_interlocuteur_telephone: {
                    required: "Veuillez renseigner un numéro de téléphone pour l'interlocuteur.",
                    digits: "Veuillez renseigner un numéro de téléphone valide."
                },
                associations_interlocuteur_fax: {
                    required: "",
                    digits: "Veuillez renseigner un numéro de fax valide."
                },
            },
            submitHandler: function (ev) {
                $(ev).ajaxSubmit({
                    type: $('#ajoutSocietes').attr('method'),
                    url: $('#ajoutSocietes').attr('action'),
                    data: $('#ajoutSocietes').serialize(),
                    dataType: 'json',
                    success: function (data) {
                        if (data.return == 'icom') {
                            smallBox('Ajout impossible', 'Une association porte déjà ce numéro ICOM.', 'warning');
                        } else if (data.return == 'nom') {
                            smallBox('Ajout impossible', 'Une association porte déjà ce nom.', 'warning');
                        } else if (data.return == 'nom&icom') {
                            smallBox('Ajout impossible', 'Une association porte déjà ce nom et ce numéro icom.', 'warning');
                        } else {
                            smallBox('Ajout réussi !', 'L\'association à correctement été ajoutée.', 'success');
                            setTimeout(function () {
                                $('#listing_associations').DataTable().ajax.reload(null, false); // refresh la datable association
                            }, 500);
                            $('#associations_modification').modal('toggle'); // ferme le modal en cas d'ajout
                        }
                        console.log(data.retour);
                    }
                });
            },

            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            },

            invalidHandler: function () {
                smallBox('Ajout impossible', "Veuillez remplir les champs correctement.", 'error', '3000')
            }
        });
    };

    loadScript("assets/js/plugin/jquery-form/jquery-form.min.js", pagefunction);

</script>