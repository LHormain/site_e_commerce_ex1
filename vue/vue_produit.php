<?php  

   include('controler/traitement_produit.php');
?>

<div class="container">
    <div class="row">
        <!-- images produit : carousel -->
        <section class="col-md-6">
            <div id="carouselImage" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators justify-content-evenly">

                    <?php
                        echo $carousel_indicators; 
                    ?>

                </div>
                <div class="carousel-inner">
                    <?php 
                        echo $carousel_inner; 
                    ?>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselImage" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true">
                        <img src="public/assets/img/site/fleche-gauche-dans-un-cercle.png" alt="" class="img-fluid w-100">
                    </span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselImage" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true">
                        <img src="public/assets/img/site/fleche-gauche-dans-un-cercle.png" alt="" class="img-fluid w-100">
                    </span>
                    <span class="visually-hidden">Suivant</span>
                </button>
                
            </div>
        </section>
        <!-- description -->
        <section class="col-md-6 ">
            <h1 class="text-center">
                <?php echo $nom_produit; ?>
            </h1>
            <p class="my-5">
                <?php echo nl2br($description_produit, false); ?>
            </p>
            <div class="row">
                <div class="col-lg-6">
                    <span id="prix"><?php echo $prix; ?></span><span>€</span> <?php echo $cat_prix.$promo; ?>€
                    <br><br>
                    <!-- mettre en favoris -->
                    <?php 
                    if (isset($_SESSION['id_client'])) { // favoris ssi connecté
                        ?>
                        <button type="button" class="btn btn-link card_produit" id="<?php echo $id_produit; ?>" value="<?php echo $_SESSION['id_client']; ?>" >
                            <img src="public/assets/img/icones/<?php echo $image; ?>" alt="" class=" img-fluid icones btn_jaime">
                        </button> 
                        <?php
                    } ?>
                    <br>
                    <span class="produit">Reference :</span> <?php echo $id_produit; ?><br>
                    <!-- ------------------------------------------------------------ -->
                    <!-- Partie qui peut changer en fonction de la catégorie ou sous catégorie du produit -->
                    <!-- ------------------------------------------------------------ -->
                    <?php
                    if ($laize != 0) {
                        echo '
                        <span class="produit">'.$cat_taille.'</span>'.$laize.$cat_taille_unit.'<br>
                        '; 
                    }
                    if ($composition != 0) {
                        echo '
                        <span class="produit">Composition:</span>'.$composition.'<br>';
                    }
                    if ($couleur != 'aucune') {
                        echo'
                        <span class="produit">Couleur :</span> '. $couleur.'<br>
                        ';
                    }
                    if ($poids != 0 && $c == 1) {
                        echo '
                        <span class="produit">Poids :</span> '.$poids.' g/m²<br>';
                    }
                    
                        echo'
                        <span class="produit">Usage :</span> '. $usage.'<br>
                        ';
                     ?>
                    <!-- ------------------------------------------------------------ -->
                </div>
                <div class="col-lg-6">
                    <!-- ------------------------------------------------------------------ -->
                    <!--                       formulaire panier                            -->
                    <!-- ------------------------------------------------------------------ -->
                    <form action="#" method="post">
                    <!-- <form action="index.php?page=62" method="post"> -->
                        <div class="pt-lg-4 input_pp">
                            <label for="quantite_produit">Quantité <?php if (in_array($c, [1,4])){echo '(en m)';} ?>: </label>
                            <button type="button" class="btn btn-button-light" id="btn_moins"><i class="fa-solid fa-minus" style="color: #b47b77;"></i></button>
                            <input type="number" name="quantite_produit" id="quantite_produit" min="1" max="<?php echo $stock_max; ?>" value="1" <?php if (in_array($c, [1,4])) {echo 'step="0.1"';} ?>  >
                            <button type="button" class="btn btn-button-light" id="btn_plus"><i class="fa-solid fa-plus" style="color: #b47b77;"></i></button>
                        </div>
                        <div class="mt-lg-4">
                            <span class="produit" style="<?php echo $dispo_style; ?>"><?php echo $disponibilite; ?></span> 
                        </div>
                        <!-- affichage du prix géré par javascript en fonction de la quantité dans l'input -->
                        <div  class="mt-lg-4">
                            Prix total :<span id="prix_tot"><?php echo $prix; ?> </span> <span>€</span>
                        </div>
                        <!-- input cachés -->
                        <input type="hidden" name="id_produit" id="id_produit" value="<?php echo $id_produit; ?>">
                        <input type="hidden" name="prix_unitaire_produit" value="<?php echo $prix; ?>">
                        <input type="hidden" name="client" id="client" value="<?php if (isset($_SESSION['id_cient'])) {echo $_SESSION['id_client'];}else { echo 'NULL';} ?>">
                        <input type="hidden" name="commande" id="commande" value="<?php echo $_SESSION['id_commande']; ?>">
                        <div class="text-center m-lg-5">
                            <!-- <input type="submit" value="Ajouter au panier" class="btn btn-primary form_submit" <?php if ($stock == 0) { echo 'disabled';} ?>> -->
                            <button type="button" name="" id="" class="btn btn-primary form_submit" <?php if ($stock == 0) { echo 'disabled';} ?>>Ajouter au panier</button>
                        </div>
                    </form>
                    <!-- ------------------------------------------------------------------ -->
                    <!--                               fin panier                           -->
                    <!-- ------------------------------------------------------------------ -->
                </div>
            </div>
        </section>
        <!-- avis clients -->
        <section class="col-lg-12">
            <h2 class="my-5">Avis clients :</h2>
            <div class="row">
                
                <?php
                for ($i = 0; $i < 3; $i++) {
                    echo avisClient(3, '12 janvier 2022', 'Beau tissus', 'Très beau tissus, Même superbe', 'Nom client'); 
                }
                 ?>

            </div>
        </section>
        <!-- suggestion produit -->
        <section class="col-lg-12">
            <h2 class="my-5">Nos suggestions :</h2>
            <!-- <h2 class="my-5">Les clients ont aussi acheté :</h2> -->
            <div class="row">
                <?php
                    echo $cards_suggestions;

                ?>
            </div>
        </section>
    </div>
</div>

<script src="public/assets/js/script_produits.js"></script>
<script src="public/assets/js/add_favoris.js"></script>