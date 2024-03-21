<?php
include('controler/traitement_offre_gestion.php');
?>
<h3 class="mt-3">Gestion du jumbotron de la page d'accueil concernant l'offre saisonnière</h3>

<h4>Message promotionnelle </h4>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>Titre</th>
                <th>Texte</th>
                <th>Positionnement</th>
                <th>Afficher</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                echo $table_paragraphe;
            ?>
           
           
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>

<h4>Images d'arrière plan</h4>
<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>Nom</th>
                <th>Position</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
                echo $table_image;
            ?>
            
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>

<script src="public/assets/js/gestion_affichage_jumbo.js"></script>