<?php
include('controler/traitement_ateliers_saisie_paragraphe.php')
?>
<h3 class="mt-3"><?php echo $titre; ?> paragraphe pour l'atelier : <?php echo $nom_atelier; ?></h3>
<p><?php echo $texte_page_courante; ?></p>
<div class="my-5 text-start offset-2 col">
    <a class="btn btn-primary" href="index.php?page=12&c=51&id=<?php echo $id_atelier; ?>" role="button">Retour à la gestion des paragraphes</a>
</div>
<div class="row">
    <form action="#" method="post" class="col-8 offset-2 text-start">
        <!-- titre paragraphe -->
        <div class="mb-3 ">
            <label for="titre_descriptif" class="form-label">Sous titre de l'atelier</label>
            <input type="text" class="form-control" name="titre_descriptif" id="titre_descriptif" aria-describedby="helpId2" placeholder="" value="<?php echo $titre_descriptif; ?>" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>>
            <small id="helpId2" class="form-text text-muted">Choisissez un sous titre</small>
        </div>
        <!-- texte -->
        <div class="mb-3">
          <label for="texte_descriptif" class="form-label">Paragraphe du descriptif de l'atelier</label>
          <textarea class="form-control" name="texte_descriptif" id="texte_descriptif" rows="10" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>><?php echo $texte_descriptif; ?></textarea>
        </div>
        <!-- enregistrer -->
        <input type="submit" value="Enregistrer" class="btn btn-primary col-3 ms-auto">

    </form>
</div>

