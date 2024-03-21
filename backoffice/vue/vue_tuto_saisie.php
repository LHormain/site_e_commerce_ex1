<?php
include('controler/traitement_tuto_saisie.php');
?>
<h3 class="mt-3">Saisie</h3>

<div class="row">
   <form action="#" method="post" class="col-8 offset-2 text-start" enctype="multipart/form-data">
      <?php echo $texte_page_courante; ?>
      <div class="row flex-column ">
            <!-- Titre du tuto -->
            <div class="mb-3">
                <label for="titre_tutoriel" class="form-label">Titre du tutoriel</label>
                <input type="text" class="form-control" name="titre_tutoriel" id="titre_tutoriel" aria-describedby="helpId1" placeholder="" value="<?php echo $titre_tutoriel; ?>">
                <small id="helpId1" class="form-text text-muted">Titre accrocheur</small>
            </div>
            <!-- texte de présentation -->
            <div class="mb-3">
                <label for="texte_tutoriel" class="form-label">Texte explicatif</label>
                <textarea class="form-control" name="texte_tutoriel" id="texte_tutoriel" rows="3"><?php echo $texte_tutoriel; ?></textarea>
            </div>
            <!-- lien -->
            <div class="mb-3">
                <label for="video_tutoriel" class="form-label">Lien vers la vidéo</label>
                <input type="text" class="form-control" name="video_tutoriel" id="video_tutoriel" aria-describedby="helpId2" placeholder="" value="<?php echo $video_tutoriel; ?>">
                <small id="helpId2" class="form-text text-muted">lien vers une vidéo YouTube : copier le liens d'intégration en faisant un click droit sur la vidéo YouTube</small>
            </div>
            <!-- image pour le portfolio -->
            <div class="mb-3">
              <label for="nom_img_site" class="form-label">Nom de l'image pour le portfolio</label>
              <input type="text"
                class="form-control" name="nom_img_site" id="nom_img_site" aria-describedby="helpId3" placeholder="">
              <small id="helpId3" class="form-text text-muted">Une image pour la miniature du tutoriel</small>
            </div>
            <div class="mb-3">
              <label for="photo" class="form-label">Choisir un fichier image</label>
              <input type="file" class="form-control" name="photo" id="photo" placeholder="" aria-describedby="fileHelpId">
              <div id="fileHelpId" class="form-text">png ou jpg</div>
            </div>
            <!-- enregistrer -->
            <input type="submit" value="Enregistrer" class="btn btn-primary col-3 ms-auto">
        </div>
   </form>
</div>