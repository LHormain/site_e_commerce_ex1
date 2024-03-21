<?php
include('controler/traitement_image_produit_saisie.php');
echo $boutons;
?>
<h3 class="mt-3">Saisie d'une image pour le produit : <?php echo $nom_produit['nom_produit']; ?></h3>
<?php
    echo $texte_page_courante;
?>

<h3 class="mt-3">Ajouter une image</h3>

<div class="row">
    <form action="#" method="post" class="col-8 offset-2 text-start" enctype="multipart/form-data">
        <div class="row  ">
             
            <!-- nom image -->
            <div class="mb-3  ">
                <label for="nom_image" class="form-label">Nom de l'image</label>
                <input type="text"
                  class="form-control" name="nom_image" id="nom_image" aria-describedby="helpId1" placeholder="">
                <small id="helpId1" class="form-text text-muted">Entrer le  nom de l'image.Pas de caractères spéciaux ou d'espace.</small>
            </div>
           <!-- fichier image -->
            <div class="mb-3">
              <label for="photo" class="form-label">Choisir un fichier image</label>
              <input type="file" class="form-control" name="photo" id="photo" placeholder="" aria-describedby="fileHelpId">
              <div id="fileHelpId" class="form-text">jpeg, jpg, png, gif ou webp. Max 256Mo.</div>
            </div>
            <!-- enregistrer -->
            <input type="submit" value="Enregistrer" class="btn btn-primary col-3 mb-3 ms-auto align-self-end">
        </div>
    </form>
</div>