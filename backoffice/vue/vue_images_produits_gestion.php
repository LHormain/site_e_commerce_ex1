<?php
include('controler/traitement_image_produit_gestion.php');
echo $boutons;
?>
<h3 class="mt-3"><?php echo $nom_page;?></h3>
 
<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>Nom</th>
                <th>Produit associé</th>
                <th>Position image</th>
                <!-- <th>Type</th> -->
                <th>Afficher</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                
                echo $table_img_produit;
            ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>

<script src="public/assets/js/input_position.js"></script>
<script src="public/assets/js/gestion_affichage_image.js"></script>