<?php
include('controler/traitement_offre_saisie_img.php');
?>

<h3 class="mt-3">Saisie d'une image</h3>

<div class="row">
   <form action="" method="post" class="col-8 offset-2 text-start" enctype="multipart/form-data">
      <div class="row flex-column ">
            <!-- nom de l'image -->
            <div class="mb-3">
                <label for="nom_img_jumbotron" class="form-label">Nom de l'image</label>
                <input type="text" class="form-control" name="nom_img_jumbotron" id="nom_img_jumbotron" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Un nom pertinent sans caractères spéciaux et ne commençant pas par un chiffre</small>
            </div>
            <!-- image -->
            <div class="mb-3 text-start">
                <label for="photo" class="form-label">Image</label>
                <input type="file" class="form-control" name="photo" id="photo" placeholder="" aria-describedby="fileHelpId">
                <div id="fileHelpId" class="form-text">jpeg, jpg, png, gif ou webp. Max 256Mo.</div>
            </div>
            <!-- positionnement -->
            <div class="mb-3">
                <div class="row">
                    <label class="form-label">Positionnement</label>
                    <div class="form-check form-check-inline col-3 ms-3">
                        <input class="form-check-input" type="radio" name="position_img_jumbotron" id="position1" value="1" <?php if ($position_img_jumbotron == 1) {echo 'checked';} ?>>
                        <label class="form-check-label" for="position1">Droite</label>
                    </div>
                    <div class="form-check form-check-inline col-3">
                        <input class="form-check-input" type="radio" name="position_img_jumbotron" id="position2" value="2" <?php if ($position_img_jumbotron == 2) {echo 'checked';} ?>>
                        <label class="form-check-label" for="position2">Milieu</label>
                    </div>
                    <div class="form-check form-check-inline col-3">
                        <input class="form-check-input" type="radio" name="position_img_jumbotron" id="position3" value="3" <?php if ($position_img_jumbotron == 3) {echo 'checked';} ?>>
                        <label class="form-check-label" for="position3">Gauche</label>
                    </div>
                </div>
            </div>
            <!-- enregistrer -->
            <input type="submit" value="Enregistrer" class="btn btn-primary col-3 ">
        </div>
   </form>
</div>