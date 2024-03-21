<?php
include('controler/traitement_contact_gestion.php');
?>
<h3 class="mt-3">Gestion</h3>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th><a href="index.php?page=8&ordre=1">Date</a></th>
                <th><a href="index.php?page=8&ordre=2">Expéditeur</a></th>
                <th>Mail</th>
                <th>Téléphone</th>
                <th>Entreprise</th>
                <th>Catégorie</th>
                <th>Lire</th>
                <th>Répondre</th>
                <th>Lue</th>
                <th>Répondu</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody class="table-group-divider ">
            <?php
                
                echo $table_messages;   
            ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>

<script src="public/assets/js/gestion_repondu.js"></script>