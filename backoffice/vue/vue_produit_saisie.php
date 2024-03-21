<?php
include('controler/traitement_produit_saisie.php');
?>
<h3 class="mt-3">Saisie d'un produit</h3>
<?php
    echo $texte_page_courante;
?>

<div class="row">
    <form action="#" method="post" class="col-8 offset-2 text-start" >
        <div class="row  ">

            <!-- nom produit -->
            <div class="mb-3  ">
              <label for="nom_produit" class="form-label">Nom du produit</label>
              <input type="text" class="form-control" name="nom_produit" id="nom_produit" aria-describedby="helpId1" placeholder="" value="<?php echo $nom_produit; ?>">
              <small id="helpId1" class="form-text text-muted">Entrer le  nom du produit</small>
            </div>
            <!-- description -->
            <div class="mb-3  ">
                <label for="description_produit" class="form-label">Description du produit</label>
                <textarea class="form-control" name="description_produit" id="description_produit" rows="4"><?php echo $description_produit; ?></textarea>
            </div>
            <!-- category caché si update -->
            <div class="mb-3 col-6 <?php if (isset($id_produit)) {echo 'visually-hidden';} ?>">
                <label for="id_cat" class="form-label">Catégorie</label>
                <select class="form-select form-select-lg" name="id_cat" id="id_cat" oninput="chargementSelect()" > 
                    <option selected>Choisir une option</option>
                    <?php 
                        echo $select_cat;
                    ?>
                </select>
            </div>
            <!-- sous category caché si update -->
            <div class="mb-3 col-6 <?php if (isset($id_produit)) {echo 'visually-hidden';} ?>">
                <label for="id_sous_cat" class="form-label">Sous catégorie</label>
                <select class="form-select form-select-lg" name="id_sous_cat" id="id_sous_cat" >
                    <option selected>Choisir une option</option>
                    <?php 

                        echo $select_sous_cat;
                    ?>
                </select>
            </div>
            <!-- prix -->
            <div class="mb-3  col-6">
                <label for="prix_produit" class="form-label">Prix</label>
                <input type="text"
                class="form-control" name="prix_produit" id="prix_produit" aria-describedby="helpId3" placeholder="" value="<?php echo $prix_produit; ?>">
                <small id="helpId3" class="form-text text-muted">Prix à l'unité ou au metre</small>
            </div>
            <!-- promo saisonnière -->
            <div class="mb-3 col-6 ms-3">
                <div class="form-check ">
                    <input class="form-check-input" type="radio" value="1" id="promo_oui" name="promo_saison_produit" <?php if ($promo_saison_produit == 1) {echo 'checked';} ?>>
                    <label class="form-check-label" for="promo_oui">
                        Est dans la promotion saisonnière.
                    </label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" value="0" id="promo_non" name="promo_saison_produit" <?php if ($promo_saison_produit == 0 || $promo_saison_produit == '') {echo 'checked';} ?>>
                    <label class="form-check-label" for="promo_non">
                        N'est pas dans la promotion saisonnière.
                    </label>
                </div>
            </div>
            <!-- poids -->
            <div class="mb-3 col-6">
                <label for="poids_produit" class="form-label">Poids</label>
                <input type="text" class="form-control" name="poids_produit" id="poids_produit" aria-describedby="helpId4" placeholder="" value="<?php echo $poids_produit; ?>">
                <small id="helpId4" class="form-text text-muted">Densité ou poids du produit. 0 si inconnu.</small>
            </div>
            <!-- dimension -->
            <div class="mb-3 col-6">
                <label for="dimension_produit" class="form-label">Dimension</label>
                <input type="text" class="form-control" name="dimension_produit" id="dimension_produit" aria-describedby="helpId5" placeholder="" value="<?php echo $dimension_produit; ?>">
                <small id="helpId5" class="form-text text-muted">Métrage pour tissus, diamètre pour boutons, largeur pour rubans, tailles pour patrons ... Le métrage du tissus sans unité. Ajouter l'unité pour les autres</small>
            </div>
            <!-- composition -->
            <div class="mb-3 col-6">
                <label for="composition_produit" class="form-label">Composition</label>
                <input type="text" class="form-control" name="composition_produit" id="composition_produit" aria-describedby="helpId6" placeholder="" value="<?php echo $composition_produit; ?>">
                <small id="helpId6" class="form-text text-muted">Composition du produit (lin, coton, plastique, ...) avec ou sans pourcentage</small>
            </div>
            <!-- couleur -->
            <div class="mb-3 col-6">
                <label for="couleur_produit" class="form-label">Couleur</label>
                <select class="form-select form-select-lg" name="couleur_produit" id="couleur_produit">
                    <option selected>Choisir une option </option>
                    <?php 

                        echo $select_couleurs;
                    ?>
                </select>
            </div>
            <!-- usage -->
            <div class="mb-3 col-6">
                <label for="usage_produit" class="form-label">Usage</label>
                <select class="form-select form-select-lg" name="usage_produit" id="usage_produit">
                    <option selected>Choisir une option </option>
                    <?php 

                    echo $select_usages;
                    ?>
                </select>
            </div>

            <!-- enregistrer -->
            <input type="submit" value="Enregistrer" class="btn btn-primary col-3 mb-3 ms-auto align-self-end">
        </div>
    </form>
</div>

<script src="public/assets/js/select_sous_cat.js"></script>

