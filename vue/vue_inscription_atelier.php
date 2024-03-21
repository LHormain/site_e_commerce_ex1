<?php
include('controler/traitement_inscription_atelier.php');

?>

<div class="container my-5 text-center">
    <div class="row">
        <h1>Inscription à un atelier</h1>
        <?php
            if ($message_page_courante == '') {
        ?>

        <h2 class="mt-5">
            Bonjour <?php echo $client['prenom_client'] ?>,<br>
        </h2>
        <p class="my-3">
            Veuillez renseigner ces quelques information pour que nous puissions procéder à votre inscription à l'atelier <?php echo $atelier['nom_atelier']; ?>.
            <br>
            Nous vous rappelons que cet atelier est d'une durée de <?php echo $atelier['duree_atelier']; ?> minutes.
        </p>
        <form action="#" method="post" class="offset-3 col-6 text-start ">
            <div class="row">
                <!-- id_client -->
                <div class=" visually-hidden">
                    <input type="text" class="form-control" name="id_client" id="id_client" aria-describedby="helpId" placeholder="" value="<?php echo $client['id_client']; ?>">
                    <small id="helpId" class="form-text text-muted">identifiant du client</small>
                </div>
                <!-- n° atelier -->
                <div class=" visually-hidden">
                    <input type="text" class="form-control" name="id_atelier" id="id_atelier" aria-describedby="helpId2" placeholder="" value="<?php echo $c; ?>">
                    <small id="helpId2" class="form-text text-muted">numéro de l'atelier</small>
                </div>
                <!-- horaire -->
                <div class="col-md-5 d-flex flex-column mb-3" id="horaireBox">
                    <p class="form-label ">
                        Choisissez un horaire :
                    </p>
                    <?php
                        echo $radio_horaire;
                    ?>
                </div>
                <!-- nbr de participant -->
                <div class="mb-3 offset-1  col-md-6">
                  <label for="nbr_inscrit" class="form-label">Nombre d'inscrit</label>
                  <input type="number" class="form-control" name="nbr_inscrit" id="nbr_inscrit" aria-describedby="helpId3" placeholder="" min="1" max="5" value="1">
                  <small id="helpId3" class="form-text text-muted">Nombre de personne participant à l'atelier</small>
                </div>
                <!-- estimation du prix -->
                <div>
                    <div class="row">
                        <div class="mb-3 col-6 text-end align-self-end">
                            Prix de la séance :
                        </div>
                        <div class="visually-hidden" id="prix_unitaire"><?php echo $atelier['prix_atelier']; ?></div>
                        <div class="col-6 "><span id="prix"><?php echo $atelier['prix_atelier']; ?></span> <span>€</span></div>
                    </div>
                </div>
                <!-- captcha -->
                <!-- code de verification -->
                <div class="label col-lg-6 mb-lg-3" >
                    <p for="">Écrivez dans la case de droite uniquement les chiffres apparaissant dans le code suivant : <br> <span id="code"></span></p>
                </div>
                <div class="champ col-6  mb-lg-3">
                    <input type="text" name="captcha" id="captcha" class="py-2 form-control" required>
                </div>
                <!-- envoyer -->
                <input type="submit" class="btn btn-primary offset-4 col-4" value="Envoyer" disabled>
            </div>
        </form>
        <script src="public/assets/js/captcha.js"></script>
        <script src="public/assets/js/formulaire_atelier.js"></script>
        <script>
        getPrixTotal();
        </script>
        <?php
        }
        else {
            ?>
            <script>window.location.assign("index.php?page=602&cas=2");</script>
            <?php
            // echo $message_page_courante;
            ?>
            <!-- <div class=text-center>
                <a class="btn btn-primary" href="index.php?page=6" role="button" >Vers votre page client</a>
                <a class="btn btn-primary" href="index.php?page=1" role="button">Retour vers l'accueil</a>
            </div> -->
        <?php
        }
        ?>
    </div>
</div>

