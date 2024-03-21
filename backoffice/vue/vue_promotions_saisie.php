<?php
include('controler/traitement_promotions_saisie.php');
?>

<h3 class="mt-3">Saisie des offres promotionnelles du carousel de la page d'accueil</h3>
<?php echo $texte_page_courante; ?>
<div class="row">
   <form action="" method="post" class="col-8 offset-2 text-start" enctype="multipart/form-data">
      <div class="row flex-column ">
         <!-- Titre de la vue_promotions -->
         <div class="mb-3 ">
            <label for="titre_slide" class="form-label">Titre de la promotion</label>
            <input type="text" class="form-control" name="titre_slide" id="titre_slide" aria-describedby="helpId1" placeholder="" value="<?php echo $titre_slide; ?>">
            <small id="helpId1" class="form-text text-muted">Titre accrocheur</small>
         </div>
         <!-- texte de la vue_promotions -->
         <div class="mb-3 ">
            <label for="texte_slide" class="form-label">Texte explicatif</label>
            <textarea class="form-control" name="texte_slide" id="texte_slide" rows="3"><?php echo $texte_slide; ?></textarea>
         </div>
         <!-- image -->
         <div class="mb-3 ">
            <label for="nom_img_site" class="form-label">Nom de l'image </label>
            <input type="text" class="form-control" name="nom_img_site" id="nom_img_site" aria-describedby="helpId2" placeholder="" value="<?php echo $nom_image; ?>">
            <small id="helpId2" class="form-text text-muted">Un nom pertinent sans caractères spéciaux et ne commençant pas par un chiffre</small>
         </div>
         <div class="mb-3 ">
            <label for="photo" class="form-label">Image</label>
            <input type="file" class="form-control" name="photo" id="photo" placeholder="" aria-describedby="fileHelpId">
            <div id="fileHelpId" class="form-text">jpeg, jpg, png, gif ou webp. Max 256Mo.</div>
         </div>
         
         <!-- categorie et sous categorie concerné -->
         <!-- category -->
         <div class="mb-3 ">
                <label for="id_cat" class="form-label">Catégorie mise en avant par l'offre</label>
                <select class="form-select form-select-lg" name="id_cat" id="id_cat" oninput="chargementSelect()" > 
                    <option selected>Choisir une option</option>
                    <?php 
                        echo $select_cat;
                    ?>
                </select>
            </div>
            <!-- sous category -->
            <div class="mb-3 ">
                <label for="id_sous_cat" class="form-label">Sous catégorie mise en avant par l'offre</label>
                <select class="form-select form-select-lg" name="id_sous_cat" id="id_sous_cat" >
                    <option selected>Choisir une option</option>
                    <?php 

                        echo $select_sous_cat;
                    ?>
                </select>
            </div>
         <!-- enregistrer -->
         <input type="submit" value="Enregistrer" class="btn btn-primary col-3 ms-auto">
      </div>
   </form>
</div>

<script src="public/assets/js/select_sous_cat.js"></script>