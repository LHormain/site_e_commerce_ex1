<?php   
// pour le choix de l'element option sélectionné au chargement de la page
if(isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = intval($_GET['c']);
}
else {
    $c = 0;
}
?>


<div class="container">
    <div class="row">
        
        <p class="text-center">Les champs suivis d'un * sont obligatoire</p>
        <form action="index.php?page=4&r=2" method="post" class="offset-lg-2 col-lg-8 contact">
            <div class="row">
                <!-- nom complet -->
                    <div class="label col-lg-4 mb-lg-3mb-lg-3" >
                        <label for="nom_contact">Nom Complet* </label>
                    </div>
                    <div class="champ col-7 offset-lg-1 mb-lg-3">
                        <input type="text" name="nom_contact" id="nom_contact" required>
                    </div>
                <!-- adresse email -->
                    <div class="label col-lg-4 mb-lg-3mb-lg-3" >
                        <label for="mail_contact">Adresse E-mail* </label>
                    </div>
                    <div class="champ col-7 offset-lg-1 mb-lg-3">
                        <input type="email" name="mail_contact" id="mail_contact" required>
                    </div>
                <!-- telephone -->
                    <div class="label col-lg-4 mb-lg-3mb-lg-3" >
                        <label for="tel_contact">Téléphone</label>
                    </div>
                    <div class="champ col-7 offset-lg-1 mb-lg-3">
                        <input type="texte" name="tel_contact" id="tel_contact">
                    </div>
                <!-- entreprise -->
                    <div class="label col-lg-4 mb-lg-3mb-lg-3" >
                        <label for="entreprise_contact">Entreprise (le cas échéant)</label>
                    </div>
                    <div class="champ col-7 offset-lg-1 mb-lg-3">
                        <input type="text" name="entreprise_contact" id="entreprise_contact">
                    </div>
                <!-- type de demande = sujet du message -->
                    <div class="label col-lg-4 mb-lg-3mb-lg-3" >
                        <label for="categorie_contact">Type de Demande*</label>
                    </div>
                    <div class="champ col-7 offset-lg-1 mb-lg-3">
                        <select name="categorie_contact" id="categorie_contact" required>
                            <option value="general" <?php if ($c == 0) {echo 'selected';} ?>>Question générale</option>
                            <option value="rdv" <?php if ($c == 2) {echo 'selected';} ?>>Prise de rendez-vous en magasin</option>
                            <option value="confection" <?php if ($c == 3) {echo 'selected';} ?>>Confection sur mesure</option>
                            <option value="pro" <?php if ($c == 4) {echo 'selected';} ?>>Service à un professionnel </option>
                        </select>
                    </div>
                <!-- message -->
                    <div class="label col-lg-4 mb-lg-3" >
                        <label for="message_contact">Message*</label>
                    </div>
                    <div class="champ col-7 offset-lg-1 mb-lg-3">
                        <textarea name="message_contact" id="message_contact" cols="30" rows="10" required></textarea>
                    </div>
                    <!-- conditions générales -->
                        <div class="label col-lg-4 mb-lg-3" >
                            <label for="">Conditions Générales *</label>
                        </div>
                        <div class="champ col-7 offset-lg-1 mb-lg-3 d-flex flex-no-wrap align-items-start">
                            <input type="checkbox" name="condition" id="condition" class="mt-1" required> 
                            <label for="condition" class="ms-2 " id="condition_label">J'accepte les <a href="index.php?page=5">conditions générales et la politique de confidentialité</a>  de [Nom de votre entreprise]. En cochant cette case, je confirme avoir lu et compris ces documents, et je consens à leur application.</label>
                        </div>
                <!-- code de verification -->
                    <div class="label col-lg-4 mb-lg-3" >
                        <label for="">Écrivez dans la case de droite uniquement les chiffres apparaissant dans le code suivant : <br> <span id="code"></span></label>
                    </div>
                    <div class="champ col-7 offset-lg-1 mb-lg-3">
                        <input type="text" name="captcha" id="captcha">
                    </div>
                <!-- envoyer -->
                    <div class="label col-lg-4 mb-lg-3" ></div>
                    <div class="champ col-7 offset-lg-1 mb-lg-3">
                        <input type="submit" value="Envoyer" class="btn btn-primary" disabled>
                    </div>
            </div>
        </form>
    </div>
</div>
<script src="public/assets/js/captcha.js"></script>
<script src="public/assets/js/formulaire_contact.js"></script>