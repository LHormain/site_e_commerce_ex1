<?php
include('controler/traitement_sous_categorie_saisie.php');
?>
<h3 class="mt-3">Saisie d'une sous catégorie</h3>
<?php
    echo $texte_page_courante;
?>
<div class="row">
    <form action="#" method="post" class="col-8 offset-2 text-start" enctype="multipart/form-data">
        <div class="row flex-column ">
            
          <!-- category -->
          <div class="mb-3 col-6 ">
              <label for="id_cat" class="form-label">Catégorie</label>
              <select class="form-select form-select-lg" name="id_cat" id="id_cat" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>> 
                  <option selected>Choisir une option</option>
                  <?php 
                      
                      echo $select_cat;
                  ?>
              </select>
          </div>
          <div id="nouvelle_sous_cat">
            <!-- nom sous catégorie -->
            <div class="mb-3  ">
              <label for="nom_sous_categorie" class="form-label">Nom de la sous catégorie</label>
              <input type="text"
                class="form-control" name="nom_sous_categorie" id="nom_sous_categorie" aria-describedby="helpId1" placeholder="" value="<?php echo $nom_sous_categorie; ?>" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>>
              <small id="helpId1" class="form-text text-muted">Entrer le  nom de la sous catégorie</small>
            </div>
            <!-- description  -->
            <div class="mb-3">
                <label for="description_sous_categorie" class="form-label">Description de la sous catégorie</label>
                <textarea class="form-control" name="description_sous_categorie" id="description_sous_categorie" rows="3" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>><?php echo $description_sous_categorie; ?></textarea>
              </div>
            <!-- nom image -->
            <div class="mb-3  ">
                <label for="image_sous_categorie" class="form-label">Nom de l'image</label>
                <input type="text"
                  class="form-control" name="image_sous_categorie" id="image_sous_categorie" aria-describedby="helpId2" placeholder="" value="<?php echo $image_sous_categorie; ?>"  <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>>
                <small id="helpId2" class="form-text text-muted">Entrer le  nom de l'image pour illustrer la sous catégorie. Pas d'espace ou ce caractères spéciaux.</small>
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
        </div>
    </form>
</div>