<?php
include('controler/traitement_paniers_clients.php');
?>
<div class="container">
    <div class="row align-items-start">
        <div class="table-responsive col mb-5">
            <h1 class="text-center my-5">Mon panier</h1>
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>Nom produit</th>
                        <th>Quantité produit</th>
                        <th>Prix Unitaire (€)</th>
                        <th>Sous-total (€)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table">
                <?php
                    echo $liste_panier;
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3 offset-1 mb-5 border">
            <h2 class="text-center mt-5">Ma commande</h2>
            <div class="row my-5 fw-bold">
                <div class="col offset-1">Prix total HT </div>
                <div class="col-3" id="prix_total"><?php  echo number_format($prix_total,2,',',' '); ?> €</div>
            </div>
            <div class="text-center mb-5">
                <?php  
                    if (isset($_SESSION['id_client'])) {
                        ?>
                        <a href="index.php?page=63&id=<?php echo $id_commande; ?>" class="btn btn-primary" role="button">Commander</a>
                        <?php
                    }
                    else {
                        ?>
                        <a href="index.php?page=6" class="btn btn-primary" role="button">Se connecter pour commander</a>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="public/assets/js/input_quantite.js"></script>