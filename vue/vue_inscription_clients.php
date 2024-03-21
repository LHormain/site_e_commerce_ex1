<?php
include('controler/traitement_inscription_clients.php');

// si non connecté ou si update info personnelle
if ((!isset($_SESSION['id_client']) || (isset($_GET['c']) && $_GET['c'] != NULL) && $update == 0) ) {
?>
<div class="row">
    <div class="offset-lg-2 col-lg-8 text-center mt-5">
        <?php echo $message_page_courante; ?>
        <p>
            Les champs suivit d'un * sont obligatoire.
        </p>
        <!-- formulaire de contact -->
        <form action="#" method="post" class="my-5 text-start">
            <div class="row">
                <div class="mb-3">
                  <label for="username_client" class="form-label py-2">Identifiant de connexion*</label>
                  <input type="text" class="form-control" name="username_client" id="username_client" aria-describedby="helpId0" placeholder="" value="<?php echo $username_client; ?>">
                  <small id="helpId0" class="form-text text-muted visually-hidden">Choisissez un identifiant</small>
                </div>
                <!-- nom complet -->
                <div class="mb-3 col">
                    <label for="nom_client" class="form-label">Nom*</label>
                    <input type="text" class="form-control py-2" name="nom_client" id="nom_client" aria-describedby="helpId1" placeholder="Votre nom" value="<?php echo $nom_client; ?>" required>
                    <small id="helpId1" class="form-text text-muted visually-hidden">Votre nom</small>
                </div>
                <div class="mb-3 col">
                    <label for="prenom_client" class="form-label">Prénom*</label>
                    <input type="text" class="form-control py-2" name="prenom_client" id="prenom_client" aria-describedby="helpId2" placeholder="Votre prénom" value="<?php echo $prenom_client; ?>" required>
                    <small id="helpId2" class="form-text text-muted visually-hidden">Votre prénom</small>
                </div>
                <!-- mail -->
                <div class="mb-3">
                    <label for="mail_client" class="form-label">E-mail*</label>
                    <input type="email" class="form-control py-2" name="mail_client" id="mail_client" aria-describedby="helpId3" placeholder="votremail@fournisseur.com" value="<?php echo $mail_client; ?>" required>
                    <small id="helpId3" class="form-text text-muted visually-hidden">Votre adresse email</small>
                </div>
                <!-- telephone -->
                <div class="mb-3">
                    <label for="tel_client" class="form-label">Téléphone*</label>
                    <input type="text" class="form-control py-2" name="tel_client" id="tel_client" aria-describedby="helpId4" placeholder="00 00 00 00 00 " value="<?php echo $tel_client; ?>">
                    <small id="helpId4" class="form-text text-muted visually-hidden">Téléphone, champs facultatif</small>
                </div>
                
                <!-- adresse -->
                <fieldset class="mb-3">
                    <legend>Adresse complète</legend>
                    <div class="row">
                        <div class="mb-3 col-6">
                          <label for="rue_client" class="form-label">n° et Rue*</label>
                          <input type="text" class="form-control py-2" name="rue_client" id="rue_client" aria-describedby="helpId5" placeholder="" value="<?php echo $rue_client; ?>" required>
                          <small id="helpId5" class="form-text text-muted visually-hidden">numéro et nom de la rue de votre domicile</small>
                        </div>
                        <div class="mb-3 col-6">
                          <label for="complement_adresse_client" class="form-label">Complément</label>
                          <input type="text"
                            class="form-control py-2" name="complement_adresse_client" id="complement_adresse_client" aria-describedby="helpId6" placeholder="" value="<?php echo $complement_adresse_client; ?>">
                          <small id="helpId6" class="form-text text-muted visually-hidden">Complément d'adresse</small>
                        </div>
                        <div class="mb-3 col">
                          <label for="code_p_client" class="form-label">Code postal*</label>
                          <input type="text"
                            class="form-control py-2" name="code_p_client" id="code_p_client" aria-describedby="helpId7" placeholder="" value="<?php echo $code_p_client; ?>" required>
                          <small id="helpId7" class="form-text text-muted visually-hidden">Votre code postal</small>
                        </div>
                        <div class="mb-3 col">
                          <label for="ville_client" class="form-label">Ville*</label>
                          <input type="text"
                            class="form-control py-2" name="ville_client" id="ville_client" aria-describedby="helpId8" placeholder="" value="<?php echo $ville_client; ?>" required>
                          <small id="helpId8" class="form-text text-muted visually-hidden">Votre ville</small>
                        </div>
                        <div class="mb-3 col">
                            <label for="pays_client" class="form-label">Pays*</label>
                            <select class="form-select py-2" name="pays_client" id="pays_client" aria-describedby="helpId9" required>
                                <option value="france" <?php if ($pays_client == 'france') {echo 'selected';} ?>>France</option>
                                <option value="belgique" <?php if ($pays_client == 'belgique') {echo 'selected';} ?>>Belgique</option>
                                <option value="luxembourg" <?php if ($pays_client == 'luxembourg') {echo 'selected';} ?>>Luxembourg</option>
                            </select>
                            <small id="helpId9" class="form-text text-muted visually-hidden">Votre pays</small>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="mb-3">
                    <legend>Mot de passe</legend>
                    <small class="form-text text-muted">Minimum 5 caractères, 1 chiffre, 1 lettre minuscule, 1 majuscule et un caractère spécial</small>
                    <div class="row">
                        <!-- mot de passe -->
                        <div class="mb-3 col">
                        <label for="mdp_client" class="form-label">
                            <?php 
                            if (isset($_GET['c'])) { 
                                echo 'Entrez votre mot de passe';
                            }
                            else {
                                echo 'Choisissez votre mot de passe*';
                            } 
                            ?>
                        </label>
                        <input type="password" class="form-control py-2" name="mdp_client" id="mdp_client" aria-describedby="HelpIdMDP" placeholder="" required>
                        <small id="helpIdMDP" class="form-text text-muted visually-hidden">12 caractères minimum. Doit comporter des majuscules, minuscules et des chiffres</small>
                        </div>
                        <div class="mb-3 col">
                        <label for="mdp_check" class="form-label">Confirmer votre mot de passe*</label>
                        <input type="password" class="form-control py-2" name="mdp_check" id="mdp_check" aria-describedby="helpIdMDP2" placeholder="" required>
                        <small id="helpIdMDP2" class="form-text text-muted visually-hidden">Répéter votre mot de passe pour confirmation</small>
                        </div>
                    </div>
                </fieldset>
                <!-- protection donnée personnelle -->
                <div class="form-check mb-3 ms-3">
                    <input class="form-check-input" type="checkbox" value="legal" id="legal" name="" required>
                    <label class="form-check-label" for="legal" id="condition_label">
                        J'accepte l'utilisation de mon adresse mail dans le but exclusivement de me contacter suite à mes demandes.*
                    </label>
                </div>
                <!-- captcha -->
                <!-- code de verification -->
                <div class="label col-lg-4 mb-lg-3" >
                    <label for="">Écrivez dans la case de droite uniquement les chiffres apparaissant dans le code suivant : <br> <span id="code"></span></label>
                </div>
                <div class="champ col-7 offset-lg-1 mb-lg-3">
                    <input type="text" name="captcha" id="captcha" class="py-2 form-control" required>
                </div>
            </div>
            <!-- envoyer -->
            <div class="mb-3 row justify-content-center">
                <div class="col-2">
                    <input type="submit" value="Envoyer" class="form-control btn btn-primary " disabled>
                </div>
            </div>
        </form>
        <!-- fin formulaire -->
    </div>
</div>

<script src="public/assets/js/captcha.js"></script>
<script src="public/assets/js/formulaire_inscription.js"></script>

<?php
}
else {
    if ($update == 1) {
    // update réussi
        ?>
        <script>window.location.assign("index.php?page=602&cas=6");</script>
        <?php 
    }
    else {
    // l'inscription a réussi
    ?>
    <script>window.location.assign("index.php?page=602&cas=1");</script>
    <?php 
    }

?>
<!-- <div class="row">
    <div class="offset-lg-2 col-lg-8 text-center my-5"> -->
<?php
    // echo $message_page_courante;
?>
        <!-- <a class="btn btn-primary" href="index.php?page=6" role="button" >Vers votre page client</a>
        <a class="btn btn-primary" href="index.php?page=1" role="button">Retour vers l'accueil</a>
    </div>
</div> -->
<?php
}
?>