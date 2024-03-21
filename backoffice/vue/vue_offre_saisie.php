<?php
include('controler/traitement_offre_saisie.php');
?>

<h3 class="mt-3">Saisie d'un paragraphe</h3>
<p><?php echo $texte_page; ?></p>

<div class="row">
   <form action="" method="post" class="col-8 offset-2 text-start" >
      <div class="row flex-column ">
            <!-- Titre de la vue_promotions -->
            <div class="mb-3">
                <label for="titre_paragraphe" class="form-label">Titre ou sous titre de la promotion </label>
                <input type="text" class="form-control" name="titre_paragraphe" id="titre_paragraphe" aria-describedby="helpId" placeholder="" value="<?php echo $titre_paragraphe; ?>">
                <small id="helpId" class="form-text text-muted">Titre accrocheur</small>
            </div>
            <!-- texte de la vue_promotions -->
            <div class="mb-3">
                <label for="texte_paragraphe" class="form-label">Texte explicatif</label>
                <textarea class="form-control" name="texte_paragraphe" id="texte_paragraphe" rows="3"><?php echo $texte_paragraphe; ?></textarea>
            </div>
            <!-- positionnement -->
            <div class="mb-3">
                <div class="row">
                    <label class="form-label">Positionnement</label>
                    <div class="form-check form-check-inline col-3 ms-3">
                        <input class="form-check-input" type="radio" name="taille_paragraphe" id="position1" value="1" <?php if ($taille_paragraphe == 1) { echo 'checked';} ?>>
                        <label class="form-check-label" for="position1">pleine page</label>
                    </div>
                    <div class="form-check form-check-inline col-3">
                        <input class="form-check-input" type="radio" name="taille_paragraphe" id="position2" value="2" <?php if ($taille_paragraphe == 2) { echo 'checked';} ?>>
                        <label class="form-check-label" for="position2">demis page</label>
                    </div>
                </div>
            </div>
            <!-- enregistrer -->
            <input type="submit" value="Enregistrer" class="btn btn-primary col-3 ms-auto">
        </div>
   </form>
</div>