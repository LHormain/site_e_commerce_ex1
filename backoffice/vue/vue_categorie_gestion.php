<?php
include('controler/traitement_categorie_gestion.php');
?>
<h3 class="mt-3">Gestion des catégories</h3>

<div class="table-responsive">
    <table class="table table-striped
        table-hover	
        table-bordered
        
        align-middle">
        <thead class="table-primary">
        <!-- <caption>Catégories</caption> -->
            <tr>
                <th>Nom</th>
                <th>Image</th>
                <th>Afficher</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                
                echo $table_cat;
            ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>

<script src="public/assets/js/gestion_affichage_cat.js"></script>