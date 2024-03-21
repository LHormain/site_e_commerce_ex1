<?php
include('controler/traitement_clients_gestion.php');
?>
<h3 class="mt-3">Gestion</h3>

<div class="table-responsive">
    <table class="table table-striped
    table-hover	
    table-bordered
    align-middle">
        <thead class="table-primary">
            <!-- <caption>Liste des clients</caption> -->
            <tr>
                <th><a href="index.php?page=7&ordre=1">identifiant client</a></th>
                <th>date d'inscription</th>
                <th><a href="index.php?page=7&ordre=2">nom</a></th>
                <th><a href="index.php?page=7&ordre=3">prénom</a></th>
                <th>mail</th>
                <th>Téléphone</th>
                <th>adresse de livraison</th>
                <th>adresse de facturation</th>
                <th>paniers</th>
                <th>commande</th>
                <!-- <th>facture</th> -->
            </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                    echo $table_clients;
                ?>
                
            </tbody>
            <tfoot>
                
            </tfoot>
    </table>
</div>

