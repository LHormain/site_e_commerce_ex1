<?php
include('controler/traitement_sous_categorie_gestion.php');
?>
<h3 class="mt-3">Gestion des produits</h3>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th><a href="index.php?page=32&c=2&ordre=1">Nom</a></th>
                <th>Image</th>
                <th><a href="index.php?page=32&c=2&ordre=2">Catégorie</a></th>
                <th>Afficher</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                
                echo $table_sous_cat;
            ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>

<script src="public/assets/js/gestion_affichage_sscat.js"></script>