<?php
include('controler/traitement_produit_gestion.php');
?>

<h3 class="mt-3">Gestion des produits </h3>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <caption class="caption-top"><img src="public/assets/img/pictures.png" class="icones_table modifier ajout_img" alt=""> : Produit sans images</caption>
        <thead class="table-primary">
            <tr>
                <th><a href="index.php?page=3&c=2&idcat=<?php echo $id_cat; ?>&ordre=1">Nom</a></th>
                <th>Voir images</th>
                <th>Ajouter une image</th>
                <th>Prix</th>
                <th>Stock</th>
                <th><a href="index.php?page=3&c=2&idcat=<?php echo $id_cat; ?>&ordre=2">Sous catégorie</a></th>
                <th>Promo</th>
                <th>Afficher</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                
                echo $table_produits;
                
            ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>

<script src="public/assets/js/input_stock.js"></script>
<script src="public/assets/js/gestion_affichage_promo.js"></script>
<script src="public/assets/js/gestion_affichage_produit.js"></script>
