<?php
include('controler/traitement_ateliers_gestion.php');
?>
<h3 class="mt-3">Gestion des ateliers</h3>

<div class="table-responsive">
    <table class="table table-striped
    table-hover	
    table-bordered
    align-middle">
        <thead class="table-primary">
            <!-- <caption>Table Name</caption> -->
            <tr>
                <th>Titre</th>
                <th>Nombre de participant maximum</th>
                <th>Inscriptions</th>
                <th>Prix unitaire</th>
                <th>Images</th>
                <th>Dates</th>
                <th>Descriptif</th>
                <th>Afficher</th>
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

<script src="public/assets/js/gestion_affichage_ateliers.js"></script>