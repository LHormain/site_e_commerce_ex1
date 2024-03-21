<?php
include('controler/traitement_categorie_saisie.php');
?>
<h3 class="mt-3">Saisie d'une catégorie</h3>
<?php
    echo $texte_page_courante;
?>
<div class="row">
    <form action="#" method="post" enctype="multipart/form-data" class="col-8 offset-2 text-start" >
        <div class="row flex-column ">
            
            <!-- nom produit -->
            <div class="mb-3  ">
              <label for="nom_categorie" class="form-label">Nom de la catégorie</label>
              <input type="text"
                class="form-control" name="nom_categorie" id="nom_categorie" aria-describedby="helpId1" placeholder="" value="<?php echo $nom_categorie; ?>" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>>
              <small id="helpId1" class="form-text text-muted">Entrer le  nom de la catégorie</small>
            </div>
            <!-- description  -->
            <div class="mb-3">
              <label for="description_categorie" class="form-label">Description de la catégorie</label>
              <textarea class="form-control" name="description_categorie" id="description_categorie" rows="3" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>><?php echo $description_categorie; ?></textarea>
            </div>
            <!-- nom image -->
            <div class="mb-3  ">
              <label for="image_categorie" class="form-label">Nom de l'image</label>
              <input type="text"
                class="form-control" name="image_categorie" id="image_categorie" aria-describedby="helpId2" placeholder="" value="<?php echo $image_categorie; ?>" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>>
              <small id="helpId2" class="form-text text-muted">Entrer le  nom de l'image pour illustrer la catégorie. Pas d'espace ou de caractères spéciaux.</small>
            </div>
            <!-- fichier -->
            <div class="mb-3">
              <label for="photo" class="form-label">Choisir un fichier image</label>
              <input type="file" class="form-control" name="photo" id="photo" placeholder="" aria-describedby="fileHelpId" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>>
              <div id="fileHelpId" class="form-text">Image jpeg, jpg, png, gif ou webp. Max 256Mo.</div>
            </div>
            <!-- enregistrer -->
            <input type="submit" value="Enregistrer" class="btn btn-primary col-3 ms-auto">
        </div>
    </form>
</div>