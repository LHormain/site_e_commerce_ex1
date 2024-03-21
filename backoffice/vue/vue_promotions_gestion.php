<?php
include('controler/traitement_promotions_gestion.php');
?>

<h3 class="mt-3">Gestion des offres promotionnelles du carousel de la page d'accueil</h3>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>Titre</th>
                <th>Texte</th>
                <th>Image</th>
                <th>Sous catégorie concernée</th>
                <th>Afficher sur l'accueil</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                echo $table;
            ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>
<script src="public/assets/js/gestion_affichage_slides.js"></script>